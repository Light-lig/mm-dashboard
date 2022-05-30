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
        Schema::create('accesos_usuario_motels', function (Blueprint $table) {
            $table->increments('acc_id');
            $table->integer('mo_id')->unsigned();
            $table->integer('usr_id')->unsigned();
            $table->foreign('usr_id')->references('usr_id')->on('users')->onUpdate('cascade');
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
        Schema::dropIfExists('accesos_usuario_motels');
    }
};
