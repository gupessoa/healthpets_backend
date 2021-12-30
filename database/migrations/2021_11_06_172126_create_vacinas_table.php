<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacinas', function (Blueprint $table) {
            $table->id(); //id INT(5) NOT NULL,
            $table->string('nome'); //nome VARCHAR(45) NULL,
            $table->date('data_aplicacao'); //data_aplicacao DATE NULL,
            $table->string('fabricante')->nullable(); //fabricante VARCHAR(45) NULL,
            $table->string('lote')->nullable(); //lote VARCHAR(20) NULL,
            $table->foreignId('animal_id')->constrained('animais')->cascadeOnDelete(); //fk_id_animal INT(5) NOT NULL #duvida
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
        Schema::dropIfExists('vacinas');
    }
}
