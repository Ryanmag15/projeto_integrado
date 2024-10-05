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
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Título do negócio
            $table->decimal('amount', 10, 2); // Valor do negócio
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // FK para users
            $table->foreignId('client_id')->constrained()->onDelete('cascade'); // FK para clients
            $table->timestamps();
            $table->softDeletes(); // adiciona coluna "deleted_at"

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deals');
    }
};
