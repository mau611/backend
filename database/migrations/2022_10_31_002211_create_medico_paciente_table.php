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
        Schema::create('medico_paciente', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("medico_id");
            $table->unsignedBigInteger("paciente_id");
            $table->foreign("medico_id")->references("id")->on("medicos")->onDelete("cascade");
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
        Schema::dropIfExists('medico_paciente');
    }
};
