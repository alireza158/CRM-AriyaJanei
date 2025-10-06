<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // اگر ستون وجود ندارد، اضافه کن
        if (!Schema::hasColumn('messages', 'seen_at')) {
            Schema::table('messages', function (Blueprint $table) {
                $table->timestamp('seen_at')->nullable()->after('attachment');
            });
        }

        // اگر قبلاً ستون boolean به نام seen داشته‌اید، بک‌فیل کنید
        if (Schema::hasColumn('messages', 'seen')) {
            // هر پیامی که قبلاً seen بوده، زمان دیده‌شدنش را از updated_at یا created_at بگذار
            DB::table('messages')
              ->where('seen', 1)
              ->update(['seen_at' => DB::raw('COALESCE(`updated_at`,`created_at`)')]);
        }
    }

    public function down(): void
    {
        // در صورت نیاز به رول‌بک
        if (Schema::hasColumn('messages', 'seen_at')) {
            Schema::table('messages', function (Blueprint $table) {
                $table->dropColumn('seen_at');
            });
        }
    }
};

