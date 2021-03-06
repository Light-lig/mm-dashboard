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
        Schema::create('sm_detalle_habitacion', function (Blueprint $table) {
            $table->id('deth_id')->autoIncrement();
            $table->string('etiqueta');
            $table->string('valor');
            $table->foreignId('ha_id')->references('ha_id')->on('sm_habitacion');
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
        Schema::dropIfExists('sm_detalle_habitacion');
    }
};
