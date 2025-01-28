<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    const TABLE_NAME_ROLES = 'roles';
    const TABLE_NAME_USERS = 'users';
    const TABLE_NAME_USER_ROLES = 'user_roles';
    const TABLE_NAME_PASSWORD_RESET_TOKENS = 'password_reset_tokens';
    const TABLE_NAME_SESSIONS = 'sessions';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(static::TABLE_NAME_ROLES, function (Blueprint $table) {
            $table->uuid('role_id')->primary();
            $table->string('name')->unique();
            $table->string('description');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create(static::TABLE_NAME_USERS, function (Blueprint $table) {
            $table->uuid('user_id')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->uuid('primary_role')->nullable();
            $table->foreign('primary_role')->references('role_id')->on(static::TABLE_NAME_ROLES)->onDelete('set null');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create(static::TABLE_NAME_USER_ROLES, function (Blueprint $table) {
            $table->uuid('user_id');
            $table->uuid('role_id');
            $table->foreign('user_id')->references('user_id')->on(static::TABLE_NAME_USERS)->onDelete('cascade');
            $table->foreign('role_id')->references('role_id')->on(static::TABLE_NAME_ROLES)->onDelete('cascade');

            $table->primary(['user_id', 'role_id']);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create(static::TABLE_NAME_PASSWORD_RESET_TOKENS, function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create(static::TABLE_NAME_SESSIONS, function (Blueprint $table) {
            $table->string('id')->primary();
            $table->uuid('user_id')->nullable()->index();
            $table->foreign('user_id')->references('user_id')->on(static::TABLE_NAME_USERS)->onDelete('cascade');
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
        Schema::dropIfExists(static::TABLE_NAME_SESSIONS);
        Schema::dropIfExists(static::TABLE_NAME_PASSWORD_RESET_TOKENS);
        Schema::dropIfExists(static::TABLE_NAME_USER_ROLES);
        Schema::dropIfExists(static::TABLE_NAME_USERS);
        Schema::dropIfExists(static::TABLE_NAME_ROLES);

    }
};
