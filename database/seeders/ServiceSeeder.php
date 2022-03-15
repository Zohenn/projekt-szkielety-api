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
                'id' => 'assembly',
                'name' => 'Montaż zestawu',
                'price' => 80,
            ],
            [
                'id' => 'osInstallation',
                'name' => 'Instalacja systemu',
                'price' => 50,
            ]
        ]);
    }
}
