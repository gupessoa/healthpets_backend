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
            $table->id(); //id INT(5) NOT NULL,
            $table->float('lote', 5, 2);//peso FLOAT(5,2) NULL,
            $table->string('humor'); //humor VARCHAR(45) NULL,
            $table->string('descricao'); //descricao VARCHAR(100) NULL,
            $table->binary('foto');//foto LONGBLOB NULL,
            $table->foreignId('animal_id')->constrained('animais')->cascadeOnDelete();//fk_id_animal INT(5) NOT NULL
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
