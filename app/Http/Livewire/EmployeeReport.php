<?php

namespace App\Http\Livewire;

use App\Exports\EmployeeReportExcel;
use App\Http\Resources\EmployeeReportResource;
use App\Models\Department;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeReport extends Component
{

    use WithPagination;

    public $fromDate = null;
    public $toDate = null;
    public $departmentId = null;

    public function filter($withPaginate = true)
    {
        $employee = User::with('department');

        if (empty($this->departmentId || $this->fromDate || $this->toDate)) {
            return collect([]);
        }

        if ($this->departmentId) {
            $employee = $employee
                ->whereHas('department', function ($query) {
                    $query->where('department_id', 'like', "%{$this->departmentId}%");
                });
        }

        if ($this->fromDate || $this->toDate) {

            $employee = $employee->whereBetween(
                'created_at',
                [
                    (new Carbon($this->fromDate))->subDay(),
                    (new Carbon($this->toDate))->addDay()
                ]
            );
        }


        if (!$withPaginate) return $employee->orderBy('id', 'asc')->get();

        return $employee
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    public function employeeReportExcel()
    {
        $data = $this->filter(false);
        return Excel::download(new EmployeeReportExcel(EmployeeReportResource::collection($data)), 'employee-report.xlsx');
    }


    public function render()
    {
        return view('livewire.employee-report')->with([
            'pdfData'     => $this->filter(false),
            'employees'   => $this->filter(),
            'departments' => Department::all(),
        ]);
    }

}
