<?php

namespace App\Exports;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;

class DailyAttendanceReportExport implements FromCollection
{

    /**
     * @return \Illuminate\Support\Collection
     */

    public $data = [];

    public function __construct($data)
    {

        $this->data = $data;

    }

    public function collection()
    {
        $this->data->prepend([
            'Company',
            'Department',
            'Employee Name',
            'Time In',
            'Time Out',
            'Overtime',
            'Attendance'
        ]);

        return $this->data;
    }

}
