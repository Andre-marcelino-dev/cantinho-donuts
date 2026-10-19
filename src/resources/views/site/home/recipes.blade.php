<!-- Recipes Section (livro de receitas animado) -->
@php
    $recipes = asset('davilla/gallery-davilla/fundorecipes.jpg');

    /*
     | RECEITAS DO LIVRO
     | Para adicionar uma receita, copie um bloco [ ... ] e altere os textos.
     | Em "ingredientes", uma linha que começa com # vira um subtítulo (ex.: "# Cobertura").
     | "cor" muda a cor de destaque da página: rose, gold ou choco.
     | O livro abre sozinho em uma receita diferente a cada dia.
     */
    $receitas = [
        [
            'titulo'      => 'Brigadeiro',
            'destaque'    => 'tradicional',
            'intro'       => 'O docinho mais amado do Brasil, cremoso por dentro e coberto de granulado. Simples, rápido e impossível de comer um só.',
            'tempo'       => '30 min',
            'rendimento'  => '25 unidades',
            'nivel'       => 'Fácil',
            'cor'         => 'choco',
            'ingredientes'=> [
                '1 lata de leite condensado (395 g)',
                '1 colher (sopa) de manteiga',
                '3 colheres (sopa) de chocolate em pó 50%',
                'Chocolate granulado para enrolar',
            ],
            'preparo'     => [
                'Em uma panela, junte o leite condensado, a manteiga e o chocolate em pó.',
                'Cozinhe em fogo baixo, mexendo sem parar, por 10 a 15 minutos, até a massa desgrudar do fundo da panela.',
                'Transfira para um prato untado com manteiga e deixe esfriar completamente.',
                'Com as mãos untadas, faça bolinhas e passe no granulado. Coloque em forminhas.',
            ],
            'dica'        => 'Para saber o ponto, incline a panela: a massa deve escorregar inteira, formando uma bola.',
        ],
        [
            'titulo'      => 'Bolo de cenoura',
            'destaque'    => 'com chocolate',
            'intro'       => 'Fofinho, úmido e com aquela cobertura brilhante que escorre pelas laterais. O clássico do café da tarde.',
            'tempo'       => '1 hora',
            'rendimento'  => '12 fatias',
            'nivel'       => 'Fácil',
            'cor'         => 'gold',
            'ingredientes'=> [
                '3 cenouras médias picadas',
                '4 ovos',
                '1 xícara (chá) de óleo',
                '2 xícaras (chá) de açúcar',
                '2 e 1/2 xícaras (chá) de farinha de trigo',
                '1 colher (sopa) de fermento em pó',
                '# Cobertura',
                '1 colher (sopa) de manteiga',
                '3 colheres (sopa) de chocolate em pó',
                '1 xícara (chá) de açúcar',
                '1 xícara (chá) de leite',
            ],
            'preparo'     => [
                'Bata no liquidificador a cenoura, os ovos e o óleo até ficar bem liso.',
                'Em uma tigela, misture o açúcar e a farinha, junte o creme batido e mexa bem. Por último, adicione o fermento.',
                'Asse em forma untada e enfarinhada, em forno preaquecido a 180 °C, por cerca de 40 minutos.',
                'Para a cobertura, leve todos os ingredientes ao fogo, mexendo até engrossar levemente, e espalhe sobre o bolo ainda morno.',
            ],
            'dica'        => 'Faça o teste do palito: se sair limpo, o bolo está pronto.',
        ],
        [
            'titulo'      => 'Pudim',
            'destaque'    => 'de leite condensado',
            'intro'       => 'Lisinho, sem furinhos e com uma calda dourada de caramelo. A sobremesa de domingo que nunca sai de moda.',
            'tempo'       => '2 horas + geladeira',
            'rendimento'  => '10 fatias',
            'nivel'       => 'Médio',
            'cor'         => 'gold',
            'ingredientes'=> [
                '1 lata de leite condensado',
                'A mesma medida da lata de leite',
                '3 ovos',
                '# Calda',
                '1 xícara (chá) de açúcar',
                '1/2 xícara (chá) de água',
            ],
            'preparo'     => [
                'Derreta o açúcar em fogo baixo até ficar dourado, junte a água com cuidado e cozinhe até formar uma calda. Espalhe na forma.',
                'Bata no liquidificador o leite condensado, o leite e os ovos por cerca de 1 minuto.',
                'Despeje na forma caramelizada, cubra com papel-alumínio e asse em banho-maria a 180 °C por cerca de 1 hora e 30 minutos.',
                'Deixe esfriar, leve à geladeira por pelo menos 4 horas e desenforme.',
            ],
            'dica'        => 'Bata pouco no liquidificador: menos ar na mistura, menos furinhos no pudim.',
        ],
        [
            'titulo'      => 'Mousse',
            'destaque'    => 'de maracujá',
            'intro'       => 'Aerado, azedinho na medida e pronto em minutos. Perfeito para os dias quentes.',
            'tempo'       => '15 min + geladeira',
            'rendimento'  => '6 taças',
            'nivel'       => 'Fácil',
            'cor'         => 'gold',
            'ingredientes'=> [
                '1 lata de leite condensado',
                '1 lata de creme de leite sem soro',
                'A mesma medida da lata de suco concentrado de maracujá',
                'Polpa de 1 maracujá para decorar',
            ],
            'preparo'     => [
                'Bata no liquidificador o leite condensado, o creme de leite e o suco por 3 minutos.',
                'Distribua em taças ou em um refratário.',
                'Leve à geladeira por pelo menos 3 horas, até firmar.',
                'Na hora de servir, cubra com a polpa do maracujá com sementes.',
            ],
            'dica'        => 'Quer mais firme? Bata por mais tempo: o ácido do maracujá ajuda a dar consistência.',
        ],
        [
            'titulo'      => 'Beijinho',
            'destaque'    => 'de coco',
            'intro'       => 'O par perfeito do brigadeiro. Branquinho, perfumado e com o toque especial do cravo.',
            'tempo'       => '30 min',
            'rendimento'  => '25 unidades',
            'nivel'       => 'Fácil',
            'cor'         => 'rose',
            'ingredientes'=> [
                '1 lata de leite condensado',
                '1 colher (sopa) de manteiga',
                '50 g de coco ralado',
                'Coco ralado para enrolar',
                'Cravos-da-índia para decorar',
            ],
            'preparo'     => [
                'Em uma panela, misture o leite condensado, a manteiga e o coco ralado.',
                'Cozinhe em fogo baixo, mexendo sempre, até desgrudar do fundo da panela.',
                'Passe para um prato untado e deixe esfriar.',
                'Enrole bolinhas, passe no coco ralado e finalize com um cravo no topo.',
            ],
            'dica'        => 'Use coco ralado fresco ou úmido para um beijinho ainda mais macio.',
        ],
        [
            'titulo'      => 'Brownie',
            'destaque'    => 'de chocolate',
            'intro'       => 'Casquinha crocante por cima e centro úmido e denso. Para os verdadeiros amantes de chocolate.',
            'tempo'       => '45 min',
            'rendimento'  => '16 quadrados',
            'nivel'       => 'Médio',
            'cor'         => 'choco',
            'ingredientes'=> [
                '200 g de chocolate meio amargo',
                '150 g de manteiga',
                '3 ovos',
                '1 xícara (chá) de açúcar',
                '1/2 xícara (chá) de farinha de trigo',
                '1 pitada de sal',
            ],
            'preparo'     => [
                'Derreta o chocolate com a manteiga em banho-maria ou no micro-ondas e misture bem.',
                'Em outra tigela, bata os ovos com o açúcar até clarear. Junte o chocolate derretido.',
                'Incorpore a farinha e o sal delicadamente, sem bater demais.',
                'Asse em forma de 20 x 20 cm forrada com papel-manteiga, a 180 °C, por cerca de 25 minutos.',
            ],
            'dica'        => 'Tire do forno quando o centro ainda estiver levemente úmido: ele termina de firmar ao esfriar.',
        ],
    ];

    $coresReceita = ['rose' => '#b94e5c', 'gold' => '#b8893f', 'choco' => '#6b3a2a'];
    $totalReceitas = count($receitas);
    $receitaDoDia = $totalReceitas ? now()->dayOfYear % $totalReceitas : 0;
@endphp

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,500;1,600&family=Poppins:wght@300;400;500;600&family=Great+Vibes&display=swap" rel="stylesheet">

<style>
.fsr{--cream:#fdf6ee;--choco:#2a1710;--choco-2:#4a2a1d;--rose:#e07a85;--rose-2:#b94e5c;--gold:#d9b06c;--gold-2:#f3d9a4;--text:#6e5a50;--muted:#a08d7d;
  position:relative;padding:120px 16px 130px;font-family:'Poppins',sans-serif;color:var(--choco);overflow:hidden;isolation:isolate;background:var(--choco)}
.fsr *{box-sizing:border-box}
.fsr__bg{position:absolute;inset:0;z-index:-3;background-size:cover;background-position:center}
.fsr__overlay{position:absolute;inset:0;z-index:-2;background:radial-gradient(ellipse at 50% 55%,rgba(74,42,29,.55),rgba(42,23,16,.94) 70%),linear-gradient(180deg,rgba(42,23,16,.75),rgba(42,23,16,.9))}
.fsr__glow{position:absolute;left:50%;top:58%;width:900px;height:600px;transform:translate(-50%,-50%);border-radius:50%;z-index:-1;
  background:radial-gradient(closest-side,rgba(243,217,164,.22),transparent);animation:fsrGlow 6s ease-in-out infinite}
@keyframes fsrGlow{50%{opacity:.6;transform:translate(-50%,-50%) scale(1.08)}}

/* Cabeçalho */
.fsr__head{text-align:center;max-width:700px;margin:0 auto 70px;color:#fff}
.fsr__eyebrow{display:inline-flex;align-items:center;gap:14px;font-size:13px;font-weight:600;letter-spacing:.32em;text-transform:uppercase;color:var(--gold-2)}
.fsr__eyebrow::before,.fsr__eyebrow::after{content:"";height:1px;width:0;background:var(--gold);transition:width 1.2s cubic-bezier(.2,.7,.2,1) .2s}
.fsr__eyebrow.is-in::before,.fsr__eyebrow.is-in::after{width:46px}
.fsr__title{font-family:'Playfair Display',serif;font-weight:800;font-size:clamp(38px,5.4vw,62px);line-height:1.06;letter-spacing:-.02em;margin:20px 0 16px;color:#fff}
.fsr__title em{font-style:italic;font-weight:600;background:linear-gradient(90deg,var(--gold-2),var(--rose),var(--gold),var(--gold-2));background-size:300% 100%;
  -webkit-background-clip:text;background-clip:text;color:transparent;animation:fsrShine 6s linear infinite}
@keyframes fsrShine{to{background-position:300% 0}}
.fsr__sub{font-size:17px;line-height:1.7;color:rgba(255,255,255,.75);margin:0;font-weight:300}

/* Livro */
.fsr__stage{max-width:1100px;margin:0 auto;padding:0 18px}
.fsr__book{position:relative;height:660px;perspective:2600px;animation:fsrFloat 8s ease-in-out infinite}
@keyframes fsrFloat{0%,100%{transform:translateY(0) rotateX(0)}50%{transform:translateY(-8px)}}
.fsr__cover{position:absolute;inset:-16px -18px -22px;border-radius:20px;background:linear-gradient(135deg,#7a4430,#3e2217 60%,#2e180f);
  box-shadow:0 60px 100px -30px rgba(0,0,0,.8),inset 0 0 0 2px rgba(217,176,108,.28),inset 0 0 0 8px rgba(0,0,0,.12)}
.fsr__cover::after{content:"";position:absolute;left:50%;top:0;bottom:0;width:30px;transform:translateX(-50%);background:linear-gradient(90deg,transparent,rgba(0,0,0,.35),transparent)}
.fsr__page,.fsr__face{position:absolute;top:0;height:100%;padding:44px 46px 46px;overflow:hidden}
.fsr__page{width:50%}
.fsr__page--l{left:0}
.fsr__page--r{left:50%}
.fsr__paper--l{border-radius:12px 2px 2px 12px;
  background:linear-gradient(90deg,rgba(0,0,0,0) 80%,rgba(120,80,50,.16) 100%),
             radial-gradient(circle at 20% 15%,#fffdf8,#fbf3e6 70%);
  box-shadow:-2px 2px 0 #efe3d2,-4px 4px 0 #e6d7c3,-6px 6px 0 #dccab3}
.fsr__paper--r{border-radius:2px 12px 12px 2px;
  background:linear-gradient(90deg,rgba(120,80,50,.18) 0%,rgba(0,0,0,0) 18%),
             repeating-linear-gradient(180deg,transparent 0 31px,rgba(224,122,133,.09) 31px 32px),
             radial-gradient(circle at 80% 15%,#fffdf8,#fbf3e6 70%);
  box-shadow:2px 2px 0 #efe3d2,4px 4px 0 #e6d7c3,6px 6px 0 #dccab3}
.fsr__spine{position:absolute;left:50%;top:0;bottom:0;width:2px;transform:translateX(-50%);background:rgba(120,80,50,.25);z-index:4;pointer-events:none}

/* Folha que vira */
.fsr__leaf{position:absolute;top:0;width:50%;height:100%;z-index:6;transform-style:preserve-3d;display:none;pointer-events:none}
.fsr__leaf.is-next{left:50%;transform-origin:0 50%}
.fsr__leaf.is-prev{left:0;transform-origin:100% 50%}
.fsr__leaf.is-on{display:block}
.fsr__leaf.is-turning{transition:transform 1s cubic-bezier(.45,.05,.25,1)}
.fsr__leaf.is-next.is-turning{transform:rotateY(-180deg)}
.fsr__leaf.is-prev.is-turning{transform:rotateY(180deg)}
.fsr__face{inset:0;width:100%;-webkit-backface-visibility:hidden;backface-visibility:hidden}
.fsr__face--back{transform:rotateY(180deg)}
.fsr__face::after{content:"";position:absolute;inset:0;pointer-events:none;opacity:0;background:linear-gradient(90deg,rgba(42,23,16,.28),transparent 60%)}
.fsr__leaf.is-turning .fsr__face::after{animation:fsrShade 1s ease}
@keyframes fsrShade{50%{opacity:1}}

/* Fita marcadora */
.fsr__ribbon{position:absolute;z-index:7;top:-18px;right:70px;width:28px;height:130px;background:linear-gradient(90deg,var(--rose-2),var(--rose) 50%,var(--rose-2));
  clip-path:polygon(0 0,100% 0,100% 100%,50% 86%,0 100%);transform-origin:50% 0;animation:fsrSway 5s ease-in-out infinite;box-shadow:0 6px 10px rgba(0,0,0,.2)}
@keyframes fsrSway{0%,100%{transform:rotate(-2deg)}50%{transform:rotate(3deg)}}

/* Cantos clicáveis */
.fsr__corner{position:absolute;z-index:8;bottom:0;width:70px;height:70px;border:0;padding:0;cursor:pointer;background:transparent}
.fsr__corner--r{right:0}
.fsr__corner--l{left:0}
.fsr__corner::before{content:"";position:absolute;bottom:0;width:34px;height:34px;transition:width .35s ease,height .35s ease}
.fsr__corner--r::before{right:0;border-radius:0 0 12px 0;background:linear-gradient(315deg,#2e180f 0 50%,#f1e2cd 50% 60%,#e3cfb4 100%);box-shadow:-3px -3px 6px rgba(0,0,0,.12)}
.fsr__corner--l::before{left:0;border-radius:0 0 0 12px;background:linear-gradient(45deg,#2e180f 0 50%,#f1e2cd 50% 60%,#e3cfb4 100%);box-shadow:3px -3px 6px rgba(0,0,0,.12)}
.fsr__corner:hover::before{width:60px;height:60px}
.fsr__corner--r::after{content:"";position:absolute;right:6px;bottom:6px;width:10px;height:10px;border-radius:50%;background:var(--rose);animation:fsrHint 2s infinite}
@keyframes fsrHint{0%{box-shadow:0 0 0 0 rgba(224,122,133,.7)}80%,100%{box-shadow:0 0 0 14px rgba(224,122,133,0)}}

/* Conteúdo da página esquerda */
.fsr__rc{--rc:#b94e5c;height:100%;display:flex;flex-direction:column}
.fsr__tag{align-self:flex-start;display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border-radius:50px;font-size:11px;font-weight:600;letter-spacing:.16em;
  text-transform:uppercase;color:var(--rc);background:color-mix(in srgb,var(--rc) 12%,transparent);border:1px solid color-mix(in srgb,var(--rc) 25%,transparent)}
.fsr__tag svg{width:14px;height:14px}
.fsr__tag--today{color:#fff;background:linear-gradient(135deg,var(--rose),var(--rose-2));border-color:transparent;animation:fsrPulse 2.4s infinite}
@keyframes fsrPulse{0%{box-shadow:0 0 0 0 rgba(224,122,133,.55)}80%,100%{box-shadow:0 0 0 12px rgba(224,122,133,0)}}
.fsr__rtitle{font-family:'Playfair Display',serif;font-weight:800;font-size:40px;line-height:1.05;letter-spacing:-.01em;margin:18px 0 12px;color:var(--choco)}
.fsr__rtitle em{display:block;font-style:italic;font-weight:600;font-size:.72em;color:var(--rc);margin-top:4px}
.fsr__intro{font-size:14.5px;line-height:1.7;color:var(--text);margin:0 0 18px}
.fsr__meta{display:grid;grid-template-columns:repeat(3,1fr);border-top:1.5px dashed #e6d5c1;border-bottom:1.5px dashed #e6d5c1;padding:14px 0;margin-bottom:auto}
.fsr__meta div{display:flex;flex-direction:column;align-items:center;gap:4px;text-align:center;padding:0 6px}
.fsr__meta div+div{border-left:1px solid #eadbc8}
.fsr__meta svg{width:20px;height:20px;color:var(--rc)}
.fsr__meta small{font-size:9.5px;letter-spacing:.14em;text-transform:uppercase;color:var(--muted)}
.fsr__meta b{font-size:13px;font-weight:600;color:var(--choco-2);line-height:1.25}
.fsr__illus{display:block;width:150px;height:96px;margin:14px auto 10px;fill:none;stroke:var(--rc);stroke-width:2;stroke-linecap:round;stroke-linejoin:round;opacity:.8}
.fsr__illus *{stroke-dasharray:260;stroke-dashoffset:260}
.is-drawn .fsr__illus *{transition:stroke-dashoffset 2s cubic-bezier(.6,0,.2,1) .2s;stroke-dashoffset:0}
.fsr__illus .steam{animation:fsrSteam 3s ease-in-out infinite}
.fsr__illus .steam:nth-of-type(2){animation-delay:-1s}
.fsr__illus .steam:nth-of-type(3){animation-delay:-2s}
@keyframes fsrSteam{0%,100%{transform:translateY(0);opacity:.9}50%{transform:translateY(-5px);opacity:.4}}
.fsr__tip{position:relative;padding:14px 16px 14px 18px;border-radius:12px;background:color-mix(in srgb,var(--rc) 8%,transparent);border-left:3px solid var(--rc)}
.fsr__tip b{display:block;font-family:'Great Vibes',cursive;font-weight:400;font-size:24px;line-height:1;color:var(--rc);margin-bottom:4px}
.fsr__tip p{margin:0;font-size:13px;line-height:1.6;color:var(--choco-2)}
.fsr__pnum{position:absolute;bottom:16px;left:0;right:0;text-align:center;font-family:'Playfair Display',serif;font-style:italic;font-size:13px;color:var(--muted)}

/* Conteúdo da página direita */
.fsr__h4{display:flex;align-items:center;gap:12px;font-family:'Playfair Display',serif;font-weight:700;font-size:22px;margin:0 0 14px;color:var(--choco)}
.fsr__h4::after{content:"";flex:1;height:1px;background:linear-gradient(90deg,color-mix(in srgb,var(--rc) 45%,transparent),transparent)}
.fsr__ing{list-style:none;margin:0 0 22px;padding:0;columns:2;column-gap:22px}
.fsr__ing li{break-inside:avoid;margin-bottom:7px}
.fsr__ing li.sub{column-span:all;font-family:'Playfair Display',serif;font-style:italic;font-weight:600;font-size:14px;color:var(--rc);margin:8px 0 6px}
.fsr__ing label{display:flex;gap:9px;align-items:flex-start;cursor:pointer;font-size:13px;line-height:1.45;color:var(--choco-2)}
.fsr__ing input{position:absolute;opacity:0;pointer-events:none}
.fsr__ing i{flex:none;width:16px;height:16px;margin-top:1px;border-radius:5px;border:1.5px solid color-mix(in srgb,var(--rc) 55%,transparent);display:grid;place-items:center;transition:background .25s,border-color .25s,transform .3s cubic-bezier(.3,1.7,.5,1)}
.fsr__ing i::after{content:"";width:8px;height:4px;border-left:2px solid #fff;border-bottom:2px solid #fff;transform:rotate(-45deg) scale(0);margin-top:-2px;transition:transform .25s cubic-bezier(.3,1.7,.5,1)}
.fsr__ing input:checked+i{background:var(--rc);border-color:var(--rc);transform:scale(1.1)}
.fsr__ing input:checked+i::after{transform:rotate(-45deg) scale(1)}
.fsr__ing input:checked~span{text-decoration:line-through;color:var(--muted)}
.fsr__ing input:focus-visible+i{outline:2px solid var(--rc);outline-offset:2px}
.fsr__steps{list-style:none;margin:0;padding:0;counter-reset:s}
.fsr__steps li{counter-increment:s;position:relative;padding-left:40px;margin-bottom:12px;font-size:13px;line-height:1.6;color:var(--choco-2)}
.fsr__steps li::before{content:counter(s);position:absolute;left:0;top:0;width:26px;height:26px;border-radius:50%;display:grid;place-items:center;
  font-family:'Playfair Display',serif;font-weight:700;font-size:13px;color:#fff;background:var(--rc)}
.fsr__steps li:not(:last-child)::after{content:"";position:absolute;left:12.5px;top:30px;bottom:-10px;width:1px;background:color-mix(in srgb,var(--rc) 25%,transparent)}
.fsr__scroll{height:100%;overflow-y:auto;padding-right:6px;scrollbar-width:thin;scrollbar-color:#e3cfb4 transparent}

/* Controles */
.fsr__controls{display:flex;align-items:center;justify-content:center;gap:16px;margin-top:64px;flex-wrap:wrap}
.fsr__btn{display:inline-flex;align-items:center;gap:10px;height:52px;padding:0 24px;border-radius:50px;border:0;cursor:pointer;font-family:inherit;font-size:14px;font-weight:600;
  color:#fff;background:rgba(255,255,255,.08);box-shadow:inset 0 0 0 1px rgba(255,255,255,.18);-webkit-backdrop-filter:blur(8px);backdrop-filter:blur(8px);
  transition:background .3s,transform .35s cubic-bezier(.3,1.6,.5,1),box-shadow .3s,color .3s}
.fsr__btn svg{width:18px;height:18px}
.fsr__btn:hover{background:rgba(255,255,255,.16);transform:translateY(-3px)}
.fsr__btn--main{background:linear-gradient(135deg,var(--rose),var(--rose-2));box-shadow:0 16px 34px -14px rgba(185,78,92,.8)}
.fsr__btn--main:hover{background:linear-gradient(135deg,var(--rose),var(--rose-2));box-shadow:0 22px 40px -14px rgba(185,78,92,.95)}
.fsr__btn--icon{width:52px;padding:0;justify-content:center}
.fsr__btn--shuffle:hover svg{animation:fsrShake .5s}
@keyframes fsrShake{25%{transform:rotate(-15deg)}75%{transform:rotate(15deg)}}
.fsr__counter{font-family:'Playfair Display',serif;font-size:17px;font-weight:700;color:var(--gold-2);min-width:64px;text-align:center}
.fsr__counter span{color:rgba(255,255,255,.5);font-weight:600}
.fsr__hint{text-align:center;margin:18px 0 0;font-size:13px;color:rgba(255,255,255,.55)}

.fsr__tpl{display:none}

/* Revelar */
.fsr--js [data-reveal]{opacity:0;transform:translateY(50px);transition:opacity 1s cubic-bezier(.2,.7,.2,1) var(--d,0s),transform 1s cubic-bezier(.2,.7,.2,1) var(--d,0s)}
.fsr--js [data-reveal].is-in{opacity:1;transform:none}
.fsr--js .fsr__stage[data-reveal]{transform:translateY(60px) scale(.94) rotateX(12deg)}
.fsr--js .fsr__stage[data-reveal].is-in{transform:none}

/* Telas menores: páginas empilhadas */
@media (max-width:900px){
  .fsr__book{height:auto;animation:none;perspective:none}
  .fsr__cover,.fsr__spine,.fsr__leaf,.fsr__corner{display:none!important}
  .fsr__page{position:relative;left:auto!important;width:100%;height:auto;padding:36px 26px 46px;border-radius:18px!important;box-shadow:0 30px 60px -30px rgba(0,0,0,.7)}
  .fsr__page--r{margin-top:18px}
  .fsr__paper--l,.fsr__paper--r{background:radial-gradient(circle at 20% 10%,#fffdf8,#fbf3e6 70%)}
  .fsr__ribbon{left:auto;right:30px;height:90px}
  .fsr__scroll{height:auto;overflow:visible}
  .fsr__book.is-fading .fsr__page{animation:fsrFade .6s ease}
  .fsr__rtitle{font-size:34px}
}
@media (max-width:480px){.fsr__ing{columns:1}.fsr__meta b{font-size:12px}}
@keyframes fsrFade{0%{opacity:1;transform:none}45%{opacity:0;transform:translateX(-24px)}55%{opacity:0;transform:translateX(24px)}100%{opacity:1;transform:none}}
@media (prefers-reduced-motion:reduce){
  .fsr *,.fsr *::before,.fsr *::after{animation:none!important;transition:none!important}
  .fsr--js [data-reveal]{opacity:1;transform:none}
  .fsr__illus *{stroke-dashoffset:0}
}
</style>

<section class="fsr" id="fsr" data-today="{{ $receitaDoDia }}">
    <div class="fsr__bg" style="background-image:url('{{ $recipes }}');"></div>
    <div class="fsr__overlay"></div>
    <div class="fsr__glow"></div>

    <div class="fsr__head">
        <span class="fsr__eyebrow" data-reveal>Do nosso caderno</span>
        <h2 class="fsr__title" data-reveal style="--d:.1s">Receitas <em>para você</em></h2>
        <p class="fsr__sub" data-reveal style="--d:.2s">Todo dia o nosso livro abre em uma receita nova, direto do caderno da família. Vire as páginas e volte amanhã para descobrir a próxima!</p>
    </div>

    <div class="fsr__stage" data-reveal style="--d:.25s">
        <div class="fsr__book">
            <div class="fsr__cover"></div>
            <div class="fsr__page fsr__page--l fsr__paper--l" data-page="l"></div>
            <div class="fsr__page fsr__page--r fsr__paper--r" data-page="r"></div>
            <div class="fsr__spine"></div>
            <div class="fsr__leaf">
                <div class="fsr__face fsr__face--front"></div>
                <div class="fsr__face fsr__face--back"></div>
            </div>
            <span class="fsr__ribbon" aria-hidden="true"></span>
            <button type="button" class="fsr__corner fsr__corner--l" data-go="-1" aria-label="Receita anterior"></button>
            <button type="button" class="fsr__corner fsr__corner--r" data-go="1" aria-label="Próxima receita"></button>
        </div>
    </div>

    <div class="fsr__controls">
        <button type="button" class="fsr__btn fsr__btn--icon" data-go="-1" aria-label="Receita anterior">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M11 6l-6 6 6 6"/></svg>
        </button>
        <span class="fsr__counter" aria-live="polite"><b class="cur">01</b> <span>/ {{ str_pad($totalReceitas, 2, '0', STR_PAD_LEFT) }}</span></span>
        <button type="button" class="fsr__btn fsr__btn--icon" data-go="1" aria-label="Próxima receita">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </button>
        <button type="button" class="fsr__btn fsr__btn--main" data-today-btn>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="3"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
            Receita do dia
        </button>
        <button type="button" class="fsr__btn fsr__btn--shuffle" data-random>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 3h5v5"/><path d="M4 20 21 3"/><path d="M21 16v5h-5"/><path d="M15 15l6 6"/><path d="M4 4l5 5"/></svg>
            Surpreenda-me
        </button>
    </div>
    <p class="fsr__hint">Dica: clique no canto da página ou arraste para o lado para virar.</p>

    {{-- Conteúdo de cada receita (usado pelo livro) --}}
    @foreach ($receitas as $i => $r)
        <template class="fsr__tpl" data-side="l" data-i="{{ $i }}">
            <div class="fsr__rc" style="--rc:{{ $coresReceita[$r['cor']] ?? '#b94e5c' }}">
                @if ($i === $receitaDoDia)
                    <span class="fsr__tag fsr__tag--today"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l2.4 7.6L22 12l-7.6 2.4L12 22l-2.4-7.6L2 12l7.6-2.4z"/></svg>Receita do dia</span>
                @else
                    <span class="fsr__tag">Receita nº {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                @endif
                <h3 class="fsr__rtitle">{{ $r['titulo'] }} <em>{{ $r['destaque'] }}</em></h3>
                <p class="fsr__intro">{{ $r['intro'] }}</p>
                <div class="fsr__meta">
                    <div><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg><small>Tempo</small><b>{{ $r['tempo'] }}</b></div>
                    <div><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 21h16M5 21v-6a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v6"/><path d="M5 17c1.2 0 1.8-1 3-1s1.8 1 3 1 1.8-1 3-1 1.8 1 3 1 1.8-1 2-1"/><path d="M12 13V9"/></svg><small>Rende</small><b>{{ $r['rendimento'] }}</b></div>
                    <div><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l2.9 6.3 6.9.7-5.2 4.6 1.5 6.8L12 17l-6.1 3.4 1.5-6.8L2.2 9l6.9-.7z"/></svg><small>Nível</small><b>{{ $r['nivel'] }}</b></div>
                </div>
                <svg class="fsr__illus" viewBox="0 0 160 100" aria-hidden="true">
                    <path class="steam" d="M62 30 C56 22 68 18 62 8"/>
                    <path class="steam" d="M80 28 C74 20 86 16 80 6"/>
                    <path class="steam" d="M98 30 C92 22 104 18 98 8"/>
                    <path d="M14 44 H146"/>
                    <path d="M22 44 C22 74 46 92 80 92 C114 92 138 74 138 44"/>
                    <path d="M60 92 L56 98 H104 L100 92"/>
                    <path d="M118 40 L146 6"/>
                    <path d="M140 10 C150 2 158 8 152 16 C146 22 138 18 140 10 Z"/>
                </svg>
                <div class="fsr__tip"><b>Dica da confeiteira</b><p>{{ $r['dica'] }}</p></div>
            </div>
            <span class="fsr__pnum">{{ ($i * 2) + 1 }}</span>
        </template>

        <template class="fsr__tpl" data-side="r" data-i="{{ $i }}">
            <div class="fsr__rc" style="--rc:{{ $coresReceita[$r['cor']] ?? '#b94e5c' }}">
                <div class="fsr__scroll">
                    <h4 class="fsr__h4">Ingredientes</h4>
                    <ul class="fsr__ing">
                        @foreach ($r['ingredientes'] as $ing)
                            @if (\Illuminate\Support\Str::startsWith($ing, '#'))
                                <li class="sub">{{ trim(ltrim($ing, '#')) }}</li>
                            @else
                                <li><label><input type="checkbox"><i></i><span>{{ $ing }}</span></label></li>
                            @endif
                        @endforeach
                    </ul>
                    <h4 class="fsr__h4">Modo de preparo</h4>
                    <ol class="fsr__steps">
                        @foreach ($r['preparo'] as $passo)
                            <li>{{ $passo }}</li>
                        @endforeach
                    </ol>
                </div>
            </div>
            <span class="fsr__pnum">{{ ($i * 2) + 2 }}</span>
        </template>
    @endforeach
</section>

<script>
(function () {
    var root = document.getElementById('fsr');
    if (!root) return;
    root.classList.add('fsr--js');
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var book = root.querySelector('.fsr__book');
    var pageL = root.querySelector('[data-page="l"]');
    var pageR = root.querySelector('[data-page="r"]');
    var leaf = root.querySelector('.fsr__leaf');
    var front = leaf.querySelector('.fsr__face--front');
    var back = leaf.querySelector('.fsr__face--back');
    var cur = root.querySelector('.fsr__counter .cur');
    var tpls = root.querySelectorAll('.fsr__tpl');
    var total = tpls.length / 2;
    if (!total) return;
    var today = Math.min(parseInt(root.dataset.today, 10) || 0, total - 1);
    var i = today, busy = false;

    function html(side, n) { return root.querySelector('.fsr__tpl[data-side="' + side + '"][data-i="' + n + '"]').innerHTML; }
    function draw(el) { el.classList.remove('is-drawn'); void el.offsetWidth; el.classList.add('is-drawn'); }
    function counter() { cur.textContent = (i + 1 < 10 ? '0' : '') + (i + 1); }
    function stacked() { return window.matchMedia('(max-width: 900px)').matches; }

    pageL.innerHTML = html('l', i);
    pageR.innerHTML = html('r', i);
    counter();

    function go(n, dir) {
        if (busy || n === i) return;
        dir = dir || (n > i ? 1 : -1);
        busy = true;
        var oldL = pageL.innerHTML, oldR = pageR.innerHTML;
        var newL = html('l', n), newR = html('r', n);
        i = n; counter();

        if (reduce || stacked()) {
            book.classList.remove('is-fading'); void book.offsetWidth; book.classList.add('is-fading');
            setTimeout(function () { pageL.innerHTML = newL; pageR.innerHTML = newR; draw(pageL); }, reduce ? 0 : 280);
            setTimeout(function () { book.classList.remove('is-fading'); busy = false; }, reduce ? 0 : 620);
            return;
        }

        leaf.className = 'fsr__leaf is-on ' + (dir > 0 ? 'is-next' : 'is-prev');
        front.className = 'fsr__face fsr__face--front ' + (dir > 0 ? 'fsr__paper--r' : 'fsr__paper--l');
        back.className = 'fsr__face fsr__face--back ' + (dir > 0 ? 'fsr__paper--l' : 'fsr__paper--r');
        if (dir > 0) { front.innerHTML = oldR; back.innerHTML = newL; pageR.innerHTML = newR; }
        else { front.innerHTML = oldL; back.innerHTML = newR; pageL.innerHTML = newL; }
        draw(back);
        void leaf.offsetWidth;
        leaf.classList.add('is-turning');

        setTimeout(function () {
            if (dir > 0) pageL.innerHTML = newL; else pageR.innerHTML = newR;
            draw(pageL);
            leaf.className = 'fsr__leaf';
            front.innerHTML = ''; back.innerHTML = '';
            busy = false;
        }, 1020);
    }

    root.querySelectorAll('[data-go]').forEach(function (b) {
        b.addEventListener('click', function () {
            var d = +b.dataset.go;
            go((i + d + total) % total, d);
        });
    });
    root.querySelector('[data-today-btn]').addEventListener('click', function () { go(today); });
    root.querySelector('[data-random]').addEventListener('click', function () {
        if (total < 2) return;
        var n; do { n = Math.floor(Math.random() * total); } while (n === i);
        go(n, 1);
    });

    // Arrastar / deslizar para virar
    var sx = null, sy = 0;
    book.addEventListener('pointerdown', function (e) {
        if (e.target.closest('label, input, button, .fsr__scroll')) return;
        sx = e.clientX; sy = e.clientY;
    });
    window.addEventListener('pointerup', function (e) {
        if (sx === null) return;
        var dx = e.clientX - sx, dy = e.clientY - sy; sx = null;
        if (Math.abs(dx) > 60 && Math.abs(dx) > Math.abs(dy)) {
            var d = dx < 0 ? 1 : -1;
            go((i + d + total) % total, d);
        }
    });

    // Setas do teclado quando o livro está na tela
    var visible = false;
    new IntersectionObserver(function (es) { visible = es[0].isIntersecting; }, { threshold: 0.4 }).observe(book);
    document.addEventListener('keydown', function (e) {
        if (!visible || /input|textarea|select/i.test(document.activeElement.tagName)) return;
        if (e.key === 'ArrowRight') go((i + 1) % total, 1);
        if (e.key === 'ArrowLeft') go((i - 1 + total) % total, -1);
    });

    // Revelar ao rolar
    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) {
            if (!e.isIntersecting) return;
            e.target.classList.add('is-in');
            if (e.target.classList.contains('fsr__stage')) setTimeout(function () { draw(pageL); }, 700);
            io.unobserve(e.target);
        });
    }, { threshold: 0.15 });
    root.querySelectorAll('[data-reveal]').forEach(function (el) { io.observe(el); });
})();
</script>
<!-- End Recipes Section -->