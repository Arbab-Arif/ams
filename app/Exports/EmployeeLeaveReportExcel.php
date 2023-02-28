<?php

namespace App\Exports;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployeeLeaveReportExcel implements FromCollection
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
            'S.No',
            'Employee Name',
            'T.P',
            'T.C',
            'T.S',
            'T.E',
            'T.M',
            'Other Leave',
            'Total days',
        ]);

        return $this->data;
    }

}
