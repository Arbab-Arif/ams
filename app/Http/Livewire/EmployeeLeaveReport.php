<?php

namespace App\Http\Livewire;

use App\Exports\EmployeeLeaveReportExcel;
use App\Http\Resources\EmployeeLeaveReportResource;
use App\Models\Department;
use App\Models\EmployeeLeave;
use App\Models\LeaveRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeLeaveReport extends Component
{

    use WithPagination;

    public $fromDate = null;
    public $toDate = null;
    public $departmentId = null;
    public int $daysCount = 0;

    public function filter()
    {

        if (!$this->fromDate || !$this->toDate) {
            return collect([]);
        }

        $this->daysCount = Carbon::parse($this->fromDate)->diffInDays($this->toDate);

        $dateRange = [
            $this->fromDate,
            $this->toDate
        ];

        return User::query()
            ->with([
                'leaveRequest' => function (HasMany $query) use ($dateRange) {
                    return $query
                        ->with('leaveSetup')
                        ->where('status', 'APPROVED')
                        ->whereBetween('start_date', $dateRange)
                        ->whereBetween('end_date', $dateRange);
                }
            ])
            ->withCount([
                'attendance' => fn($query) => $query->whereBetween('date', $dateRange)
            ])
            ->when(
                $this->departmentId,
                fn($query) => $query->whereDepartmentId($this->departmentId)
            )
            ->get()
            ->map(function ($employee) {
                $leaveRequests = $employee->leaveRequest->groupBy(
                    fn($leaveRequest) => Str::of(optional($leaveRequest->leaveSetup)->leave_type ?? 0)->lower()->slug('_')->__toString()
                );
                unset($employee->leaveRequest);
                $employee['leaveRequest'] = $leaveRequests;
                return $employee;
            });

    }

    public function employeeLeaveReportExcel()
    {
        $data = $this->filter();
        return Excel::download(new EmployeeLeaveReportExcel(EmployeeLeaveReportResource::collection($data)), 'employee-leave-report.xlsx');
    }


    public function render()
    {
        return view('livewire.employee-leave-report')->with([
            'employees'   => $this->filter(),
            'departments' => Department::all(),
        ]);
    }
}
