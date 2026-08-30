<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_eventos', function (Blueprint $table) {
            $table->id('id_evento');
            $table->string('titulo_evento', 30);
            $table->string('nome_evento', 120);
            $table->string('descricao_evento', 160)->nullable();
            $table->string('foto_evento', 50)->nullable();
            $table->date('data_evento');
            $table->string('horario_evento', 30);
            $table->string('endereco_evento', 160);
            $table->string('tags_evento', 255)->nullable();
            $table->string('link_local_evento', 255)->nullable();
            $table->integer('ordem_evento')->default(0);
            $table->string('status_evento', 10)->default('ATIVO');
            $table->datetime('criado_em_evento')->useCurrent();
            $table->datetime('atualizado_em_evento')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_eventos');
    }
};
