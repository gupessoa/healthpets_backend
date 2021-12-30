<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntervalosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intervalos', function (Blueprint $table) {
            $table->id(); //id INT(5) NOT NULL,
            $table->string('dia_especifico'); //dia_especifico VARCHAR(45) NULL,
            $table->integer('dia_alternado'); //dia_alternado INT NULL
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
        Schema::dropIfExists('intervalos');
    }
}
