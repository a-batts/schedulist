<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('classes', function (Blueprint $table) {
          $table->renameColumn('class_link', 'video_link');
          $table->dropColumn(['g_classroom', 'blackboard', 'textbook', 'ap_classroom', 'linkone', 'linkone_name', 'linktwo', 'linktwo_name', 'linkthree', 'linkthree_name']);
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
