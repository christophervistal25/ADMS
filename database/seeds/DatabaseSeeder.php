<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // factory('App\Doctor')->create();
        $this->call([
            AccountsSeeder::class,
            DoctorSeeder::class,
            ServiceSeeder::class,
            // CloseDaysSeeder::class,
            // AppointmentSeeder::class,
            // ExaminationRecordSeeder::class,
        ]);
    }
}
