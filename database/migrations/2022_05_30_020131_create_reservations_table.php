<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("reservations", function (Blueprint $table) {
            $table->increments("res_id");
            $table->date("fecha");
            $table->time("hora");
            $table->decimal("res_cantidad_apagar", 10, 6);
            $table->integer("ha_id")->unsigned();
            $table->integer("usr_id")->unsigned();
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
        Schema::dropIfExists("reservations");
    }
};
