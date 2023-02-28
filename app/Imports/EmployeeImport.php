<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class EmployeeImport implements ToModel, WithStartRow
{

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new User([
            'name'            => $row[0],
            'company_id'      => session('company_id'),
            'department_id'   => session('department_id'),
            'email'           => $row[1],
            'password'        => bcrypt($row[2]),
            'employee_code'   => $row[3],
            'employer_name'   => $row[4],
            'company_code'    => $row[5],
            'cnic'            => $row[6],
            'dob'             => $row[7],
            'city'            => $row[8],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }

}
