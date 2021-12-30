<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcedimentosHigieneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedimentos_higiene', function (Blueprint $table) {
            $table->id(); //id INT(5) NOT NULL,
            $table->date('data'); //data DATE NULL,
            $table->time('horario'); //horario TIME NULL,
            $table->foreignId('tipo_procedimento_id')->constrained('tipos_procedimento')->cascadeOnDelete();  //fk_id_tipo_procedimento INT(5) NOT NULL,
            $table->foreignId('local_atendimento_id')->constrained('local_atendimentos')->cascadeOnDelete();  //fk_id_local_atendimento INT(5) NOT NULL
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
        Schema::dropIfExists('procedimentos_higiene');
    }
}
