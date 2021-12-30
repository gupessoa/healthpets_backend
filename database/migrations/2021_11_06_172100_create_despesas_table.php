<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDespesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('despesas', function (Blueprint $table) {
            $table->id(); //id INT(5) NOT NULL,
            $table->string('descricao'); //descricao VARCHAR(150) NULL,
            $table->float('valor', 5, 2); //valor FLOAT(5,2) NULL,
            $table->date('data'); //data DATE NULL,
            $table->float('percentual', 5, 2); //percentual FLOAT NULL,
            $table->foreignId('categoria_id')->constrained('categorias')->cascadeOnDelete(); //fk_id_categoria INT(5) NOT NULL,
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); //fk_id_user INT(5) NOT NULL
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
        Schema::dropIfExists('despesas');
    }
}
