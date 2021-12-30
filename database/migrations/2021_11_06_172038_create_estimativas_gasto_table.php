<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstimativasGastoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimativas_gasto', function (Blueprint $table) {
            $table->id(); //id INT(5) NOT NULL,
            $table->float('valor_estimado', 5, 2); //valor_estimado FLOAT(5,2) NULL,
            $table->date('inicio_estimativa'); //inicio_estimativa DATE NULL,
            $table->date('fim_estimativa'); //fim_estimativa DATE NULL
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
        Schema::dropIfExists('estimativas_gasto');
    }
}
