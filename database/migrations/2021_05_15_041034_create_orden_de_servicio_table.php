<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenDeServicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_de_servicio', function (Blueprint $table) {
            $table->integer('nro')->autoIncrement();
            $table->integer('nro_orden_anterior')->nullable();
            $table->string('motivo_orden');
            $table->text('descripcion_estado_celular');
            $table->text('detalle_reparacion')->nullable();
            $table->text('materiales_necesarios')->nullable();
            $table->double('importe_reparacion', 8, 2)->nullable();
            $table->dateTime('tiempo_de_reparacion')->nullable();
            $table->unsignedBigInteger('imei');
            $table->integer('dni_empleado');
            $table->integer('dni_cliente');
            $table->timestamps();

            $table->foreign('nro_orden_anterior')->references('nro')->on('orden_de_servicio');
            $table->foreign('imei')->references('imei')->on('celular');
            $table->foreign('dni_empleado')->references('dni')->on('empleado')->onUpdate('cascade');
            $table->foreign('dni_cliente')->references('dni')->on('cliente')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orden_de_servicio');
    }
}
