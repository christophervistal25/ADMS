<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['title'];

    public function patients()
    {
        return $this->belongsToMany('App\Patient', 'patient_appointment', 'appointment_id', 'patient_id')->withTimestamps();
    }
}
