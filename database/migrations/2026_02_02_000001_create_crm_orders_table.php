<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('crm_orders', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            // اگر auth داری:
            $table->unsignedBigInteger('created_by')->nullable()->index();
            $table->unsignedBigInteger('assigned_to')->nullable()->index();

            $table->string('status')->default('draft')->index(); // draft | submitted | canceled

            $table->string('customer_name');
            $table->string('customer_mobile', 20)->index();
            $table->text('customer_address');

            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('city_id')->nullable();

            $table->unsignedBigInteger('shipping_id');
            $table->unsignedBigInteger('shipping_price')->default(0);
            $table->unsignedBigInteger('discount_amount')->default(0);
            $table->unsignedBigInteger('total_price')->default(0);

            // ردیابی ارتباط با آریا
            $table->unsignedBigInteger('ariya_customer_id')->nullable()->index();
            $table->unsignedBigInteger('ariya_address_id')->nullable()->index();
            $table->unsignedBigInteger('ariya_order_id')->nullable()->index();

            // اگر می‌خوای برای embed هم قفل کنی:
            $table->string('embed_token')->nullable()->index();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('crm_orders');
    }
};
