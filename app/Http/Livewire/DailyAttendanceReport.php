<?php

namespace App\Http\Livewire;

use App\Exports\DailyAttendanceReportExport;
use App\Http\Resources\DailyAttendanceReportResource;
use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class DailyAttendanceReport extends Component
{

    use WithPagination;

    public $date = null;
//    public $overTimeLimit = null;

    public function attendanceReportExcel(Request $request)
    {
        $data = $this->filter(false);
        return Excel::download(new DailyAttendanceReportExport(DailyAttendanceReportResource::collection($data)), 'daily-attendance-report.xlsx');
    }

    public function filter($withPaginate = true)
    {
        if (is_null($this->date)) {
            return collect([]);
        }

        $data = User::with([
            'attendance' => fn($query) => $query->where('date', $this->date),
            'company'
        ]);

        if (!$withPaginate) return $data->get();

        return tap($data->paginate(10),function($paginatedInstance){
            return DailyAttendanceReportResource::collection($paginatedInstance->getCollection());
        });

    }

    public function render()
    {
        return view('livewire.daily-attendance-report')->with([
            'employees' => $this->filter(),
        ]);
    }

}
