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
        Schema::create('sm_fotos', function (Blueprint $table) {
            $table->id('fot_id')->autoIncrement();
            $table->string('fh_descripcion');
            $table->string('fh_foto');
            $table->foreignId('ha_id')->nullable()->references('ha_id')->on('sm_habitacion');
            $table->foreignId('mo_id')->nullable()->references('mo_id')->on('sm_motel');
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
        Schema::dropIfExists('sm_fotos');
    }
};
