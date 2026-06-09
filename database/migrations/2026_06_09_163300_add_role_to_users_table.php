<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['collector', 'artist', 'admin'])->default('collector')->after('email');
            $table->boolean('email_verified')->default(false)->after('role');
            $table->string('google_id')->nullable()->after('email_verified');
            $table->string('avatar')->nullable()->after('google_id');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'email_verified', 'google_id', 'avatar']);
        });
    }
};