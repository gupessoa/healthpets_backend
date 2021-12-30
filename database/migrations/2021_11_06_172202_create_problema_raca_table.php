<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProblemaRacaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problema_raca', function (Blueprint $table) {
            $table->foreignId('raca_id')->constrained('racas')->cascadeOnDelete(); // id_raca INT(5) NOT NULL,
            $table->foreignId('problema_id')->constrained('problemas')->cascadeOnDelete(); // id_problema INT(5) NOT NULL
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('problema_raca');
    }
}
