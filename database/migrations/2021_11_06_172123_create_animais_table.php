<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animais', function (Blueprint $table) {
            $table->id(); //id INT(5) NOT NULL,
            $table->string('nome'); //nome_animal VARCHAR(100) NULL,
            $table->date('data_nascimento'); //data_nasc DATE NULL,
            //$table->string('cor', 30); //cor VARCHAR(30) NULL,
            $table->string('foto_perfil')->default('/images/icon-512x512.png'); //foto_perfil LONGBLOB NULL,
            $table->foreignId('especie_id')->constrained('especies')->cascadeOnDelete();//fk_id_especie INT(5) NOT NULL,
            $table->foreignId('raca_id')->constrained('racas')->cascadeOnDelete();//fk_id_raca INT(5) NOT NULL
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
        Schema::dropIfExists('animais');
    }
}
