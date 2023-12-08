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
        Schema::create('tutor_proyecto', function (Blueprint $table) {
            $table->increments('tutproy_id');
            $table->integer('ofer_id');
            $table->integer('pers_id');
            $table->integer('tutproy_estado');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            
            $table->foreign('ofer_id')->references('ofer_id')
            ->on('oferta');
            
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
        Schema::dropIfExists('tutor_proyecto');
    }
};
