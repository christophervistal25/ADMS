<?php

use App\ClinicClose;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CloseDaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClinicClose::create([
			'start' => Carbon::parse('2019-09-22 20:56:00')
			'end'   => Carbon::parse('2019-09-22 20:56:00')
        ]);
    }
}
