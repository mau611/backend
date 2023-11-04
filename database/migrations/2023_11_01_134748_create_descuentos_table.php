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
        Schema::create('descuentos', function (Blueprint $table) {
            $table->id();
            $table->string("descripcion");
            $table->boolean("porcentaje");
            $table->integer("cantidad_descuento");
            $table->boolean("activo");
            $table->boolean("conCaducidad");
            $table->date("fecha_caducidad")->nullable();
            $table->boolean("producto");
            $table->boolean("servicio");
            $table->integer("serv_o_prod_id");
            $table->unsignedBigInteger("paciente_id");
            $table->foreign("paciente_id")->references("id")->on("pacientes")->onDelete("cascade");
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
        Schema::dropIfExists('descuentos');
    }
};
