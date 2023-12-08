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
        Schema::create('malla', function (Blueprint $table) {
            $table->increments('mal_id');
            $table->integer('ofer_id');
            $table->integer('asig_id');
            $table->integer('pers_id');
            $table->integer('mal_estado');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            
            $table->foreign('ofer_id')->references('ofer_id')
                ->on('oferta');

            $table->foreign('asig_id')->references('asig_id')
                ->on('asignatura');

            $table->foreign('pers_id')->references('pers_id')
                ->on('personal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('malla');
    }
};
