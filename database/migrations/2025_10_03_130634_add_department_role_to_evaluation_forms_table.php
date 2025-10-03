<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('evaluation_forms', function (Blueprint $table) {
            $table->string('department_role')->nullable()->after('target_role');
        });
    }

    public function down()
    {
        Schema::table('evaluation_forms', function (Blueprint $table) {
            $table->dropColumn('department_role');
        });
    }

};
