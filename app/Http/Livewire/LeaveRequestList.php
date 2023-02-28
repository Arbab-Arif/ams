<?php

namespace App\Http\Livewire;

use App\Models\EmployeeLeave;
use App\Models\LeaveRequest;
use App\Scopes\CompanyScope;
use App\Scopes\DepartmentScope;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class LeaveRequestList extends Component
{

    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $status = '';

    protected $listeners = [
        'statusUpdate'    => 'statusUpdate',
        'rejectionSubmit' => 'rejectionSubmit',
    ];

    public function rejectionSubmit($id, $status, $reason)
    {
        $leaveRequest = LeaveRequest::findOrfail($id);
        $leaveRequest->update([
            'status' => $status,
            'reason' => $reason
        ]);
    }

    public function statusUpdate($id, $status)
    {
        $leaveRequest = LeaveRequest::with('leaveSetup')->findOrfail($id);
        if ($status === 'APPROVED') {
            $column = Str::slug($leaveRequest->leaveSetup->leave_type, '_');

            $employeeLeave = EmployeeLeave::whereUserId($leaveRequest->user_id)
                ->where($column, '!=', 0)
                ->where($column, '>=', $leaveRequest->days_count)
                ->first();

            $employeeLeave->update([
                $column => $employeeLeave->$column - $leaveRequest->days_count
            ]);
        }
        $leaveRequest->update([
            'status' => $status
        ]);

    }


    protected function filter()
    {
        $leaveRequest = LeaveRequest::with('user', 'leaveSetup');

        if(auth('web')->check()){
            $leaveRequest->where('user_id', auth()->id());
        }

        if ($this->search) {
            $leaveRequest = $leaveRequest
                ->whereHas('user', function ($query) {
                    $query->where('name', 'like', "%{$this->search}%");
                })->orWhereHas('leaveSetup', function ($query) {
                    $query->where('leave_type', 'like', "%{$this->search}%");

                });

        }
        return $leaveRequest
            ->orderBy('id', 'desc')
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.leave-request-list')
            ->with(['leaveRequests' => $this->filter()]);
    }

}
