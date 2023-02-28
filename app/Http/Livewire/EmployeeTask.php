<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeTask extends Component
{

    use WithPagination;

    public $perPage = 10;
    public $sortField = 'id';
    public $sortAsc = true;
    public $search = '';

    protected $listeners = [
        'taskCompleted' => 'completeTask',
    ];

    public function sortBy($field)
    {
        if ($this->sortField == $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function completeTask(Task $task)
    {
        $task->update([
            'status'      => !$task->status,
            'complete_at' => date('Y-m-d h:m')
        ]);
    }

    protected function filter()
    {
        $task = Task::query()->whereUserId(auth()->user()->id);

        if ($this->search) {
            $task = $task
                ->where('title', 'like', "%{$this->search}%");
        }
        return $task
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.employee-task')
            ->with([
                'tasks' => $this->filter()
            ]);
    }

}
