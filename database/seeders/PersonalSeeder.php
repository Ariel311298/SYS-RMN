<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('personal')->insert([
            'pers_ncedula' => '0107281438',
            'pers_nombres' => 'Ariel Fernando',
            'pers_apellidos' => 'Jaramillo Zhigue',
            'pers_fec_nac' => '1998-12-31',
            'pers_direccion' => 'Via a Mayancela',
            'pers_nacionalidad' => 'Ecuatoriano',    
            'pers_genero' => 'Masculino',
            'pers_etnia' => 'Mestizo',
            'pers_est_civil' => 'Soltero',
            'pers_nivel' => 'Tercer Nivel',  
            'pers_estado' => '1',    
        ]);

        DB::table('personal')->insert([
            'pers_ncedula' => '0107675678',
            'pers_nombres' => 'SecretarioN SecretarioN',
            'pers_apellidos' => 'SecretatioA SecretarioA',
            'pers_fec_nac' => '1997-11-29',
            'pers_direccion' => 'Via a la Troncal',
            'pers_nacionalidad' => 'Ecuatoriano',    
            'pers_genero' => 'Masculino',
            'pers_etnia' => 'Mestizo',
            'pers_est_civil' => 'Soltero',
            'pers_nivel' => 'Tercer Nivel',  
            'pers_estado' => '1',    
        ]);
        
        DB::table('personal')->insert([
            'pers_ncedula' => '0102678976',
            'pers_nombres' => 'DocenteN DocenteN',
            'pers_apellidos' => 'DocenteA DocenteA',
            'pers_fec_nac' => '1996-10-19',
            'pers_direccion' => 'Via a Guayaquil',
            'pers_nacionalidad' => 'Ecuatoriano',    
            'pers_genero' => 'Masculino',
            'pers_etnia' => 'Mestizo',
            'pers_est_civil' => 'Soltero',
            'pers_nivel' => 'Tercer Nivel',  
            'pers_estado' => '1',    
        ]);
        
        DB::table('personal')->insert([
            'pers_ncedula' => '0101281229',
            'pers_nombres' => 'RectorN RectorN',
            'pers_apellidos' => 'RectorAp RectorAp',
            'pers_fec_nac' => '1995-10-15',
            'pers_direccion' => 'Via a Azogues',
            'pers_nacionalidad' => 'Ecuatoriano',    
            'pers_genero' => 'Masculino',
            'pers_etnia' => 'Mestizo',
            'pers_est_civil' => 'Soltero',
            'pers_nivel' => 'Tercer Nivel',  
            'pers_estado' => '1',    
        ]);

        DB::table('personal')->insert([
            'pers_ncedula' => '0107123232',
            'pers_nombres' => 'Juan Marcelo',
            'pers_apellidos' => 'Fuertes Aguirre',
            'pers_fec_nac' => '1999-11-30',
            'pers_direccion' => 'Inglaterra 3-56 y Union Sovietica',
            'pers_nacionalidad' => 'Ecuatoriano/a',    
            'pers_genero' => 'Masculino',
            'pers_etnia' => 'Mestizo/a',
            'pers_est_civil' => 'Soltero/a',
            'pers_nivel' => 'Tercer Nivel',  
            'pers_estado' => '1',    
        ]);
    }
}
