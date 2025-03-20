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
        Schema::table('products_categorys', function (Blueprint $table) {
            $table->string('icon')->nullable()->after('name'); // Adiciona a coluna após o 'id'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products_categorys', function (Blueprint $table) {
            $table->dropColumn('icon');
        });
    }
};
