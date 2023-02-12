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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->date("fecha");
            $table->integer("numero");
            $table->double("total");
            $table->string("estado");
            $table->string("tipo_pago");
            $table->longText("detalles_pago");
            $table->longText("observaciones");
            $table->unsignedBigInteger("paciente_id");
            $table->unsignedBigInteger("profesional_id");
            $table->foreign("paciente_id")->references("id")->on("pacientes")->onDelete("cascade");
            $table->foreign("profesional_id")->references("id")->on("profesionals")->onDelete("cascade");
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
        Schema::dropIfExists('ventas');
    }
};
