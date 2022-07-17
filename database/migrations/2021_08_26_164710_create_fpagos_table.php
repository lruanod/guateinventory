<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFpagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fpagos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('formapago',45);
            $table->string('estado',45);
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
        Schema::dropIfExists('fpagos');
    }
}
