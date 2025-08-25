<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderProducts;
use App\Models\Products;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buscar uma loja existente
        $shop = Shop::first();
        if (!$shop) {
            $this->command->info('Nenhuma loja encontrada. Execute o ShopSeeder primeiro.');
            return;
        }

        // Buscar produtos existentes
        $products = Products::where('id_shop', $shop->id)->take(5)->get();
        if ($products->isEmpty()) {
            $this->command->info('Nenhum produto encontrado. Execute o ProductsSeeder primeiro.');
            return;
        }

        // Criar comandas de exemplo
        $orders = [
            [
                'order_number' => 'CMD-001',
                'order_owner_name' => 'João Silva',
                'status' => 'open',
                'opened_at' => now()->subHours(2),
                'total_amount' => 0,
            ],
            [
                'order_number' => 'CMD-002',
                'order_owner_name' => 'Maria Santos',
                'status' => 'open',
                'opened_at' => now()->subHour(),
                'total_amount' => 0,
            ],
            [
                'order_number' => 'CMD-003',
                'order_owner_name' => 'Pedro Costa',
                'status' => 'closed',
                'opened_at' => now()->subHours(4),
                'closed_at' => now()->subHour(),
                'total_amount' => 0,
            ],
        ];

        foreach ($orders as $orderData) {
            $order = Order::create([
                'order_number' => $orderData['order_number'],
                'order_owner_name' => $orderData['order_owner_name'],
                'id_shop' => $shop->id,
                'status' => $orderData['status'],
                'opened_at' => $orderData['opened_at'],
                'closed_at' => $orderData['closed_at'] ?? null,
                'total_amount' => $orderData['total_amount'],
            ]);

            // Adicionar produtos aleatórios às comandas
            $randomProducts = $products->random(rand(1, 3));
            $total = 0;

            foreach ($randomProducts as $product) {
                $quantity = rand(1, 3);
                $orderProduct = OrderProducts::create([
                    'id_order' => $order->id,
                    'id_shop' => $shop->id,
                    'id_product' => $product->id,
                    'quantity' => $quantity,
                    'unit_price' => $product->price,
                    'notes' => rand(0, 1) ? 'Sem observações' : null,
                ]);

                $total += $quantity * $product->price;
            }

            // Atualizar total da comanda
            $order->update(['total_amount' => $total]);
        }

        $this->command->info('Comandas de exemplo criadas com sucesso!');
    }
}
