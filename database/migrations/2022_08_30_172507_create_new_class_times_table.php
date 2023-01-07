<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewClassTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_times', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id')->constrained();
            $table->foreignId('class_id')->constrained();
            $table->integer('day_of_week');
            $table->string('start_time', 5);
            $table->string('end_time', 5);
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
        Schema::dropIfExists('new_class_times');
    }
}
