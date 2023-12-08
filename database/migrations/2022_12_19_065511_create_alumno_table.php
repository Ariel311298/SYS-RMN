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
        Schema::create('alumno', function (Blueprint $table) {
            $table->increments('alum_id');
            $table->string('alum_ncedula', 10)->nullable();
            $table->string('alum_npasaporte', 10)->nullable();
            $table->string('alum_nombres', 50);
            $table->string('alum_apellidos', 50);
            $table->date('alum_fec_nac');
            $table->string('alum_barrio', 50)->nullable();
            $table->string('alum_genero', 10);
            $table->string('alum_nacionalidad', 15);
            $table->string('alum_etnia', 18);
            $table->string('alum_dis_tipo', 20)->nullable();
            $table->string('alum_dis_porcentaje', 3)->nullable();
            $table->string('alum_num_car_conadis', 10)->nullable();
            $table->string('alum_foto', 255)->nullable();
            $table->integer('alum_estado');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumno');
    }
};
