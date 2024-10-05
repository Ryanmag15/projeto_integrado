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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nome do cliente
            $table->string('email')->unique(); // Email do cliente
            $table->string('phone')->nullable(); // Telefone do cliente
            $table->text('address')->nullable(); // Endereço do cliente
            $table->foreignId('company_id')->constrained()->onDelete('cascade'); // Referência à empresa
            $table->timestamps(); // Campos de data de criação e atualização
            $table->softDeletes(); // adiciona coluna "deleted_at"

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
