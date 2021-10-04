<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 1000);
            $table->unsignedBigInteger('owner')->index('events_user_id_foreign');
            $table->string('category', 100);
            $table->string('schedule_id', 10)->nullable();
            $table->date('date');
            $table->string('start_time');
            $table->string('end_time');
            $table->tinyInteger('reoccuring');
            $table->bigInteger('frequency')->nullable();
            $table->string('days')->nullable();
            $table->string('description', 250)->nullable();
            $table->timestamps();
            $table->string('color')->nullable();
            $table->string('shared_with')->nullable();
            $table->tinyInteger('public')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
