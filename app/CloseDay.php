<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CloseDay extends Model
{
    protected $fillable = ['start', 'end', 'all_day'];
    public $dates = ['start', 'end'];


	public static function allDay()
	{
	  	return self::where(['all_day' => 1])
                    ->whereYear('start', date('Y'))
                    ->get(['start']);
	}

    public static function byTime($month, $day)
    {
        return self::where(['all_day' => 0])
                   ->whereYear('start', date('Y'))
                   ->whereMonth('start', $month)
                   ->whereDay('start', $day)
                   ->get(['start', 'end']);
    }
}
