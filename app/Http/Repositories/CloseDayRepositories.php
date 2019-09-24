<?php 
namespace App\Http\Repositories;

use Carbon\Carbon;

class CloseDayRepositories
{
	/**
	 * 8 is equal to the two combination of max hours
	 * for morning and afternoon appointment
	 */
	public function isAllDay(Carbon $start, Carbon $end)
	{
		return ($end->diffInHours($start) - 1) >= 8 ? 1 : 0;
	}

}
