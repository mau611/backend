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
        Schema::create('ingreso_productos', function (Blueprint $table) {
            $table->id();
            $table->date("fecha");
            $table->double("PrecioCompra");
            $table->double("PrecioVenta");
            $table->integer("cantidad");
            $table->unsignedBigInteger("producto_id");
            $table->foreign("producto_id")->references("id")->on("productos")->onDelete("cascade");
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
        Schema::dropIfExists('ingreso_productos');
    }
};
