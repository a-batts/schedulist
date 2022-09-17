<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddScheduleIdRowToClassesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('classes', function (Blueprint $table) {
            $table->foreignId('schedule_id')->nullable()->constrained();
            $table->text('class_location')->change();
            $table->renameColumn('class_location', 'location');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('classes', function (Blueprint $table) {
            //
        });
    }
}
