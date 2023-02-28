<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class SampleEmployeeImport implements FromCollection
{

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $sampleArray = [
            collect([
                'name',
                'email',
                'password',
                'employee code',
                'employer name',
                'company code',
                'cnic',
                'Date Of Joining (YYYY-MM-DD)',
                'City'
            ]),
        ];

        foreach (range(1, 4) as $n) {
            array_push($sampleArray,
                collect([
                    'Jhon Doe',
                    "{$n}jhon@doe.com",
                    '12345678',
                    'JD',
                    'Jane Doe',
                    'FS',
                    '42000-0000000-0',
                    '2020-01-01',
                    'Karachi'
                ])
            );
        }
        return collect($sampleArray);
    }

}
