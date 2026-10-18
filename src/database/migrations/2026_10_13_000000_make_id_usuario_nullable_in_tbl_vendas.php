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
        // Pedidos feitos pelo app não têm um funcionário (usuário) responsável
        Schema::table('tbl_vendas', function (Blueprint $table) {
            $table->integer('id_usuario')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_vendas', function (Blueprint $table) {
            $table->integer('id_usuario')->nullable(false)->change();
        });
    }
};
