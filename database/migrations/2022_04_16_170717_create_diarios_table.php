<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diarios', function (Blueprint $table) {
            $table->id();
            $table->float('peso')->nullable();
            $table->string('humor')->nullable();
            $table->string('descricao');
            $table->string('data');
            $table->string('titulo');
            $table->unsignedBigInteger('id_animal');
            $table->foreign('id_animal')->references('id')->on('animais')->onDelete('cascade');
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
        Schema::dropIfExists('diarios');
    }
}
