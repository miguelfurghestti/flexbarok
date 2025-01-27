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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->after('email'); // Adicionando o campo phone após email
            $table->date('birth')->after('phone'); // Adicionando o campo birth após phone
            $table->unsignedBigInteger('id_shop')->after('birth'); // Adicionando o campo id_shop após birth
            $table->string('level')->after('id_shop'); // Adicionando o campo level após id_shop

            // Adicionando chave estrangeira (se necessário)
            $table->foreign('id_shop')->references('id')->on('shops')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_shop']); // Removendo a chave estrangeira
            $table->dropColumn(['phone', 'birth', 'id_shop', 'level']); // Removendo as colunas
        });
    }
};
