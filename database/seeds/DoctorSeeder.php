<?php

use Illuminate\Database\Seeder;
use App\Doctor;

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
        	'fullname' => 'John Doe',
        	'title' => 'Dr.',
        ]);
    }
}
