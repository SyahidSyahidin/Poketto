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
    Schema::create('likes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Siapa yang like
        $table->foreignId('article_id')->constrained()->onDelete('cascade'); // Artikel apa yang dilike
        $table->timestamps();
        
        // Supaya 1 user cuma bisa memberikan 1 kali like di artikel yang sama (mencegah duplikat)
        $table->unique(['user_id', 'article_id']);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
