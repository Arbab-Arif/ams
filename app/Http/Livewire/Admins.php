<?php

namespace App\Http\Livewire;

use App\Models\Admin;
use Livewire\Component;
use Livewire\WithPagination;

class Admins extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $sortField = 'id';
    public $sortAsc = true;
    public $search = '';

    protected $listeners = [
        'adminDeleted' => 'deleteAdmin',
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

    public function deleteAdmin($id)
    {
        Admin::find($id)->delete();
    }

    protected function filter()
    {
        $admin = Admin::query()->where('id', '>', 1);

        if ($this->search) {
            $admin = $admin
                ->where('name', 'like', "%{$this->search}%");
        }
        if (isCompanyAdmin()) {
            $admin = $admin
                ->whereNotNull('department_id');
        }
        return $admin
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.admins')
            ->with([
                'admins' => $this->filter()
            ]);
    }
}
