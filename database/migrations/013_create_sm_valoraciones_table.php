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
        Schema::create('sm_valoracion', function (Blueprint $table) {
            $table->id('val_id')->autoIncrement();
            $table->integer('val_valoracion');
            $table->foreignId('mo_id')->references('mo_id')->on('sm_motel');
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
        Schema::dropIfExists('sm_valoracion');
    }
};
