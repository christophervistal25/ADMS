<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    protected $fillable = ['patient_id', 'occlusion', 'periodontal_condition', 'oral_hygiene', 'denture_upper', 'denture_lower', 'denture_upper_since', 'denture_lower_since', 'abnormalities', 'general_condition', 'physician', 'nature_of_treatment', 'allergies', 'previous_history_bleeding', 'chronic_ailment', 'blood_pressure', 'drugs_taken'];


    public function isOneDay()
    {
    	return ($this->created_at->timestamp - time()) > 8600;
    }

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
    
    public function teeths()
    {
    	return $this->hasMany('App\ExaminationToothChart');
    }



}
