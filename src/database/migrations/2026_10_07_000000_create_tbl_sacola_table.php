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
        // Itens que o cliente escolheu no app e ainda não viraram pedido
        Schema::create('tbl_sacola', function (Blueprint $table) {
            $table->integer('id_sacola', true);
            $table->integer('id_cliente')->index('fk_sacola_clientes');
            $table->integer('id_produto')->index('fk_sacola_produtos');
            $table->integer('qtde_sacola')->default(1);
            $table->dateTime('criado_em_sacola')->useCurrent();
            $table->dateTime('atualizado_em_sacola')->useCurrentOnUpdate()->useCurrent();

            // O mesmo produto aparece uma vez só na sacola de cada cliente
            $table->unique(['id_cliente', 'id_produto'], 'uk_sacola_cliente_produto');

            $table->foreign(['id_cliente'], 'fk_sacola_clientes')->references(['id_cliente'])->on('tbl_clientes')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['id_produto'], 'fk_sacola_produtos')->references(['id_produto'])->on('tbl_produtos')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_sacola');
    }
};
