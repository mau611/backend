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
        Schema::create('consumo_usos', function (Blueprint $table) {
            $table->id();
            $table->date("fecha");
            $table->unsignedBigInteger("ingreso_producto_uso_id");
            $table->foreign("ingreso_producto_uso_id")->references("id")->on("ingreso_producto_usos")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consumo_usos');
    }
};
