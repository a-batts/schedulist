<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->mediumText('name')->change();
            $table->smallInteger('category')->change();
            $table->dropColumn('reoccuring');
            $table->text('days')->change();
            $table->dropColumn('description');
            $table->date('end_date')->nullable();
            $table
                ->integer('frequency')
                ->default(0)
                ->change();
            $table->mediumInteger('interval')->default(1);
            $table->dropColumn('schedule_id');
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
};
