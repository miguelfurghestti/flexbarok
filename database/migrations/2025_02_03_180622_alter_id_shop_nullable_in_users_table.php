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
            $table->dropForeign(['id_shop']);
            $table->unsignedBigInteger('id_shop')->nullable()->change();
            $table->foreign('id_shop')->references('id')->on('shops')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_shop']);
            $table->unsignedBigInteger('id_shop')->nullable(false)->change();
            $table->foreign('id_shop')->references('id')->on('shops')->onDelete('cascade');
        });
    }
};
