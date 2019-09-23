<?php

use Illuminate\Database\Seeder;
use App\Appointment;
use Carbon\Carbon;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$date = date('Y-m-d');

    		Appointment::create([
	        	'service_id' => 1,
	        	'doctor_id' => 1,
				'start_date' => Carbon::parse($date . ' 08:00:00 AM'),
				'end_date'   => Carbon::parse($date . '09:00:00 AM')
        	]);	

        	Appointment::create([
	        	'service_id' => 1,
	        	'doctor_id' => 1,
				'start_date' => Carbon::parse($date . ' 09:00:00 AM'),
				'end_date'   => Carbon::parse($date . '10:00:00 AM')
        	]);	

        	Appointment::create([
	        	'service_id' => 1,
	        	'doctor_id' => 1,
				'start_date' => Carbon::parse($date . ' 10:00:00 AM'),
				'end_date'   => Carbon::parse($date . '11:00:00 AM')
        	]);

        	Appointment::create([
	        	'service_id' => 1,
	        	'doctor_id' => 1,
				'start_date' => Carbon::parse($date . ' 11:00:00 AM'),
				'end_date'   => Carbon::parse($date . '12:00:00 PM')
        	]);

        	Appointment::create([
	        	'service_id' => 1,
	        	'doctor_id' => 1,
				'start_date' => Carbon::parse($date . ' 01:00:00 PM'),
				'end_date'   => Carbon::parse($date . '02:00:00 PM')
        	]);

        	/*Appointment::create([
	        	'service_id' => 1,
	        	'doctor_id' => 1,
				'start_date' => Carbon::parse($date . ' 04:00:00 PM'),
				'end_date'   => Carbon::parse($date . '05:00:00 PM')
        	]);*/
    }
}
