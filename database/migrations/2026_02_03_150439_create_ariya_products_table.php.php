<?php

// database/migrations/xxxx_xx_xx_create_ariya_products_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('ariya_products', function (Blueprint $table) {
      $table->id();

      $table->unsignedBigInteger('ariya_id')->unique(); // product id از آریا
      $table->string('title');
      $table->bigInteger('base_price')->default(0);
      $table->integer('base_quantity')->default(0)->index(); // اگر محصول بدون مدل بود
      $table->boolean('has_varieties')->default(false);

      $table->timestamp('synced_at')->nullable();
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('ariya_products');
  }
};
