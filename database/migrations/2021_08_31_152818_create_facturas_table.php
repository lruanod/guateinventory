<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fechafactura');
            $table->string('firma',100);
            $table->unsignedBigInteger('fpago_id');
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('venta_id');
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('tienda_id');
            $table->timestamps();

            $table->foreign('fpago_id')->references('id')->on('fpagos');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('venta_id')->references('id')->on('ventas');
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
        Schema::dropIfExists('facturas');
    }
}
