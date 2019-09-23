<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCloseDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('close_days', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('start')->nullable();
            $table->timestamp('end')->nullable();
            $table->boolean('all_day');
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
        Schema::dropIfExists('close_days');
    }
}
