<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            [
                'id' => '1',
                'name' => 'Montaż zestawu',
                'price' => 80,
            ],
            [
                'id' => '2',
                'name' => 'Instalacja systemu',
                'price' => 50,
            ]
        ]);
    }
}
