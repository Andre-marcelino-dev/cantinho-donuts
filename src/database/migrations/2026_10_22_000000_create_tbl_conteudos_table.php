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
        // Textos e imagens do site editados no painel (Conteúdo do site).
        // Só guarda o que foi alterado: o texto original fica em config/conteudo.php
        Schema::create('tbl_conteudos', function (Blueprint $table) {
            $table->integer('id_conteudo', true);
            $table->string('chave_conteudo', 120)->unique('uk_chave_conteudo');
            $table->text('valor_conteudo');
            $table->dateTime('atualizado_em_conteudo')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_conteudos');
    }
};
