<?php
// database/migrations/2026_02_02_000001_add_lock_fields_to_crm_orders.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('crm_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('locked_by')->nullable()->index()->after('assigned_to');
            $table->timestamp('locked_at')->nullable()->after('locked_by');
            $table->timestamp('lock_expires_at')->nullable()->index()->after('locked_at');

            // اگر جدول users داری:
           $table->foreign('locked_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('crm_orders', function (Blueprint $table) {
            // اگر foreign گذاشتی، اول drop کن
            // $table->dropForeign(['locked_by']);

            $table->dropColumn(['locked_by', 'locked_at', 'lock_expires_at']);
        });
    }
};
