<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fechaventa');
            $table->double('impuesto',12,2);
            $table->double('descuento',12,2);
            $table->double('total',12,2);
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('tienda_id');
            $table->timestamps();


            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->foreign('tienda_id')->references('id')->on('tiendas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
}
