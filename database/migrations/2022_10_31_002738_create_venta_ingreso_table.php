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
        Schema::create('venta_ingresos', function (Blueprint $table) {
            $table->id();
            $table->integer("subtotal");
            $table->integer("cantidad");
            $table->unsignedBigInteger("ingreso_id");
            $table->unsignedBigInteger("venta_id");
            $table->foreign("ingreso_id")->references("id")->on("ingreso_productos")->onDelete("cascade");
            $table->foreign("venta_id")->references("id")->on("ventas")->onDelete("cascade");
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
        Schema::dropIfExists('venta_producto');
    }
};
