<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['service_id', 'doctor_id', 'start_date', 'end_date'];
    public $timestamps  = false;
    protected $dates    = ['start_date', 'end_date'];


    public function patients()
    {
        return $this->belongsToMany('App\Patient', 'patient_appointment', 'appointment_id', 'patient_id')->withPivot('code')->withTimestamps();
    }

    public function service()
    {
        return $this->belongsTo('App\Service');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Doctor');
    }

}
