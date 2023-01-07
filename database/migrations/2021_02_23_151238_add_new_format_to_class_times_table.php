<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFormatToClassTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('class_times', function (Blueprint $table) {
            $table->string('block4')->nullable();
            $table->string('block5')->nullable();
            for ($i = 1; $i <= 5; $i++) {
                $table->string('block' . $i . '_start')->nullable();
                $table->string('block' . $i . '_end')->nullable();
            }
            $table->string('fixed_start_times')->default('820,950,1115,1335');
            $table->string('fixed_end_times')->default('935,1105,1325,1450');
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
