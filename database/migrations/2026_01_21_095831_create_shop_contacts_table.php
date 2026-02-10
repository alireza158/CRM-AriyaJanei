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
      Schema::create('shop_contacts', function (Blueprint $table) {
    $table->id();

    $table->string('visitor_name',100);
    $table->string('city',60);
    $table->enum('relation_type',['مرتبط','غیر مرتبط']);

    $table->string('address',200);
    $table->decimal('lat',10,7)->nullable();
    $table->decimal('lng',10,7)->nullable();

    $table->string('shop_name',120);
    $table->string('owner_name',120);
    $table->string('owner_phone',30);

    $table->string('cooperation_interest',50);

    // مرتبط
    $table->string('activity_field',100)->nullable();
    $table->string('shop_size',50)->nullable();
    $table->string('shop_location',50)->nullable();
    $table->string('shop_grade',150)->nullable();
    $table->json('main_goods')->nullable();
    $table->string('arya_customer',20)->nullable();
    $table->string('payment_terms',20)->nullable();

    // غیر مرتبط
    $table->string('nr_activity',120)->nullable();
    $table->string('nr_activity_other',120)->nullable();
    $table->json('nr_goods')->nullable();
    $table->string('nr_goods_other',200)->nullable();

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_contacts');
    }
};
