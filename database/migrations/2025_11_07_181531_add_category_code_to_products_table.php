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
        Schema::table('products', function (Blueprint $table) {
            // Nếu cột LOAI chưa tồn tại thì thêm
            if (!Schema::hasColumn('products', 'LOAI')) {
                $table->string('LOAI', 20)->nullable(false)->after('MOTA');
            }

            // Nếu cột XOA chưa tồn tại thì thêm
            if (!Schema::hasColumn('products', 'XOA')) {
                $table->tinyInteger('XOA')->default(0)->after('LOAI'); // 0: chưa xóa, 1: đã xóa
            }

            // Tạo foreign key cho LOAI
            $table->foreign('LOAI')->references('MALOAI')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Drop foreign key trước
            if (Schema::hasColumn('products', 'LOAI')) {
                $table->dropForeign(['LOAI']);
            }

            // Drop các cột LOAI và XOA
            if (Schema::hasColumn('products', 'LOAI')) {
                $table->dropColumn('LOAI');
            }

            if (Schema::hasColumn('products', 'XOA')) {
                $table->dropColumn('XOA');
            }
        });
    }
};
