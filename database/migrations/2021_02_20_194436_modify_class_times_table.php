<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyClassTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('class_times', function (Blueprint $table) {
            $table->string('m')->default('async');
            $table->string('tu')->default('async');
            $table->string('w')->default('async');
            $table->string('th')->default('async');
            $table->string('f')->default('async');
            $table->string('sa')->default('async');
            $table->string('su')->default('async');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
