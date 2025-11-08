<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            
            // User ID
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            
            // Sản phẩm (tham chiếu bằng MASP chứ không phải id)
            $table->string('MASP', 20);
            $table->foreign('MASP')
                  ->references('MASP')
                  ->on('products')
                  ->onDelete('cascade');
            
            // Số lượng sản phẩm
            $table->integer('quantity')->unsigned();
            
            // Tổng giá
            $table->decimal('price', 10, 2)->nullable(false);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
