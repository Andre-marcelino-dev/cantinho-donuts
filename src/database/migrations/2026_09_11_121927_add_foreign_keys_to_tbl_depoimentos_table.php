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
        Schema::table('tbl_depoimentos', function (Blueprint $table) {
            $table->foreign(['id_cliente'], 'fk_depoimentos_clientes')->references(['id_cliente'])->on('tbl_clientes')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_depoimentos', function (Blueprint $table) {
            $table->dropForeign('fk_depoimentos_clientes');
        });
    }
};
