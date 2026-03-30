<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leaves', function (Blueprint $table) {
            $table->foreignId('substitute_user_id')->nullable()->after('user_id')->constrained('users')->nullOnDelete();
        });

        Schema::table('notifications', function (Blueprint $table) {
            $table->foreignId('leave_id')->nullable()->after('user_id')->constrained('leaves')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropConstrainedForeignId('leave_id');
        });

        Schema::table('leaves', function (Blueprint $table) {
            $table->dropConstrainedForeignId('substitute_user_id');
        });
    }
};
