<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_information', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('patient_id');
            $table->string('nickname');
            $table->integer('age');
            $table->date('birthdate');
            $table->enum('martial_status', ['Single', 'Married', 'Divorced', 'Widowed']);
            $table->enum('sex', ['Women', 'Men', 'Choose not to say']);
            $table->string('occupation');
            $table->string('home_address');
            // $table->string('profile')->default('no_image.png');
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
        Schema::dropIfExists('patient_information');
    }
}
