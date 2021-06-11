<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialEstadoOrdenDeServicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_estado_orden_de_servicio', function (Blueprint $table) {
            $table->id();
            $table->integer('nro_orden_de_servicio');
            $table->string('nombre_estado');
            $table->string('comentario')->nullable();
            $table->timestamps();

            $table->foreign('nro_orden_de_servicio')->references('nro')->on('orden_de_servicio');
            $table->foreign('nombre_estado')->references('nombre')->on('estado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historial_estado_orden_de_servicio');
    }
}
