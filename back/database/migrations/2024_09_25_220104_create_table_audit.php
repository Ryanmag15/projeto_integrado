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
        Schema::create('audits', function (Blueprint $table) {
            $table->id();
            $table->string('model_type'); // Tipo de modelo (ex: User, Company)
            $table->unsignedBigInteger('model_id'); // ID do modelo alterado
            $table->string('action'); // Ação realizada (create, update, delete)
            $table->unsignedBigInteger('user_id')->nullable(); // ID do usuário que fez a alteração
            $table->text('changes')->nullable(); // Mudanças feitas (JSON)
            $table->timestamps();
            $table->softDeletes(); // adiciona coluna "deleted_at"

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audits');
    }
};
