<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReforcosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reforcos', function (Blueprint $table) {
            $table->id(); //id INT(5) NOT NULL,
            $table->integer('dia_alternado'); //a_cada INT(5) NULL,
            $table->string('dia_especifico'); //periodo VARCHAR(45) NULL,
            $table->foreignId('vacina_id')->constrained('vacinas')->cascadeOnDelete(); //fk_id_vacina INT(5) NOT NULL #MudarParaaTabelaVacina
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
        Schema::dropIfExists('reforcos');
    }
}
