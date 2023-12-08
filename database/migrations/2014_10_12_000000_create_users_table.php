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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rol_id');
            $table->integer('alum_id')->nullable();
            $table->integer('pers_id')->nullable();
            $table->string('name', 255)->unique();
            $table->string('email', 255)->unique();
            $table->string('password')->unique();
            $table->rememberToken();
            $table->integer('usu_estado');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            
            $table->foreign('rol_id')->references('rol_id')
                ->on('rol');            
            
            $table->foreign('alum_id')->references('alum_id')
                ->on('alumno');        
            
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
        Schema::dropIfExists('users');
    }
};
