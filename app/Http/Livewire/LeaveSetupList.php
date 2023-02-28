<?php

namespace App\Http\Livewire;

use App\Models\LeaveSetup;
use Livewire\Component;
use Livewire\WithPagination;

class LeaveSetupList extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';

    protected $listeners = [
        'deleteLeave' => 'deleteLeave'
    ];

    public function deleteLeave($id)
    {
        LeaveSetup::find($id)->delete();
    }

    protected function filter()
    {
        $leaveSetup = LeaveSetup::query();

        if ($this->search) {
            $leaveSetup = $leaveSetup
                ->orWhere('leave_type', 'like', "%{$this->search}%")
                ->orWhereHas('company', function ($query){
                    $query->where('name', 'like', "%{$this->search}%");
                });
        }
        return $leaveSetup
            ->orderBy('id', 'desc')
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.leave-setup-list')->with([
            'leaveSetups' => $this->filter()
        ]);
    }

}
