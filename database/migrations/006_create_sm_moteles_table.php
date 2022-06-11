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
    public function up()
    {
        Schema::create('sm_motel', function (Blueprint $table) {
            $table->id('mo_id')->autoIncrement();
            $table->string('mo_direccion',150);
            $table->string('mo_foto_portada');
            $table->double('mo_latitud');
            $table->double('mo_longitud');
            $table->string('mo_nombre');
            $table->foreignId('cat_id')->references('cat_id')->on('sm_categoria');
            $table->foreignId('mun_id')->references('mun_id')->on('sm_municipio');
            $table->softDeletes();
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
        Schema::dropIfExists('sm_motel');
    }
};
