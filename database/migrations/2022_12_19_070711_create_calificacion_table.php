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
        Schema::create('calificacion', function (Blueprint $table) {
            $table->increments('cal_id');
            $table->integer('mal_id')->nullable();
            $table->integer('mat_id')->nullable();
            $table->decimal('cal_deberP1Q1', $precision = 4, $scale = 2)->nullable();
            $table->decimal('cal_actindP1Q1', $precision = 4, $scale = 2)->nullable();
            $table->decimal('cal_actgruP1Q1', $precision = 4, $scale = 2)->nullable();
            $table->decimal('cal_lecP1Q1', $precision = 4, $scale = 2)->nullable();
            $table->decimal('cal_pruP1Q1', $precision = 4, $scale = 2)->nullable();
            $table->decimal('cal_promP1Q1', $precision = 4, $scale = 2)->nullable();
            $table->decimal('cal_deberP2Q1', $precision = 4, $scale = 2)->nullable();
            $table->decimal('cal_actindP2Q1', $precision = 4, $scale = 2)->nullable();
            $table->decimal('cal_actgruP2Q1', $precision = 4, $scale = 2)->nullable();
            $table->decimal('cal_lecP2Q1', $precision = 4, $scale = 2)->nullable();
            $table->decimal('cal_pruP2Q1', $precision = 4, $scale = 2)->nullable();
            $table->decimal('cal_promP2Q1', $precision = 4, $scale = 2)->nullable();
            $table->decimal('cal_promParQ1', $precision = 4, $scale = 2)->nullable();
            $table->decimal('cal_promQ1_80', $precision = 4, $scale = 2)->nullable();
            $table->decimal('cal_examQ1_10', $precision = 4, $scale = 2)->nullable();
            $table->decimal('cal_examQ1_20', $precision = 4, $scale = 2)->nullable();
            $table->decimal('cal_promTotalQ1', $precision = 4, $scale = 2)->nullable();
            $table->string('cal_escalaQ1', 4)->nullable();
            $table->decimal('cal_deberP1Q2', $precision = 4, $scale = 2)->nullable();
            $table->decimal('cal_actindP1Q2', $precision = 4, $scale = 2)->nullable();
            $table->decimal('cal_actgruP1Q2', $precision = 4, $scale = 2)->nullable();
            $table->decimal('cal_lecP1Q2', $precision = 4, $scale = 2)->nullable();
            $table->decimal('cal_pruP1Q2', $precision = 4, $scale = 2)->nullable();
            $table->decimal('cal_promP1Q2', $precision = 4, $scale = 2)->nullable();
            $table->decimal('cal_deberP2Q2', $precision = 4, $scale = 2)->nullable();
            $table->decimal('cal_actindP2Q2', $precision = 4, $scale = 2)->nullable();
            $table->decimal('cal_actgruP2Q2', $precision = 4, $scale = 2)->nullable();
            $table->decimal('cal_lecP2Q2', $precision = 4, $scale = 2)->nullable();
            $table->decimal('cal_pruP2Q2', $precision = 4, $scale = 2)->nullable();
            $table->decimal('cal_promP2Q2', $precision = 4, $scale = 2)->nullable();
            $table->decimal('cal_promParQ2', $precision = 4, $scale = 2)->nullable();
            $table->decimal('cal_promQ2_80', $precision = 4, $scale = 2)->nullable();
            $table->decimal('cal_examQ2_10', $precision = 4, $scale = 2)->nullable();
            $table->decimal('cal_examQ2_20', $precision = 4, $scale = 2)->nullable();
            $table->decimal('cal_promTotalQ2', $precision = 4, $scale = 2)->nullable();
            $table->string('cal_escalaQ2', 4)->nullable();
            $table->decimal('cal_promAnual', $precision = 4, $scale = 2)->nullable();
            $table->string('cal_escalaAnual', 4)->nullable();
            $table->string('cal_estatus', 10)->nullable();
            $table->decimal('cal_examMejora', $precision = 4, $scale = 2)->nullable();
            $table->decimal('cal_examSupletorio', $precision = 4, $scale = 2)->nullable();
            $table->decimal('cal_examRemedial', $precision = 4, $scale = 2)->nullable();
            $table->decimal('cal_examGracia', $precision = 4, $scale = 2)->nullable();
            $table->integer('cal_estado'); 
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            
            $table->foreign('mal_id')->references('mal_id')
            ->on('malla');

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
        Schema::dropIfExists('calificacion');
    }
};
