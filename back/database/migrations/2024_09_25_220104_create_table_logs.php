<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('message'); // Mensagem do log
            $table->text('context')->nullable(); // Contexto adicional, se necessário
            $table->foreignId('user_id')->nullable()->constrained(); // ID do usuário, se aplicável
            $table->string('ip_address')->nullable(); // IP do cliente
            $table->string('http_method')->nullable(); // Método HTTP da requisição
            $table->string('url')->nullable(); // URL da requisição
            $table->string('level')->default('error'); // Nível de severidade
            $table->text('stack_trace')->nullable(); // Stack trace da exceção
            $table->timestamps();
            $table->softDeletes(); // adiciona coluna "deleted_at"

        });
    }

    public function down()
    {
        Schema::dropIfExists('logs');
    }
};
