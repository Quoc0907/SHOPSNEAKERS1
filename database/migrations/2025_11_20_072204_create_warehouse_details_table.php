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
        Schema::create('warehouse_details', function (Blueprint $table) {
            $table->string("MAKHO", 20)->nullable(false);
            $table->string("MASP", 20)->nullable(false);
            $table->integer("SL")->unsigned()->default(0);
            $table->primary(["MAKHO", "MASP"]);
            $table->foreign("MAKHO")->references("MAKHO")->on("warehouses");
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
        Schema::dropIfExists('warehouse_details');
    }
};
