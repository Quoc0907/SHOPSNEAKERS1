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
        // Xóa bảng cũ nếu tồn tại
        Schema::dropIfExists('orders');

Schema::create('orders', function (Blueprint $table) {
    $table->id(); // SOHD
    $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // thay MAKH
    $table->string('MANV', 20)->nullable(false)->default('FSE00001');
    $table->decimal('TRIGIA', 15, 2)->nullable(false);
    $table->string('PTVC', 50)->nullable(false)->default('Giao hàng tiêu chuẩn');
    $table->string('token', 100)->nullable(); // có thể null
    $table->date('NGHD')->nullable(false)->default(DB::raw('CURRENT_DATE')); // mặc định ngày hiện tại
    $table->string('TRANGTHAI', 30)->nullable(false)->default('cho-xac-nhan');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
