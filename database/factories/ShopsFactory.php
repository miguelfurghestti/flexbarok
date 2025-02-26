<?php

namespace Database\Factories;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ShopsFactory extends Factory
{

    protected $model = Shop::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            //'user' => User::factory(),
            'user' => User::where('level', 1)->inRandomOrder()->first()->id,
            'address' => $this->faker->streetAddress(),
            'number' => $this->faker->randomNumber(3),
            'city' => $this->faker->city(),
            'cnpj' => $this->faker->unique()->numerify('########0001##'), // CNPJ fictício
            'phone' => $this->faker->phoneNumber(), // Número de telefone fictício
            'email' => $this->faker->unique()->safeEmail(), // E-mail fictício
            'website' => $this->faker->domainName(), // Website fictício
            'type_sell' => $this->faker->randomElement(['order', 'table']), // Tipos de venda
            'modules' => json_encode($this->faker->randomElements(['financeiro', 'vendas', 'estoque'], 2)), // Módulos fictícios
        ];
    }
}