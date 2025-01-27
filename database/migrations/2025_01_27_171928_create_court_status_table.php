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
        Schema::create('court_status', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_court');
            $table->string('owner_name');
            $table->timestamp('starts');
            $table->timestamp('ends');
            $table->string('status');
            $table->timestamps();

            $table->foreign('id_court')->references('id')->on('courts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('court_status');
    }
};
