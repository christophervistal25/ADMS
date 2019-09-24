<?php

use App\ClinicClose;
use App\CloseDay;
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
        // CloseDay::create([
        //     'start' => Carbon::parse(date('Y-m-d', strtotime('+2 day')) . ' 08:00:00 AM'),
        //     'end'   => Carbon::parse(date('Y-m-d', strtotime('+2 day')) . ' 10:00:00 AM'),
        //     'all_day' => 1,
        // ]);

        // CloseDay::create([
        //     'start' => Carbon::parse(date('Y-m-d') . ' 08:00:00 AM'),
        //     'end'   => Carbon::parse(date('Y-m-d') . ' 10:00:00 AM'),
        //     'all_day' => 0,
        // ]);
    }
}
