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
        Schema::table('tbl_itens_kit', function (Blueprint $table) {
            $table->foreign('id_kit', 'fk_item_kit_kit')
                ->references('id_kit')
                ->on('tbl_kits');

            $table->foreign('id_produto', 'fk_item_kit_produto')
                ->references('id_produto')
                ->on('tbl_produtos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_itens_kit', function (Blueprint $table) {
            $table->dropForeign('fk_item_kit_kit');
            $table->dropForeign('fk_item_kit_produto');
        });
    }
};
