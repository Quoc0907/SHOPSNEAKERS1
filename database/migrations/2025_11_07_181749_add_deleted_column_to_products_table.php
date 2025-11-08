<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Thêm cột LOAI và XOA nếu chưa có
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'LOAI')) {
                $table->string('LOAI', 20)->after('MOTA');
            }

            if (!Schema::hasColumn('products', 'XOA')) {
                $table->tinyInteger('XOA')->default(0)->after('LOAI');
            }
        });

        // Thêm foreign key LOAI -> categories.MALOAI
        // Kiểm tra xem foreign key đã tồn tại chưa bằng query MySQL
        $fkExists = DB::select("
            SELECT CONSTRAINT_NAME 
            FROM information_schema.KEY_COLUMN_USAGE 
            WHERE TABLE_SCHEMA = DATABASE() 
            AND TABLE_NAME = 'products' 
            AND COLUMN_NAME = 'LOAI' 
            AND REFERENCED_TABLE_NAME = 'categories'
        ");

        if (empty($fkExists)) {
            Schema::table('products', function (Blueprint $table) {
                $table->foreign('LOAI')->references('MALOAI')->on('categories')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Xóa foreign key nếu tồn tại
        $fkExists = DB::select("
            SELECT CONSTRAINT_NAME 
            FROM information_schema.KEY_COLUMN_USAGE 
            WHERE TABLE_SCHEMA = DATABASE() 
            AND TABLE_NAME = 'products' 
            AND COLUMN_NAME = 'LOAI' 
            AND REFERENCED_TABLE_NAME = 'categories'
        ");

        if (!empty($fkExists)) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropForeign(['LOAI']);
            });
        }

        // Xóa cột LOAI và XOA nếu tồn tại
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'LOAI')) {
                $table->dropColumn('LOAI');
            }
            if (Schema::hasColumn('products', 'XOA')) {
                $table->dropColumn('XOA');
            }
        });
    }
};
