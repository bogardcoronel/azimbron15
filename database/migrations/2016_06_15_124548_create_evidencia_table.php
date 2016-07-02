<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvidenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evidencia', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_archivo');
            $table->string('mime');
            $table->integer('tamanho_archivo');
            $table->binary('evidencia');
            $table->integer('pago_realizado_id')->unsigned();
            $table->foreign('pago_realizado_id')->references('id')->on('pagos_realizados')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::drop('evidencia');
    }
}
