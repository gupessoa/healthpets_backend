<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animal_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_animal') ;
            $table->unsignedBigInteger('id_user') ;
            $table->char('owner')->default('s');
            $table->foreign('id_animal')->references('id')->on('animais')->cascadeOnDelete();
            $table->foreign('id_user')->references('id')->on('users')->cascadeOnDelete();
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
        Schema::dropIfExists('animal_user');
    }
}
