<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToClassTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('class_times', function (Blueprint $table) {
            $table->string('schedule_type')->default('normal');
            $table->integer('number_of_blocks')->nullable();;
            $table->integer('starting_block')->nullable();;
            $table->date('starting_date')->nullable();;
            $table->string('block1')->nullable();
            $table->string('block2')->nullable();
            $table->string('block3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('class_times', function (Blueprint $table) {
            //
        });
    }
}
