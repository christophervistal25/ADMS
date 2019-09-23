<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = ['fullname', 'title', 'active'];

    public function appointments()
    {
        return $this->hasMany('App\Appointment');
    }

    public static function scopeActive($query)
    {
    	return $query->where('active', '!=', 'in-active');
    }
}
