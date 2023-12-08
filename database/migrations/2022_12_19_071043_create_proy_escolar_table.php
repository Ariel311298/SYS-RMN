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
        Schema::create('proy_escolar', function (Blueprint $table) {
            $table->increments('proy_id');
            $table->integer('tutproy_id')->nullable();
            $table->integer('mat_id')->nullable();
            $table->string('proy_prom_parcialP1Q1', 2)->nullable();
            $table->string('proy_prom_parcialP2Q1', 2)->nullable();
            $table->string('proy_promTotalQ1', 2)->nullable();
            $table->string('proy_prom_parcialP1Q2', 2)->nullable();
            $table->string('proy_prom_parcialP2Q2', 2)->nullable();
            $table->string('proy_promTotalQ2', 2)->nullable();
            $table->integer('proy_estado');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            
            $table->foreign('tutproy_id')->references('tutproy_id')
            ->on('tutor_proyecto');

            $table->foreign('mat_id')->references('mat_id')
            ->on('matricula');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proy_escolar');
    }
};
