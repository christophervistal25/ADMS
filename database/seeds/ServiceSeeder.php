<?php

use Illuminate\Database\Seeder;
use App\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Service::create([
    		'name' => 'Filling',
    		'price' => 600,
    		'per_each' => 1,
            'duration' => rand(1,4),
    	]);

    	Service::create([
    		'name' => 'Extraction',
    		'price' => 700,
    		'per_each' => 1,
            'duration' => rand(1,4),
    	]);

    	Service::create([
    		'name' => 'Cleaning',
    		'price' => 800,
    		'per_each' => 0,
            'duration' => rand(1,4),
    	]);

    	Service::create([
    		'name' => 'Denture',
    		'price' => 600,
    		'per_each' => 1,
            'duration' => rand(1,4),
    	]);

    	Service::create([
    		'name' => 'Braces upper and lower',
    		'price' => 50000,
    		'per_each' => 0,
            'duration' => rand(1,4),
    	]);
    }
}
