<?php

use App\Examination;
use App\ExaminationToothChart;
use App\Patient;
use Illuminate\Database\Seeder;

class ExaminationRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
        $patient = Patient::find(1);
        $examination = new Examination();
        $examination->occlusion             = '1';
        $examination->periodontal_condition =  '1';
        $examination->oral_hygiene          = '1';
        $examination->denture_lower         = '1';
        $examination->denture_upper         = '1';
        $examination->denture_upper_since   = '1';
        $examination->denture_lower_since   = '1';
        $examination->abnormalities         = '1';
        $examination->general_condition     = '1';
        $examination->physician             = '1';
        $examination->nature_of_treatment   = '1';
        $examination->allergies             = '1';
        $examination->history_bleeding      = '1';
        $examination->chronic_ailment       = '1';
        $examination->blood_pressure        = '1';
        $examination->drugs_taken           = '1';

       $examination = $patient->examinations()->save($examination);
       $teeths[] = new ExaminationToothChart([
            'tooth_number'      => '1', 
            'tooth_description' => '1',
            'treatment'         => '1',
            'surface'           => '1',
            'status'            => '1',
        ]);

       $teeths[] = new ExaminationToothChart([
            'tooth_number'      => '2', 
            'tooth_description' => '2',
            'treatment'         => '2',
            'surface'           => '2',
            'status'            => '2',
        ]);

        $examination->teeths()->saveMany($teeths);
        }
}
