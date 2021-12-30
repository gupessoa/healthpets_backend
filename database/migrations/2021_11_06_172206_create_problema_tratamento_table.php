<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProblemaTratamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problema_tratamento', function (Blueprint $table) {
            $table->foreignId('problema_id')->constrained('problemas')->cascadeOnDelete(); // id_problema INT(5) NOT NULL,
            $table->foreignId('tratamento_id')->constrained('tratamentos')->cascadeOnDelete(); // id_tratamento INT(5) NOT NULL
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('problema_tratamento');
    }
}
