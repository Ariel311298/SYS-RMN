<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rol')->insert([
            'rol_id' => '1',
            'rol_nombre' => 'Administrador/a',
            'rol_abrev' => 'Adm',
            'rol_estado' => '1'
        ]);

        DB::table('rol')->insert([
            'rol_id' => '2',
            'rol_nombre' => 'Secretario/a',
            'rol_abrev' => 'Sec',
            'rol_estado' => '1'
        ]);

        DB::table('rol')->insert([
            'rol_id' => '3',
            'rol_nombre' => 'Docente',
            'rol_abrev' => 'Doc',
            'rol_estado' => '1'
        ]);

        DB::table('rol')->insert([
            'rol_id' => '4',
            'rol_nombre' => 'Rector/a',
            'rol_abrev' => 'Rec',
            'rol_estado' => '1'
        ]);

        DB::table('rol')->insert([
            'rol_id' => '5',
            'rol_nombre' => 'Alumno/a',
            'rol_abrev' => 'Alm',
            'rol_estado' => '1'
        ]);
    }
}
