<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// O cadastro pelo app pede só nome, e-mail, telefone e senha.
// CPF, nascimento, endereço e foto passam a ser opcionais (o cliente completa depois).
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tbl_clientes', function (Blueprint $table) {
            $table->string('cpf_cnpj_cliente', 18)->nullable()->change();
            $table->date('data_nasc_cliente')->nullable()->change();
            $table->string('endereco_cliente', 40)->nullable()->change();
            $table->string('numero_cliente', 6)->nullable()->change();
            $table->string('bairro_cliente', 40)->nullable()->change();
            $table->string('cidade_cliente', 40)->nullable()->change();
            $table->string('uf_cliente', 2)->nullable()->change();
            $table->string('cep_cliente', 9)->nullable()->change();
            $table->string('foto_cliente', 60)->nullable()->change();
        });
    }

    public function down(): void
    {
        // Não volta para obrigatório: os clientes do app ficariam com campos vazios.
    }
};
