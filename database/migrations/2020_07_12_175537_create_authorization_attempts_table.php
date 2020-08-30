<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorizationAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authorization_attempts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('application_id');
            $table->foreignId('user_id')->nullable();

            $table->string('authorization_attempt_id')->unique();
            $table->string('status');
            $table->timestamp('expires_at');
            $table->timestamps();

            $table->foreign('application_id')
              ->references('id')
              ->on('applications');
            $table->foreign('user_id')
              ->references('id')
              ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authorization_attempts');
    }
}
