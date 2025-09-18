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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete(); // حذف کاربر باعث حذف تسک‌ها می‌شود
            $table->string('title'); // عنوان تسک
            $table->text('description')->nullable(); // توضیحات اختیاری
            $table->date('date'); // تاریخ تسک
            $table->boolean('completed')->default(false); // وضعیت انجام شده
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
