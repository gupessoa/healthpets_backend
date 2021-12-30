<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id(); //id INT(5) NOT NULL,
            $table->date('data_consulta'); //data_consulta DATE NULL,
            $table->time('horario_consulta'); //horario_consulta TIME NULL,
            $table->string('descricao'); //descricao VARCHAR(200) NULL,
            $table->foreignId('local_atendimento_id')->constrained('local_atendimentos')->cascadeOnDelete(); //fk_id_local_atendimento INT(5) NOT NULL
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
        Schema::dropIfExists('consultas');
    }
}
