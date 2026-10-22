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
        // Receitas do livro da Home, editadas no painel (Conteúdo do Site → Livro de receitas)
        Schema::create('tbl_receitas', function (Blueprint $table) {
            $table->integer('id_receita', true);
            $table->string('titulo_receita', 60);
            $table->string('destaque_receita', 60)->nullable();
            $table->text('intro_receita')->nullable();
            $table->string('tempo_receita', 30)->nullable();
            $table->string('rendimento_receita', 30)->nullable();
            $table->string('nivel_receita', 20)->nullable();
            $table->string('cor_receita', 10)->default('rose');
            // Uma linha por item; nos ingredientes, linha começando com # vira subtítulo
            $table->text('ingredientes_receita');
            $table->text('preparo_receita');
            $table->text('dica_receita')->nullable();
            $table->integer('ordem_receita')->default(0);
            $table->string('status_receita', 10)->default('ATIVO');
        });

        // Começa com as receitas que eram fixas no código
        $receitas = [
            ['Brigadeiro', 'tradicional', 'O docinho mais amado do Brasil, cremoso por dentro e coberto de granulado. Simples, rápido e impossível de comer um só.', '30 min', '25 unidades', 'Fácil', 'choco',
                ['1 lata de leite condensado (395 g)', '1 colher (sopa) de manteiga', '3 colheres (sopa) de chocolate em pó 50%', 'Chocolate granulado para enrolar'],
                ['Em uma panela, junte o leite condensado, a manteiga e o chocolate em pó.', 'Cozinhe em fogo baixo, mexendo sem parar, por 10 a 15 minutos, até a massa desgrudar do fundo da panela.', 'Transfira para um prato untado com manteiga e deixe esfriar completamente.', 'Com as mãos untadas, faça bolinhas e passe no granulado. Coloque em forminhas.'],
                'Para saber o ponto, incline a panela: a massa deve escorregar inteira, formando uma bola.'],
            ['Bolo de cenoura', 'com chocolate', 'Fofinho, úmido e com aquela cobertura brilhante que escorre pelas laterais. O clássico do café da tarde.', '1 hora', '12 fatias', 'Fácil', 'gold',
                ['3 cenouras médias picadas', '4 ovos', '1 xícara (chá) de óleo', '2 xícaras (chá) de açúcar', '2 e 1/2 xícaras (chá) de farinha de trigo', '1 colher (sopa) de fermento em pó', '# Cobertura', '1 colher (sopa) de manteiga', '3 colheres (sopa) de chocolate em pó', '1 xícara (chá) de açúcar', '1 xícara (chá) de leite'],
                ['Bata no liquidificador a cenoura, os ovos e o óleo até ficar bem liso.', 'Em uma tigela, misture o açúcar e a farinha, junte o creme batido e mexa bem. Por último, adicione o fermento.', 'Asse em forma untada e enfarinhada, em forno preaquecido a 180 °C, por cerca de 40 minutos.', 'Para a cobertura, leve todos os ingredientes ao fogo, mexendo até engrossar levemente, e espalhe sobre o bolo ainda morno.'],
                'Faça o teste do palito: se sair limpo, o bolo está pronto.'],
            ['Pudim', 'de leite condensado', 'Lisinho, sem furinhos e com uma calda dourada de caramelo. A sobremesa de domingo que nunca sai de moda.', '2 horas + geladeira', '10 fatias', 'Médio', 'gold',
                ['1 lata de leite condensado', 'A mesma medida da lata de leite', '3 ovos', '# Calda', '1 xícara (chá) de açúcar', '1/2 xícara (chá) de água'],
                ['Derreta o açúcar em fogo baixo até ficar dourado, junte a água com cuidado e cozinhe até formar uma calda. Espalhe na forma.', 'Bata no liquidificador o leite condensado, o leite e os ovos por cerca de 1 minuto.', 'Despeje na forma caramelizada, cubra com papel-alumínio e asse em banho-maria a 180 °C por cerca de 1 hora e 30 minutos.', 'Deixe esfriar, leve à geladeira por pelo menos 4 horas e desenforme.'],
                'Bata pouco no liquidificador: menos ar na mistura, menos furinhos no pudim.'],
            ['Mousse', 'de maracujá', 'Aerado, azedinho na medida e pronto em minutos. Perfeito para os dias quentes.', '15 min + geladeira', '6 taças', 'Fácil', 'gold',
                ['1 lata de leite condensado', '1 lata de creme de leite sem soro', 'A mesma medida da lata de suco concentrado de maracujá', 'Polpa de 1 maracujá para decorar'],
                ['Bata no liquidificador o leite condensado, o creme de leite e o suco por 3 minutos.', 'Distribua em taças ou em um refratário.', 'Leve à geladeira por pelo menos 3 horas, até firmar.', 'Na hora de servir, cubra com a polpa do maracujá com sementes.'],
                'Quer mais firme? Bata por mais tempo: o ácido do maracujá ajuda a dar consistência.'],
            ['Beijinho', 'de coco', 'O par perfeito do brigadeiro. Branquinho, perfumado e com o toque especial do cravo.', '30 min', '25 unidades', 'Fácil', 'rose',
                ['1 lata de leite condensado', '1 colher (sopa) de manteiga', '50 g de coco ralado', 'Coco ralado para enrolar', 'Cravos-da-índia para decorar'],
                ['Em uma panela, misture o leite condensado, a manteiga e o coco ralado.', 'Cozinhe em fogo baixo, mexendo sempre, até desgrudar do fundo da panela.', 'Passe para um prato untado e deixe esfriar.', 'Enrole bolinhas, passe no coco ralado e finalize com um cravo no topo.'],
                'Use coco ralado fresco ou úmido para um beijinho ainda mais macio.'],
            ['Brownie', 'de chocolate', 'Casquinha crocante por cima e centro úmido e denso. Para os verdadeiros amantes de chocolate.', '45 min', '16 quadrados', 'Médio', 'choco',
                ['200 g de chocolate meio amargo', '150 g de manteiga', '3 ovos', '1 xícara (chá) de açúcar', '1/2 xícara (chá) de farinha de trigo', '1 pitada de sal'],
                ['Derreta o chocolate com a manteiga em banho-maria ou no micro-ondas e misture bem.', 'Em outra tigela, bata os ovos com o açúcar até clarear. Junte o chocolate derretido.', 'Incorpore a farinha e o sal delicadamente, sem bater demais.', 'Asse em forma de 20 x 20 cm forrada com papel-manteiga, a 180 °C, por cerca de 25 minutos.'],
                'Tire do forno quando o centro ainda estiver levemente úmido: ele termina de firmar ao esfriar.'],
        ];

        foreach ($receitas as $i => $r) {
            DB::table('tbl_receitas')->insert([
                'titulo_receita'       => $r[0],
                'destaque_receita'     => $r[1],
                'intro_receita'        => $r[2],
                'tempo_receita'        => $r[3],
                'rendimento_receita'   => $r[4],
                'nivel_receita'        => $r[5],
                'cor_receita'          => $r[6],
                'ingredientes_receita' => implode("\n", $r[7]),
                'preparo_receita'      => implode("\n", $r[8]),
                'dica_receita'         => $r[9],
                'ordem_receita'        => $i + 1,
                'status_receita'       => 'ATIVO',
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_receitas');
    }
};
