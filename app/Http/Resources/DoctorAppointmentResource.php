<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorAppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'    => $this->id,
            'title' => $this->service->appointment->patients[0]->name . ' - ' . $this->service->name,
            'start' => $this->start_date->format('Y-m-d H:i:s'),
            'end'   => $this->end_date->format('Y-m-d H:i:s')
        ];
        // return parent::toArray($request);
    }
}
