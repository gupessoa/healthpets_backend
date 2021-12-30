<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalProcedimentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animal_procedimento', function (Blueprint $table) {
            $table->foreignId('animal_id')->constrained('animais')->cascadeOnDelete(); // id_animal INT(5) NOT NULL,
            $table->foreignId('procedimento_id')->constrained('procedimentos_higiene')->cascadeOnDelete(); // id_procedimento INT(5) NOT NULL
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animal_procedimento');
    }
}
