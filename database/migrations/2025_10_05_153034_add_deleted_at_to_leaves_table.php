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
    Schema::table('leaves', function (Blueprint $table) {
        $table->softDeletes(); // ستون nullable deleted_at اضافه می‌کند
    });
}

public function down(): void
{
    Schema::table('leaves', function (Blueprint $table) {
        $table->dropSoftDeletes(); // ستون deleted_at را حذف می‌کند
    });
}

};
