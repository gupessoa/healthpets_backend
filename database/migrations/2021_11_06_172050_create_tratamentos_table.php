<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTratamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tratamentos', function (Blueprint $table) {
            $table->id(); //id INT(5) NOT NULL,
            $table->date('data_inicio'); //data_inicio DATE NULL,
            $table->date('data_fim'); //data_fim DATE NULL,
            $table->string('descricao'); //descricao VARCHAR(100) NULL,
            $table->foreignId('consulta_id')->constrained('consultas')->cascadeOnDelete(); //fk_id_consultas INT(5) NOT NULL,
            $table->foreignId('tipo_tratamento_id')->constrained('tipos_tratamento')->cascadeOnDelete(); //fk_id_tipo_tratamento INT(5) NOT NULL
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
        Schema::dropIfExists('tratamentos');
    }
}
