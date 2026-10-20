<!-- Recipes Section Two: lista de receitas (redesign animado) -->
@php
    /*
     | RECEITAS
     | Para adicionar uma receita, copie um bloco [ ... ] e altere os textos.
     | - foto: arquivo dentro de public/davilla/regiao-img/
     | - minutos: tempo total aproximado (usado para ordenar "Mais rápidas")
     | - em "ingredientes", uma linha que começa com # vira subtítulo (ex.: '# Cobertura')
     */
    $receitas = [
        [
            'titulo' => 'Bolo Red Velvet', 'categoria' => 'Bolos', 'foto' => 'recipe_1.jpg',
            'tempo' => '1h30', 'minutos' => 90, 'rendimento' => '12 fatias', 'nivel' => 'Médio',
            'intro' => 'Massa aveludada de cor intensa com cobertura cremosa de cream cheese. Um clássico para ocasiões especiais.',
            'ingredientes' => [
                '2 e 1/2 xícaras (chá) de farinha de trigo', '1 e 1/2 xícara (chá) de açúcar', '1 colher (sopa) de cacau em pó',
                '1 colher (chá) de bicarbonato de sódio', '1 pitada de sal', '2 ovos', '1 xícara (chá) de óleo',
                '1 xícara (chá) de leite + 1 colher (sopa) de vinagre', '1 colher (sopa) de corante vermelho em gel', '1 colher (chá) de essência de baunilha',
                '# Cobertura', '300 g de cream cheese', '100 g de manteiga em temperatura ambiente', '2 xícaras (chá) de açúcar de confeiteiro',
            ],
            'preparo' => [
                'Misture o leite com o vinagre e deixe descansar por 10 minutos.',
                'Em uma tigela, misture a farinha, o açúcar, o cacau, o bicarbonato e o sal.',
                'Em outra tigela, bata os ovos com o óleo, o leite reservado, o corante e a baunilha. Junte aos secos e misture até ficar homogêneo.',
                'Divida em duas formas de 20 cm untadas e asse em forno preaquecido a 180 °C por cerca de 30 minutos.',
                'Para a cobertura, bata o cream cheese com a manteiga e o açúcar de confeiteiro até ficar liso. Monte o bolo intercalando massa e cobertura.',
            ],
            'dica' => 'Use corante em gel: ele dá uma cor bem intensa sem deixar a massa mole.',
        ],
        [
            'titulo' => 'Sorvete de abacate', 'categoria' => 'Sorvetes', 'foto' => 'recipe_2.jpg',
            'tempo' => '15 min + congelador', 'minutos' => 15, 'rendimento' => '8 porções', 'nivel' => 'Fácil',
            'intro' => 'Cremoso, refrescante e com apenas quatro ingredientes. Não precisa de máquina de sorvete.',
            'ingredientes' => ['1 abacate médio bem maduro', '1 lata de leite condensado', '1 caixinha de creme de leite', 'Suco de 1 limão'],
            'preparo' => [
                'Bata no liquidificador a polpa do abacate, o leite condensado, o creme de leite e o suco de limão até ficar bem liso.',
                'Transfira para um pote com tampa e leve ao congelador.',
                'Depois de 2 horas, mexa bem com um garfo para quebrar os cristais de gelo.',
                'Volte ao congelador por mais 4 horas, até firmar.',
            ],
            'dica' => 'O limão realça o sabor e evita que o sorvete escureça.',
        ],
        [
            'titulo' => 'Sorvete de baunilha', 'categoria' => 'Sorvetes', 'foto' => 'recipe_3.jpg',
            'tempo' => '20 min + congelador', 'minutos' => 20, 'rendimento' => '8 porções', 'nivel' => 'Fácil',
            'intro' => 'O sorvete mais clássico de todos, aerado e perfumado. Perfeito sozinho ou com uma fatia de bolo.',
            'ingredientes' => ['500 ml de creme de leite fresco bem gelado', '1 lata de leite condensado gelado', '1 colher (sopa) de essência de baunilha ou as sementes de 1 fava'],
            'preparo' => [
                'Bata o creme de leite fresco na batedeira até o ponto de chantilly.',
                'Desligue a batedeira e incorpore o leite condensado e a baunilha delicadamente, com uma espátula.',
                'Coloque em um pote com tampa e leve ao congelador por pelo menos 8 horas.',
            ],
            'dica' => 'Deixe a tigela e o batedor na geladeira antes de começar: o chantilly fica no ponto mais rápido.',
        ],
        [
            'titulo' => 'Macarons de chocolate', 'categoria' => 'Doces finos', 'foto' => 'recipe_4.jpg',
            'tempo' => '1h30', 'minutos' => 90, 'rendimento' => '25 unidades', 'nivel' => 'Difícil',
            'intro' => 'Casquinha crocante, interior macio e recheio de ganache. Exige técnica, mas o resultado vale cada minuto.',
            'ingredientes' => [
                '100 g de farinha de amêndoas', '90 g de açúcar de confeiteiro', '15 g de cacau em pó', '75 g de claras (cerca de 2) em temperatura ambiente', '75 g de açúcar refinado',
                '# Recheio', '100 g de chocolate meio amargo picado', '100 g de creme de leite fresco',
            ],
            'preparo' => [
                'Peneire juntos a farinha de amêndoas, o açúcar de confeiteiro e o cacau.',
                'Bata as claras e, quando espumarem, adicione o açúcar refinado aos poucos até formar picos firmes e brilhantes.',
                'Incorpore os secos às claras com uma espátula, até a massa escorrer como uma fita grossa.',
                'Com um saco de confeitar, modele discos de 3 cm em uma assadeira com papel-manteiga. Bata a assadeira na bancada e deixe descansar por 30 minutos.',
                'Asse a 150 °C por cerca de 14 minutos. Para o recheio, aqueça o creme de leite, despeje sobre o chocolate e mexa até derreter. Recheie quando as cascas esfriarem.',
            ],
            'dica' => 'Só leve ao forno quando a superfície não grudar no dedo: é isso que forma o “pezinho” do macaron.',
        ],
        [
            'titulo' => 'Sorvete caseiro de frutas vermelhas', 'categoria' => 'Sorvetes', 'foto' => 'recipe_5.jpg',
            'tempo' => '15 min + congelador', 'minutos' => 15, 'rendimento' => '6 porções', 'nivel' => 'Fácil',
            'intro' => 'Cor linda, sabor de fruta de verdade e textura cremosa. Uma sobremesa rápida para os dias quentes.',
            'ingredientes' => ['2 xícaras (chá) de frutas vermelhas congeladas', '1 lata de leite condensado', '1 caixinha de creme de leite'],
            'preparo' => [
                'Bata as frutas congeladas com o leite condensado e o creme de leite até ficar homogêneo.',
                'Transfira para um pote com tampa e leve ao congelador por 2 horas.',
                'Mexa bem com um garfo e volte ao congelador por mais 4 horas.',
            ],
            'dica' => 'Tire do congelador 10 minutos antes de servir para fazer bolas perfeitas.',
        ],
        [
            'titulo' => 'Cupcakes de baunilha', 'categoria' => 'Cupcakes', 'foto' => 'recipe_6.jpg',
            'tempo' => '40 min', 'minutos' => 40, 'rendimento' => '12 unidades', 'nivel' => 'Fácil',
            'intro' => 'Bolinhos fofinhos com cobertura de buttercream. Dá para variar a cor e o sabor da cobertura à vontade.',
            'ingredientes' => [
                '1/2 xícara (chá) de manteiga amolecida', '1 xícara (chá) de açúcar', '2 ovos', '1 colher (chá) de essência de baunilha',
                '1 e 1/2 xícara (chá) de farinha de trigo', '1/2 xícara (chá) de leite', '1 colher (sopa) de fermento em pó',
                '# Cobertura', '200 g de manteiga sem sal amolecida', '2 xícaras (chá) de açúcar de confeiteiro', '2 colheres (sopa) de leite', 'Corante alimentício (opcional)',
            ],
            'preparo' => [
                'Bata a manteiga com o açúcar até clarear. Junte os ovos, um a um, e a baunilha.',
                'Adicione a farinha e o leite, alternando, e por último o fermento.',
                'Encha 2/3 das forminhas e asse a 180 °C por cerca de 20 minutos. Deixe esfriar.',
                'Para a cobertura, bata a manteiga até ficar bem clara, junte o açúcar de confeiteiro e o leite e bata até ficar aerada. Decore com saco e bico de confeitar.',
            ],
            'dica' => 'Bata bem a manteiga da cobertura: quanto mais clara, mais leve fica o buttercream.',
        ],
        [
            'titulo' => 'Pirulitos coloridos', 'categoria' => 'Doces', 'foto' => 'recipe_7.jpg',
            'tempo' => '40 min', 'minutos' => 40, 'rendimento' => '15 unidades', 'nivel' => 'Médio',
            'intro' => 'Pirulitos de calda brilhantes e coloridos, perfeitos para festas infantis e lembrancinhas.',
            'ingredientes' => ['2 xícaras (chá) de açúcar', '2/3 de xícara (chá) de xarope de glucose de milho', '3/4 de xícara (chá) de água', 'Corantes alimentícios em gel', 'Essência a gosto (morango, tutti-frutti...)', 'Palitos para pirulito'],
            'preparo' => [
                'Em uma panela, junte o açúcar, a glucose e a água. Leve ao fogo médio, sem mexer, até atingir 150 °C (ponto de bala dura).',
                'Tire do fogo, espere as bolhas baixarem e adicione a essência e o corante.',
                'Despeje com cuidado em formas de pirulito untadas, com os palitos já posicionados.',
                'Deixe esfriar por cerca de 20 minutos antes de desenformar e embalar.',
            ],
            'dica' => 'Use termômetro culinário e muito cuidado: a calda fica extremamente quente. Mantenha as crianças longe do fogão nessa etapa.',
        ],
        [
            'titulo' => 'Macarons franceses', 'categoria' => 'Doces finos', 'foto' => 'recipe_8.jpg',
            'tempo' => '1h30', 'minutos' => 90, 'rendimento' => '25 unidades', 'nivel' => 'Difícil',
            'intro' => 'A receita básica do macaron, com recheio de ganache de chocolate branco. Ponto de partida para criar seus próprios sabores.',
            'ingredientes' => [
                '100 g de farinha de amêndoas', '100 g de açúcar de confeiteiro', '75 g de claras (cerca de 2) em temperatura ambiente', '75 g de açúcar refinado', 'Corante em gel (opcional)',
                '# Recheio', '120 g de chocolate branco picado', '50 g de creme de leite fresco',
            ],
            'preparo' => [
                'Peneire juntos a farinha de amêndoas e o açúcar de confeiteiro.',
                'Bata as claras com o açúcar refinado, adicionado aos poucos, até picos firmes. Se quiser, junte o corante.',
                'Incorpore os secos com uma espátula até a massa escorrer como uma fita grossa.',
                'Modele discos de 3 cm, bata a assadeira na bancada e deixe descansar por 30 minutos.',
                'Asse a 150 °C por cerca de 14 minutos. Derreta o chocolate branco com o creme de leite quente, espere firmar e recheie.',
            ],
            'dica' => 'Pese os ingredientes em balança: em macarons, a precisão faz toda a diferença.',
        ],
        [
            'titulo' => 'Bolo com cobertura de caramelo', 'categoria' => 'Bolos', 'foto' => 'recipe_9.jpg',
            'tempo' => '1h10', 'minutos' => 70, 'rendimento' => '12 fatias', 'nivel' => 'Médio',
            'intro' => 'Bolo fofinho de liquidificador coberto com uma calda de caramelo amanteigado. Irresistível.',
            'ingredientes' => [
                '3 ovos', '1 xícara (chá) de açúcar', '1/2 xícara (chá) de óleo', '1 xícara (chá) de leite', '2 xícaras (chá) de farinha de trigo', '1 colher (sopa) de fermento em pó',
                '# Cobertura de caramelo', '1 xícara (chá) de açúcar', '1/2 xícara (chá) de creme de leite fresco quente', '2 colheres (sopa) de manteiga', '1 pitada de sal',
            ],
            'preparo' => [
                'Bata no liquidificador os ovos, o açúcar, o óleo e o leite. Passe para uma tigela, junte a farinha e, por último, o fermento.',
                'Asse em forma untada a 180 °C por 35 a 40 minutos.',
                'Para o caramelo, derreta o açúcar em fogo baixo até ficar âmbar. Fora do fogo, junte o creme de leite quente com cuidado e mexa.',
                'Volte ao fogo baixo, adicione a manteiga e o sal e mexa até ficar liso. Espalhe sobre o bolo ainda morno.',
            ],
            'dica' => 'O creme de leite precisa estar quente: assim o caramelo não empedra.',
        ],
    ];

    $categoriasReceitas = collect($receitas)->pluck('categoria')->unique()->values();
    $porPaginaReceitas = 9;
@endphp

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,500;1,600&family=Poppins:wght@300;400;500;600&family=Great+Vibes&display=swap" rel="stylesheet">

<style>
.frl{--cream:#fdf6ee;--paper:#fffaf4;--choco:#2a1710;--choco-2:#4a2a1d;--rose:#e07a85;--rose-2:#b94e5c;--gold:#d9b06c;--gold-2:#f3d9a4;--text:#6e5a50;--muted:#a08d7d;--line:#ecdccb;--wa:#25d366;--wa-2:#128c4a;
  position:relative;padding:40px 0 120px;background:var(--cream);font-family:'Poppins',sans-serif;color:var(--choco);isolation:isolate}
.frl *{box-sizing:border-box}
.frl [hidden]{display:none!important}
.frl__glow{position:absolute;inset:0;z-index:-1;overflow:hidden;pointer-events:none}
.frl__glow i{position:absolute;border-radius:50%;filter:blur(90px);animation:frlBlob 22s ease-in-out infinite}
.frl__glow i:nth-child(1){width:460px;height:460px;background:rgba(224,122,133,.18);top:200px;left:-160px}
.frl__glow i:nth-child(2){width:420px;height:420px;background:rgba(217,176,108,.2);bottom:100px;right:-160px;animation-delay:-10s}
@keyframes frlBlob{50%{transform:translate(50px,-50px) scale(1.12)}}

/* Barra */
.frl__bar{position:sticky;top:0;z-index:20;max-width:1240px;margin:0 auto 40px;padding:14px 20px}
.frl__bar-in{display:flex;flex-direction:column;gap:14px;padding:18px;border-radius:26px;background:rgba(255,250,244,.85);-webkit-backdrop-filter:blur(14px);backdrop-filter:blur(14px);
  border:1px solid rgba(255,255,255,.9);box-shadow:0 24px 50px -32px rgba(74,42,29,.5)}
.frl__top{display:flex;gap:12px;flex-wrap:wrap;align-items:center}
.frl__search{position:relative;flex:1 1 260px}
.frl__search svg{position:absolute;left:18px;top:50%;width:19px;height:19px;margin-top:-9.5px;color:var(--muted);pointer-events:none}
.frl__search input{width:100%;height:50px;padding:0 18px 0 50px;border-radius:50px;border:1px solid var(--line);background:#fff;font-family:inherit;font-size:15px;color:var(--choco);outline:none;transition:border-color .3s,box-shadow .3s}
.frl__search input:focus{border-color:var(--rose);box-shadow:0 0 0 4px rgba(224,122,133,.15)}
.frl__sort{position:relative}
.frl__sort select{height:50px;padding:0 44px 0 18px;border-radius:50px;border:1px solid var(--line);background:#fff;font-family:inherit;font-size:14px;color:var(--choco-2);cursor:pointer;outline:none;
  -webkit-appearance:none;appearance:none}
.frl__sort select:focus{border-color:var(--rose)}
.frl__sort svg{position:absolute;right:16px;top:50%;width:16px;height:16px;margin-top:-8px;pointer-events:none;color:var(--muted)}
.frl__filters{display:flex;gap:10px;overflow-x:auto;padding:4px 2px 12px;margin-bottom:-8px;scrollbar-width:none}
.frl__filters::-webkit-scrollbar{display:none}
.frl__filter{position:relative;flex:none;border:0;cursor:pointer;font-family:inherit;font-size:14px;font-weight:500;color:var(--choco-2);padding:10px 18px;border-radius:50px;background:#fff;
  box-shadow:inset 0 0 0 1px var(--line);overflow:hidden;isolation:isolate;transition:color .35s,transform .35s cubic-bezier(.3,1.6,.5,1),box-shadow .35s}
.frl__filter::before{content:"";position:absolute;inset:0;z-index:-1;border-radius:inherit;background:linear-gradient(135deg,var(--rose),var(--rose-2));transform:scale(0);transition:transform .45s cubic-bezier(.3,1.3,.5,1)}
.frl__filter:hover{transform:translateY(-2px)}
.frl__filter.is-active{color:#fff;box-shadow:0 12px 24px -12px rgba(185,78,92,.7)}
.frl__filter.is-active::before{transform:scale(1)}

/* Grade */
.frl__grid{max-width:1240px;margin:0 auto;padding:0 20px;display:grid;grid-template-columns:repeat(3,1fr);gap:28px}
.frl__item{transition:opacity .45s ease,transform .55s cubic-bezier(.3,1.3,.5,1)}
#frl .frl__item.is-out{opacity:0;transform:scale(.92) translateY(20px)}
.frl__card{position:relative;display:block;width:100%;aspect-ratio:4/5;padding:0;border:0;border-radius:28px;overflow:hidden;cursor:pointer;text-align:left;font-family:inherit;color:#fff;
  background:linear-gradient(135deg,#f3c6c9,#f3d9a4);box-shadow:0 30px 60px -34px rgba(74,42,29,.6);isolation:isolate;transition:transform .55s cubic-bezier(.3,1.4,.5,1),box-shadow .5s}
.frl__card:hover{transform:translateY(-10px);box-shadow:0 46px 80px -34px rgba(74,42,29,.72)}
.frl__card img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;color:transparent;z-index:-2;transition:transform 1.2s cubic-bezier(.2,.7,.2,1)}
.frl__card:hover img{transform:scale(1.1)}
.frl__card::before{content:"";position:absolute;inset:0;z-index:-1;background:linear-gradient(180deg,rgba(42,23,16,0) 35%,rgba(42,23,16,.55) 65%,rgba(42,23,16,.95))}
.frl__lvl{position:absolute;top:16px;left:16px;display:inline-flex;align-items:center;gap:6px;padding:6px 12px;border-radius:30px;font-size:11px;font-weight:600;letter-spacing:.12em;text-transform:uppercase;
  background:rgba(255,255,255,.18);-webkit-backdrop-filter:blur(8px);backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,.28)}
.frl__lvl i{display:flex;gap:2px}
.frl__lvl i b{width:4px;height:10px;border-radius:2px;background:rgba(255,255,255,.35)}
.frl__lvl i b.on{background:var(--gold-2)}
.frl__time{position:absolute;top:16px;right:16px;display:inline-flex;align-items:center;gap:6px;padding:6px 12px;border-radius:30px;font-size:12px;font-weight:600;color:var(--choco);background:#fff}
.frl__time svg{width:14px;height:14px;color:var(--rose-2)}
.frl__cap{position:absolute;left:0;right:0;bottom:0;padding:24px}
.frl__cat{display:block;font-size:11px;font-weight:600;letter-spacing:.18em;text-transform:uppercase;color:var(--gold-2);margin-bottom:6px}
.frl__title{display:block;font-family:'Playfair Display',serif;font-weight:700;font-size:25px;line-height:1.2}
.frl__line{display:block;width:34px;height:2px;margin:12px 0;border-radius:2px;background:linear-gradient(90deg,var(--rose),var(--gold));transition:width .5s}
.frl__card:hover .frl__line{width:80px}
.frl__open{display:inline-flex;align-items:center;gap:8px;font-size:13px;font-weight:600;color:#fff;opacity:.85;transition:gap .4s,opacity .3s}
.frl__card:hover .frl__open{gap:14px;opacity:1}
.frl__open svg{width:16px;height:16px}

.frl__empty{max-width:460px;margin:20px auto 0;text-align:center;padding:36px 24px;border-radius:24px;border:1.5px dashed var(--line);background:rgba(255,255,255,.6);color:var(--text)}
.frl__empty h3{font-family:'Playfair Display',serif;font-size:22px;color:var(--choco);margin:0 0 6px}
.frl__more-wrap{text-align:center;margin-top:50px}
.frl__more{display:inline-flex;align-items:center;gap:10px;padding:16px 32px;border:0;border-radius:60px;cursor:pointer;font-family:inherit;font-size:15px;font-weight:600;color:#fff;
  background:linear-gradient(135deg,var(--choco-2),var(--choco));box-shadow:0 18px 40px -14px rgba(42,23,16,.7);transition:transform .35s cubic-bezier(.3,1.6,.5,1)}
.frl__more:hover{transform:translateY(-3px)}
.frl__more svg{width:18px;height:18px}

/* Modal da receita */
.frl__modal{position:fixed;inset:0;z-index:9999;display:flex;align-items:flex-start;justify-content:center;overflow-y:auto;padding:40px 16px;background:rgba(42,23,16,.75);
  -webkit-backdrop-filter:blur(6px);backdrop-filter:blur(6px);opacity:0;visibility:hidden;transition:opacity .4s,visibility 0s .4s}
.frl__modal.is-open{opacity:1;visibility:visible;transition:opacity .4s}
.frl__sheet{position:relative;width:100%;max-width:960px;border-radius:30px;overflow:hidden;background:var(--paper);box-shadow:0 60px 120px -40px rgba(0,0,0,.6);
  transform:translateY(40px) scale(.97);transition:transform .6s cubic-bezier(.3,1.3,.5,1)}
.frl__modal.is-open .frl__sheet{transform:none}
.frl__close{position:absolute;z-index:3;top:16px;right:16px;width:46px;height:46px;border:0;border-radius:50%;cursor:pointer;display:grid;place-items:center;color:var(--choco);background:rgba(255,255,255,.92);
  box-shadow:0 10px 20px -10px rgba(0,0,0,.4);transition:transform .35s cubic-bezier(.3,1.6,.5,1)}
.frl__close:hover{transform:rotate(90deg)}
.frl__close svg{width:20px;height:20px}
.frl__hero{position:relative;height:340px;color:#fff;display:flex;align-items:flex-end}
.frl__hero img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;color:transparent}
.frl__hero::before{content:"";position:absolute;inset:0;z-index:1;background:linear-gradient(180deg,rgba(42,23,16,.1),rgba(42,23,16,.85))}
.frl__hero-in{position:relative;z-index:2;padding:30px 36px}
.frl__hero h2{font-family:'Playfair Display',serif;font-weight:800;font-size:clamp(30px,4vw,44px);line-height:1.1;margin:6px 0 0;color:#fff}
.frl__meta{display:grid;grid-template-columns:repeat(3,1fr);border-bottom:1.5px dashed var(--line)}
.frl__meta div{display:flex;flex-direction:column;align-items:center;gap:4px;padding:18px 10px;text-align:center}
.frl__meta div+div{border-left:1px solid var(--line)}
.frl__meta svg{width:22px;height:22px;color:var(--rose-2)}
.frl__meta small{font-size:10.5px;letter-spacing:.14em;text-transform:uppercase;color:var(--muted)}
.frl__meta b{font-size:14px;font-weight:600;color:var(--choco-2)}
.frl__content{display:grid;grid-template-columns:.85fr 1.15fr;gap:40px;padding:34px 36px 36px}
.frl__intro{grid-column:1/-1;margin:0;font-size:16px;line-height:1.75;color:var(--text)}
.frl__h{display:flex;align-items:center;gap:12px;font-family:'Playfair Display',serif;font-weight:700;font-size:22px;margin:0 0 16px}
.frl__h::after{content:"";flex:1;height:1px;background:linear-gradient(90deg,rgba(224,122,133,.45),transparent)}
.frl__ing{list-style:none;margin:0;padding:0}
.frl__ing li{margin-bottom:9px}
.frl__ing li.sub{font-family:'Playfair Display',serif;font-style:italic;font-weight:600;font-size:15px;color:var(--rose-2);margin:16px 0 8px}
.frl__ing label{display:flex;gap:10px;align-items:flex-start;cursor:pointer;font-size:14px;line-height:1.5;color:var(--choco-2)}
.frl__ing input{position:absolute;opacity:0;pointer-events:none}
.frl__ing i{flex:none;width:18px;height:18px;margin-top:1px;border-radius:6px;border:1.5px solid rgba(185,78,92,.5);display:grid;place-items:center;transition:background .25s,border-color .25s,transform .3s cubic-bezier(.3,1.7,.5,1)}
.frl__ing i::after{content:"";width:9px;height:5px;border-left:2px solid #fff;border-bottom:2px solid #fff;transform:rotate(-45deg) scale(0);margin-top:-2px;transition:transform .25s cubic-bezier(.3,1.7,.5,1)}
.frl__ing input:checked+i{background:var(--rose-2);border-color:var(--rose-2);transform:scale(1.1)}
.frl__ing input:checked+i::after{transform:rotate(-45deg) scale(1)}
.frl__ing input:checked~span{text-decoration:line-through;color:var(--muted)}
.frl__ing input:focus-visible+i{outline:2px solid var(--rose-2);outline-offset:2px}
.frl__steps{list-style:none;margin:0;padding:0;counter-reset:s}
.frl__steps li{counter-increment:s;position:relative;padding:0 0 18px 48px;font-size:14.5px;line-height:1.7;color:var(--choco-2);cursor:pointer;transition:opacity .3s}
.frl__steps li::before{content:counter(s);position:absolute;left:0;top:0;width:32px;height:32px;border-radius:50%;display:grid;place-items:center;font-family:'Playfair Display',serif;font-weight:700;font-size:14px;
  color:#fff;background:linear-gradient(135deg,var(--rose),var(--rose-2));transition:background .3s}
.frl__steps li:not(:last-child)::after{content:"";position:absolute;left:15.5px;top:36px;bottom:4px;width:1px;background:rgba(185,78,92,.25)}
.frl__steps li.is-done{opacity:.45}
.frl__steps li.is-done::before{content:"✓";background:#3f8f5a}
.frl__steps-hint{margin:-6px 0 14px;font-size:12px;color:var(--muted)}
.frl__tip{margin-top:10px;padding:16px 18px;border-radius:16px;background:rgba(224,122,133,.09);border-left:3px solid var(--rose-2)}
.frl__tip b{display:block;font-family:'Great Vibes',cursive;font-weight:400;font-size:26px;line-height:1;color:var(--rose-2);margin-bottom:4px}
.frl__tip p{margin:0;font-size:14px;line-height:1.6;color:var(--choco-2)}
.frl__actions{display:flex;flex-wrap:wrap;gap:10px;padding:0 36px 34px}
.frl__act{display:inline-flex;align-items:center;gap:8px;padding:12px 18px;border:0;border-radius:14px;cursor:pointer;font-family:inherit;font-size:13.5px;font-weight:600;text-decoration:none;
  transition:transform .35s cubic-bezier(.3,1.6,.5,1),background .3s,color .3s}
.frl__act:hover{transform:translateY(-2px);text-decoration:none}
.frl__act svg{width:17px;height:17px}
.frl__act--wa{color:#fff;background:linear-gradient(135deg,var(--wa),var(--wa-2))}
.frl__act--wa:hover{color:#fff}
.frl__act--alt{color:var(--choco);background:#fff;box-shadow:inset 0 0 0 1px var(--line)}
.frl__act--alt.is-done{color:#fff;background:#3f8f5a;box-shadow:none}
.frl__nav{margin-left:auto;display:flex;gap:8px}
.frl__nav button{width:44px;height:44px;border:0;border-radius:50%;cursor:pointer;display:grid;place-items:center;color:var(--choco);background:#fff;box-shadow:inset 0 0 0 1px var(--line);transition:background .3s,color .3s}
.frl__nav button:hover{background:var(--choco);color:#fff}
.frl__nav svg{width:18px;height:18px}

/* Revelar */
.frl--js [data-reveal]{opacity:0;transform:translateY(50px) scale(.96);transition:opacity .9s cubic-bezier(.2,.7,.2,1) var(--d,0s),transform .9s cubic-bezier(.2,.7,.2,1) var(--d,0s)}
.frl--js [data-reveal].is-in{opacity:1;transform:none}

@media (max-width:991px){.frl__grid{grid-template-columns:repeat(2,1fr)}.frl__content{grid-template-columns:1fr;gap:30px}}
@media (max-width:600px){
  .frl__grid{grid-template-columns:1fr;padding:0 16px;gap:20px}
  .frl__bar{padding:10px 12px}
  .frl__sort{flex:1 1 100%}
  .frl__sort select{width:100%}
  .frl__modal{padding:0}
  .frl__sheet{border-radius:0;min-height:100%}
  .frl__hero{height:260px}
  .frl__hero-in,.frl__content{padding-left:20px;padding-right:20px}
  .frl__actions{padding:0 20px 30px}
  .frl__nav{margin-left:0;width:100%;justify-content:space-between}
}
@media print{
  body.frl-printing>*:not(.frl-print-root){display:none!important}
  .frl__modal{position:static;background:none;padding:0;opacity:1;visibility:visible}
  .frl__close,.frl__actions{display:none!important}
  .frl__sheet{box-shadow:none;transform:none}
}
@media (prefers-reduced-motion:reduce){
  .frl *,.frl *::before,.frl *::after{animation:none!important;transition:none!important}
  .frl--js [data-reveal]{opacity:1;transform:none}
}
</style>

<section class="frl" id="frl" data-per-page="{{ $porPaginaReceitas }}">
    <div class="frl__glow" aria-hidden="true"><i></i><i></i></div>

    <!-- Busca, ordenação e categorias -->
    <div class="frl__bar">
        <div class="frl__bar-in">
            <div class="frl__top">
                <label class="frl__search">
                    <input type="search" placeholder="Encontre uma receita..." aria-label="Buscar receita" autocomplete="off">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="M20 20l-3.5-3.5"/></svg>
                </label>
                <label class="frl__sort">
                    <select aria-label="Ordenar receitas">
                        <option value="recentes">Mais recentes</option>
                        <option value="rapidas">Mais rápidas</option>
                        <option value="az">Ordem alfabética (A-Z)</option>
                        <option value="za">Ordem alfabética (Z-A)</option>
                    </select>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                </label>
            </div>
            <div class="frl__filters" role="tablist" aria-label="Categorias de receitas">
                <button type="button" class="frl__filter is-active" data-filter="*">Todas</button>
                @foreach ($categoriasReceitas as $cat)
                    <button type="button" class="frl__filter" data-filter="{{ \Illuminate\Support\Str::slug($cat) }}">{{ $cat }}</button>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Receitas -->
    <div class="frl__grid">
        @foreach ($receitas as $i => $r)
            @php
                $niveis = ['Fácil' => 1, 'Médio' => 2, 'Difícil' => 3];
                $nivelN = $niveis[$r['nivel']] ?? 1;
            @endphp
            <div class="frl__item" data-reveal style="--d:{{ ($loop->index % 3) * 0.1 }}s"
                data-i="{{ $i }}" data-cat="{{ \Illuminate\Support\Str::slug($r['categoria']) }}" data-min="{{ $r['minutos'] }}"
                data-name="{{ \Illuminate\Support\Str::lower(\Illuminate\Support\Str::ascii($r['titulo'] . ' ' . $r['categoria'] . ' ' . implode(' ', $r['ingredientes']))) }}"
                data-title="{{ \Illuminate\Support\Str::lower(\Illuminate\Support\Str::ascii($r['titulo'])) }}">
                <button type="button" class="frl__card" data-open="{{ $i }}" aria-label="Ver receita: {{ $r['titulo'] }}">
                    <img src="{{ asset('davilla/regiao-img/' . $r['foto']) }}" alt="" loading="lazy">
                    <span class="frl__lvl"><i>@for ($n = 1; $n <= 3; $n++)<b class="{{ $n <= $nivelN ? 'on' : '' }}"></b>@endfor</i>{{ $r['nivel'] }}</span>
                    <span class="frl__time"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>{{ $r['tempo'] }}</span>
                    <span class="frl__cap">
                        <span class="frl__cat">{{ $r['categoria'] }}</span>
                        <span class="frl__title">{{ $r['titulo'] }}</span>
                        <span class="frl__line"></span>
                        <span class="frl__open">Ver receita <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg></span>
                    </span>
                </button>
            </div>
        @endforeach
    </div>

    <div class="frl__empty" hidden>
        <h3>Nenhuma receita encontrada</h3>
        Tente outra palavra ou escolha outra categoria.
    </div>

    <div class="frl__more-wrap">
        <button type="button" class="frl__more" hidden>Ver mais receitas
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M6 13l6 6 6-6"/></svg>
        </button>
    </div>

    {{-- Conteúdo completo de cada receita (usado na janela da receita) --}}
    @foreach ($receitas as $i => $r)
        <template class="frl__tpl" data-i="{{ $i }}" data-slug="{{ \Illuminate\Support\Str::slug($r['titulo']) }}" data-title="{{ $r['titulo'] }}">
            <div class="frl__hero">
                <img src="{{ asset('davilla/regiao-img/' . $r['foto']) }}" alt="{{ $r['titulo'] }}">
                <div class="frl__hero-in">
                    <span class="frl__cat">{{ $r['categoria'] }}</span>
                    <h2>{{ $r['titulo'] }}</h2>
                </div>
            </div>
            <div class="frl__meta">
                <div><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg><small>Tempo</small><b>{{ $r['tempo'] }}</b></div>
                <div><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 21h16M5 21v-6a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v6"/><path d="M5 17c1.2 0 1.8-1 3-1s1.8 1 3 1 1.8-1 3-1 1.8 1 3 1 1.8-1 2-1"/><path d="M12 13V9"/></svg><small>Rende</small><b>{{ $r['rendimento'] }}</b></div>
                <div><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l2.9 6.3 6.9.7-5.2 4.6 1.5 6.8L12 17l-6.1 3.4 1.5-6.8L2.2 9l6.9-.7z"/></svg><small>Nível</small><b>{{ $r['nivel'] }}</b></div>
            </div>
            <div class="frl__content">
                <p class="frl__intro">{{ $r['intro'] }}</p>
                <div>
                    <h3 class="frl__h">Ingredientes</h3>
                    <ul class="frl__ing">
                        @foreach ($r['ingredientes'] as $ing)
                            @if (\Illuminate\Support\Str::startsWith($ing, '#'))
                                <li class="sub">{{ trim(ltrim($ing, '#')) }}</li>
                            @else
                                <li><label><input type="checkbox"><i></i><span>{{ $ing }}</span></label></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div>
                    <h3 class="frl__h">Modo de preparo</h3>
                    <p class="frl__steps-hint">Toque em um passo para marcá-lo como feito.</p>
                    <ol class="frl__steps">
                        @foreach ($r['preparo'] as $passo)
                            <li>{{ $passo }}</li>
                        @endforeach
                    </ol>
                    @if (!empty($r['dica']))
                        <div class="frl__tip"><b>Dica da confeiteira</b><p>{{ $r['dica'] }}</p></div>
                    @endif
                </div>
            </div>
        </template>
    @endforeach

    <!-- Janela da receita -->
    <div class="frl__modal" role="dialog" aria-modal="true" aria-label="Receita" aria-hidden="true">
        <div class="frl__sheet">
            <button type="button" class="frl__close" aria-label="Fechar receita"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M6 6l12 12M18 6L6 18"/></svg></button>
            <div class="frl__body"></div>
            <div class="frl__actions">
                <a href="#" target="_blank" rel="noopener" class="frl__act frl__act--wa">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.5 14.4c-.3-.1-1.8-.9-2-1-.3-.1-.5-.1-.7.1-.2.3-.8 1-.9 1.2-.2.2-.3.2-.6.1-.3-.1-1.3-.5-2.4-1.5-.9-.8-1.5-1.8-1.7-2.1-.2-.3 0-.5.1-.6l.4-.5c.2-.2.2-.3.3-.5.1-.2 0-.4 0-.5l-.9-2.2c-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.5s1.1 2.9 1.2 3.1c.1.2 2.1 3.2 5.1 4.5.7.3 1.3.5 1.7.6.7.2 1.4.2 1.9.1.6-.1 1.8-.7 2-1.4.3-.7.3-1.3.2-1.4-.1-.2-.3-.3-.6-.4zM12 21.8c-1.8 0-3.5-.5-5-1.4l-.4-.2-3.7 1 1-3.6-.2-.4c-1-1.6-1.5-3.4-1.5-5.2C2.2 6.6 6.6 2.2 12 2.2c2.6 0 5.1 1 6.9 2.9 1.9 1.9 2.9 4.3 2.9 6.9 0 5.4-4.4 9.8-9.8 9.8zm8.4-18.2C18.2 1.3 15.2 0 12 0 5.4 0 0 5.4 0 12c0 2.1.6 4.2 1.6 6L0 24l6.2-1.6c1.8 1 3.8 1.5 5.8 1.5 6.6 0 12-5.4 12-12 0-3.2-1.2-6.2-3.6-8.3z"/></svg>
                    Compartilhar
                </a>
                <button type="button" class="frl__act frl__act--alt frl__copy">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.5.5l3-3a5 5 0 0 0-7-7l-1.7 1.7"/><path d="M14 11a5 5 0 0 0-7.5-.5l-3 3a5 5 0 0 0 7 7l1.7-1.7"/></svg>
                    <span>Copiar link</span>
                </button>
                <button type="button" class="frl__act frl__act--alt frl__print">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9V2h12v7"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                    Imprimir
                </button>
                <span class="frl__nav">
                    <button type="button" data-step="-1" aria-label="Receita anterior"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M11 6l-6 6 6 6"/></svg></button>
                    <button type="button" data-step="1" aria-label="Próxima receita"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg></button>
                </span>
            </div>
        </div>
    </div>
</section>

<script>
(function () {
    var root = document.getElementById('frl');
    if (!root) return;
    root.classList.add('frl--js');
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var items = Array.prototype.slice.call(root.querySelectorAll('.frl__item'));
    var grid = root.querySelector('.frl__grid');
    var perPage = parseInt(root.dataset.perPage, 10) || 9;
    var state = { cat: '*', q: '', sort: 'recentes', limit: perPage };

    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('is-in'); io.unobserve(e.target); } });
    }, { threshold: 0.1 });

    function norm(s) { return (s || '').toLowerCase().normalize('NFD').replace(/[̀-ͯ]/g, ''); }

    function apply(animate) {
        var q = norm(state.q.trim());
        var list = items.filter(function (it) { return (state.cat === '*' || it.dataset.cat === state.cat) && (!q || it.dataset.name.indexOf(q) !== -1); });
        var sorted = items.slice().sort(function (a, b) {
            if (state.sort === 'az') return a.dataset.title.localeCompare(b.dataset.title);
            if (state.sort === 'za') return b.dataset.title.localeCompare(a.dataset.title);
            if (state.sort === 'rapidas') return (+a.dataset.min) - (+b.dataset.min) || (+a.dataset.i) - (+b.dataset.i);
            return (+a.dataset.i) - (+b.dataset.i);
        });
        list.sort(function (a, b) { return sorted.indexOf(a) - sorted.indexOf(b); });

        function render() {
            sorted.forEach(function (it) { grid.appendChild(it); });
            var shown = 0;
            items.forEach(function (it) {
                var idx = list.indexOf(it), vis = idx !== -1 && idx < state.limit;
                it.hidden = !vis;
                if (vis) {
                    if (animate && !reduce) { it.classList.add('is-in', 'is-out'); it.style.transitionDelay = (shown % perPage) * 0.05 + 's'; }
                    else io.observe(it);
                    shown++;
                }
            });
            if (animate && !reduce) requestAnimationFrame(function () { requestAnimationFrame(function () {
                items.forEach(function (it) { it.classList.remove('is-out'); });
                setTimeout(function () { items.forEach(function (it) { it.style.transitionDelay = ''; }); }, 900);
            }); });
            root.querySelector('.frl__empty').hidden = list.length > 0;
            root.querySelector('.frl__more').hidden = list.length <= state.limit;
            visibleOrder = list;
        }
        if (animate && !reduce) {
            items.forEach(function (it) { if (!it.hidden) it.classList.add('is-out'); });
            setTimeout(render, 300);
        } else render();
    }
    var visibleOrder = items;

    root.querySelectorAll('.frl__filter').forEach(function (b) {
        b.addEventListener('click', function () {
            if (state.cat === b.dataset.filter) return;
            root.querySelectorAll('.frl__filter').forEach(function (x) { x.classList.toggle('is-active', x === b); });
            state.cat = b.dataset.filter; state.limit = perPage; apply(true);
        });
    });
    var t, input = root.querySelector('.frl__search input');
    input.addEventListener('input', function () { clearTimeout(t); t = setTimeout(function () { state.q = input.value; state.limit = perPage; apply(true); }, 250); });
    root.querySelector('.frl__sort select').addEventListener('change', function (e) { state.sort = e.target.value; apply(true); });
    root.querySelector('.frl__more').addEventListener('click', function () { state.limit += perPage; apply(false); });

    // ---------- Janela da receita ----------
    var modal = root.querySelector('.frl__modal'), body = root.querySelector('.frl__body');
    var wa = root.querySelector('.frl__act--wa'), copyBtn = root.querySelector('.frl__copy');
    var current = null, lastFocus = null;

    function open(i, push) {
        var tpl = root.querySelector('.frl__tpl[data-i="' + i + '"]');
        if (!tpl) return;
        current = +i;
        body.innerHTML = tpl.innerHTML;
        body.querySelectorAll('.frl__steps li').forEach(function (li) { li.addEventListener('click', function () { li.classList.toggle('is-done'); }); });
        var url = location.href.split('#')[0] + '#receita-' + tpl.dataset.slug;
        wa.href = 'https://wa.me/?text=' + encodeURIComponent('Olha que receita gostosa: ' + tpl.dataset.title + '\n' + url);
        copyBtn.dataset.url = url;
        if (!modal.classList.contains('is-open')) { lastFocus = document.activeElement; }
        modal.classList.add('is-open'); modal.setAttribute('aria-hidden', 'false');
        modal.scrollTop = 0;
        document.documentElement.style.overflow = 'hidden';
        if (push !== false) try { history.replaceState(null, '', '#receita-' + tpl.dataset.slug); } catch (e) {}
        setTimeout(function () { root.querySelector('.frl__close').focus(); }, 50);
    }
    function close() {
        modal.classList.remove('is-open'); modal.setAttribute('aria-hidden', 'true');
        document.documentElement.style.overflow = '';
        try { history.replaceState(null, '', location.pathname + location.search); } catch (e) {}
        if (lastFocus) lastFocus.focus();
    }
    root.querySelectorAll('[data-open]').forEach(function (b) { b.addEventListener('click', function () { open(b.dataset.open); }); });
    root.querySelector('.frl__close').addEventListener('click', close);
    modal.addEventListener('click', function (e) { if (e.target === modal) close(); });
    document.addEventListener('keydown', function (e) {
        if (!modal.classList.contains('is-open')) return;
        if (e.key === 'Escape') close();
        if (e.key === 'ArrowRight') step(1);
        if (e.key === 'ArrowLeft') step(-1);
    });
    function step(d) {
        var order = visibleOrder.length ? visibleOrder : items;
        var pos = order.findIndex(function (it) { return +it.dataset.i === current; });
        var next = order[(pos + d + order.length) % order.length];
        if (next) open(next.dataset.i);
    }
    root.querySelectorAll('[data-step]').forEach(function (b) { b.addEventListener('click', function () { step(+b.dataset.step); }); });

    copyBtn.addEventListener('click', function () {
        var url = copyBtn.dataset.url, label = copyBtn.querySelector('span');
        function done() { copyBtn.classList.add('is-done'); label.textContent = 'Link copiado!'; setTimeout(function () { copyBtn.classList.remove('is-done'); label.textContent = 'Copiar link'; }, 1800); }
        if (navigator.clipboard) navigator.clipboard.writeText(url).then(done, function () {});
    });
    root.querySelector('.frl__print').addEventListener('click', function () {
        var holder = document.createElement('div'); holder.className = 'frl-print-root frl';
        holder.appendChild(modal.cloneNode(true));
        document.body.appendChild(holder); document.body.classList.add('frl-printing');
        window.print();
        setTimeout(function () { holder.remove(); document.body.classList.remove('frl-printing'); }, 500);
    });

    // Abre direto pelo link compartilhado (#receita-nome)
    var h = location.hash.replace('#receita-', '');
    if (h) { var tp = root.querySelector('.frl__tpl[data-slug="' + h + '"]'); if (tp) open(tp.dataset.i, false); }

    apply(false);
})();
</script>
<!-- End Recipes Section Two -->