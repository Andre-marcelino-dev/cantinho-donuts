<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Zonas de entrega: cada uma cobre uma faixa de distância (km) a partir da loja
        Schema::create('tbl_zonas_entrega', function (Blueprint $table) {
            $table->integer('id_zona_entrega', true);
            $table->string('nome_zona_entrega', 30);
            $table->string('apelido_zona_entrega', 40)->nullable();
            $table->decimal('km_min_zona_entrega', 5, 2)->default(0);
            $table->decimal('km_max_zona_entrega', 5, 2);
            $table->decimal('taxa_zona_entrega', 8, 2)->default(0);
            $table->string('prazo_zona_entrega', 30);
            $table->string('cor_zona_entrega', 10)->default('rose');
            $table->string('status_zona_entrega', 10)->default('ATIVO');
            $table->dateTime('criado_em_zona_entrega')->useCurrent();
            $table->dateTime('atualizado_em_zona_entrega')->useCurrentOnUpdate()->useCurrent();
        });

        // Bairros de cada zona (aparecem nos cards do site). A faixa de CEP é opcional
        // e, quando preenchida, tem prioridade sobre o cálculo de distância.
        Schema::create('tbl_bairros_entrega', function (Blueprint $table) {
            $table->integer('id_bairro_entrega', true);
            $table->integer('id_zona_entrega')->index('fk_bairros_zonas_entrega');
            $table->string('nome_bairro_entrega', 60);
            $table->char('cep_inicio_bairro_entrega', 8)->nullable();
            $table->char('cep_fim_bairro_entrega', 8)->nullable();

            $table->foreign('id_zona_entrega', 'fk_bairros_zonas_entrega')
                ->references('id_zona_entrega')->on('tbl_zonas_entrega')
                ->onDelete('cascade');
        });

        // Começa com as zonas que estavam fixas na página Região
        $zonas = [
            ['Zona 1', 'Pertinho da gente', 0, 3, 0, 'até 40 min', 'rose',
                ['Parque Santa Rita', 'Itaim Paulista', 'Vila Curuçá', 'Jardim Camargo Novo']],
            ['Zona 2', 'Logo ali', 3, 6, 8, '40 a 60 min', 'gold',
                ['Jardim Helena', 'Vila Jacuí', 'São Miguel Paulista', 'Lajeado', 'Guaianases']],
            ['Zona 3', 'Vale a viagem', 6, 10, 15, '1h a 1h30', 'choco',
                ['Ermelino Matarazzo', 'Ponte Rasa', 'Itaquera', 'José Bonifácio', 'Cidade Tiradentes']],
        ];

        foreach ($zonas as [$nome, $apelido, $kmMin, $kmMax, $taxa, $prazo, $cor, $bairros]) {
            $id = DB::table('tbl_zonas_entrega')->insertGetId([
                'nome_zona_entrega'    => $nome,
                'apelido_zona_entrega' => $apelido,
                'km_min_zona_entrega'  => $kmMin,
                'km_max_zona_entrega'  => $kmMax,
                'taxa_zona_entrega'    => $taxa,
                'prazo_zona_entrega'   => $prazo,
                'cor_zona_entrega'     => $cor,
            ]);

            DB::table('tbl_bairros_entrega')->insert(array_map(fn ($bairro) => [
                'id_zona_entrega'     => $id,
                'nome_bairro_entrega' => $bairro,
            ], $bairros));
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_bairros_entrega');
        Schema::dropIfExists('tbl_zonas_entrega');
    }
};
