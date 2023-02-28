<?php

namespace App\Http\Livewire;

use App\Models\Department;
use Livewire\Component;
use Livewire\WithPagination;

class Departments extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';

    protected $listeners = [
        'deleteDepartment' => 'deleteDepartment'
    ];

    public function deleteDepartment($id)
    {
        Department::find($id)->delete();
    }

    public function sortBy($field)
    {
        if ($this->sortField == $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    protected function filter()
    {
        $department = Department::query();

        if ($this->search) {
            $department = $department
                ->where('name', 'like', "%{$this->search}%");
        }
        return $department
            ->orderBy('id', 'desc')
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.departments')
            ->with([
                'departments' => $this->filter()
            ]);
    }

}
