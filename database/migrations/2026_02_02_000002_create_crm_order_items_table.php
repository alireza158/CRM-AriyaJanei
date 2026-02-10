<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('crm_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('crm_order_id')->constrained('crm_orders')->cascadeOnDelete();

            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('variety_id');
            $table->unsignedInteger('quantity')->default(1);

            // قیمت ذخیره‌شده در CRM (برای نمایش)
            $table->unsignedBigInteger('price')->default(0);

            $table->timestamps();

            $table->index(['crm_order_id', 'product_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('crm_order_items');
    }
};
