<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('schedule_name')->nullable();
            $table->string('schedule_type');
            $table->dateTime('schedule_start');
            $table->string('block_1')->nullable();
            $table->string('block_2')->nullable();
            $table->string('block_3')->nullable();
            $table->string('block_4')->nullable();
            $table->string('block_5')->nullable();
            $table->string('block_6')->nullable();
            $table->string('block_7')->nullable();
            $table->integer('start_block')->nullable();
            $table->integer('number_blocks')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_schedules');
    }
}
