<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProblemasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problemas', function (Blueprint $table) {
            $table->id(); //id INT(5) NOT NULL,
            $table->string('nome'); //nome_problema VARCHAR(100) NULL,
            $table->string('gravidade'); //gravidade VARCHAR(45) NULL,
            $table->foreignId('tipo_problema_id')->constrained('tipo_problemas')->cascadeOnDelete(); //fk_id_tipo_problema INT(5) NOT NULL
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('problemas');
    }
}
