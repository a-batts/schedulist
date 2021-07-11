<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('userid')->unique();
            $table->integer('period');
            $table->string('name');
            $table->string('teacher');
            $table->string('teacher_email')->nullable();
            $table->string('class_link');
            $table->bigInteger('color');
            $table->string('g_classroom')->nullable();
            $table->string('blackboard')->nullable();
            $table->string('textbook')->nullable();
            $table->string('ap_classroom')->nullable();
            $table->string('linkone')->nullable();
            $table->string('linkone_name')->nullable();
            $table->string('linktwo')->nullable();
            $table->string('linktwo_name')->nullable();
            $table->string('linkthree')->nullable();
            $table->string('linkthree_name')->nullable();
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
        Schema::dropIfExists('classes');
    }
}
