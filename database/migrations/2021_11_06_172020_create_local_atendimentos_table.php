<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalAtendimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_atendimentos', function (Blueprint $table) {
            $table->id(); //id INT(5) NOT NULL,
            $table->string('nome'); //nome_local VARCHAR(100) NULL,
            $table->string('cep'); //cep VARCHAR(8) NULL,
            $table->string('logradouro'); //logradouro VARCHAR(200) NULL,
            $table->integer('numero'); //numero INT(5) NULL,
            $table->string('bairro'); //bairro VARCHAR(50) NULL,
            $table->string('cidade'); //cidade VARCHAR(50) NULL,
            $table->char('uf'); //uf CHAR(2) NULL,
            $table->string('pais'); //pais VARCHAR(50) NULL
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
        Schema::dropIfExists('local_atendimentos');
    }
}
