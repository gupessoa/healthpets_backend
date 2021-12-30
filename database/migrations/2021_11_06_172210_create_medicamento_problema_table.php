<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicamentoProblemaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicamento_problema', function (Blueprint $table) {
            $table->foreignId('problema_id')->constrained('problemas')->cascadeOnDelete(); // id_problema INT(5) NOT NULL,
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
        Schema::dropIfExists('medicamento_problema');
    }
}
