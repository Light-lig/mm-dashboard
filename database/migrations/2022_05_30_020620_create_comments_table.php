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
        Schema::create('sm_comentario', function (Blueprint $table) {
            $table->increments('com_id');
            $table->string('com_comentario');
            $table->date('com_fecha_comentario');
            $table->integer('mo_id');
            $table->integer('usr_id')->unsigned();
            $table->foreign('usr_id')->references('usr_id')->on('sm_usuarios')->onUpdate('cascade');
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
        Schema::dropIfExists('sm_comentario');
    }
};
