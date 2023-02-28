<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;

class Tasks extends Component
{

    use WithPagination;

    public $perPage = 10;
    public $sortField = 'id';
    public $sortAsc = true;
    public $search = '';

    protected $listeners = [
        'taskDeleted' => 'deleteTask',
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

    public function deleteTask($id)
    {
        Task::find($id)->delete();
    }

    protected function filter()
    {
        $task = Task::query();

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
        return view('livewire.tasks')
            ->with([
                'tasks' => $this->filter()
            ]);
    }

}
