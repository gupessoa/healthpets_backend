<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->string('descricao')->nullable();
            $table->date('data');
            $table->string('horario')->nullable();
            $table->unsignedBigInteger('id_animal');
            $table->foreign('id_animal')->references('id')->on('animais')->onDelete('cascade');
            $table->unsignedBigInteger('id_local');
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
        Schema::dropIfExists('consultas');
    }
}
