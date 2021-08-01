<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('empresas', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->char('nome',150);
            $table->char('razao_Social',150);
            $table->char('cnpj',14)->unique();
            $table->char('telefone',11);
            $table->char('email',150)->unique();
            $table->char('cep',8);
            $table->char('rua',100);
            $table->integer('numero');
            $table->char('bairro',100);
            $table->char('complemento',50);
            $table->char('cidade',150);
            $table->char('estado',2);
            $table->boolean('isAtivo')->default(1);
            $table->char('uuid',255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('empresas');
    }

}
