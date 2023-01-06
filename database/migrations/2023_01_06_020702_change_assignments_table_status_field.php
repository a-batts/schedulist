<?php

use App\Models\Assignment;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        foreach (Assignment::all() as $assignment) {
            $assignment->status = match ($assignment->status) {
                'inc' => 0,
                'done' => 1,
            };
            $assignment->save();
        }

        Schema::table('assignments', function (Blueprint $table) {
            $table->smallInteger('status')->default(0)->change();
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
};
