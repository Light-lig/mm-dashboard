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
        Schema::create('sm_habitacion', function (Blueprint $table) {
            $table->id('ha_id')->autoIncrement();
            $table->string('ha_descripcion',100);
            $table->string('ha_nombre_habitacion');
            $table->string('ha_numero_habitacion');
            $table->double('ha_precio',8,2);
            $table->string('ha_tiempo');
            $table->foreignId('ha_id_tipo_de_habitacion')->references('id_tipo_habitacion')->on('sm_tipo_habitacion');
            $table->foreignId('es_id')->references('est_id')->on('sm_estado');
            $table->foreignId('mo_id')->references('mo_id')->on('sm_motel');
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
        Schema::dropIfExists('sm_habitacion');
    }
};
