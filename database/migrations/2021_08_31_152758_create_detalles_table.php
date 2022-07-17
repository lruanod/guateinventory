<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cantidad');
            $table->double('preciodetalle',12,2);
            $table->double('preciodetalleven',12,2);
            $table->double('subtotal',12,2);
            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('venta_id');
            $table->unsignedBigInteger('tienda_id');
            $table->timestamps();

            $table->foreign('producto_id')->references('id')->on('productos');
            $table->foreign('venta_id')->references('id')->on('ventas');
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
        Schema::dropIfExists('detalles');
    }
}
