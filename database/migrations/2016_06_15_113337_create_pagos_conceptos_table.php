<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosConceptosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'pagos_conceptos', function (Blueprint $table) {
            $table->primary(array('pagos_realizados_id', 'pagos_id'));
            $table->integer('pagos_realizados_id')->unsigned();
            $table->integer('pagos_id')->unsigned();
            $table->foreign('pagos_realizados_id')->references('id')->on('pagos_realizados')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('pagos_id')->references('id')->on('pagos')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pagos_conceptos');
    }
}
