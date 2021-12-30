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
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // id_user INT(5) NOT NULL,
            $table->foreignId('animal_id')->constrained('animais')->cascadeOnDelete(); // id_animal INT(5) NOT NULL,
            $table->string('tipo_relacao'); // tipo_relacao VARCHAR(45) NULL
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
