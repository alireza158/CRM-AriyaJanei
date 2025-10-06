<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
public function up(): void
{
Schema::create('request_tickets', function (Blueprint $table) {
$table->id();
$table->foreignId('user_id')->constrained()->cascadeOnDelete();
$table->string('title');
$table->text('description')->nullable();


// وضعیت‌ها: pending, manager_approved, final_approved, manager_rejected, internal_rejected
$table->string('status')->default('pending');


// جهت رهگیری تاییدکنندگان
$table->foreignId('manager_id')->nullable()->constrained('users')->nullOnDelete();
$table->foreignId('super_manager_id')->nullable()->constrained('users')->nullOnDelete();


$table->timestamps();
// $table->softDeletes(); // درصورت نیاز
});
}


public function down(): void
{
Schema::dropIfExists('request_tickets');
}
};