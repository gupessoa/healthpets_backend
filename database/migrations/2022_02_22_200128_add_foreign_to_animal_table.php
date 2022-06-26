<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignToAnimalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('animais', function (Blueprint $table) {
            $table->foreign('id_especie')->references('id')->on('especies')->onDelete('cascade');
            $table->foreign('id_raca')->references('id')->on('racas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('animais', function (Blueprint $table) {
            $table->dropForeign(['id_especie']);
            $table->dropForeign(['id_raca']);
        });
    }
}
