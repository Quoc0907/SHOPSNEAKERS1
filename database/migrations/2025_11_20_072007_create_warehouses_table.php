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
        Schema::create('warehouses', function (Blueprint $table) {
            $table->string("MAKHO", 20)->nullable(false)->primary();
            $table->string("TENKHO", 40)->nullable(false)->unique();
            $table->string("DCHI", 50)->nullable(false);
            $table->string("SODT", 20)->nullable(false);
            $table->tinyInteger("XOA")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warehouses');
    }
};
