<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo',45);
            $table->string('nombre',100);
            $table->double('precio',12,2);
            $table->string('descripcion',100);
            $table->string('marca',45);
            $table->integer('stock');
            $table->string('estado',45);
            $table->unsignedBigInteger('medida_id');
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('tienda_id');
            $table->timestamps();

            $table->foreign('medida_id')->references('id')->on('medidas');
            $table->foreign('categoria_id')->references('id')->on('categorias');
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
        Schema::dropIfExists('productos');
    }
}
