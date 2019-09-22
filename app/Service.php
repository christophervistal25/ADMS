<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'price', 'per_each', 'duration'];

    public function appointment()
    {
        return $this->hasOne('App\Appointment');
    }
    
}
