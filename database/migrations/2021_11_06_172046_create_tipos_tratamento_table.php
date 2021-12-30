<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposTratamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_tratamento', function (Blueprint $table) {
            $table->id(); //id INT(5) NOT NULL,
            $table->string('descricao'); //descricao VARCHAR(100) NULL,
            $table->string('periodicidade'); //periodicidade VARCHAR(100) NULL
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
        Schema::dropIfExists('tipos_tratamento');
    }
}
