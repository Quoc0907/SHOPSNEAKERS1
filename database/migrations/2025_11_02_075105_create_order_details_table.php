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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id(); // khóa chính tự tăng
            
            // Khóa ngoại tới bảng orders
            $table->foreignId('order_id')
                  ->constrained('orders')
                  ->onDelete('cascade');
            
            // Khóa ngoại tới bảng products
            $table->string('MASP', 20);
            $table->foreign('MASP')
                  ->references('MASP')
                  ->on('products')
                  ->onDelete('cascade');
            
            // Các thông tin chi tiết đơn hàng
            $table->integer('SL')->unsigned(); // số lượng
            $table->integer('GIAGOC')->unsigned(); // giá gốc
            $table->integer('GIABAN')->unsigned(); // giá bán
            
            $table->timestamps(); // thời gian tạo và cập nhật
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
