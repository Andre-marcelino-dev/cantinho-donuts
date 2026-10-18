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
        Schema::create('tbl_itens_kit', function (Blueprint $table) {
            $table->integer('id_item_kit', true);
            $table->integer('id_kit')->index('fk_item_kit_kit');
            $table->integer('id_produto')->index('fk_item_kit_produto');
            $table->string('status_item_kit', 10)->default('ATIVO');
            $table->dateTime('criado_em_item_kit')->useCurrent();
            $table->dateTime('atualizado_em_item_kit')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_itens_kit');
    }
};
