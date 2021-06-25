<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCelularTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('celular', function (Blueprint $table) {
            $table->unsignedBigInteger('imei');
            $table->string('nombre_marca');
            $table->string('nombre_modelo');
            $table->timestamps();

            $table->foreign('nombre_marca')->references('nombre')->on('marca')->onUpdate('cascade');
            $table->foreign('nombre_modelo')->references('nombre')->on('modelo')->onUpdate('cascade');

            $table->primary(['imei', 'nombre_marca', 'nombre_modelo']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('celular');
    }
}
