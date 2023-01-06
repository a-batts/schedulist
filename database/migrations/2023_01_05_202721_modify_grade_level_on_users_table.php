<?php

use App\Models\User;
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
        foreach (User::all() as $user) {
            $user->grade_level = match ($user->grade_level) {
                'other' => 0,
                'es' => 1,
                'ms' => 2,
                'hs' => 3,
                'university' => 4,
                null => null
            };
            $user->save();
        }
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('grade_level')->change();
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
