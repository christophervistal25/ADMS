<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PatientInformation extends Model
{
    protected $fillable = ['patient_id', 'nickname', 'birthdate', 'martial_status', 'sex', 'occupation', 'home_address'];

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }

    public function setBirthdateAttribute($value)
    {
        $this->attributes['birthdate'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function getBirthdateAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }
    
}
