<?php

namespace Database\Seeders;

use App\Models\Sport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        $sports = [
            [
                'name' => 'Futebol',
                'icon' => 'ico-futebol.png',
            ],
            [
                'name' => 'Vôlei',
                'icon' => 'ico-volei.png',
            ],
            [
                'name' => 'Beach Tênis',
                'icon' => 'ico-beach-tenis.png',
            ],
            [
                'name' => 'Tênis',
                'icon' => 'ico-tenis.png',
            ],
            [
                'name' => 'Basquete',
                'icon' => 'ico-basquete.png',
            ],
            [
                'name' => 'Handebol',
                'icon' => 'ico-handebol.png',
            ],
            [
                'name' => 'Futevôlei',
                'icon' => 'ico-futevolei.png',
            ],
        ];

        foreach ($sports as $sport) {
            \App\Models\Sport::create($sport);
        }
    }
}
