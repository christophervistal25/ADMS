<?php

use Illuminate\Database\Seeder;

use App\Patient;
use App\PatientInformation;
use App\Admin;

class AccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $patient = Patient::create([
            'firstname' => 'John',
            'middlename' => 'Foo',
            'lastname' => 'Doe',
            'email' => 'christophervistal26@gmail.com',
            'password' => 1234,
            'mobile_no' => '09193693499'
        ]);

        PatientInformation::create([
            'patient_id'     => $patient->id,
            'nickname'       => 'User',
            'birthdate'      => '1997-01-06 18:04:00',
            'martial_status' => 'Single',
            'sex'            => 'Men',
            'age'            => 22,
            'occupation'     => 'Programmer',
            'home_address'   => 'Tandag City',
        ]);

    
        Admin::create([
            'name' => 'Administrator Apit',
            'email' => 'admin@yahoo.com',
            'password' => 1234,
        ]);
    }
}
