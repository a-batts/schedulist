<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateClassesTableFields extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('classes', function (Blueprint $table) {
            $table->mediumText('location')->change();
            $table->mediumText('name')->change();
            $table->mediumText('teacher')->change();
            $table->mediumText('teacher_email')->change();
            $table->mediumText('video_link')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }
}
