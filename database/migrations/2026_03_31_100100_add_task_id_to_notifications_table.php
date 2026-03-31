<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->foreignId('task_id')->nullable()->after('leave_id')->constrained('tasks')->nullOnDelete();
            $table->index(['user_id', 'task_id']);
        });
    }

    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'task_id']);
            $table->dropConstrainedForeignId('task_id');
        });
    }
};
