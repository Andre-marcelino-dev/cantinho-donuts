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
            $table->foreign(['id_cliente'], 'fk_vendas_clientes')->references(['id_cliente'])->on('tbl_clientes')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_usuario'], 'fk_vendas_usuarios')->references(['id_usuario'])->on('tbl_usuarios')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_vendas', function (Blueprint $table) {
            $table->dropForeign('fk_vendas_clientes');
            $table->dropForeign('fk_vendas_usuarios');
        });
    }
};
