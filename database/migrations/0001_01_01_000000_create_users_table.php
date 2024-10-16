<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('user_name');
            $table->string('password');
            $table->bigInteger('phone_number');
            $table->string('gender');
            $table->string('message');
            $table->unsignedBigInteger('grade_id');
            $table->string('profile_picture');
            $table->string('role')->default('user');
            $table->string('status')->default('de-active');
            $table->boolean('is_verified')->default(0);
            $table->boolean('is_approved')->default(0);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('grade_id')->references('id')->on('grades');
        });

        Schema::create('hobbies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('mail_verifications', function (Blueprint $table) {
            $table->id();
            $table->longText('token');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hobbies');
        Schema::dropIfExists('mail_verifications');
        Schema::dropIfExists('users');
        Schema::dropIfExists('grades');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
