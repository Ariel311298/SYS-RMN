<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'rol_id' => '1',
            'pers_id' => '1',
            'name' => 'Administrador1',
            'email' => 'ariel20012002@gmail.com',
            'password' => bcrypt('administrador'),
            'usu_estado' => '1'
        ]);

        DB::table('users')->insert([
            'rol_id' => '2',
            'pers_id' => '2',
            'name' => 'Secretario1',
            'email' => 'ariel20012002@hotmail.com',
            'password' => bcrypt('secretario'),
            'usu_estado' => '1'
        ]);

        DB::table('users')->insert([
            'rol_id' => '3',
            'pers_id' => '3',
            'name' => 'Docente1',
            'email' => 'jaferjarlar@gmail.com',
            'password' => bcrypt('docente123'),
            'usu_estado' => '1'
        ]);

        DB::table('users')->insert([
            'rol_id' => '4',
            'pers_id' => '4',
            'name' => 'Rector1',
            'email' => 'rector1@gmail.com',
            'password' => bcrypt('rector123'),
            'usu_estado' => '1'
        ]);

        DB::table('users')->insert([
            'rol_id' => '5',
            'alum_id' => '1',
            'name' => 'Alumno1',
            'email' => 'alum1@gmail.com',
            'password' => bcrypt('alumno123'),
            'usu_estado' => '1'
        ]);

        DB::table('users')->insert([
            'rol_id' => '1',
            'pers_id' => '5',
            'name' => 'adminfuertes45',
            'email' => 'sysrmn3493@hotmail.com',
            'password' => bcrypt('31/12/98Admin'),
            'usu_estado' => '1'
        ]);
    }
}
