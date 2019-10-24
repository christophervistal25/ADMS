<?php 
namespace App\Http\Repositories;

use App\Appointment;
use App\CloseDay;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Collection;

class AppointmentRepository
{
	protected $appointment;
    public const MAX_HOURS_OF_APPOINTMENT = 4;


	public function __construct(Appointment $appointment)
	{
		$this->appointment = $appointment;
	}

	public function availables($date, $duration, $appointments)
	{
		list($month, $day, $year) = explode('-', $date);

		$date      = Carbon::parse($year . $month . $day . '08:00');
		$morning   = $this->generateTimePeriod($date, $duration, 'morning');

		$date      = Carbon::parse($year . $month . $day . '13:00');
		$afternoon = $this->generateTimePeriod($date, $duration, 'afternoon');

		$timePeriods = $this->getAvailables(array_merge($morning, $afternoon), $appointments);

		return array_values(array_unique($this->filterByTimeClose($timePeriods, $month, $day)));
	}

	private function filterByTimeClose($timePeriods, $month, $day)
	{
		$timeClose = CloseDay::getBy($month, $day);
		 foreach ($timeClose as $time) {

            foreach ($timePeriods as $result) {
                $splitted = explode('|', $result);
                $start  = Carbon::parse($splitted[0]);
                $end    = Carbon::parse($splitted[1]);

                if ($start->between($time->start, $time->end) && $end->between($time->start, $time->end)) {
                    $index = array_search($result, $timePeriods);
                    unset($timePeriods[$index]);
                } 

            }

       }
       return $timePeriods;
	}

	private function getAvailables(array $results = [], $appointments)
	{
		$exists = [];
		foreach ($results as $result) {
			list($createdStart, $createdEnd) = explode('|', $result);
			$startGenerated                  = Carbon::parse($createdStart);
			$endGenerated                    = Carbon::parse($createdEnd);

           foreach ($appointments as $appointment) {
				$start = Carbon::parse($appointment->start_date);
				$end   = Carbon::parse($appointment->end_date);

                if ( $startGenerated->between($start, $end) && $endGenerated->between($start, $end) 
                	|| $start->between($startGenerated, $endGenerated) && $end->between($startGenerated, $endGenerated) ) {
					$exists[] = $startGenerated . '|' . $endGenerated . '|exists';
					$index    = array_search($result, $results);
					unset($results[$index]);
                } 

           }

       }

       return array_values(array_merge($results, $exists));
	}

	private function generateTimePeriod($date, $increment, $greet)
	{
		$results = [];
		$end = ($greet === 'morning') ? 13 : 18;
		$noOfIteration = (int) floor(self::MAX_HOURS_OF_APPOINTMENT / $increment);

		foreach (range(1, $noOfIteration) as $index => $value) {
			$startTime   = $date->format('H:00');
			$endTime     = $date->addHour($increment)->format('H:00');
			if ($endTime >= $end) { break; }
			$results[]   =  $date->format('Y-m-d ') . $startTime . '|' . $date->format('Y-m-d ') . $endTime;
		}

		return $results;
	}


}
