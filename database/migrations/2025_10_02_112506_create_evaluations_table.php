<?php
// database/migrations/2025_01_01_000000_create_evaluations_tables.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // فرم‌ها
        Schema::create('evaluation_forms', function (Blueprint $table) {
            $table->id();
            $table->string('title');             // عنوان فرم
            $table->string('evaluator_role');    // چه کسی پر می‌کنه (User, Manager, Admin, InternalManager)
            $table->string('target_role');       // برای چه کسی هست (User, Manager, Admin, InternalManager)
            $table->unsignedBigInteger('unit_id')->nullable(); // مثلا فروش، انبار، مالی
            $table->timestamps();
        });

        // سوالات
        Schema::create('evaluation_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_id');
            $table->string('title');         // متن سوال
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('form_id')->references('id')->on('evaluation_forms')->onDelete('cascade');
        });

        // پاسخ‌ها
        Schema::create('evaluation_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('user_id');        // ارزیابی‌کننده
            $table->unsignedBigInteger('target_user_id'); // ارزیابی‌شونده
            $table->tinyInteger('score');
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->foreign('question_id')->references('id')->on('evaluation_questions')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('target_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('evaluation_answers');
        Schema::dropIfExists('evaluation_questions');
        Schema::dropIfExists('evaluation_forms');
    }
};
