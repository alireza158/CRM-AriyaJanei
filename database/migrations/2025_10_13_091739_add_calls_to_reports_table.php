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
    Schema::table('reports', function (Blueprint $table) {
        $table->integer('successful_calls')->default(0);
        $table->integer('unsuccessful_calls')->default(0);
    });
}

public function down(): void
{
    Schema::table('reports', function (Blueprint $table) {
        $table->dropColumn(['successful_calls', 'unsuccessful_calls']);
    });
}
};
