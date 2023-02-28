<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;

class Companies extends Component
{

    use WithPagination;

    public $perPage = 10;
    public $search = '';

    protected $listeners = [
        'deleteCompany' => 'deleteCompany'
    ];

    public function deleteCompany($id)
    {
        Company::find($id)->delete();
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
        $companies = Company::query();

        if ($this->search) {
            $companies = $companies
                ->where('name', 'like', "%{$this->search}%");
        }
        return $companies
            ->orderBy('id', 'desc')
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.companies')
            ->with([
                'companies' => $this->filter()
            ]);
    }

}
