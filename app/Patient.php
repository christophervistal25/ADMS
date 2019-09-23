<?php

namespace App;

use App\Patient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Patient extends Authenticatable 
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'mobile_no'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function appointments()
    {
        return $this->belongsToMany('App\Appointment', 'patient_appointment', 'patient_id', 'appointment_id')->withTimestamps();
    }

    public function info()
    {
        return $this->hasOne('App\PatientInformation');
    }

    public static function getAppointments(int $patientId)
    {
         return Patient::with(['appointments' => function ($query) {
            $query->whereDay('start_date' , '>=', date('d'))
                  ->whereYear('start_date' , date('Y'))
                  ->whereMonth('start_date', '>=', date('m'))
                  ->whereTime('start_date', '>=', date('H:i:s'));
        }, 'appointments.service', 'appointments.doctor'])->find($patientId);
    }
}
