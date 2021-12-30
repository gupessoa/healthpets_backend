<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntervaloMedicamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intervalo_medicamento', function (Blueprint $table) {
            $table->foreignId('intervalo_id')->constrained('intervalos')->cascadeOnDelete(); // id_intervalo INT(5) NOT NULL,
            $table->foreignId('medicamento_id')->constrained('medicamentos')->cascadeOnDelete(); // id_medicamento INT(5) NOT NULL
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('intervalo_medicamento');
    }
}
