<?php

use Illuminate\Database\Seeder;

use App\Patient;
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
        Patient::create([
            'name' => 'Christopher Vistal',
            'email' => 'christophervistal26@gmail.com',
            'password' => bcrypt(1234),
        ]);

        Admin::create([
            'name' => 'Administrator Vistal',
            'email' => 'admin@yahoo.com',
            'password' => bcrypt(1234),
        ]);
    }
}
