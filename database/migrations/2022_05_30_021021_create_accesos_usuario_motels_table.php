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
        Schema::create('sm_accesos_usuario_motel', function (Blueprint $table) {
            $table->increments('acc_id');
            $table->integer('mo_id')->unsigned();
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
        Schema::dropIfExists('sm_accesos_usuario_motel');
    }
};
