<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeLeaveReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * \Illuminate\Http\Request  $request
     * @return array
     */

    public function toArray($request)
    {
        return [
            $this->resource->id,
            $this->resource->name,
            round($this->resource->attendance_count / 2),
            optional($this->resource->leaveRequest->get('casual_leave'))->sum('days_count') ?? '0',
            optional($this->resource->leaveRequest->get('sick_leave'))->sum('days_count') ?? '0',
            optional($this->resource->leaveRequest->get('maternity_leave'))->sum('days_count') ?? '0',
            optional($this->resource->leaveRequest->get('earned_leave'))->sum('days_count') ?? '0',
            optional($this->resource->leaveRequest->get('leave'))->sum('days_count') ?? '0',
//            $days
        ];

    }
}
