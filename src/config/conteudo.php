<?php

/*
|--------------------------------------------------------------------------
| Conteúdo do site editável no painel (Admin → Conteúdo do Site → Páginas)
|--------------------------------------------------------------------------
| Cada página tem seções, e cada seção tem campos. A chave do campo é a usada
| nas views: conteudo('home.agenda.titulo'). "padrao" é o texto/imagem original,
| usado enquanto o campo não for alterado no painel (ou depois de restaurar).
|
| Tipos: texto (uma linha), textarea (várias linhas), lista (uma opção por linha)
|        e imagem (caminho dentro de public/).
| "destaque" => true: aceita *palavra* (itálico colorido) e **palavra** (negrito).
*/

return [

    'home' => [
        'titulo'    => 'Home',
        'descricao' => 'Página inicial do site.',
        'icone'     => 'bi-house-heart',
        'rota'      => 'home',
        'secoes'    => [

            'banner' => [
                'titulo' => 'Banner principal (slides do topo)',
                'ajuda'  => 'Os slides do topo da Home têm uma tela própria, com ordem e ativar/desativar.',
                'atalho' => ['rota' => 'admin.banner', 'texto' => 'Gerenciar banners'],
                'campos' => [],
            ],

            'agenda' => [
                'titulo' => 'Agenda (Feira livre / eventos)',
                'ajuda'  => 'Os eventos em si são cadastrados em Feira Livre / Eventos.',
                'campos' => [
                    'home.agenda.selo'        => ['rotulo' => 'Selo acima do título', 'tipo' => 'texto', 'padrao' => 'Nossa agenda'],
                    'home.agenda.titulo'      => ['rotulo' => 'Título', 'tipo' => 'texto', 'destaque' => true, 'padrao' => 'Venha nos *visitar*'],
                    'home.agenda.texto'       => ['rotulo' => 'Texto', 'tipo' => 'textarea', 'destaque' => true, 'padrao' => 'Confira onde a nossa barraca vai estar e garanta seus doces fresquinhos, direto das nossas mãos para você.'],
                    'home.agenda.tags_titulo' => ['rotulo' => 'Título da lista de doces do evento', 'tipo' => 'texto', 'padrao' => 'Hoje na barraca'],
                    'home.agenda.tags_rodape' => ['rotulo' => 'Frase no fim do cartão', 'tipo' => 'texto', 'padrao' => 'Vem provar!'],
                ],
            ],

            'boas_vindas' => [
                'titulo' => 'Boas-vindas',
                'campos' => [
                    'home.boas_vindas.texto_fundo'  => ['rotulo' => 'Texto gigante do fundo', 'tipo' => 'texto', 'padrao' => 'Bem-vindo'],
                    'home.boas_vindas.selo'         => ['rotulo' => 'Selo acima do título', 'tipo' => 'texto', 'padrao' => 'Seja bem-vindo a'],
                    'home.boas_vindas.titulo'       => ['rotulo' => 'Título', 'tipo' => 'texto', 'destaque' => true, 'padrao' => 'Esse Doce é *para você*'],
                    'home.boas_vindas.texto_1'      => ['rotulo' => 'Primeiro parágrafo', 'tipo' => 'textarea', 'destaque' => true, 'padrao' => 'Na **Esse Doce é para você**, cada detalhe é pensado para transformar simples momentos em experiências inesquecíveis. Nossos bolos e doces são preparados com ingredientes selecionados, combinando sabor, qualidade e um toque especial de carinho em cada receita.'],
                    'home.boas_vindas.texto_2'      => ['rotulo' => 'Segundo parágrafo (deixe vazio para esconder)', 'tipo' => 'textarea', 'destaque' => true, 'padrao' => 'Mais do que uma confeitaria, somos um lugar onde aromas encantam, sabores surpreendem e memórias são criadas. Do primeiro olhar à última mordida, queremos fazer parte dos seus melhores momentos.'],
                    'home.boas_vindas.frase'        => ['rotulo' => 'Frase final', 'tipo' => 'texto', 'padrao' => 'Descubra o prazer de saborear o extraordinário.'],
                    'home.boas_vindas.assinatura'   => ['rotulo' => 'Assinatura', 'tipo' => 'texto', 'padrao' => 'com carinho, Esse Doce'],
                    'home.boas_vindas.item1_titulo' => ['rotulo' => 'Destaque 1 — título', 'tipo' => 'texto', 'padrao' => 'Ingredientes selecionados'],
                    'home.boas_vindas.item1_texto'  => ['rotulo' => 'Destaque 1 — texto', 'tipo' => 'texto', 'padrao' => 'Qualidade em cada receita'],
                    'home.boas_vindas.item2_titulo' => ['rotulo' => 'Destaque 2 — título', 'tipo' => 'texto', 'padrao' => 'Feito com carinho'],
                    'home.boas_vindas.item2_texto'  => ['rotulo' => 'Destaque 2 — texto', 'tipo' => 'texto', 'padrao' => 'Preparado à mão, sem pressa'],
                    'home.boas_vindas.item3_titulo' => ['rotulo' => 'Destaque 3 — título', 'tipo' => 'texto', 'padrao' => 'Momentos especiais'],
                    'home.boas_vindas.item3_texto'  => ['rotulo' => 'Destaque 3 — texto', 'tipo' => 'texto', 'padrao' => 'Para celebrar quem você ama'],
                ],
            ],

            'sabor' => [
                'titulo' => 'Sabor que marca (imagem com selos)',
                'campos' => [
                    'home.sabor.selo'         => ['rotulo' => 'Selo acima do título', 'tipo' => 'texto', 'padrao' => 'Cantinho Donuts'],
                    'home.sabor.titulo'       => ['rotulo' => 'Título', 'tipo' => 'texto', 'destaque' => true, 'padrao' => 'Sabor que marca, *tradição que encanta.*'],
                    'home.sabor.texto'        => ['rotulo' => 'Texto', 'tipo' => 'textarea', 'destaque' => true, 'padrao' => 'Dos clássicos bolos caseiros aos doces finos mais sofisticados. Na **Cantinho Donuts**, cada receita é uma celebração de sabor, pensada para tornar o seu momento ainda mais especial.'],
                    'home.sabor.lista'        => ['rotulo' => 'Itens com ✓ (um por linha)', 'tipo' => 'lista', 'padrao' => "Feito no dia\nIngredientes selecionados\nEncomendas personalizadas"],
                    'home.sabor.botao1_texto' => ['rotulo' => 'Botão principal — texto', 'tipo' => 'texto', 'padrao' => 'Confira nossa vitrine'],
                    'home.sabor.botao1_link'  => ['rotulo' => 'Botão principal — link', 'tipo' => 'link', 'padrao' => 'cardapio'],
                    'home.sabor.botao2_texto' => ['rotulo' => 'Botão secundário — texto', 'tipo' => 'texto', 'padrao' => 'Faça sua encomenda'],
                    'home.sabor.botao2_link'  => ['rotulo' => 'Botão secundário — link', 'tipo' => 'link', 'padrao' => 'pedidos'],
                    'home.sabor.imagem'       => ['rotulo' => 'Imagem', 'tipo' => 'imagem', 'padrao' => 'donuts/IMG/there-are-many-different-types-pastries-pink-plate.jpg'],
                    'home.sabor.selo1_titulo' => ['rotulo' => 'Selo da imagem 1 — título', 'tipo' => 'texto', 'padrao' => 'Bolo do dia'],
                    'home.sabor.selo1_texto'  => ['rotulo' => 'Selo da imagem 1 — texto', 'tipo' => 'texto', 'padrao' => 'Saindo do forno'],
                    'home.sabor.selo2_titulo' => ['rotulo' => 'Selo da imagem 2 (com estrelas)', 'tipo' => 'texto', 'padrao' => 'Clientes apaixonados'],
                    'home.sabor.faixa'        => ['rotulo' => 'Faixa rolante (uma palavra por linha)', 'tipo' => 'lista', 'padrao' => "Bolos caseiros\nDoces finos\nTortas\nBrigadeiros gourmet\nBolos de festa\nEncomendas especiais"],
                ],
            ],

            'vitrine' => [
                'titulo' => 'Vitrine de produtos',
                'ajuda'  => 'Os produtos vêm do cadastro de Produtos.',
                'campos' => [
                    'home.vitrine.selo'   => ['rotulo' => 'Selo acima do título', 'tipo' => 'texto', 'padrao' => 'Nossa vitrine'],
                    'home.vitrine.titulo' => ['rotulo' => 'Título', 'tipo' => 'texto', 'destaque' => true, 'padrao' => 'Nossos *doces trabalhos*'],
                    'home.vitrine.texto'  => ['rotulo' => 'Texto', 'tipo' => 'textarea', 'destaque' => true, 'padrao' => 'Cada criação é feita à mão, com carinho e ingredientes selecionados. Escolha o seu favorito.'],
                    'home.vitrine.botao'  => ['rotulo' => 'Texto do link de cada produto', 'tipo' => 'texto', 'padrao' => 'Ver detalhes'],
                    'home.vitrine.vazio'  => ['rotulo' => 'Mensagem quando a categoria não tem doces', 'tipo' => 'texto', 'padrao' => 'Nenhum doce nesta categoria no momento.'],
                ],
            ],

            'porque' => [
                'titulo' => 'Por que nos escolher (cartões e números)',
                'campos' => [
                    'home.porque.imagem_fundo'  => ['rotulo' => 'Imagem de fundo', 'tipo' => 'imagem', 'padrao' => 'donuts/IMG/banner3.png'],
                    'home.porque.selo'          => ['rotulo' => 'Selo acima do título', 'tipo' => 'texto', 'padrao' => 'Por que nos escolher'],
                    'home.porque.titulo'        => ['rotulo' => 'Título — primeira linha', 'tipo' => 'texto', 'padrao' => 'Feito à mão,'],
                    'home.porque.titulo_brilho' => ['rotulo' => 'Título — segunda linha (com brilho)', 'tipo' => 'texto', 'padrao' => 'feito com amor'],
                    'home.porque.texto'         => ['rotulo' => 'Texto', 'tipo' => 'textarea', 'destaque' => true, 'padrao' => 'Cada doce nasce de receitas cuidadosas, ingredientes selecionados e o carinho de quem vive a confeitaria todos os dias.'],
                    'home.porque.card1_titulo'  => ['rotulo' => 'Cartão 1 — título', 'tipo' => 'texto', 'padrao' => 'Tradição'],
                    'home.porque.card1_texto'   => ['rotulo' => 'Cartão 1 — texto', 'tipo' => 'textarea', 'padrao' => 'Receitas de família preservadas há gerações, com o sabor autêntico que desperta memórias afetivas.'],
                    'home.porque.card2_selo'    => ['rotulo' => 'Cartão 2 (destaque) — selo', 'tipo' => 'texto', 'padrao' => 'Mais pedido'],
                    'home.porque.card2_titulo'  => ['rotulo' => 'Cartão 2 (destaque) — título', 'tipo' => 'texto', 'padrao' => 'Criatividade'],
                    'home.porque.card2_texto'   => ['rotulo' => 'Cartão 2 (destaque) — texto', 'tipo' => 'textarea', 'padrao' => 'Bolos e doces personalizados que transformam sua ideia em uma peça única para cada celebração.'],
                    'home.porque.card3_titulo'  => ['rotulo' => 'Cartão 3 — título', 'tipo' => 'texto', 'padrao' => 'Paixão'],
                    'home.porque.card3_texto'   => ['rotulo' => 'Cartão 3 — texto', 'tipo' => 'textarea', 'padrao' => 'Ingredientes selecionados e um cuidado artesanal em cada detalhe, do forno até a sua mesa.'],
                    'home.porque.botao_texto'   => ['rotulo' => 'Botão dos cartões — texto', 'tipo' => 'texto', 'padrao' => 'Veja nossa vitrine'],
                    'home.porque.botao_link'    => ['rotulo' => 'Botão dos cartões — link', 'tipo' => 'link', 'padrao' => 'cardapio'],
                    'home.porque.numero1'       => ['rotulo' => 'Número 1 (ex.: 15+)', 'tipo' => 'texto', 'padrao' => '15+'],
                    'home.porque.numero1_texto' => ['rotulo' => 'Número 1 — legenda', 'tipo' => 'texto', 'padrao' => 'Anos de história'],
                    'home.porque.numero2'       => ['rotulo' => 'Número 2', 'tipo' => 'texto', 'padrao' => '12000+'],
                    'home.porque.numero2_texto' => ['rotulo' => 'Número 2 — legenda', 'tipo' => 'texto', 'padrao' => 'Clientes felizes'],
                    'home.porque.numero3'       => ['rotulo' => 'Número 3', 'tipo' => 'texto', 'padrao' => '180'],
                    'home.porque.numero3_texto' => ['rotulo' => 'Número 3 — legenda', 'tipo' => 'texto', 'padrao' => 'Receitas exclusivas'],
                    'home.porque.numero4'       => ['rotulo' => 'Número 4', 'tipo' => 'texto', 'padrao' => '100%'],
                    'home.porque.numero4_texto' => ['rotulo' => 'Número 4 — legenda', 'tipo' => 'texto', 'padrao' => 'Artesanal'],
                ],
            ],

            'especialidades' => [
                'titulo' => 'Nossas especialidades (categorias)',
                'ajuda'  => 'Os cartões são as categorias cadastradas em Categorias (nome e descrição).',
                'campos' => [
                    'home.especialidades.imagem_fundo' => ['rotulo' => 'Imagem de fundo', 'tipo' => 'imagem', 'padrao' => 'donuts/images/fundoServicos.png'],
                    'home.especialidades.selo'         => ['rotulo' => 'Selo acima do título', 'tipo' => 'texto', 'padrao' => 'O que fazemos'],
                    'home.especialidades.titulo'       => ['rotulo' => 'Título', 'tipo' => 'texto', 'destaque' => true, 'padrao' => 'Nossas *especialidades*'],
                    'home.especialidades.texto'        => ['rotulo' => 'Texto', 'tipo' => 'textarea', 'destaque' => true, 'padrao' => 'De bolos de festa a docinhos finos: conheça as delícias que saem todos os dias da nossa cozinha.'],
                ],
            ],

            'receitas' => [
                'titulo' => 'Livro de receitas',
                'ajuda'  => 'As receitas (ingredientes, modo de preparo, dica) têm uma tela própria. Sem nenhuma receita ativa, a seção some.',
                'atalho' => ['rota' => 'admin.receita', 'texto' => 'Gerenciar receitas'],
                'campos' => [
                    'home.receitas.imagem_fundo' => ['rotulo' => 'Imagem de fundo', 'tipo' => 'imagem', 'padrao' => 'donuts/gallery-donuts/fundorecipes.jpg'],
                    'home.receitas.selo'         => ['rotulo' => 'Selo acima do título', 'tipo' => 'texto', 'padrao' => 'Do nosso caderno'],
                    'home.receitas.titulo'       => ['rotulo' => 'Título', 'tipo' => 'texto', 'destaque' => true, 'padrao' => 'Receitas *para você*'],
                    'home.receitas.texto'        => ['rotulo' => 'Texto', 'tipo' => 'textarea', 'destaque' => true, 'padrao' => 'Todo dia o nosso livro abre em uma receita nova, direto do caderno da família. Vire as páginas e volte amanhã para descobrir a próxima!'],
                    'home.receitas.dica'         => ['rotulo' => 'Dica abaixo do livro', 'tipo' => 'texto', 'padrao' => 'Dica: clique no canto da página ou arraste para o lado para virar.'],
                    'home.receitas.botao_dia'           => ['rotulo' => 'Botão e selo "Receita do dia"', 'tipo' => 'texto', 'grupo' => 'Textos do livro', 'padrao' => 'Receita do dia'],
                    'home.receitas.botao_sorteio'       => ['rotulo' => 'Botão de receita aleatória', 'tipo' => 'texto', 'grupo' => 'Textos do livro', 'padrao' => 'Surpreenda-me'],
                    'home.receitas.numero'              => ['rotulo' => 'Selo das outras receitas (vem o número depois)', 'tipo' => 'texto', 'grupo' => 'Textos do livro', 'padrao' => 'Receita nº'],
                    'home.receitas.rotulo_tempo'        => ['rotulo' => 'Rótulo do tempo', 'tipo' => 'texto', 'grupo' => 'Textos do livro', 'padrao' => 'Tempo'],
                    'home.receitas.rotulo_rende'        => ['rotulo' => 'Rótulo do rendimento', 'tipo' => 'texto', 'grupo' => 'Textos do livro', 'padrao' => 'Rende'],
                    'home.receitas.rotulo_nivel'        => ['rotulo' => 'Rótulo do nível', 'tipo' => 'texto', 'grupo' => 'Textos do livro', 'padrao' => 'Nível'],
                    'home.receitas.dica_titulo'         => ['rotulo' => 'Título da dica', 'tipo' => 'texto', 'grupo' => 'Textos do livro', 'padrao' => 'Dica da confeiteira'],
                    'home.receitas.rotulo_ingredientes' => ['rotulo' => 'Título dos ingredientes', 'tipo' => 'texto', 'grupo' => 'Textos do livro', 'padrao' => 'Ingredientes'],
                    'home.receitas.rotulo_preparo'      => ['rotulo' => 'Título do modo de preparo', 'tipo' => 'texto', 'grupo' => 'Textos do livro', 'padrao' => 'Modo de preparo'],
                ],
            ],

            'kits' => [
                'titulo' => 'Kits especiais',
                'ajuda'  => 'Os kits, fotos e preços vêm do cadastro de Kits.',
                'campos' => [
                    'home.kits.selo'          => ['rotulo' => 'Selo acima do título', 'tipo' => 'texto', 'padrao' => 'Kits especiais'],
                    'home.kits.titulo'        => ['rotulo' => 'Título', 'tipo' => 'texto', 'destaque' => true, 'padrao' => 'Sabores e *valores*'],
                    'home.kits.texto'         => ['rotulo' => 'Texto', 'tipo' => 'textarea', 'destaque' => true, 'padrao' => 'Kits montados com carinho para presentear, celebrar ou simplesmente se dar um mimo. Peça direto pelo WhatsApp.'],
                    'home.kits.ver_itens'     => ['rotulo' => 'Botão para abrir os itens', 'tipo' => 'texto', 'padrao' => 'Ver itens do kit'],
                    'home.kits.ocultar_itens' => ['rotulo' => 'Botão para fechar os itens', 'tipo' => 'texto', 'padrao' => 'Ocultar itens'],
                    'home.kits.botao'         => ['rotulo' => 'Botão do WhatsApp', 'tipo' => 'texto', 'padrao' => 'Peça agora'],
                ],
            ],

            'equipe' => [
                'titulo' => 'Equipe',
                'ajuda'  => 'Deixe o nome vazio para esconder a pessoa. Sem ninguém, a seção some. Redes vazias escondem o ícone; WhatsApp só com números e DDD (ex.: 5511999990000).',
                'campos' => array_merge([
                    'home.equipe.selo'   => ['rotulo' => 'Selo acima do título', 'tipo' => 'texto', 'padrao' => 'Quem faz acontecer'],
                    'home.equipe.titulo' => ['rotulo' => 'Título', 'tipo' => 'texto', 'destaque' => true, 'padrao' => 'Nossa equipe *criativa*'],
                    'home.equipe.texto'  => ['rotulo' => 'Texto', 'tipo' => 'textarea', 'destaque' => true, 'padrao' => 'Mãos talentosas e corações apaixonados por confeitaria. Conheça quem prepara cada doce com tanto carinho.'],
                ], ...array_map(function ($n, $pessoa) {
                    return [
                        "home.equipe.pessoa{$n}_nome"          => ['rotulo' => "Pessoa {$n} — nome", 'tipo' => 'texto', 'grupo' => "Pessoa {$n}", 'padrao' => $pessoa[0]],
                        "home.equipe.pessoa{$n}_cargo"         => ['rotulo' => "Pessoa {$n} — cargo", 'tipo' => 'texto', 'grupo' => "Pessoa {$n}", 'padrao' => $pessoa[1]],
                        "home.equipe.pessoa{$n}_especialidade" => ['rotulo' => "Pessoa {$n} — especialidade", 'tipo' => 'texto', 'grupo' => "Pessoa {$n}", 'padrao' => $pessoa[2]],
                        "home.equipe.pessoa{$n}_bio"           => ['rotulo' => "Pessoa {$n} — sobre", 'tipo' => 'textarea', 'grupo' => "Pessoa {$n}", 'padrao' => $pessoa[3]],
                        "home.equipe.pessoa{$n}_foto"          => ['rotulo' => "Pessoa {$n} — foto", 'tipo' => 'imagem', 'grupo' => "Pessoa {$n}", 'padrao' => 'donuts/IMG/chefe1.jpg'],
                        "home.equipe.pessoa{$n}_instagram"     => ['rotulo' => "Pessoa {$n} — link do Instagram", 'tipo' => 'link', 'grupo' => "Pessoa {$n}", 'padrao' => ''],
                        "home.equipe.pessoa{$n}_whatsapp"      => ['rotulo' => "Pessoa {$n} — WhatsApp", 'tipo' => 'texto', 'grupo' => "Pessoa {$n}", 'padrao' => ''],
                        "home.equipe.pessoa{$n}_facebook"      => ['rotulo' => "Pessoa {$n} — link do Facebook", 'tipo' => 'link', 'grupo' => "Pessoa {$n}", 'padrao' => ''],
                    ];
                }, [1, 2, 3, 4], [
                    ['Nome da Confeiteira', 'Confeiteira-chefe e fundadora', 'Bolos de festa', 'Transformou as receitas de família em negócio e cuida pessoalmente de cada bolo que sai da nossa cozinha.'],
                    ['Nome Sobrenome', 'Chef de doces finos', 'Doces finos', 'Detalhista e apaixonado por técnica francesa. É quem cria os macarons, bombons e docinhos para casamentos.'],
                    ['Nome Sobrenome', 'Confeiteira', 'Tortas e brigadeiros', 'Mestre das tortas e do brigadeiro perfeito. Sempre testando um sabor novo para a vitrine.'],
                    ['Nome Sobrenome', 'Atendimento e encomendas', 'Encomendas personalizadas', 'Ajuda você a escolher o doce ideal para a sua festa e garante que tudo chegue no dia e na hora certos.'],
                ])),
            ],

        ],
    ],

    'sobre' => [
        'titulo'    => 'Sobre',
        'descricao' => 'História, missão, chef e compromissos.',
        'icone'     => 'bi-heart',
        'rota'      => 'sobre',
        'secoes'    => [

            'banner' => [
                'titulo' => 'Banner do topo',
                'campos' => [
                    'sobre.banner.imagem'    => ['rotulo' => 'Imagem de fundo', 'tipo' => 'imagem', 'padrao' => 'donuts/IMG/banner3.png'],
                    'sobre.banner.selo'      => ['rotulo' => 'Selo acima do título', 'tipo' => 'texto', 'padrao' => 'Confeitaria artesanal'],
                    'sobre.banner.titulo'    => ['rotulo' => 'Título', 'tipo' => 'texto', 'padrao' => 'Sobre nós'],
                    'sobre.banner.subtitulo' => ['rotulo' => 'Subtítulo', 'tipo' => 'texto', 'padrao' => 'Doces feitos à mão, com carinho e ingredientes selecionados'],
                ],
            ],

            'historia' => [
                'titulo' => 'Nossa história (linha do tempo)',
                'ajuda'  => 'Etapa com título vazio não aparece.',
                'campos' => array_merge([
                    'sobre.historia.imagem'      => ['rotulo' => 'Imagem', 'tipo' => 'imagem', 'padrao' => 'donuts/IMG/bannerbolocerto.png'],
                    'sobre.historia.selo_titulo' => ['rotulo' => 'Selo da imagem — título', 'tipo' => 'texto', 'padrao' => 'Feito à mão'],
                    'sobre.historia.selo_texto'  => ['rotulo' => 'Selo da imagem — texto', 'tipo' => 'texto', 'padrao' => 'Receitas de família'],
                    'sobre.historia.selo'        => ['rotulo' => 'Selo acima do título', 'tipo' => 'texto', 'padrao' => 'Quem somos'],
                    'sobre.historia.titulo'      => ['rotulo' => 'Título', 'tipo' => 'texto', 'destaque' => true, 'padrao' => 'Nossa *história*'],
                    'sobre.historia.texto'       => ['rotulo' => 'Texto', 'tipo' => 'textarea', 'destaque' => true, 'padrao' => 'Somos uma confeitaria artesanal que nasceu do amor pelos doces e pelas pessoas. Cada bolo, torta e docinho é preparado **à mão**, com ingredientes selecionados e o mesmo cuidado de quando tudo começou.'],
                ], ...array_map(function ($n, $etapa) {
                    return [
                        "sobre.historia.etapa{$n}_marco"  => ['rotulo' => "Etapa {$n} — marco (ex.: ano)", 'tipo' => 'texto', 'grupo' => "Etapa {$n}", 'padrao' => $etapa[0]],
                        "sobre.historia.etapa{$n}_titulo" => ['rotulo' => "Etapa {$n} — título", 'tipo' => 'texto', 'grupo' => "Etapa {$n}", 'padrao' => $etapa[1]],
                        "sobre.historia.etapa{$n}_texto"  => ['rotulo' => "Etapa {$n} — texto", 'tipo' => 'textarea', 'grupo' => "Etapa {$n}", 'padrao' => $etapa[2]],
                    ];
                }, [1, 2, 3, 4], [
                    ['O começo', 'Uma receita de família', 'Tudo começou na cozinha de casa, com as receitas da avó e o sonho de adoçar o dia das pessoas.'],
                    ['O primeiro passo', 'As primeiras encomendas', 'Os bolos conquistaram amigos e vizinhos, e as encomendas começaram a chegar pelo boca a boca.'],
                    ['Crescendo', 'Nossa própria confeitaria', 'Com uma equipe apaixonada, ganhamos um espaço só nosso para criar doces ainda mais especiais.'],
                    ['Hoje', 'Presentes nos seus momentos', 'Seguimos fazendo tudo à mão, com o mesmo carinho, para aniversários, casamentos e o café da tarde.'],
                ]), ...[[
                    'sobre.historia.botao_texto' => ['rotulo' => 'Botão — texto', 'tipo' => 'texto', 'padrao' => 'Conheça nossos doces'],
                    'sobre.historia.botao_link'  => ['rotulo' => 'Botão — link', 'tipo' => 'link', 'padrao' => 'cardapio'],
                    'sobre.historia.assinatura'  => ['rotulo' => 'Assinatura', 'tipo' => 'texto', 'padrao' => 'com carinho, da nossa cozinha'],
                ]]),
            ],

            'missao' => [
                'titulo' => 'Nossa missão (valores)',
                'ajuda'  => 'A frase fica: início + palavra que vai trocando + fim. Valor com título vazio não aparece.',
                'campos' => [
                    'sobre.missao.selo'         => ['rotulo' => 'Selo acima da frase', 'tipo' => 'texto', 'padrao' => 'Nossa missão'],
                    'sobre.missao.frase_inicio' => ['rotulo' => 'Frase — início', 'tipo' => 'texto', 'padrao' => 'Levar'],
                    'sobre.missao.palavras'     => ['rotulo' => 'Palavras que vão trocando (uma por linha)', 'tipo' => 'lista', 'padrao' => "alegria\ncarinho\nsabor\nafeto\ndoçura"],
                    'sobre.missao.frase_fim'    => ['rotulo' => 'Frase — fim (segunda linha)', 'tipo' => 'texto', 'padrao' => 'para cada momento da sua vida.'],
                    'sobre.missao.texto'        => ['rotulo' => 'Texto', 'tipo' => 'textarea', 'destaque' => true, 'padrao' => 'Acreditamos que um doce bem feito transforma um dia comum em uma lembrança especial. É por isso que colocamos o coração em cada receita.'],
                    'sobre.missao.valor1_titulo' => ['rotulo' => 'Valor 1 — título', 'tipo' => 'texto', 'grupo' => 'Valores', 'padrao' => 'Tradição'],
                    'sobre.missao.valor1_texto'  => ['rotulo' => 'Valor 1 — texto', 'tipo' => 'textarea', 'grupo' => 'Valores', 'padrao' => 'Receitas de família preservadas com respeito, que carregam o sabor das memórias afetivas.'],
                    'sobre.missao.valor2_titulo' => ['rotulo' => 'Valor 2 — título', 'tipo' => 'texto', 'grupo' => 'Valores', 'padrao' => 'Qualidade'],
                    'sobre.missao.valor2_texto'  => ['rotulo' => 'Valor 2 — texto', 'tipo' => 'textarea', 'grupo' => 'Valores', 'padrao' => 'Ingredientes selecionados e frescos, escolhidos um a um para cada receita.'],
                    'sobre.missao.valor3_titulo' => ['rotulo' => 'Valor 3 — título', 'tipo' => 'texto', 'grupo' => 'Valores', 'padrao' => 'Criatividade'],
                    'sobre.missao.valor3_texto'  => ['rotulo' => 'Valor 3 — texto', 'tipo' => 'textarea', 'grupo' => 'Valores', 'padrao' => 'Doces personalizados que transformam a sua ideia em uma peça única.'],
                    'sobre.missao.valor4_titulo' => ['rotulo' => 'Valor 4 — título', 'tipo' => 'texto', 'grupo' => 'Valores', 'padrao' => 'Paixão'],
                    'sobre.missao.valor4_texto'  => ['rotulo' => 'Valor 4 — texto', 'tipo' => 'textarea', 'grupo' => 'Valores', 'padrao' => 'Feito à mão, sem pressa e com amor, do forno até a sua mesa.'],
                ],
            ],

            'chef' => [
                'titulo' => 'Conheça a chef',
                'ajuda'  => 'Números no formato "15+" ou "100%". Número vazio não aparece.',
                'campos' => [
                    'sobre.chef.foto'          => ['rotulo' => 'Foto', 'tipo' => 'imagem', 'padrao' => 'donuts/IMG/chefe.png'],
                    'sobre.chef.selo'          => ['rotulo' => 'Selo acima do nome', 'tipo' => 'texto', 'padrao' => 'Conheça a chef'],
                    'sobre.chef.nome'          => ['rotulo' => 'Nome', 'tipo' => 'texto', 'padrao' => 'Nome da Chef'],
                    'sobre.chef.cargo'         => ['rotulo' => 'Cargo', 'tipo' => 'texto', 'padrao' => 'Confeiteira-chefe e fundadora'],
                    'sobre.chef.frase'         => ['rotulo' => 'Frase em destaque', 'tipo' => 'textarea', 'padrao' => 'Cada doce que sai da minha cozinha leva um pedacinho do meu coração.'],
                    'sobre.chef.bio'           => ['rotulo' => 'Sobre a chef', 'tipo' => 'textarea', 'padrao' => 'Apaixonada por confeitaria desde a infância, aprendeu os primeiros segredos ao lado da avó. Hoje lidera a nossa cozinha unindo receitas de família, técnicas modernas e muito carinho para criar doces que marcam momentos.'],
                    'sobre.chef.numero1'       => ['rotulo' => 'Número 1', 'tipo' => 'texto', 'grupo' => 'Números', 'padrao' => '15+'],
                    'sobre.chef.numero1_texto' => ['rotulo' => 'Número 1 — legenda', 'tipo' => 'texto', 'grupo' => 'Números', 'padrao' => 'Anos de experiência'],
                    'sobre.chef.numero2'       => ['rotulo' => 'Número 2', 'tipo' => 'texto', 'grupo' => 'Números', 'padrao' => '5000+'],
                    'sobre.chef.numero2_texto' => ['rotulo' => 'Número 2 — legenda', 'tipo' => 'texto', 'grupo' => 'Números', 'padrao' => 'Bolos entregues'],
                    'sobre.chef.numero3'       => ['rotulo' => 'Número 3', 'tipo' => 'texto', 'grupo' => 'Números', 'padrao' => '100%'],
                    'sobre.chef.numero3_texto' => ['rotulo' => 'Número 3 — legenda', 'tipo' => 'texto', 'grupo' => 'Números', 'padrao' => 'Feito à mão'],
                    'sobre.chef.botao_texto'   => ['rotulo' => 'Botão — texto', 'tipo' => 'texto', 'padrao' => 'Faça sua encomenda'],
                    'sobre.chef.botao_link'    => ['rotulo' => 'Botão — link', 'tipo' => 'link', 'padrao' => 'pedidos'],
                    'sobre.chef.assinatura'    => ['rotulo' => 'Assinatura', 'tipo' => 'texto', 'padrao' => 'Nome da Chef'],
                ],
            ],

            'compromissos' => [
                'titulo' => 'Nossos compromissos',
                'ajuda'  => 'Compromisso com título vazio não aparece.',
                'campos' => [
                    'sobre.compromissos.imagem'       => ['rotulo' => 'Imagem', 'tipo' => 'imagem', 'padrao' => 'donuts/IMG/img39.png'],
                    'sobre.compromissos.selo'         => ['rotulo' => 'Selo acima do título', 'tipo' => 'texto', 'padrao' => 'Nossos padrões'],
                    'sobre.compromissos.titulo'       => ['rotulo' => 'Título', 'tipo' => 'texto', 'destaque' => true, 'padrao' => 'Nossos *compromissos*'],
                    'sobre.compromissos.texto'        => ['rotulo' => 'Texto', 'tipo' => 'textarea', 'destaque' => true, 'padrao' => 'Mais do que fazer doces gostosos, assumimos compromissos com você. É isso que garante a qualidade de cada pedido.'],
                    'sobre.compromissos.item1_titulo' => ['rotulo' => 'Compromisso 1 — título', 'tipo' => 'texto', 'grupo' => 'Compromissos', 'padrao' => 'Ingredientes selecionados'],
                    'sobre.compromissos.item1_texto'  => ['rotulo' => 'Compromisso 1 — texto', 'tipo' => 'textarea', 'grupo' => 'Compromissos', 'padrao' => 'Chocolate de qualidade, manteiga de verdade e frutas frescas escolhidas uma a uma.'],
                    'sobre.compromissos.item2_titulo' => ['rotulo' => 'Compromisso 2 — título', 'tipo' => 'texto', 'grupo' => 'Compromissos', 'padrao' => 'Feito no dia'],
                    'sobre.compromissos.item2_texto'  => ['rotulo' => 'Compromisso 2 — texto', 'tipo' => 'textarea', 'grupo' => 'Compromissos', 'padrao' => 'Produzimos em pequenas fornadas para que tudo chegue fresquinho até você.'],
                    'sobre.compromissos.item3_titulo' => ['rotulo' => 'Compromisso 3 — título', 'tipo' => 'texto', 'grupo' => 'Compromissos', 'padrao' => 'Feito à mão'],
                    'sobre.compromissos.item3_texto'  => ['rotulo' => 'Compromisso 3 — texto', 'tipo' => 'textarea', 'grupo' => 'Compromissos', 'padrao' => 'Cada doce é preparado e decorado artesanalmente, sem pressa e com atenção aos detalhes.'],
                    'sobre.compromissos.item4_titulo' => ['rotulo' => 'Compromisso 4 — título', 'tipo' => 'texto', 'grupo' => 'Compromissos', 'padrao' => 'Higiene e cuidado'],
                    'sobre.compromissos.item4_texto'  => ['rotulo' => 'Compromisso 4 — texto', 'tipo' => 'textarea', 'grupo' => 'Compromissos', 'padrao' => 'Cozinha limpa e organizada, com cuidado em cada etapa, do preparo à embalagem.'],
                    'sobre.compromissos.item5_titulo' => ['rotulo' => 'Compromisso 5 — título', 'tipo' => 'texto', 'grupo' => 'Compromissos', 'padrao' => 'Atendimento com carinho'],
                    'sobre.compromissos.item5_texto'  => ['rotulo' => 'Compromisso 5 — texto', 'tipo' => 'textarea', 'grupo' => 'Compromissos', 'padrao' => 'Ouvimos o que você precisa para que o seu pedido fique exatamente como sonhou.'],
                ],
            ],

        ],
    ],

    'cardapio' => [
        'titulo'    => 'Cardápio',
        'descricao' => 'Lista de doces com busca e filtro por categoria.',
        'icone'     => 'bi-book',
        'rota'      => 'cardapio.index',
        'secoes'    => [

            'banner' => [
                'titulo' => 'Banner do topo',
                'campos' => [
                    'cardapio.banner.imagem'    => ['rotulo' => 'Imagem de fundo', 'tipo' => 'imagem', 'padrao' => 'donuts/cardapio_img/banner.png'],
                    'cardapio.banner.selo'      => ['rotulo' => 'Selo acima do título', 'tipo' => 'texto', 'padrao' => 'Confeitaria artesanal'],
                    'cardapio.banner.titulo'    => ['rotulo' => 'Título', 'tipo' => 'texto', 'padrao' => 'Nosso cardápio'],
                    'cardapio.banner.subtitulo' => ['rotulo' => 'Subtítulo', 'tipo' => 'texto', 'padrao' => 'Escolha o doce perfeito para o seu momento'],
                ],
            ],

            'lista' => [
                'titulo' => 'Lista de doces',
                'ajuda'  => 'Os doces, fotos e preços vêm do cadastro de Produtos.',
                'campos' => [
                    'cardapio.lista.busca'             => ['rotulo' => 'Texto dentro da busca', 'tipo' => 'texto', 'padrao' => 'Buscar doce pelo nome...'],
                    'cardapio.lista.contador'          => ['rotulo' => 'Texto depois do total (ex.: "15 doces no cardápio")', 'tipo' => 'texto', 'padrao' => 'doces no cardápio'],
                    'cardapio.lista.sem_preco'         => ['rotulo' => 'Doce sem preço', 'tipo' => 'texto', 'padrao' => 'Preço sob consulta'],
                    'cardapio.lista.mensagem_whatsapp' => ['rotulo' => 'Mensagem do WhatsApp (o nome do doce vem depois)', 'tipo' => 'texto', 'padrao' => 'Olá! Gostaria de encomendar:'],
                    'cardapio.lista.ver_mais'          => ['rotulo' => 'Botão para carregar mais', 'tipo' => 'texto', 'padrao' => 'Ver mais doces'],
                    'cardapio.lista.vazio_titulo'      => ['rotulo' => 'Busca sem resultado — título', 'tipo' => 'texto', 'padrao' => 'Nenhum doce encontrado'],
                    'cardapio.lista.vazio_texto'       => ['rotulo' => 'Busca sem resultado — texto', 'tipo' => 'texto', 'padrao' => 'Tente outro nome ou escolha outra categoria.'],
                ],
            ],
        ],
    ],

    'produto' => [
        'titulo'    => 'Produto',
        'descricao' => 'Página de cada doce (aberta pelo cardápio).',
        'icone'     => 'bi-cake2',
        'rota'      => 'cardapio.index',
        'secoes'    => [

            'banner' => [
                'titulo' => 'Banner do topo',
                'ajuda'  => 'O título é o nome do doce e o fundo é a foto dele. A imagem abaixo só aparece se o doce não tiver foto.',
                'campos' => [
                    'produto.banner.selo'      => ['rotulo' => 'Selo (quando o doce não tem categoria)', 'tipo' => 'texto', 'padrao' => 'Confeitaria artesanal'],
                    'produto.banner.subtitulo' => ['rotulo' => 'Subtítulo', 'tipo' => 'texto', 'padrao' => 'Feito à mão, com ingredientes selecionados e muito carinho'],
                    'produto.banner.imagem'    => ['rotulo' => 'Imagem de fundo (doce sem foto)', 'tipo' => 'imagem', 'padrao' => 'donuts/cardapio_img/banner.png'],
                ],
            ],

            'detalhe' => [
                'titulo' => 'Compra e vantagens',
                'ajuda'  => 'O texto de doce sem preço é o mesmo do Cardápio.',
                'campos' => [
                    'produto.detalhe.zoom'              => ['rotulo' => 'Dica sobre a foto', 'tipo' => 'texto', 'padrao' => 'Passe o mouse para ampliar'],
                    'produto.detalhe.botao_whatsapp'    => ['rotulo' => 'Botão do WhatsApp', 'tipo' => 'texto', 'padrao' => 'Pedir pelo WhatsApp'],
                    'produto.detalhe.botao_sacola'      => ['rotulo' => 'Botão da sacola', 'tipo' => 'texto', 'padrao' => 'Adicionar à sacola'],
                    'produto.detalhe.sacola_adicionado' => ['rotulo' => 'Botão da sacola depois de adicionar', 'tipo' => 'texto', 'padrao' => 'Adicionado à sacola!'],
                    'produto.detalhe.vantagem1'         => ['rotulo' => 'Vantagem 1', 'tipo' => 'texto', 'padrao' => 'Feito à mão'],
                    'produto.detalhe.vantagem2'         => ['rotulo' => 'Vantagem 2', 'tipo' => 'texto', 'padrao' => 'Ingredientes selecionados'],
                    'produto.detalhe.vantagem3'         => ['rotulo' => 'Vantagem 3', 'tipo' => 'texto', 'padrao' => 'Confirmação pelo WhatsApp'],
                    'produto.detalhe.relacionados'      => ['rotulo' => 'Título dos doces relacionados', 'tipo' => 'texto', 'destaque' => true, 'padrao' => 'Você também vai *amar*'],
                ],
            ],

            'abas' => [
                'titulo' => 'Abas (descrição, como encomendar, avaliações)',
                'ajuda'  => 'Passo com título vazio não aparece.',
                'campos' => [
                    'produto.abas.aba_descricao'   => ['rotulo' => 'Aba 1 — nome', 'tipo' => 'texto', 'padrao' => 'Descrição'],
                    'produto.abas.sem_descricao'   => ['rotulo' => 'Texto quando o doce não tem descrição', 'tipo' => 'textarea', 'padrao' => 'Em breve mais detalhes sobre este produto. Fale com a gente pelo WhatsApp para saber mais!'],
                    'produto.abas.aba_como'        => ['rotulo' => 'Aba 2 — nome', 'tipo' => 'texto', 'padrao' => 'Como encomendar'],
                    'produto.abas.passo1_titulo'   => ['rotulo' => 'Passo 1 — título', 'tipo' => 'texto', 'grupo' => 'Como encomendar', 'padrao' => 'Escolha a quantidade'],
                    'produto.abas.passo1_texto'    => ['rotulo' => 'Passo 1 — texto', 'tipo' => 'textarea', 'grupo' => 'Como encomendar', 'padrao' => 'Use os botões + e − ao lado do preço.'],
                    'produto.abas.passo2_titulo'   => ['rotulo' => 'Passo 2 — título', 'tipo' => 'texto', 'grupo' => 'Como encomendar', 'padrao' => 'Envie pelo WhatsApp'],
                    'produto.abas.passo2_texto'    => ['rotulo' => 'Passo 2 — texto', 'tipo' => 'textarea', 'grupo' => 'Como encomendar', 'padrao' => 'Toque em “Pedir pelo WhatsApp” ou adicione à sacola para pedir vários doces de uma vez.'],
                    'produto.abas.passo3_titulo'   => ['rotulo' => 'Passo 3 — título', 'tipo' => 'texto', 'grupo' => 'Como encomendar', 'padrao' => 'Confirmamos com você'],
                    'produto.abas.passo3_texto'    => ['rotulo' => 'Passo 3 — texto', 'tipo' => 'textarea', 'grupo' => 'Como encomendar', 'padrao' => 'Respondemos com a disponibilidade, a forma de pagamento e as opções de retirada ou entrega.'],
                    'produto.abas.aba_avaliacoes'  => ['rotulo' => 'Aba 3 — nome', 'tipo' => 'texto', 'padrao' => 'Avaliações'],
                    'produto.abas.nota_avaliacoes' => ['rotulo' => 'Nota abaixo das avaliações', 'tipo' => 'texto', 'padrao' => 'Avaliações da nossa confeitaria enviadas pelos clientes no app.'],
                ],
            ],

            'lateral' => [
                'titulo' => 'Coluna lateral (busca e sacola)',
                'campos' => [
                    'produto.lateral.busca_titulo'    => ['rotulo' => 'Busca — título', 'tipo' => 'texto', 'padrao' => 'Buscar doces'],
                    'produto.lateral.busca_exemplo'   => ['rotulo' => 'Busca — texto dentro do campo', 'tipo' => 'texto', 'padrao' => 'Ex.: brigadeiro, torta...'],
                    'produto.lateral.sacola_titulo'   => ['rotulo' => 'Sacola — título', 'tipo' => 'texto', 'padrao' => 'Sua sacola'],
                    'produto.lateral.sacola_vazia'    => ['rotulo' => 'Sacola vazia — texto', 'tipo' => 'textarea', 'padrao' => 'Sua sacola está vazia. Adicione este doce e outros do cardápio para pedir tudo de uma vez.'],
                    'produto.lateral.sacola_enviar'   => ['rotulo' => 'Sacola — botão de enviar', 'tipo' => 'texto', 'padrao' => 'Enviar sacola pelo WhatsApp'],
                    'produto.lateral.sacola_esvaziar' => ['rotulo' => 'Sacola — botão de esvaziar', 'tipo' => 'texto', 'padrao' => 'Esvaziar sacola'],
                ],
            ],
        ],
    ],

    'pedidos' => [
        'titulo'    => 'Pedidos',
        'descricao' => 'Como pedir (app, WhatsApp, encomendas) e sacola.',
        'icone'     => 'bi-bag-heart',
        'rota'      => 'pedidos',
        'secoes'    => [

            'banner' => [
                'titulo' => 'Banner do topo',
                'campos' => [
                    'pedidos.banner.imagem'    => ['rotulo' => 'Imagem de fundo', 'tipo' => 'imagem', 'padrao' => 'donuts/pedidios/bannerpedidos.png'],
                    'pedidos.banner.selo'      => ['rotulo' => 'Selo acima do título', 'tipo' => 'texto', 'padrao' => 'Confeitaria artesanal'],
                    'pedidos.banner.titulo'    => ['rotulo' => 'Título', 'tipo' => 'texto', 'padrao' => 'Faça seu pedido'],
                    'pedidos.banner.subtitulo' => ['rotulo' => 'Subtítulo', 'tipo' => 'texto', 'padrao' => 'Escolha seus doces favoritos e receba com todo o carinho'],
                ],
            ],

            'como' => [
                'titulo' => 'Como fazer seu pedido (3 passos)',
                'ajuda'  => 'O link do app e o WhatsApp da loja vêm das configurações da loja.',
                'campos' => [
                    'pedidos.como.selo'             => ['rotulo' => 'Selo acima do título', 'tipo' => 'texto', 'padrao' => 'Simples e rápido'],
                    'pedidos.como.titulo'           => ['rotulo' => 'Título', 'tipo' => 'texto', 'destaque' => true, 'padrao' => 'Como fazer seu *pedido*'],
                    'pedidos.como.passo1_titulo'    => ['rotulo' => 'Passo 1 (app) — título', 'tipo' => 'texto', 'grupo' => 'Passo 1 — app', 'padrao' => 'Pelo app'],
                    'pedidos.como.passo1_texto'     => ['rotulo' => 'Passo 1 (app) — texto', 'tipo' => 'textarea', 'grupo' => 'Passo 1 — app', 'padrao' => 'Monte sua sacola, use cupons, escolha entrega ou retirada e acompanhe o pedido.'],
                    'pedidos.como.passo1_botao'     => ['rotulo' => 'Botão do app (aqui e na lateral)', 'tipo' => 'texto', 'grupo' => 'Passo 1 — app', 'padrao' => 'Abrir o app'],
                    'pedidos.como.passo2_titulo'    => ['rotulo' => 'Passo 2 (WhatsApp) — título', 'tipo' => 'texto', 'grupo' => 'Passo 2 — WhatsApp', 'padrao' => 'Pelo WhatsApp'],
                    'pedidos.como.passo2_texto'     => ['rotulo' => 'Passo 2 (WhatsApp) — texto', 'tipo' => 'textarea', 'grupo' => 'Passo 2 — WhatsApp', 'padrao' => 'Adicione os doces abaixo na sua sacola e envie tudo de uma vez, ou fale direto com a gente.'],
                    'pedidos.como.passo2_botao'     => ['rotulo' => 'Botão do WhatsApp (aqui e na lateral)', 'tipo' => 'texto', 'grupo' => 'Passo 2 — WhatsApp', 'padrao' => 'Chamar no WhatsApp'],
                    'pedidos.como.passo2_mensagem'  => ['rotulo' => 'Mensagem que já vai escrita no WhatsApp', 'tipo' => 'texto', 'grupo' => 'Passo 2 — WhatsApp', 'padrao' => 'Olá! Gostaria de fazer um pedido.'],
                    'pedidos.como.passo3_titulo'    => ['rotulo' => 'Passo 3 (encomendas) — título', 'tipo' => 'texto', 'grupo' => 'Passo 3 — encomendas', 'padrao' => 'Encomendas'],
                    'pedidos.como.passo3_texto'     => ['rotulo' => 'Passo 3 (encomendas) — texto', 'tipo' => 'textarea', 'grupo' => 'Passo 3 — encomendas', 'padrao' => 'Bolos para festas, kits e quantidades maiores: conte o que precisa e mandamos o orçamento.'],
                    'pedidos.como.passo3_botao'     => ['rotulo' => 'Passo 3 (encomendas) — botão', 'tipo' => 'texto', 'grupo' => 'Passo 3 — encomendas', 'padrao' => 'Pedir orçamento'],
                ],
            ],

            'produtos' => [
                'titulo' => 'Mais pedidos (produtos)',
                'campos' => [
                    'pedidos.produtos.selo'      => ['rotulo' => 'Selo acima do título', 'tipo' => 'texto', 'padrao' => 'Os favoritos'],
                    'pedidos.produtos.titulo'    => ['rotulo' => 'Título', 'tipo' => 'texto', 'destaque' => true, 'padrao' => 'Mais *pedidos*'],
                    'pedidos.produtos.ver_todos' => ['rotulo' => 'Link para o cardápio', 'tipo' => 'texto', 'padrao' => 'Ver todo o cardápio'],
                    'pedidos.produtos.vazio'     => ['rotulo' => 'Mensagem sem produtos', 'tipo' => 'texto', 'padrao' => 'Nenhum produto disponível no momento.'],
                ],
            ],

            'lateral' => [
                'titulo' => 'Coluna lateral',
                'campos' => [
                    'pedidos.lateral.sacola_obs'      => ['rotulo' => 'Sacola — observação', 'tipo' => 'texto', 'padrao' => 'Valores e disponibilidade confirmados pelo WhatsApp.'],
                    'pedidos.lateral.app_titulo'      => ['rotulo' => 'App — título', 'tipo' => 'texto', 'padrao' => 'Peça pelo app'],
                    'pedidos.lateral.app_texto'       => ['rotulo' => 'App — texto', 'tipo' => 'textarea', 'padrao' => 'Peça em poucos toques, use cupons de desconto e acompanhe cada etapa do seu pedido.'],
                    'pedidos.lateral.duvida_titulo'   => ['rotulo' => 'Dúvidas — título', 'tipo' => 'texto', 'padrao' => 'Ficou com dúvida?'],
                    'pedidos.lateral.duvida_texto'    => ['rotulo' => 'Dúvidas — texto', 'tipo' => 'textarea', 'padrao' => 'Tire dúvidas sobre sabores, prazos e entregas.'],
                    'pedidos.lateral.duvida_mensagem' => ['rotulo' => 'Dúvidas — mensagem que já vai escrita no WhatsApp', 'tipo' => 'texto', 'padrao' => 'Olá! Tenho uma dúvida sobre os produtos.'],
                ],
            ],
        ],
    ],

    'regiao' => [
        'titulo'    => 'Região',
        'descricao' => 'Onde entregamos: consulta de CEP, zonas, retirada e perguntas.',
        'icone'     => 'bi-geo-alt',
        'rota'      => 'regiao.index',
        'secoes'    => [

            'banner' => [
                'titulo' => 'Banner do topo',
                'campos' => [
                    'regiao.banner.imagem'    => ['rotulo' => 'Imagem de fundo', 'tipo' => 'imagem', 'padrao' => 'donuts/IMG/banner3.png'],
                    'regiao.banner.selo'      => ['rotulo' => 'Selo acima do título', 'tipo' => 'texto', 'padrao' => 'Confeitaria artesanal'],
                    'regiao.banner.titulo'    => ['rotulo' => 'Título', 'tipo' => 'texto', 'padrao' => 'Onde entregamos'],
                    'regiao.banner.subtitulo' => ['rotulo' => 'Subtítulo', 'tipo' => 'texto', 'padrao' => 'Confira se o seu bairro está na nossa área de entrega'],
                ],
            ],

            'consulta' => [
                'titulo' => 'Consulta de CEP e regras de entrega',
                'ajuda'  => 'As zonas, bairros, taxas e prazos são cadastrados em Zonas de entrega.',
                'campos' => [
                    'regiao.consulta.selo'          => ['rotulo' => 'Selo acima do título', 'tipo' => 'texto', 'padrao' => 'Área de entrega'],
                    'regiao.consulta.titulo'        => ['rotulo' => 'Título', 'tipo' => 'texto', 'destaque' => true, 'padrao' => 'Será que a gente *chega até você?*'],
                    'regiao.consulta.texto'         => ['rotulo' => 'Texto', 'tipo' => 'textarea', 'destaque' => true, 'padrao' => 'Digite seu CEP e descubra na hora se entregamos no seu endereço, quanto custa e em quanto tempo seu pedido chega.'],
                    'regiao.consulta.pergunta_cep'  => ['rotulo' => 'Pergunta acima do campo de CEP', 'tipo' => 'texto', 'padrao' => 'Qual é o seu CEP?'],
                    'regiao.consulta.horario'       => ['rotulo' => 'Dias e horário de entrega', 'tipo' => 'texto', 'padrao' => 'Terça a sábado, das 9h às 18h'],
                    'regiao.consulta.pedido_minimo' => ['rotulo' => 'Pedido mínimo para entrega em R$ (0 = sem mínimo)', 'tipo' => 'texto', 'padrao' => '30'],
                ],
            ],

            'zonas' => [
                'titulo' => 'Zonas de entrega',
                'campos' => [
                    'regiao.zonas.selo'   => ['rotulo' => 'Selo acima do título', 'tipo' => 'texto', 'padrao' => 'Bairros atendidos'],
                    'regiao.zonas.titulo' => ['rotulo' => 'Título', 'tipo' => 'texto', 'destaque' => true, 'padrao' => 'Nossas *zonas de entrega*'],
                    'regiao.zonas.busca'  => ['rotulo' => 'Texto dentro da busca de bairro', 'tipo' => 'texto', 'padrao' => 'Procurar bairro...'],
                ],
            ],

            'alternativas' => [
                'titulo' => 'Retirar na loja / Mora mais longe',
                'ajuda'  => 'O endereço da loja vem das configurações da loja.',
                'campos' => [
                    'regiao.alternativas.retirar_titulo' => ['rotulo' => 'Retirada — título', 'tipo' => 'texto', 'padrao' => 'Prefere retirar?'],
                    'regiao.alternativas.retirar_texto'  => ['rotulo' => 'Retirada — texto', 'tipo' => 'textarea', 'padrao' => 'Faça seu pedido e retire na nossa loja, sem taxa de entrega. Seu doce fica separado e embalado esperando por você.'],
                    'regiao.alternativas.retirar_botao'  => ['rotulo' => 'Retirada — botão', 'tipo' => 'texto', 'padrao' => 'Como chegar'],
                    'regiao.alternativas.longe_titulo'   => ['rotulo' => 'Mais longe — título', 'tipo' => 'texto', 'padrao' => 'Mora mais longe?'],
                    'regiao.alternativas.longe_texto'    => ['rotulo' => 'Mais longe — texto', 'tipo' => 'textarea', 'padrao' => 'Para encomendas grandes, festas e eventos, avaliamos entregas fora das nossas zonas. Fale com a gente e conte onde é a sua celebração.'],
                    'regiao.alternativas.longe_botao'    => ['rotulo' => 'Mais longe — botão', 'tipo' => 'texto', 'padrao' => 'Consultar pelo WhatsApp'],
                    'regiao.alternativas.longe_mensagem' => ['rotulo' => 'Mais longe — mensagem que já vai escrita no WhatsApp', 'tipo' => 'texto', 'padrao' => 'Olá! Gostaria de saber se vocês entregam no meu endereço.'],
                ],
            ],

            'mensagens' => [
                'titulo' => 'Mensagens da consulta de CEP',
                'ajuda'  => 'Aparecem depois que o cliente digita o CEP ou escolhe o bairro. {endereco} é trocado pelo bairro e CEP do cliente.',
                'campos' => [
                    'regiao.mensagens.ok_titulo'         => ['rotulo' => 'Entregamos — título', 'tipo' => 'texto', 'grupo' => 'Quando entregamos', 'padrao' => 'Oba! Entregamos em {endereco}'],
                    'regiao.mensagens.ok_botao'          => ['rotulo' => 'Entregamos — botão do WhatsApp', 'tipo' => 'texto', 'grupo' => 'Quando entregamos', 'padrao' => 'Fazer meu pedido'],
                    'regiao.mensagens.ok_whatsapp'       => ['rotulo' => 'Entregamos — mensagem que já vai escrita no WhatsApp', 'tipo' => 'texto', 'grupo' => 'Quando entregamos', 'padrao' => 'Olá! Quero fazer um pedido para entrega em {endereco}.'],
                    'regiao.mensagens.nao_titulo'        => ['rotulo' => 'Não entregamos — título', 'tipo' => 'texto', 'grupo' => 'Quando não entregamos', 'padrao' => 'Ainda não entregamos aí'],
                    'regiao.mensagens.nao_texto'         => ['rotulo' => 'Não entregamos — texto', 'tipo' => 'textarea', 'grupo' => 'Quando não entregamos', 'padrao' => 'Mas não fique sem seu doce: você pode retirar na loja ou falar com a gente para encomendas maiores.'],
                    'regiao.mensagens.nao_botao'         => ['rotulo' => 'Não entregamos — botão do WhatsApp', 'tipo' => 'texto', 'grupo' => 'Quando não entregamos', 'padrao' => 'Consultar exceção'],
                    'regiao.mensagens.nao_whatsapp'      => ['rotulo' => 'Não entregamos — mensagem que já vai escrita no WhatsApp', 'tipo' => 'texto', 'grupo' => 'Quando não entregamos', 'padrao' => 'Olá! Vocês entregam em {endereco}?'],
                    'regiao.mensagens.nao_retirar'       => ['rotulo' => 'Não entregamos — botão de retirar', 'tipo' => 'texto', 'grupo' => 'Quando não entregamos', 'padrao' => 'Retirar na loja'],
                    'regiao.mensagens.incompleto_titulo' => ['rotulo' => 'CEP incompleto — título', 'tipo' => 'texto', 'grupo' => 'Erros', 'padrao' => 'CEP incompleto'],
                    'regiao.mensagens.incompleto_texto'  => ['rotulo' => 'CEP incompleto — texto', 'tipo' => 'texto', 'grupo' => 'Erros', 'padrao' => 'Digite os 8 números do seu CEP.'],
                    'regiao.mensagens.invalido_titulo'   => ['rotulo' => 'CEP não existe — título', 'tipo' => 'texto', 'grupo' => 'Erros', 'padrao' => 'CEP não encontrado'],
                    'regiao.mensagens.invalido_texto'    => ['rotulo' => 'CEP não existe — texto', 'tipo' => 'texto', 'grupo' => 'Erros', 'padrao' => 'Confira os números ou escolha seu bairro na lista abaixo.'],
                    'regiao.mensagens.indefinido_titulo' => ['rotulo' => 'Endereço não confirmado — título', 'tipo' => 'texto', 'grupo' => 'Erros', 'padrao' => 'Não conseguimos confirmar seu endereço'],
                    'regiao.mensagens.indefinido_texto'  => ['rotulo' => 'Endereço não confirmado — texto', 'tipo' => 'texto', 'grupo' => 'Erros', 'padrao' => 'Escolha seu bairro na lista abaixo ou fale com a gente pelo WhatsApp.'],
                    'regiao.mensagens.falha_titulo'      => ['rotulo' => 'Falha na consulta — título', 'tipo' => 'texto', 'grupo' => 'Erros', 'padrao' => 'Não conseguimos consultar agora'],
                    'regiao.mensagens.falha_texto'       => ['rotulo' => 'Falha na consulta — texto', 'tipo' => 'texto', 'grupo' => 'Erros', 'padrao' => 'Escolha seu bairro na lista abaixo ou fale com a gente pelo WhatsApp.'],
                    'regiao.mensagens.falha_limite'      => ['rotulo' => 'Muitas consultas seguidas — texto', 'tipo' => 'texto', 'grupo' => 'Erros', 'padrao' => 'Muitas consultas seguidas. Espere um minutinho e tente de novo.'],
                ],
            ],

            'faq' => [
                'titulo' => 'Perguntas frequentes',
                'ajuda'  => 'Nas respostas, {horario} e {pedido_minimo} são trocados pelos valores da seção "Consulta de CEP". Pergunta vazia não aparece.',
                'campos' => array_merge([
                    'regiao.faq.selo'   => ['rotulo' => 'Selo acima do título', 'tipo' => 'texto', 'padrao' => 'Dúvidas sobre a entrega'],
                    'regiao.faq.titulo' => ['rotulo' => 'Título', 'tipo' => 'texto', 'destaque' => true, 'padrao' => 'Perguntas *frequentes*'],
                ], ...array_map(function ($n, $pq) {
                    return [
                        "regiao.faq.pergunta{$n}" => ['rotulo' => "Pergunta {$n}", 'tipo' => 'texto', 'grupo' => "Pergunta {$n}", 'padrao' => $pq[0]],
                        "regiao.faq.resposta{$n}" => ['rotulo' => "Resposta {$n}", 'tipo' => 'textarea', 'grupo' => "Pergunta {$n}", 'padrao' => $pq[1]],
                    ];
                }, [1, 2, 3, 4, 5], [
                    ['Em quais dias e horários vocês entregam?', 'Entregamos {horario}. Na hora do pedido, combinamos com você o melhor horário dentro desse período.'],
                    ['Tem pedido mínimo para entrega?', 'Sim, o pedido mínimo para entrega é de {pedido_minimo}. Para retirada na loja não há valor mínimo.'],
                    ['Como os doces são transportados?', 'Os doces vão em embalagens próprias, bem protegidos, para chegarem bonitos e na temperatura certa. Bolos decorados são entregues com cuidado redobrado.'],
                    ['Posso agendar a entrega para outro dia?', 'Pode, sim. Para bolos de festa e encomendas personalizadas, recomendamos pedir com antecedência para garantir a data que você precisa.'],
                    ['Meu bairro não está na lista. E agora?', 'Fale com a gente pelo WhatsApp. Dependendo do tamanho do pedido, avaliamos a entrega. Você também pode retirar na loja sem taxa.'],
                ])),
            ],
        ],
    ],

    'contato' => [
        'titulo'    => 'Contato',
        'descricao' => 'Fale conosco, horários de funcionamento e mapa.',
        'icone'     => 'bi-chat-heart',
        'rota'      => 'contato',
        'secoes'    => [

            'topo' => [
                'titulo' => 'Fale conosco',
                'ajuda'  => 'WhatsApp, e-mail e endereço vêm das configurações da loja.',
                'campos' => [
                    'contato.topo.selo'            => ['rotulo' => 'Selo acima do título', 'tipo' => 'texto', 'padrao' => 'Fale conosco'],
                    'contato.topo.titulo'          => ['rotulo' => 'Título', 'tipo' => 'texto', 'destaque' => true, 'padrao' => 'Vamos *conversar?*'],
                    'contato.topo.texto'           => ['rotulo' => 'Texto', 'tipo' => 'textarea', 'destaque' => true, 'padrao' => 'Tire suas dúvidas, faça encomendas, peça um orçamento ou mande sugestões. Respondemos o mais rápido possível.'],
                    'contato.topo.contatos_titulo' => ['rotulo' => 'Título do cartão de contatos', 'tipo' => 'texto', 'padrao' => 'Nossos contatos'],
                ],
            ],

            'horarios' => [
                'titulo' => 'Horários de funcionamento',
                'ajuda'  => 'Escreva no formato 08:00 - 17:30. Deixe vazio para o dia fechado. O site mostra sozinho se está aberto agora.',
                'campos' => [
                    'contato.horarios.titulo' => ['rotulo' => 'Título do cartão', 'tipo' => 'texto', 'padrao' => 'Horários de funcionamento'],
                    'contato.horarios.dia1'   => ['rotulo' => 'Segunda-feira', 'tipo' => 'texto', 'padrao' => '08:00 - 17:30'],
                    'contato.horarios.dia2'   => ['rotulo' => 'Terça-feira', 'tipo' => 'texto', 'padrao' => '08:00 - 17:30'],
                    'contato.horarios.dia3'   => ['rotulo' => 'Quarta-feira', 'tipo' => 'texto', 'padrao' => '08:00 - 17:30'],
                    'contato.horarios.dia4'   => ['rotulo' => 'Quinta-feira', 'tipo' => 'texto', 'padrao' => '08:00 - 17:30'],
                    'contato.horarios.dia5'   => ['rotulo' => 'Sexta-feira', 'tipo' => 'texto', 'padrao' => '08:00 - 17:30'],
                    'contato.horarios.dia6'   => ['rotulo' => 'Sábado', 'tipo' => 'texto', 'padrao' => '09:00 - 16:00'],
                    'contato.horarios.dia0'   => ['rotulo' => 'Domingo', 'tipo' => 'texto', 'padrao' => ''],
                ],
            ],

            'formulario' => [
                'titulo' => 'Formulário',
                'campos' => [
                    'contato.formulario.titulo'            => ['rotulo' => 'Título', 'tipo' => 'texto', 'padrao' => 'Envie sua mensagem'],
                    'contato.formulario.assuntos'          => ['rotulo' => 'Assuntos para escolher (um por linha, até 30 letras cada)', 'tipo' => 'lista', 'padrao' => "Encomenda\nCardápio\nOrçamento\nEntrega\nPagamento\nOutro"],
                    'contato.formulario.botao'             => ['rotulo' => 'Botão de enviar', 'tipo' => 'texto', 'padrao' => 'Enviar mensagem'],
                    'contato.formulario.mensagem_whatsapp' => ['rotulo' => 'Mensagem que já vai escrita no WhatsApp', 'tipo' => 'texto', 'padrao' => 'Olá! Vim pelo site e gostaria de mais informações.'],
                    'contato.formulario.nota'              => ['rotulo' => 'Nota abaixo do formulário', 'tipo' => 'textarea', 'padrao' => 'Campos com * são obrigatórios. Seus dados são usados apenas para responder ao seu contato.'],
                ],
            ],

            'mapa' => [
                'titulo' => 'Mapa',
                'campos' => [
                    'contato.mapa.selo'       => ['rotulo' => 'Selo acima do título', 'tipo' => 'texto', 'padrao' => 'Onde estamos'],
                    'contato.mapa.titulo'     => ['rotulo' => 'Título', 'tipo' => 'texto', 'destaque' => true, 'padrao' => 'Venha nos *visitar*'],
                    'contato.mapa.botao_rota' => ['rotulo' => 'Botão de rota', 'tipo' => 'texto', 'padrao' => 'Traçar rota'],
                    'contato.mapa.dica'       => ['rotulo' => 'Dica abaixo dos botões', 'tipo' => 'texto', 'padrao' => 'Clique no mapa para mover e dar zoom'],
                ],
            ],
        ],
    ],


    'geral' => [
        'titulo'    => 'Todas as páginas',
        'descricao' => 'Partes que aparecem em várias páginas: título da aba, rodapé e depoimentos.',
        'icone'     => 'bi-layout-text-window',
        'rota'      => 'home',
        'secoes'    => [

            'site' => [
                'titulo' => 'Aba do navegador e Google',
                'campos' => [
                    'geral.site.titulo'    => ['rotulo' => 'Título da aba (aparece também no Google)', 'tipo' => 'texto', 'padrao' => 'Cantinho Donuts | a melhor confeitaria da região'],
                    'geral.site.descricao' => ['rotulo' => 'Descrição para o Google (até ~160 letras)', 'tipo' => 'textarea', 'padrao' => 'Bolos, doces finos e encomendas personalizadas feitos à mão, com ingredientes selecionados e muito carinho.'],
                    'geral.site.icone'     => ['rotulo' => 'Ícone da aba (favicon)', 'tipo' => 'imagem', 'padrao' => 'donuts/images/favicon.png'],
                ],
            ],

            'cabecalho' => [
                'titulo' => 'Cabeçalho',
                'ajuda'  => 'Os itens do menu são as páginas do site; as categorias do Cardápio vêm de Categorias. O banner grande da Home fica em Banners.',
                'campos' => [
                    'geral.cabecalho.logo' => ['rotulo' => 'Logo (computador e celular)', 'tipo' => 'imagem', 'padrao' => 'donuts/IMG/logo-donuts.svg'],
                ],
            ],

            'rodape' => [
                'titulo' => 'Rodapé',
                'ajuda'  => 'Nome da loja, endereço, WhatsApp, e-mail, horário e redes sociais vêm das configurações da loja.',
                'campos' => [
                    'geral.rodape.chamada_selo'      => ['rotulo' => 'Faixa de chamada — frase pequena', 'tipo' => 'texto', 'padrao' => 'Vamos adoçar o seu dia?'],
                    'geral.rodape.chamada_titulo'    => ['rotulo' => 'Faixa de chamada — título', 'tipo' => 'texto', 'padrao' => 'Encomende agora o seu doce favorito'],
                    'geral.rodape.chamada_botao'     => ['rotulo' => 'Faixa de chamada — botão', 'tipo' => 'texto', 'padrao' => 'Chamar no WhatsApp'],
                    'geral.rodape.mensagem_whatsapp' => ['rotulo' => 'Mensagem que já vai escrita no WhatsApp', 'tipo' => 'texto', 'padrao' => 'Olá! Vim pelo site e gostaria de fazer uma encomenda.'],
                    'geral.rodape.slogan'            => ['rotulo' => 'Frase abaixo do nome da loja', 'tipo' => 'texto', 'padrao' => 'Confeitaria artesanal'],
                    'geral.rodape.sobre'             => ['rotulo' => 'Texto sobre a loja', 'tipo' => 'textarea', 'destaque' => true, 'padrao' => 'Bolos, doces finos e encomendas personalizadas feitos à mão, com ingredientes selecionados e muito carinho. Cada receita é pensada para tornar o seu momento ainda mais especial.'],
                    'geral.rodape.contatos_titulo'   => ['rotulo' => 'Título dos contatos', 'tipo' => 'texto', 'padrao' => 'Nossos contatos'],
                    'geral.rodape.form_titulo'       => ['rotulo' => 'Formulário — título', 'tipo' => 'texto', 'padrao' => 'Faça sua encomenda'],
                    'geral.rodape.form_pergunta'     => ['rotulo' => 'Formulário — pergunta da mensagem', 'tipo' => 'texto', 'padrao' => 'O que você gostaria de encomendar?'],
                    'geral.rodape.form_botao'        => ['rotulo' => 'Formulário — botão', 'tipo' => 'texto', 'padrao' => 'Enviar encomenda'],
                    'geral.rodape.direitos'          => ['rotulo' => 'Frase final (depois de "© ano nome da loja.")', 'tipo' => 'texto', 'padrao' => 'Feito com ♥ e muito açúcar. Todos os direitos reservados.'],
                ],
            ],

            'depoimentos' => [
                'titulo' => 'Depoimentos (Home e Sobre)',
                'ajuda'  => 'Os depoimentos são os aprovados em Depoimentos.',
                'campos' => [
                    'geral.depoimentos.imagem_fundo' => ['rotulo' => 'Imagem de fundo', 'tipo' => 'imagem', 'padrao' => 'donuts/IMG/banner3.png'],
                    'geral.depoimentos.selo'         => ['rotulo' => 'Selo acima do título', 'tipo' => 'texto', 'padrao' => 'Depoimentos'],
                    'geral.depoimentos.titulo'       => ['rotulo' => 'Título', 'tipo' => 'texto', 'destaque' => true, 'padrao' => 'O que nossos *clientes dizem*'],
                    'geral.depoimentos.texto'        => ['rotulo' => 'Texto', 'tipo' => 'textarea', 'destaque' => true, 'padrao' => 'Avaliações reais enviadas por quem já provou, pelo app The Gusta.'],
                    'geral.depoimentos.verificado'   => ['rotulo' => 'Legenda abaixo do nome do cliente', 'tipo' => 'texto', 'padrao' => 'Cliente verificado · App The Gusta'],
                    'geral.depoimentos.botao'        => ['rotulo' => 'Botão para avaliar', 'tipo' => 'texto', 'padrao' => 'Deixe também a sua avaliação'],
                    'geral.depoimentos.vazio'        => ['rotulo' => 'Mensagem quando ainda não há depoimentos', 'tipo' => 'textarea', 'padrao' => 'Ainda não temos depoimentos publicados. Fez um pedido com a gente? Conte como foi!'],
                    'geral.depoimentos.botao_vazio'  => ['rotulo' => 'Botão quando ainda não há depoimentos', 'tipo' => 'texto', 'padrao' => 'Avaliar pelo app'],
                ],
            ],

        ],
    ],
];
