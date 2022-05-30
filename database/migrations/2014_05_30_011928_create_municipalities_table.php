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
        Schema::create("sm_municipio", function (Blueprint $table) {
            $table->increments("mun_id");
            $table->string("mun_nombre");
            $table->integer("dep_id")->unsigned();
            $table->foreign('dep_id')->references('dep_id')->on('sm_departamento')->onUpdate('cascade');
            $table->timestamps();
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
        Schema::dropIfExists("sm_municipio");
    }
};
