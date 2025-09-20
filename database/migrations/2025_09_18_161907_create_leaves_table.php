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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // کارمند
            $table->foreignId('manager_id')->nullable()->constrained('users'); // مدیر واحد
            $table->foreignId('accountant_id')->nullable()->constrained('users'); // حسابدار
            $table->foreignId('super_manager_id')->nullable()->constrained('users'); // مدیریت کل

            $table->string('leave_type'); // مرخصی ساعتی / روزانه
            $table->text('start_date');
            $table->text('end_date')->nullable();
            $table->text('start_time')->nullable();
            $table->text('end_time')->nullable();
            $table->text('reason')->nullable();

            $table->enum('status', [
                'pending',       // ثبت‌شده
                'manager_approved',
                'manager_rejected',
                'accounting_approved',
                'accounting_rejected',
                'final_approved',
                'final_rejected',
            ])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
