<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplateVacinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_vacinas', function (Blueprint $table) {
            $table->id(); //id INT(5) NOT NULL,
            $table->string('nome'); //nome_vacina VARCHAR(45) NULL,
            $table->integer('frequencia');//frequencia_vacina INT NULL
            $table->foreignId('especie_id')->constrained('especies')->cascadeOnDelete();
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
        Schema::dropIfExists('template_vacinas');
    }
}
