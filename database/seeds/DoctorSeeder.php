<?php

use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Doctor::create([
        	'name' => 'John Doe',
        	'title' => 'Dr.',
        ]);
    }
}
