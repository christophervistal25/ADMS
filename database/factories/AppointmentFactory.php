<?php

use App\Appointment;
use Faker\Generator as Faker;

$factory->define(Appointment::class, function (Faker $faker) {
    return [
			'name' => 'Christopher Vistal',
            'email' => 'christophervistal26@gmail.com',
            'password' => 1234,
            'mobile_no' => '09193693499'
    ];
});
