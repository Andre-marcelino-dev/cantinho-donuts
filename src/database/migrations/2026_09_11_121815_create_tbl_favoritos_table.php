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
        Schema::create('tbl_favoritos', function (Blueprint $table) {
            $table->integer('id_favorito', true);
            $table->integer('id_cliente')->index('fk_favoritos_clientes');
            $table->integer('id_produto')->index('fk_favoritos_produtos');
            $table->string('status_favorito', 10)->default('ATIVO');
            $table->dateTime('criado_em_favorito')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_favoritos');
    }
};
