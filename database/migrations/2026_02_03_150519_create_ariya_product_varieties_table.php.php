<?php
// database/migrations/xxxx_xx_xx_create_ariya_product_varieties_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('ariya_product_varieties', function (Blueprint $table) {
      $table->id();

      $table->foreignId('ariya_product_id')->constrained('ariya_products')->cascadeOnDelete();

      $table->unsignedBigInteger('ariya_variety_id')->nullable()->index(); 
      // برای placeholder که مدل ندارد می‌تواند null باشد

      $table->string('model_name')->default('-');      // اسم مدل یا "-"
      $table->string('unique_key')->nullable();        // unique_attributes_key
      $table->bigInteger('price')->default(0);
      $table->integer('quantity')->default(0);

      $table->boolean('is_placeholder')->default(false);

      $table->timestamp('synced_at')->nullable();
      $table->timestamps();

      // جلوگیری از تکرار: هر محصول یا یک variety واقعی یا یک placeholder
      $table->unique(['ariya_product_id', 'ariya_variety_id']);
    });
  }

  public function down(): void {
    Schema::dropIfExists('ariya_product_varieties');
  }
};
