<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id(); // khóa chính tự tăng
            $table->string('MASP', 20); // khóa ngoại tham chiếu đến products
            $table->foreign('MASP')
                  ->references('MASP')
                  ->on('products')
                  ->onDelete('cascade');
            
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            
            $table->tinyInteger('rating')->unsigned(); // điểm đánh giá (1-5)
            $table->text('comment')->nullable(); // nội dung bình luận
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
