<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infos', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->string('descricao');
            $table->boolean('adicionar_lembrete');
            $table->unsignedBigInteger('id_categoria');
            $table->foreign('id_categoria')->references('id')->on('categorias');
            $table->unsignedBigInteger('id_subcategoria');
            $table->foreign('id_subcategoria')->references('id')->on('subcategorias');
            $table->string('local')->nullable();
            $table->double('valor')->nullable();
            $table->time('hora')->nullable();
            $table->boolean('alerta')->default('false');
            $table->unsignedBigInteger('id_animal');
            $table->foreign('id_animal')->references('id')->on('animais');
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
        Schema::dropIfExists('infos');
    }
}
