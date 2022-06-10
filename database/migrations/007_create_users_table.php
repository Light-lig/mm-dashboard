<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // tocara cambiar modelo y controler de login por el nombre de campos definidos para la tabla
    public function up()
    {
        Schema::create('sm_usuarios', function (Blueprint $table) {
            $table->id('usr_id')->autoIncrement();
            $table->string('usr_correo')->unique();
            $table->timestamp('usr_correo_verified_at')->nullable();
            $table->string('usr_password');
            $table->foreignId('mun_id')->references('mun_id')->on('sm_municipio')->onUpdate('cascade');
            $table->foreignId('tusr_id')->references('tusr_id')->on('sm_tipo_usuarios')->onUpdate('cascade');
            $table->string('usr_dui',9)->nullable();
            $table->string('usr_nit',18)->nullable();
            $table->string('usr_direccion',150)->nullable();
            $table->string('usr_nombre',25)->nullable();
            $table->string('usr_apellido',25)->nullable();
            $table->integer('usr_id_padre')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->charset='utf8mb4';
            $table->collation='utf8mb4_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_usuarios');
    }
};
