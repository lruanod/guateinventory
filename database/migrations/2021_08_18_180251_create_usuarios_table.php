<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('usuario',45);
            $table->string('nombre',100);
            $table->string('direccion',100);
            $table->string('email',100)->unique();
            $table->string('rol',45);
            $table->string('cui',20)->unique();
            $table->string('tel',45);
            $table->string('estado',45);
            $table->string('pass',45);
            $table->unsignedBigInteger('tienda_id');
            $table->timestamps();

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
        Schema::dropIfExists('usuarios');
    }
}
