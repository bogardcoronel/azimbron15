/<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('concepto', 50);
            $table->timestamp('fecha_limite_pago')->nullable();
            $table->decimal('cantidad', 5, 2);
            $table->tinyInteger('opcional');
            $table->timestamps();
        });
    }

    /**
 *    * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pagos');
    }
}
