<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class DailyAttendanceReportResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $company = $this->resource->company;
        $overTimeLimit = ($company->type === 'flexible') ? $company->hours : (new Carbon($company->time_in))->diffInHours($company->time_out);
        $overTime = '';
        if ($this->resource->attendance->count() >= 2) {
            $overTime = calculateFlexibleTime(
                $this->resource->attendance->first()->date,
                $this->resource->attendance->first()->time,
                $this->resource->attendance->last()->time,
                $overTimeLimit
            );
        }
        return [
            'company_name' => $company->name,
            'department_name' => $this->resource->department->name,
            'employee_name' => $this->resource->name,
            'time_in' => $this->resource->attendance->count() ? $this->resource->attendance->first()->time : 'N/A',
            'time_out' => $this->resource->attendance->count() ? $this->resource->attendance->last()->time : 'N/A',
            'overtime' => $overTime,
            'attendance' => $this->resource->attendance->count() ? 'P' : 'A'
        ];

    }

}
