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
        Schema::create('comportamiento', function (Blueprint $table) {
            $table->increments('cond_id');
            $table->integer('ofer_id')->nullable();
            $table->integer('mat_id')->nullable();
            $table->string('cond_notaQ1', 1)->nullable();
            $table->string('cond_escalaQ1', 255)->nullable();
            $table->string('cond_notaQ2', 1)->nullable();
            $table->string('cond_escalaQ2', 255)->nullable();
            $table->string('cond_notaAnual', 1)->nullable();
            $table->string('cond_escalaAnual', 255)->nullable();
            $table->integer('cond_estado');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            
            $table->foreign('ofer_id')->references('ofer_id')
            ->on('oferta');

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
        Schema::dropIfExists('comportamiento');
    }
};
