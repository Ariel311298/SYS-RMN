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
        Schema::create('personal', function (Blueprint $table) {
            $table->increments('pers_id');
            $table->string('pers_ncedula', 10)->nullable();
            $table->string('pers_npasaporte', 10)->nullable();
            $table->string('pers_nombres', 50);
            $table->string('pers_apellidos', 50);
            $table->date('pers_fec_nac');
            $table->string('pers_telf_convencional', 10)->nullable();
            $table->string('pers_num_celular', 10)->nullable();
            $table->string('pers_barrio', 50)->nullable();
            $table->string('pers_direccion', 255);
            $table->string('pers_nacionalidad', 15);
            $table->string('pers_genero', 10);
            $table->string('pers_etnia', 18);
            $table->string('pers_email_inst', 255)->nullable();
            $table->string('pers_tip_sangre', 5)->nullable();
            $table->string('pers_dis_tipo', 20)->nullable();
            $table->string('pers_dis_porcentaje', 3)->nullable();
            $table->string('pers_num_car_conadis', 10)->nullable();
            $table->string('pers_est_civil', 12);
            $table->string('pers_nivel', 15);
            $table->string('pers_foto', 255)->nullable();
            $table->integer('pers_estado');
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
        Schema::dropIfExists('personal');
    }
};
