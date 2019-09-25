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
        // $this->call(UsersTableSeeder::class);
        $this->call([
            AccountsSeeder::class,
            ServiceSeeder::class,
            CloseDaysSeeder::class,
            // AppointmentSeeder::class,
        ]);
    }
}
