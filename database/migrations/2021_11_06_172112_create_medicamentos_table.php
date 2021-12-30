<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicamentos', function (Blueprint $table) {
            $table->id(); //id INT(5) NOT NULL,
            $table->string('nome'); //nome_medicamento VARCHAR(50) NULL,
            $table->string('dosagem'); //dosagem VARCHAR(45) NULL,
            $table->string('frequencia'); //frequencia VARCHAR(45) NULL,
            $table->time('horario'); //horario TIME NULL,
            $table->foreignId('tipo_id')->constrained('tipos_medicamentos')->cascadeOnDelete(); //fk_id_tipo_medicamento INT(5) NOT NULL,
            $table->foreignId('medida_id')->constrained('medidas_dosagem')->cascadeOnDelete(); //fk_id_medida_dosagem INT(5) NOT NULL
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
        Schema::dropIfExists('medicamentos');
    }
}
