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
       // database/migrations/xxxx_create_embed_tokens_table.php
Schema::create('embed_tokens', function (Blueprint $table) {
    $table->id();
    $table->string('token', 64)->unique();
    $table->string('name')->nullable(); // مثلا نام مشتری/سایت
    $table->timestamp('expires_at')->nullable();
    $table->boolean('active')->default(true);
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('embed_tokens');
    }
};
