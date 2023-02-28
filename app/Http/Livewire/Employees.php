<?php

namespace App\Http\Livewire;

use App\Exports\SampleEmployeeImport;
use App\Imports\EmployeeImport;
use App\Models\LeaveSetup;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Employees extends Component
{

    use WithPagination, WithFileUploads;

    public $perPage = 10;
    public $sortField = 'id';
    public $sortAsc = true;
    public $customerIds = [];
    public $search = '';
    public $excelImportFile = null;

    protected $listeners = [
        'employeeResign' => 'employeeResign',
        'employeeDelete' => 'employeeDelete',
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

    public function employeeDelete($id)
    {
        User::find($id)->delete();
    }

    public function save()
    {
        $this->validate([
            'excelImportFile' => 'file|max:10240'
        ]);

        ini_set('max_execution_time', '-1');

        $leaveSetup = LeaveSetup::all();

        if (count($leaveSetup) == 0) {
            return redirect()->back()->with('message', 'Please Create Leave Setup First');
        }

        Excel::import(new EmployeeImport(), $this->excelImportFile);

        $this->excelImportFile = null;
    }

    public function employeeResign(User $user)
    {
        $user->update([
            'status' => !$user->status
        ]);
    }

    public function sampleDownload()
    {
        return Excel::download(new SampleEmployeeImport(), 'employee.xlsx');
    }

    protected function filter()
    {
        $employee = User::query();

        if ($this->search) {
            $employee = $employee
                ->where('name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%")
                ->orWhere('employer_name', 'like', "%{$this->search}%")
                ->orWhere('employee_code', 'like', "%{$this->search}%")
                ->orWhere('company_code', 'like', "%{$this->search}%")
                ->orWhere('cnic', 'like', "%{$this->search}%");
        }
        return $employee
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
    }

    public function impersonate($userId)
    {
        $originalId = auth('admin')->id();

        auth('admin')->logout();

        session()->put('impersonate', $originalId);

        auth()->loginUsingId($userId);

        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.employees')->with(['employees' => $this->filter()]);
    }

}
