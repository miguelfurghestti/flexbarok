<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'total_amount')) {
                $table->decimal('total_amount', 10, 2)->default(0)->after('order_owner_name');
            }
            if (!Schema::hasColumn('orders', 'opened_at')) {
                $table->timestamp('opened_at')->nullable()->after('total_amount');
            }
            if (!Schema::hasColumn('orders', 'closed_at')) {
                $table->timestamp('closed_at')->nullable()->after('opened_at');
            }
        });

        // Alterar o enum de status se não existir
        if (Schema::hasColumn('orders', 'status')) {
            $connection = Schema::getConnection();
            $connection->statement("ALTER TABLE orders MODIFY COLUMN status ENUM('open', 'closed', 'cancelled') DEFAULT 'open'");
        }

        Schema::table('order_products', function (Blueprint $table) {
            if (!Schema::hasColumn('order_products', 'quantity')) {
                $table->integer('quantity')->default(1)->after('id_product');
            }
            if (!Schema::hasColumn('order_products', 'unit_price')) {
                $table->decimal('unit_price', 10, 2)->after('quantity');
            }
            if (!Schema::hasColumn('order_products', 'notes')) {
                $table->text('notes')->nullable()->after('unit_price');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['total_amount', 'opened_at', 'closed_at']);
            $connection = Schema::getConnection();
            $connection->statement("ALTER TABLE orders MODIFY COLUMN status ENUM('pending', 'processing', 'completed', 'cancelled') DEFAULT 'pending'");
        });

        Schema::table('order_products', function (Blueprint $table) {
            $table->dropColumn(['quantity', 'unit_price', 'notes']);
        });
    }
};
