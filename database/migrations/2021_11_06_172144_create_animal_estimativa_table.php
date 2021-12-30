<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalEstimativaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animal_estimativa', function (Blueprint $table) {
            $table->foreignId('animal_id')->constrained('animais')->cascadeOnDelete(); // id_animal INT(5) NOT NULL,
            $table->foreignId('estimativa_gasto_id')->constrained('estimativas_gasto')->cascadeOnDelete(); // id_estimativa_gasto INT(5) NOT NULL
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animal_estimativa');
    }
}
