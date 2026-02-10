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
        Schema::create('customer_satisfaction_forms', function (Blueprint $table) {
            $table->id();
            $table->date('submitted_at');
            $table->string('customer_name');
            $table->string('customer_family');
            $table->enum('shipping_method', ['barbari', 'tipax', 'rahmati', 'ghafari', 'nadi', 'hozori']);
            $table->enum('satisfaction_status', ['satisfied', 'unsatisfied']);
            $table->foreignId('assigned_to_user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('created_by_user_id')->constrained('users')->cascadeOnDelete();
            $table->text('referral_note')->nullable();
            $table->text('result')->nullable();
            $table->timestamp('result_filled_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_satisfaction_forms');
    }
};
