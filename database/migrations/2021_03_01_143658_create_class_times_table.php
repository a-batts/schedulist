<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_times', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->default('user');
            $table->string('location', 500)->nullable();
            $table->integer('inherit_from')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('number_of_classes')->default(8);
            $table->string('fixed_start_times')->nullable();
            $table->string('fixed_end_times')->nullable();
            $table->string('Monday', 50)->nullable();
            $table->string('Tuesday', 50)->nullable();
            $table->string('Wednesday', 50)->nullable();
            $table->string('Thursday', 50)->nullable();
            $table->string('Friday', 50)->nullable();
            $table->string('Saturday', 50)->nullable();
            $table->string('Sunday', 50)->nullable();
            $table->timestamps();
            $table->string('schedule_type')->default('normal');
            $table->date('year_end_date')->nullable();
            $table->integer('number_of_blocks')->nullable();
            $table->string('block_style', 40)->nullable();
            $table->integer('starting_block')->nullable();
            $table->date('starting_date')->nullable();
            $table->string('block1')->nullable();
            $table->string('block2')->nullable();
            $table->string('block3')->nullable();
            $table->string('block4')->nullable();
            $table->string('block5')->nullable();
            $table->string('block1_start')->nullable();
            $table->string('block1_end')->nullable();
            $table->string('block2_start')->nullable();
            $table->string('block2_end')->nullable();
            $table->string('block3_start')->nullable();
            $table->string('block3_end')->nullable();
            $table->string('block4_start')->nullable();
            $table->string('block4_end')->nullable();
            $table->string('block5_start')->nullable();
            $table->string('block5_end')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_times');
    }
}
