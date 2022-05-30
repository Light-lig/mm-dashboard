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
        Schema::create('sm_departamento', function (Blueprint $table) {
            $table->increments('dep_id');
            $table->string('dep_nombre',15);
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
        Schema::dropIfExists('sm_departamento');
    }
};
