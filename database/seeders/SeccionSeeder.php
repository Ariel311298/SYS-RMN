<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seccion')->insert([
            'sec_id' => '1',
            'sec_nombre' => 'Matutina',
            'sec_estado' => '1'
        ]);

        DB::table('seccion')->insert([
            'sec_id' => '2',
            'sec_nombre' => 'Vespertina',
            'sec_estado' => '1'
        ]);
    }
}
