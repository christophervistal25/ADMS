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
        $service = $this->service;
        $patient = $service->appointment->patients[0];

        return [
            'id'        => $this->id,
            'title'     => $this->service->name . ' - ' . $this->service->appointment->patients[0]->name,
            'start'     => $this->start_date->format('Y-m-d H:i:s'),
            'end'       => $this->end_date->format('Y-m-d H:i:s'),
            'service'   => [
                'id'       => $service->id,
                'name'     => $service->name,
                'price'    => $service->price,
                'duration' => $service->duration,
            ],
            'patient'   => [
                'id'        => $patient->id,
                'name'      => $patient->name,
                'email'     => $patient->email,
                'mobile_no' => $patient->mobile_no,
            ],
            
        ];
        // return parent::toArray($request);
    }
}
