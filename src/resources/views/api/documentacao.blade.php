@php
    /*
     * Documentação da API v1. Cada grupo tem suas rotas; a página é montada
     * a partir desta lista. Ao criar uma rota nova em routes/api.php,
     * acrescente-a aqui.
     *
     * Campos de cada rota:
     *   metodo, caminho, descricao, login (true = precisa do token),
     *   envio (campos que o app manda), resposta (exemplo em JSON)
     */
    $grupos = [
        [
            'id' => 'publicas',
            'titulo' => 'Rotas públicas (não precisam de login)',
            'rotas' => [
                [
                    'metodo' => 'GET', 'caminho' => '/status', 'login' => false,
                    'descricao' => 'Verifica se a API está funcionando.',
                    'resposta' => <<<'JSON'
{
    "success": true,
    "data": { "aplicacao": "Confeitaria DaVilla", "api": "v1", "status": "online" }
}
JSON,
                ],
                [
                    'metodo' => 'GET', 'caminho' => '/configuracoes', 'login' => false,
                    'descricao' => 'Taxa de entrega (em reais) e previsão de entrega, definidas no painel admin em Sistema → Configurações da loja. A retirada não paga a taxa.',
                    'resposta' => <<<'JSON'
{
    "success": true,
    "data": { "taxa_entrega": 6, "previsao_entrega": "45 - 60 min" }
}
JSON,
                ],
                [
                    'metodo' => 'GET', 'caminho' => '/banners', 'login' => false,
                    'descricao' => 'Banners ativos, na ordem do campo "ordem_banner". A imagem fica em /davilla/images/banner/{foto_banner}.',
                    'resposta' => <<<'JSON'
{
    "success": true,
    "data": [
        { "id_banner": 4, "nome_banner": "Bolos por Encomenda", "ordem_banner": 0,
          "foto_banner": "bolos-por-encomenda.jpg", "status_banner": "ATIVO" }
    ]
}
JSON,
                ],
                [
                    'metodo' => 'GET', 'caminho' => '/categorias', 'login' => false,
                    'descricao' => 'Categorias de produtos.',
                ],
                [
                    'metodo' => 'GET', 'caminho' => '/categorias/{id}/produtos', 'login' => false,
                    'descricao' => 'Produtos ativos de uma categoria.',
                ],
                [
                    'metodo' => 'GET', 'caminho' => '/produtos', 'login' => false,
                    'descricao' => 'Todos os produtos ativos, com a categoria. A foto fica em /davilla/images/{foto_produto}.',
                    'resposta' => <<<'JSON'
{
    "success": true,
    "data": [
        { "id_produto": 4, "nome_produto": "Bolo de Cenoura (Fatia)",
          "slug_produto": "bolo-de-cenoura-fatia", "valor_produto": 23,
          "foto_produto": "produto/bolo-de-cenoura-(fatia).png", "destaque_produto": "SIM",
          "categoria_produto": { "id_categoria": 1, "nome_categoria": "Bolos" } }
    ]
}
JSON,
                ],
                [
                    'metodo' => 'GET', 'caminho' => '/produtos/{slug}', 'login' => false,
                    'descricao' => 'Detalhes de um produto pelo slug (ex.: bolo-de-cenoura-fatia). Retorna 404 se não existir ou estiver inativo.',
                ],
            ],
        ],
        [
            'id' => 'login',
            'titulo' => 'Login',
            'rotas' => [
                [
                    'metodo' => 'POST', 'caminho' => '/auth/login', 'login' => false,
                    'descricao' => 'Faz o login do cliente e devolve o token usado nas rotas com 🔒. Retorna 401 se o e-mail ou a senha estiverem errados e 403 se o cliente estiver inativo.',
                    'envio' => [
                        'email' => 'e-mail do cliente (obrigatório)',
                        'senha' => 'senha (obrigatório)',
                        'device_name' => 'nome do aparelho, ex.: app-android (opcional)',
                    ],
                    'resposta' => <<<'JSON'
{
    "success": true,
    "message": "Login realizado com sucesso.",
    "data": {
        "token": "12|AbCdEf...",
        "cliente": { "id_cliente": 1, "nome_cliente": "Fernanda Oliveira",
                     "email_cliente": "fernanda@exemplo.com", "telefone_cliente": "11999999999" }
    }
}
JSON,
                ],
                [
                    'metodo' => 'POST', 'caminho' => '/auth/logout', 'login' => true,
                    'descricao' => 'Encerra o login: apaga o token usado na requisição.',
                ],
            ],
        ],
        [
            'id' => 'cliente',
            'titulo' => 'Cliente (perfil)',
            'rotas' => [
                [
                    'metodo' => 'GET', 'caminho' => '/cliente', 'login' => true,
                    'descricao' => 'Dados do cliente logado (sem a senha). A foto fica em /davilla/images/cliente/{foto_cliente}.',
                ],
                [
                    'metodo' => 'PUT', 'caminho' => '/cliente', 'login' => true,
                    'descricao' => 'Atualiza os dados do cliente logado. Também aceita PATCH. Todos os campos são opcionais: só muda o que for enviado.',
                    'envio' => [
                        'nome_cliente' => 'até 50 caracteres',
                        'telefone_cliente' => 'até 14 caracteres, ex.: (11)98888-7777',
                        'novidades_cliente' => 'SIM ou NAO: se aceita receber novidades e promoções',
                        'data_nasc_cliente' => 'data no formato aaaa-mm-dd',
                        'endereco_cliente, numero_cliente, complemento_cliente, bairro_cliente, cidade_cliente, uf_cliente, cep_cliente' => 'endereço do cadastro',
                    ],
                ],
                [
                    'metodo' => 'PUT', 'caminho' => '/cliente/senha', 'login' => true,
                    'descricao' => 'Troca a senha. Retorna 422 se a senha atual estiver errada.',
                    'envio' => [
                        'senha_atual' => 'senha atual (obrigatório)',
                        'nova_senha' => 'nova senha, mínimo de 8 caracteres e diferente da atual',
                        'nova_senha_confirmation' => 'repetir a nova senha',
                    ],
                ],
                [
                    'metodo' => 'POST', 'caminho' => '/cliente/foto', 'login' => true,
                    'descricao' => 'Envia a foto de perfil. A requisição deve ser multipart/form-data.',
                    'envio' => [
                        'foto' => 'imagem JPG, PNG ou WEBP de até 2 MB (obrigatório)',
                    ],
                ],
            ],
        ],
        [
            'id' => 'sacola',
            'titulo' => 'Sacola',
            'rotas' => [
                [
                    'metodo' => 'GET', 'caminho' => '/sacola', 'login' => true,
                    'descricao' => 'Itens da sacola do cliente logado, com os dados de cada produto.',
                    'resposta' => <<<'JSON'
{
    "success": true,
    "data": [
        { "id_sacola": 1, "id_produto": 4, "qtde_sacola": 2,
          "produto": { "nome_produto": "Bolo de Cenoura (Fatia)", "valor_produto": 23 } }
    ]
}
JSON,
                ],
                [
                    'metodo' => 'POST', 'caminho' => '/sacola', 'login' => true,
                    'descricao' => 'Adiciona um produto à sacola. Se ele já estiver lá, soma a quantidade.',
                    'envio' => [
                        'id_produto' => 'id do produto (obrigatório)',
                        'quantidade' => 'quantidade, mínimo 1 (opcional, padrão 1)',
                    ],
                ],
                [
                    'metodo' => 'PUT', 'caminho' => '/sacola/{id}', 'login' => true,
                    'descricao' => 'Troca a quantidade de um item ({id} = id_sacola). Também aceita PATCH.',
                    'envio' => [
                        'quantidade' => 'nova quantidade, mínimo 1 (obrigatório)',
                    ],
                ],
                [
                    'metodo' => 'DELETE', 'caminho' => '/sacola/{id}', 'login' => true,
                    'descricao' => 'Remove um item da sacola ({id} = id_sacola).',
                ],
            ],
        ],
        [
            'id' => 'pedidos',
            'titulo' => 'Pedidos',
            'rotas' => [
                [
                    'metodo' => 'GET', 'caminho' => '/pedidos', 'login' => true,
                    'descricao' => 'Pedidos do cliente logado, do mais novo para o mais antigo, com itens e cupom. Status possíveis: EM ANDAMENTO, SAIU ENTREGA, FINALIZADA e CANCELADA.',
                ],
                [
                    'metodo' => 'GET', 'caminho' => '/pedidos/{id}', 'login' => true,
                    'descricao' => 'Um pedido do cliente logado. Retorna 404 se o pedido for de outro cliente.',
                ],
                [
                    'metodo' => 'POST', 'caminho' => '/pedidos', 'login' => true,
                    'descricao' => 'Transforma a sacola em um pedido e esvazia a sacola. Os preços e o desconto são calculados no servidor. Na entrega, usa o endereço principal do cliente e cobra a taxa de entrega configurada (GET /configuracoes). Retorna 422 se a sacola estiver vazia ou o cupom for inválido.',
                    'envio' => [
                        'entrega' => 'true para entrega, false para retirada (obrigatório)',
                        'forma_pagamento' => 'pix, cartao ou dinheiro (obrigatório)',
                        'observacao' => 'observação do pedido, até 500 caracteres (opcional)',
                        'cupom' => 'código do cupom de desconto (opcional)',
                    ],
                    'resposta' => <<<'JSON'
{
    "success": true,
    "message": "Pedido realizado com sucesso.",
    "data": {
        "id_venda": 12, "data_venda": "2026-10-14 08:34:00", "status_venda": "EM ANDAMENTO",
        "valor_venda": 63.6, "valor_desconto_venda": 6.4, "entrega_venda": "SIM",
        "forma_pagamento_venda": "Pix", "id_endereco": 1,
        "cupom": { "codigo_cupom": "THEGUSTA10" },
        "itens": [
            { "id_produto": 4, "qtde_item": 2, "valor_unit_item": 23,
              "produto": { "nome_produto": "Bolo de Cenoura (Fatia)" } }
        ]
    }
}
JSON,
                ],
            ],
        ],
        [
            'id' => 'enderecos',
            'titulo' => 'Endereços de entrega',
            'rotas' => [
                [
                    'metodo' => 'GET', 'caminho' => '/enderecos', 'login' => true,
                    'descricao' => 'Endereços ativos do cliente logado. O principal (usado na entrega) vem primeiro.',
                    'resposta' => <<<'JSON'
{
    "success": true,
    "data": [
        { "id_endereco": 1, "nome_endereco": "Casa", "endereco": "Rua Exemplo", "numero": "310",
          "complemento": null, "bairro": "Centro", "cidade": "São Paulo", "uf": "SP",
          "cep": "01000-000", "principal_endereco": "SIM" }
    ]
}
JSON,
                ],
                [
                    'metodo' => 'GET', 'caminho' => '/enderecos/{id}', 'login' => true,
                    'descricao' => 'Um endereço do cliente logado.',
                ],
                [
                    'metodo' => 'POST', 'caminho' => '/enderecos', 'login' => true,
                    'descricao' => 'Cadastra um endereço. O primeiro endereço do cliente já vira o principal.',
                    'envio' => [
                        'nome_endereco' => 'ex.: Casa, Trabalho — até 30 caracteres (obrigatório)',
                        'endereco' => 'rua/avenida, até 40 caracteres (obrigatório)',
                        'numero' => 'até 6 caracteres (obrigatório)',
                        'complemento' => 'até 50 caracteres (opcional)',
                        'bairro, cidade' => 'até 40 caracteres cada (obrigatório)',
                        'uf' => '2 letras (obrigatório)',
                        'cep' => 'até 9 caracteres (obrigatório)',
                    ],
                ],
                [
                    'metodo' => 'PUT', 'caminho' => '/enderecos/{id}', 'login' => true,
                    'descricao' => 'Atualiza um endereço (mesmos campos do cadastro). Também aceita PATCH.',
                ],
                [
                    'metodo' => 'PATCH', 'caminho' => '/enderecos/{id}/principal', 'login' => true,
                    'descricao' => 'Marca o endereço como principal (o usado nas entregas).',
                ],
                [
                    'metodo' => 'DELETE', 'caminho' => '/enderecos/{id}', 'login' => true,
                    'descricao' => 'Exclui (desativa) o endereço. Se ele era o principal, o próximo endereço passa a ser o principal.',
                ],
            ],
        ],
        [
            'id' => 'cupons',
            'titulo' => 'Cupons de desconto',
            'rotas' => [
                [
                    'metodo' => 'GET', 'caminho' => '/cupons/{codigo}', 'login' => true,
                    'descricao' => 'Confere se o cupom pode ser usado hoje (ativo e dentro da validade). O desconto é uma porcentagem sobre os produtos, sem a entrega. Retorna 404 se o cupom for inválido ou expirado. O desconto é aplicado de fato no POST /pedidos.',
                    'resposta' => <<<'JSON'
{
    "success": true,
    "data": { "codigo": "THEGUSTA10", "percentual": 10, "valido_ate": "2026-11-30" }
}
JSON,
                ],
            ],
        ],
    ];

    $totalRotas = collect($grupos)->sum(fn ($g) => count($g['rotas']));
@endphp
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>API — Confeitaria DaVilla</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            color: #333;
            margin: 0;
            line-height: 1.5;
        }

        header {
            background: #691650;
            color: white;
            padding: 30px;
        }

        header p {
            margin-bottom: 0;
        }

        main {
            max-width: 1100px;
            margin: 30px auto;
            padding: 0 20px;
        }

        h2 {
            color: #691650;
            margin-top: 40px;
            scroll-margin-top: 20px;
        }

        nav.indice {
            background: white;
            border-radius: 8px;
            padding: 16px 20px;
        }

        nav.indice a {
            color: #691650;
            margin-right: 18px;
            line-height: 2;
        }

        .endpoint {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 16px;
        }

        .endpoint p {
            margin: 10px 0 0;
        }

        .method {
            display: inline-block;
            min-width: 56px;
            text-align: center;
            padding: 5px 10px;
            border-radius: 4px;
            color: white;
            font-weight: bold;
            font-size: 14px;
        }

        .GET    { background: #198754; }
        .POST   { background: #0d6efd; }
        .PUT    { background: #b8860b; }
        .PATCH  { background: #6f42c1; }
        .DELETE { background: #dc3545; }

        .cadeado {
            display: inline-block;
            margin-left: 8px;
            padding: 3px 8px;
            border-radius: 4px;
            background: #fce8f4;
            color: #691650;
            font-size: 13px;
            font-weight: bold;
        }

        code {
            background: #eee;
            padding: 4px 8px;
            border-radius: 4px;
        }

        table {
            border-collapse: collapse;
            margin-top: 12px;
            width: 100%;
            font-size: 14px;
        }

        th, td {
            text-align: left;
            border-bottom: 1px solid #eee;
            padding: 6px 8px;
            vertical-align: top;
        }

        th {
            background: #fafafa;
        }

        td:first-child code {
            white-space: nowrap;
        }

        pre {
            background: #1e1e1e;
            color: #eee;
            padding: 16px;
            overflow-x: auto;
            border-radius: 6px;
            font-size: 13px;
        }

        .rotulo {
            font-weight: bold;
            margin-top: 14px;
            font-size: 14px;
        }
    </style>
</head>

<body>

<header>
    <h1>API — Confeitaria DaVilla</h1>

    <p>
        Documentação da API utilizada pelo aplicativo TheGusta.
    </p>
</header>

<main>

    <h2>Informações</h2>

    <p>
        Versão:
        <strong>v1</strong>
        &nbsp;·&nbsp;
        {{ $totalRotas }} rotas
    </p>

    <p>
        Base da API:
        <code>{{ url('/api/v1') }}</code>
    </p>

    <p>
        Todas as respostas são em JSON e têm o campo <code>success</code> (true ou false).
        Envie o cabeçalho <code>Accept: application/json</code> em todas as requisições.
    </p>

    <nav class="indice">
        <strong>Índice:</strong>
        <a href="#autenticacao">Como usar o login</a>
        @foreach ($grupos as $grupo)
            <a href="#{{ $grupo['id'] }}">{{ $grupo['titulo'] }}</a>
        @endforeach
        <a href="#erros">Erros</a>
    </nav>


    <h2 id="autenticacao">Como usar o login (token)</h2>

    <div class="endpoint">
        <p style="margin-top: 0">
            As rotas marcadas com <span class="cadeado">🔒 login</span> só funcionam com o cliente logado.
        </p>
        <p>
            1. Faça o login em <code>POST /api/v1/auth/login</code> e guarde o <code>token</code> da resposta.<br>
            2. Envie o token no cabeçalho <code>Authorization</code> de cada requisição:
        </p>
        <pre>Authorization: Bearer 12|AbCdEf...
Accept: application/json</pre>
        <p>
            Sem o token, ou com um token inválido, a API responde <strong>401</strong>
            com <code>{"message": "Unauthenticated."}</code>.
        </p>
    </div>


    @foreach ($grupos as $grupo)
        <h2 id="{{ $grupo['id'] }}">{{ $grupo['titulo'] }}</h2>

        @foreach ($grupo['rotas'] as $rota)
            <div class="endpoint">

                <span class="method {{ $rota['metodo'] }}">{{ $rota['metodo'] }}</span>

                <code>/api/v1{{ $rota['caminho'] }}</code>

                @if ($rota['login'])
                    <span class="cadeado">🔒 login</span>
                @endif

                <p>
                    {{ $rota['descricao'] }}
                </p>

                @if (!empty($rota['envio']))
                    <div class="rotulo">O que enviar (JSON)</div>
                    <table>
                        <tr><th style="width: 40%">Campo</th><th>Descrição</th></tr>
                        @foreach ($rota['envio'] as $campo => $explicacao)
                            <tr><td><code>{{ $campo }}</code></td><td>{{ $explicacao }}</td></tr>
                        @endforeach
                    </table>
                @endif

                @if (!empty($rota['resposta']))
                    <div class="rotulo">Exemplo de resposta</div>
                    <pre>{{ $rota['resposta'] }}</pre>
                @endif

            </div>
        @endforeach
    @endforeach


    <h2 id="erros">Erros</h2>

    <div class="endpoint">
        <table>
            <tr><th style="width: 15%">Código</th><th>Quando acontece</th></tr>
            <tr><td><code>401</code></td><td>Rota com 🔒 chamada sem token ou com token inválido.</td></tr>
            <tr><td><code>403</code></td><td>Login de cliente inativo.</td></tr>
            <tr><td><code>404</code></td><td>Registro não encontrado (ou de outro cliente) e cupom inválido.</td></tr>
            <tr><td><code>422</code></td><td>Dados inválidos. A resposta traz <code>message</code> e, quando for validação de campos, <code>errors</code> com o erro de cada campo.</td></tr>
        </table>

        <div class="rotulo">Exemplo de erro de validação</div>
        <pre>{
    "message": "The forma pagamento field is required.",
    "errors": {
        "forma_pagamento": ["The forma pagamento field is required."]
    }
}</pre>
    </div>

</main>

</body>
</html>
