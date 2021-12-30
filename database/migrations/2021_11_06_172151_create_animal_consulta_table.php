<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalConsultaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animal_consulta', function (Blueprint $table) {
            $table->foreignId('animal_id')->constrained('animais')->cascadeOnDelete(); // id_animal INT(5) NOT NULL,
            $table->foreignId('consulta_id')->constrained('consultas')->cascadeOnDelete(); // id_consulta INT(5) NOT NULL
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animal_consulta');
    }
}
