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
        Schema::create('warehouse_to_warehouses', function (Blueprint $table) {
            $table->id();
            $table->string("NGUON_GIAO", 20)->nullable(false);
            $table->string("DIEM_NHAN", 20)->nullable(false);
            $table->string("MASP", 20)->nullable(false);
            $table->integer("SL")->unsigned();
            $table->timestamp("NGIAO")->useCurrent();
            $table->dateTime("NNHAN");
            $table->tinyInteger("XOA")->default(0);
            $table->foreign("NGUON_GIAO")->references("MAKHO")->on("warehouses");
            $table->foreign("DIEM_NHAN")->references("MAKHO")->on("warehouses");
            $table->foreign("MASP")->references("MASP")->on("products");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warehouse_to_warehouses');
    }
};
