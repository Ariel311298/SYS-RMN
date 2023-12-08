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
        Schema::create('oferta', function (Blueprint $table) {
            $table->increments('ofer_id');
            $table->integer('per_id');
            $table->integer('cur_id');
            $table->integer('pers_id');
            $table->integer('ofer_estado');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            
            $table->foreign('per_id')->references('per_id')
            ->on('periodo');

            $table->foreign('cur_id')->references('cur_id')
            ->on('curso');

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
        Schema::dropIfExists('oferta');
    }
};
