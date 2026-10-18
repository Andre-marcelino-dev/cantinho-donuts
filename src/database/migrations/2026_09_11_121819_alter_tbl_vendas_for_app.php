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
        Schema::table('tbl_vendas', function (Blueprint $table) {
            $table->integer('id_endereco')->nullable()->index('fk_vendas_enderecos')->after('id_usuario');
            $table->integer('id_cupom')->nullable()->index('fk_vendas_cupons')->after('id_endereco');
            $table->string('forma_pagamento_venda', 10)->nullable();
            $table->string('entrega_venda', 3)->default('NAO');
            $table->text('observacao_venda')->nullable();
            $table->double('valor_desconto_venda')->default(0);
        });

        Schema::table('tbl_vendas', function (Blueprint $table) {
            $table->foreign(['id_endereco'], 'fk_vendas_enderecos')->references(['id_endereco'])->on('tbl_enderecos_cliente')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_cupom'], 'fk_vendas_cupons')->references(['id_cupom'])->on('tbl_cupons')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_vendas', function (Blueprint $table) {
            $table->dropForeign('fk_vendas_enderecos');
            $table->dropForeign('fk_vendas_cupons');
            $table->dropColumn([
                'id_endereco',
                'id_cupom',
                'forma_pagamento_venda',
                'entrega_venda',
                'observacao_venda',
                'valor_desconto_venda',
            ]);
        });
    }
};
