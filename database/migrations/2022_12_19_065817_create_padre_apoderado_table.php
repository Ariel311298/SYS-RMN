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
        Schema::create('padre_apoderado', function (Blueprint $table) {
            $table->increments('pad_id');
            $table->integer('alum_id');
            $table->string('pad_ncedula', 10)->nullable();
            $table->string('pad_npasaporte', 10)->nullable();
            $table->string('pad_nombres', 50);
            $table->string('pad_apellidos', 50);
            $table->string('pad_nacionalidad', 15);
            $table->string('pad_email', 255)->nullable();
            $table->string('pad_ocupacion', 50);
            $table->string('pad_nivel', 15);
            $table->string('pad_direccion', 255);
            $table->string('pad_telf_celular', 10)->nullable();
            $table->string('pad_telf_convencional', 10)->nullable();
            $table->date('pad_fec_nac');
            $table->string('pad_parentesco', 15);
            $table->integer('pad_estado');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            
            $table->foreign('alum_id')->references('alum_id')
                ->on('alumno');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('padre_apoderado');
    }
};
