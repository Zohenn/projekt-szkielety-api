<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder {
    public function run() {
        DB::table('categories')->insert([
            [
                'name' => 'Obudowy',
            ],
            [
                'name' => 'Procesory',
            ],
            [
                'name' => 'Karty graficzne',
            ],
            [
                'name' => 'Płyty główne'
            ],
            [
                'name' => 'Pamięci RAM'
            ],
            [
                'name' => 'Zasilacze'
            ],
            [
                'name' => 'Chłodzenie CPU'
            ],
            [
                'name' => 'Systemy operacyjne'
            ],
            [
                'name' => 'Dyski SSD'
            ],
            [
                'name' => 'Dyski HDD'
            ]
        ]);
    }
}
