<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cria um usuário shop
        User::factory()->create([
            'name' => 'Shop User',
            'email' => 'shop@example.com',
            'level' => 1,
            'id_shop' => null, // Certifique-se de que a loja exista
        ]);

        // Cria um usuário admin
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'level' => 999,
            'id_shop' => null,
        ]);
    }
}
