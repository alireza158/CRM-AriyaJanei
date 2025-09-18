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
            $table->enum('status', ['draft', 'submitted', 'read'])
                ->default('draft')
                ->after('description');
            $table->timestamp('submitted_at')
                ->nullable()
                ->after('status');
            $table->text('feedback')
                ->nullable()
                ->after('submitted_at');
            $table->tinyInteger('rating')
                ->nullable()
                ->after('feedback');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn(['status', 'submitted_at', 'feedback', 'rating']);
        });
    }
};
