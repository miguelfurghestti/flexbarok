<?php

namespace Database\Seeders;

use App\Models\Shops;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Shops::factory()->count(1)->create();
    }
}
