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
        Schema::create('tbl_vendas', function (Blueprint $table) {
            $table->integer('id_venda', true);
            $table->integer('id_cliente')->index('fk_vendas_clientes');
            $table->integer('id_usuario')->index('fk_vendas_usuarios');
            $table->dateTime('data_venda')->useCurrent();
            $table->double('valor_venda');
            $table->string('status_venda', 12)->default('EM ANDAMENTO');
            $table->dateTime('data_entrega_venda')->nullable();
            $table->dateTime('atualizado_em_venda')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_vendas');
    }
};
