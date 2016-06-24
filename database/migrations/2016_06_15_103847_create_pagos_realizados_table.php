<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosRealizadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos_realizados', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('cantidad_pagada');
            $table->timestamp('fecha_reporte_pago');
            $table->timestamp('fecha_de_pago');
            $table->integer('condominio_id')->unsigned();
            $table->integer('estatus_id')->unsigned();
            $table->string('comentarios','255')->nullable();
            $table->foreign('condominio_id')->references('id')->on('condominios')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('estatus_id')->references('id')->on('estatus')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::drop('pagos_realizados');
    }
}
