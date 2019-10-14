<?php 
namespace App\Http\Repositories;

use App\CloseDay;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class CloseDayRepositories
{
	protected $model;

	public function __construct(CloseDay $model)
	{
		$this->model = $model;
	}

	public function dateIsInRange(Carbon $start, Carbon $end)
	{
	  	return $this->model->whereDate('start', $start)
                            ->whereTime('start', '<=', $start)
                            ->whereTime('end', '>=', $end)
                            ->exists();
	}

	public function hasDateRange(Carbon $start, Carbon $end) : int
	{
		return $end->diffInDays($start);
	}

	private function isSunday($date)
	{
		return Carbon::parse($date)->dayOfWeek == Carbon::SUNDAY;
	}

	private function getClosingTime($date)
	{
		return Carbon::parse($date . ' 5:00:00 PM');
	}

	private function getOpeningTime($date)
	{
		return Carbon::parse($date . ' 8:00:00 AM');	
	}

	public function addCloseDay(array $data = [])
	{
		if (!$this->isSunday($data['start'])) {
             return $this->model->create($data);
        }
	}

	private function isFirstOrLastDate($date, $startOrEnd)
	{
		return $date->get('day') === $startOrEnd->get('day');
	}

	/**
	 * THERE'S A BUG CAUSE WE HAVE AN LOOP
	 * SO THERE ARE SOME DATES IN CALENDAR THAT DOESN'T HAVE 32 OR 33 >=
	 * ALREADY FIX BY CREATING PERIOD OR RANGE USING CARBON PERIOD.
	 */
	public function insertAllDatesFromRange(Carbon $start, Carbon $end)
	{
		$period = CarbonPeriod::create($start, $end);
		// Needs a validation here.
		foreach ($period as $date) {
			$currentDate = $date->format('Y-m-d');
			if ($this->isFirstOrLastDate($date, $start)) {
				$data = ['start' => $start, 'end' => $this->getClosingTime($currentDate)];
			} else if ($this->isFirstOrLastDate($date, $end)) {
				$data = ['start' => $this->getOpeningTime($currentDate), 'end' => $end];
			} else {
                $data = ['start' => $this->getOpeningTime($currentDate), 'end' => $this->getClosingTime($currentDate)];
			}
           $this->addCloseDay($data);
		}
	}


}
