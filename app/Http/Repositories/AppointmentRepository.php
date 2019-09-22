<?php 
namespace App\Http\Repositories;

use App\Appointment;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class AppointmentRepository
{
	// TODO FIND THE VACANT TIME

	protected $appointment;
    public const MAX_HOURS_OF_APPOINTMENT_IN_MORNING   = 4;
    public const MAX_HOURS_OF_APPOINTMENT_IN_AFTERNOON = 4;


	public function __construct(Appointment $appointment)
	{
		$this->appointment = $appointment;
	}

	public function getMaxHoursInMorning()
	{
		return self::MAX_HOURS_OF_APPOINTMENT_IN_MORNING;
	}

	public function getMaxHoursInAfternoon()
	{
		return self::MAX_HOURS_OF_APPOINTMENT_IN_AFTERNOON;
	}

	private function has($results, string $greeting)
	{
		return array_key_exists($greeting, $results);
	}

	private function getGreetingResult(array $results, string $greeting, int $duration)
	{
		$hours = ($greeting == 'morning') ? self::MAX_HOURS_OF_APPOINTMENT_IN_MORNING : self::MAX_HOURS_OF_APPOINTMENT_IN_MORNING;
		return (array_sum($results[$greeting]['result']) + $duration) > $hours ? false : true;
	}

	private function getVacantGreeting(array $results = [], int $duration)
	{
		$results = [
				'morning'   => $this->has($results, 'morning') ? $this->getGreetingResult($results, 'morning', $duration) : true,
				'afternoon' => $this->has($results, 'afternoon') ? $this->getGreetingResult($results, 'afternoon', $duration) : true,
		];	
		return array_filter($results);
	}

	public function findAvailableFor(Collection $dates, string $duration)
	{
		$results = [];
		$generatedVacantTime = [];
		foreach ($dates as $key => $date) {
			$end       = Carbon::parse($date->end_date);
			$start     = Carbon::parse($date->start_date);
			$session = $start->format('H') >= '12'  ? 'afternoon' : 'morning';
			$results[$session]['start'][]  = $start->format('H');
			$results[$session]['end'][]    = $end->format('H');
			$results[$session]['result'][] = $end->diffInHours($start);
		}
		

		$vacants = $this->getVacantGreeting($results, $duration);

		if (count($vacants) > 0) {
			foreach (array_keys($vacants) as $vacant) {
				$method = 'getMaxHoursIn' . ucfirst($vacant);

				if (!$this->has($results, 'morning') && $vacant === 'morning') {
					$lastTime = 8;
					for($i = 0; $i<=($this->$method() - $duration); $i+=$duration)
					{
						// End time
						$endTime = $lastTime + $duration;

						$generatedVacantTime['morning'][] = $lastTime  . ' - ' . $endTime;

						// Change the current end time
						$lastTime  = $endTime;
					}
				} 

				if (!$this->has($results, 'afternoon') && $vacant === 'afternoon') {
					$lastTime = 13;
					for($i = 0; $i<=($this->$method() - $duration); $i+=$duration)
					{
						// End time
						$endTime = $lastTime + $duration;

						$generatedVacantTime['afternoon'][] = $lastTime  . ' - ' . $endTime;

						// Change the current end time
						$lastTime  = $endTime;
					}
				}
				
				// If there's already an appoint in morning and afternoon
				if ($this->has($results, 'morning') && $this->has($results, 'afternoon') ) {
					for($i = 1; $i<= ($this->$method() - array_sum($results[$vacant]['result'])); $i+=$duration)
					{
						// Get the last end time this will need an OrderBy in Query
						$lastTime = end($results[$vacant]['end']);

						// 17 is the closing time of the store.
						if ($lastTime != 17) {
							// End time
							$endTime = $lastTime + $duration;

							$generatedVacantTime[$vacant][] = $lastTime  . ' - ' . $endTime;

							// Remove the last value in current end time
							array_pop($results[$vacant]['end']);

							// Push the new end time
							array_push($results[$vacant]['end'], $endTime);
						} else { // Meron ng naka book sa last which is 4-5 but depends on the service.

							$lastTime = end($results[$vacant]['start']);

							// End time
							$endTime = $lastTime - $duration;
							
							$generatedVacantTime[$vacant][] = $endTime  . ' - ' . $lastTime;

							// Remove the last value in current end time
							array_shift($results[$vacant]['start']);

							// Push the new end time
							array_unshift($results[$vacant]['start'], $endTime);
						}
					}	
				}
			}	
		} else {
			return [];
		}

		return $generatedVacantTime;
	}

}
