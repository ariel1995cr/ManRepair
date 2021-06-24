<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModeloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modelo', function (Blueprint $table) {
            $table->string('nombre');
            $table->string('nombre_marca');
            $table->date('fecha_lanzamiento')->nullable();
            $table->string('foto')->nullable();

            $table->foreign('nombre_marca')->references('nombre')->on('marca')->onUpdate('cascade')->onDelete('cascade');;
            $table->softDeletes();

            $table->primary(['nombre', 'nombre_marca']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modelo');
    }
}
