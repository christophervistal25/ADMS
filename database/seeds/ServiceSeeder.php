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
            'duration' => 1,
    	]);

    	Service::create([
    		'name' => 'Extraction',
    		'price' => 700,
    		'per_each' => 1,
            'duration' => 2,
    	]);

    	Service::create([
    		'name' => 'Cleaning',
    		'price' => 800,
    		'per_each' => 0,
            'duration' => 3,
    	]);

    	Service::create([
    		'name' => 'Denture',
    		'price' => 600,
    		'per_each' => 1,
            'duration' => 4,
    	]);

    	Service::create([
    		'name' => 'Braces upper and lower',
    		'price' => 50000,
    		'per_each' => 0,
            'duration' => rand(1,4),
    	]);
    }
}
