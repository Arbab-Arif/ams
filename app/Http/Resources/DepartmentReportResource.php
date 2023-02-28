<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $date = date('Y-d-m h:m:s', strtotime($this->resource->created_at));
        return [
            $this->resource->id,
            $date,
            $this->resource->name,
            $this->resource->users->count(),
        ];

    }
}
