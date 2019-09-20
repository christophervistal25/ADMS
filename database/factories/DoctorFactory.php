<?php
use App\Doctor;
use Faker\Generator as Faker;

$factory->define(Doctor::class, function (Faker $faker) {
    return [
        'fullname' => $faker->name,
        'title'    => $faker->title
    ];
});
