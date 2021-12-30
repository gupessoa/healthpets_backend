<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicamentoTratamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicamento_tratamento', function (Blueprint $table) {
            $table->foreignId('tratamento_id')->constrained('tratamentos')->cascadeOnDelete(); // id_tratamento INT(5) NOT NULL,
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
        Schema::dropIfExists('medicamento_tratamento');
    }
}
