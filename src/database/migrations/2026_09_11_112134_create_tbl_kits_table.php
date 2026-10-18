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
        Schema::create('tbl_kits', function (Blueprint $table) {
            $table->integer('id_kit', true);
            $table->string('nome_kit', 30);
            $table->text('descricao_kit');
            $table->string('foto_kit', 100);
            $table->string('slug_kit', 30);
            $table->dateTime('criado_em_kit')->useCurrent();
            $table->dateTime('atualizado_em_kit')->useCurrentOnUpdate()->useCurrent();
            $table->decimal('preco_kit', 8, 2)->nullable();
            $table->string('destaque_kit')->nullable()->default('NENHUM');
            $table->string('whatsapp_kit')->nullable();
            $table->decimal('preco_promocional_kit', 8, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_kits');
    }
};
