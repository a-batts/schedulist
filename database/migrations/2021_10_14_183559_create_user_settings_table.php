<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSettingsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::dropIfExists('user_settings');

        Schema::create('user_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('account_alert_emails')->default(true);
            $table->boolean('account_alert_texts')->default(true);
            $table->boolean('assignment_emails')->default(false);
            $table->boolean('assignment_texts')->default(true);
            $table->boolean('event_emails')->default(false);
            $table->boolean('event_texts')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('user_settings');
    }
}
