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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->date("fecha");
            $table->integer("numero");
            $table->double("total");
            $table->string("estado_pago");
            $table->string("forma_pago");
            $table->string("detalles_pago");
            $table->string("digitos_tarjeta")->nullable();
            $table->unsignedBigInteger("consulta_id");
            $table->foreign("consulta_id")->references("id")->on("consultas")->onDelete("cascade");
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
        Schema::dropIfExists('facturas');
    }
};
