<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExaminationToothChartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examination_tooth_charts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('examination_id');
            $table->integer('tooth_number');
            $table->string('surface');
            $table->string('tooth_description');
            $table->string('treatment');
            $table->string('status');
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
        Schema::dropIfExists('examination_tooth_charts');
    }
}
