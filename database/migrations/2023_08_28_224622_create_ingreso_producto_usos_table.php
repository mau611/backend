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
        Schema::create('ingreso_producto_usos', function (Blueprint $table) {
            $table->id();
            $table->date("fecha_ingreso");
            $table->integer("existencias");
            $table->integer("precio_compra");
            $table->unsignedBigInteger("productos_uso_id");
            $table->foreign("productos_uso_id")->references("id")->on("productos_usos")->onDelete("cascade");
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
        Schema::dropIfExists('ingreso_producto_usos');
    }
};
