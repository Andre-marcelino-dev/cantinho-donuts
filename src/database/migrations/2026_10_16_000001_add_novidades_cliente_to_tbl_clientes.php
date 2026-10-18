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
        // Se o cliente aceitou receber novidades e promoções (SIM/NAO, como destaque_produto e entrega_venda)
        Schema::table('tbl_clientes', function (Blueprint $table) {
            $table->string('novidades_cliente', 3)->default('NAO')->after('status_cliente');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_clientes', function (Blueprint $table) {
            $table->dropColumn('novidades_cliente');
        });
    }
};
