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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('usr_id');
            $table->string('usr_correo')->unique();
            $table->timestamp('usr_correo_verified_at')->nullable();
            $table->string('usr_password');
            $table->integer('mun_id')->unsigned();
            $table->foreign('mun_id')->references('mun_id')->on('municipalities')->onUpdate('cascade');
            $table->integer('tusr_id')->unsigned();
            $table->foreign('tusr_id')->references('tusr_id')->on('type_users')->onUpdate('cascade');
            $table->string('usr_dui',9)->nullable();
            $table->string('usr_nit',17)->nullable();
            $table->string('usr_direccion',150)->nullable();
            $table->string('usr_nombre',25)->nullable();
            $table->string('usr_apellido',25)->nullable();
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
        Schema::dropIfExists('users');
    }
};
