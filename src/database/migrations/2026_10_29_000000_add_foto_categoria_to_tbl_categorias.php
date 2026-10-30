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
        // Imagem do card da categoria na Home (vazio = usa a imagem padrão)
        Schema::table('tbl_categorias', function (Blueprint $table) {
            $table->string('foto_categoria', 60)->nullable()->after('descricao_categoria');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_categorias', function (Blueprint $table) {
            $table->dropColumn('foto_categoria');
        });
    }
};
