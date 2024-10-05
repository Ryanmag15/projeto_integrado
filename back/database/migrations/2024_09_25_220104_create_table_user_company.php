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
        Schema::create('user_company', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); // FK para users
            $table->foreignId('company_id')->constrained(); // FK para companies
            $table->timestamps();
            $table->softDeletes(); // adiciona coluna "deleted_at"
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_company');
    }
};
