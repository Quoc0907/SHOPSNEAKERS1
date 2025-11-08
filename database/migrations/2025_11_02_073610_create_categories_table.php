<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->string('MALOAI', 20)->primary(); // Khóa chính
            $table->string('TENLOAI', 40)->unique(); // Tên loại - duy nhất
            $table->string('HINHANH', 100);
            $table->text('MOTA')->nullable(); // Mô tả có thể bỏ trống
            $table->timestamps(); // Theo dõi thời gian tạo/cập nhật
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
