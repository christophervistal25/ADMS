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
        $patient = $this->patients[0];

        return [
            'id'        => $this->id,
            'title'     => $this->service->name . ' - ' . $patient->firstname . '' . $patient->middlename . ' ' . $patient->lastname . ' (' . $patient->patient_number . ')' ,
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
                'firstname'      => $patient->firstname,
                'middlename'      => $patient->middlename,
                'lastname'      => $patient->lastname,
                'email'     => $patient->email,
                'mobile_no' => $patient->mobile_no,
                'age'       => $patient->info->age,
            ],
            
        ];
        // return parent::toArray($request);
    }
}
