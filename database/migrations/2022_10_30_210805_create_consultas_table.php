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
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("start");
            $table->string("end");
            $table->unsignedBigInteger("paciente_id");
            $table->unsignedBigInteger("tipo_consulta_id");
            $table->unsignedBigInteger("consultorio_id");
            $table->unsignedBigInteger("estado_cita_id");
            $table->unsignedBigInteger("profesional_id");
            $table->foreign("paciente_id")->references("id")->on("pacientes")->onDelete("cascade");
            $table->foreign("tipo_consulta_id")->references("id")->on("tipo_consultas")->onDelete("cascade");
            $table->foreign("consultorio_id")->references("id")->on("consultorios")->onDelete("cascade");
            $table->foreign("estado_cita_id")->references("id")->on("estado_citas")->onDelete("cascade");
            $table->foreign("profesional_id")->references("id")->on("profesionals");
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
        Schema::dropIfExists('consultas');
    }
};
