<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Configurações da loja editáveis no painel (ex.: taxa e previsão de entrega)
        Schema::create('tbl_configuracoes', function (Blueprint $table) {
            $table->integer('id_configuracao', true);
            $table->string('chave_configuracao', 50)->unique('uk_chave_configuracao');
            $table->string('valor_configuracao', 255);
            $table->dateTime('atualizado_em_configuracao')->useCurrentOnUpdate()->useCurrent();
        });

        // Começa com os valores que eram fixos no código
        DB::table('tbl_configuracoes')->insert([
            ['chave_configuracao' => 'taxa_entrega', 'valor_configuracao' => '6.00'],
            ['chave_configuracao' => 'previsao_entrega', 'valor_configuracao' => '45 - 60 min'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_configuracoes');
    }
};
