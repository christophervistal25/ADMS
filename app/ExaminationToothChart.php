<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExaminationToothChart extends Model
{
    protected $fillable = ['examination_id', 'surface', 'tooth_number', 'tooth_description', 'treatment', 'status'];

    public function examination()
    {
        return $this->belongsTo('App\Examination');
    }
}
