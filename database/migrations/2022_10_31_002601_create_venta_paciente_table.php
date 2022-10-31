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
        Schema::create('venta_paciente', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("venta_id");
            $table->unsignedBigInteger("paciente_id");
            $table->foreign("venta_id")->references("id")->on("ventas")->onDelete("cascade");
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
        Schema::dropIfExists('venta_paciente');
    }
};
