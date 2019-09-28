<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExaminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examinations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('patient_id');
            $table->string('occlusion');
            $table->string('periodontal_condition');
            $table->string('oral_hygiene');
            $table->boolean('denture_upper')->default(0);
            $table->boolean('denture_lower')->default(0);
            $table->string('denture_upper_since')->nullable();
            $table->string('denture_lower_since')->nullable();
            $table->string('abnormalities');
            $table->string('general_condition');
            $table->string('physician');
            $table->string('nature_of_treatment');
            $table->string('allergies');
            $table->string('history_bleeding');
            $table->string('chronic_ailment');
            $table->string('blood_pressure');
            $table->string('drugs_taken');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('examinations');
    }
}
