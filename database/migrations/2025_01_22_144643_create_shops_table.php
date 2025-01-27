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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('user');
            $table->string('adress');
            $table->string('number')->nullable();
            $table->string('city');
            $table->string('cnpj', 14)->unique();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->string('website')->nullable();
            $table->string('type_sell');
            $table->json('modules')->nullable();
            $table->timestamps();

            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};
