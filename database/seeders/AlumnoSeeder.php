<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alumno')->insert([
            'alum_ncedula' => '0109281432',
            'alum_nombres' => 'AlumnoN1 AlumnoN1',
            'alum_apellidos' => 'AlumnoAp1 AlumnoAp1',
            'alum_fec_nac' => '2010-09-11',
            'alum_genero' => 'Masculino',
            'alum_nacionalidad' => 'Ecuatoriano',    
            'alum_etnia' => 'Mestizo',  
            'alum_estado' => '1',    
        ]);
    }
}
