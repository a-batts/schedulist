<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->integer('userid');
            $table->integer('classid');
            $table->string('assignment_name');
            $table->integer('duemonth');
            $table->integer('duedate');
            $table->integer('duehr')->default(23);
            $table->integer('duemin')->default(59);
            $table->string('assignment_link');
            $table->string('description')->nullable();
            $table->string('status')->default('incomplete');
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
        Schema::dropIfExists('assignments');
    }
}
