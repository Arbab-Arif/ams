<?php

namespace App\Http\Livewire;

use App\Exports\DepartmentReportExcel;
use App\Http\Resources\DepartmentReportResource;
use App\Models\Department;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class DepartmentReport extends Component
{

    use WithPagination;

    public function filter()
    {
        return Department::with('users')
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    public function departmentReportExcel()
    {
        $data = $this->filter();
        return Excel::download(new DepartmentReportExcel(DepartmentReportResource::collection($data)), 'department-report.xlsx');
    }

    public function render()
    {
        return view('livewire.department-report')->with([
            'reports' => $this->filter()
        ]);
    }

}
