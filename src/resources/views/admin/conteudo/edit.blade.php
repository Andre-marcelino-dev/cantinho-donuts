@extends('layout.admin')

@section('title', $config['titulo'] . ' | Conteúdo do site')
@section('pg-titulo', 'Página: ' . $config['titulo'])
@section('link-topo', 'Conteúdo do site')

@section('content')

    @php
        $antigos = old('campos', []);
        $linkPagina = \Illuminate\Support\Facades\Route::has($config['rota'] ?? '') ? route($config['rota']) : url('/');
    @endphp

    <style>
        .cnt-nav{position:sticky;top:80px}
        .cnt-nav .list-group-item{display:flex;justify-content:space-between;align-items:center;gap:8px;font-size:14px}
        .cnt-nav .list-group-item.active .badge{background:#fff!important;color:var(--bs-primary)!important}
        .cnt-sec{scroll-margin-top:80px}
        .cnt-sec .card-header{display:flex;flex-wrap:wrap;align-items:center;gap:8px}
        .cnt-sec .card-title{font-weight:600}
        .cnt-ajuda{font-size:13px;color:var(--bs-secondary-color);margin:0;width:100%}
        .cnt-grupo{font-size:12px;font-weight:600;letter-spacing:.08em;text-transform:uppercase;color:var(--bs-secondary-color);
            border-bottom:1px solid var(--bs-border-color);padding-bottom:6px;margin:26px 0 14px}
        .cnt-campo{margin-bottom:18px}
        .cnt-campo label.form-label{font-weight:500;display:flex;align-items:center;gap:8px;margin-bottom:6px}
        .cnt-campo.is-dirty .form-control{border-color:var(--bs-warning);box-shadow:0 0 0 .15rem rgba(var(--bs-warning-rgb),.2)}
        .cnt-orig{font-size:12.5px;color:var(--bs-secondary-color);margin-top:6px;display:flex;flex-wrap:wrap;gap:4px 14px;align-items:center}
        .cnt-orig q{font-style:italic}
        .cnt-img{display:flex;gap:16px;align-items:flex-start;flex-wrap:wrap}
        .cnt-img figure{margin:0;width:180px;flex:0 0 auto}
        .cnt-img figure img{width:180px;height:120px;object-fit:contain;border-radius:10px;border:1px solid var(--bs-border-color);
            background:repeating-conic-gradient(#f1f1f1 0 25%,#fff 0 50%) 0 0/16px 16px}
        .cnt-img figure figcaption{font-size:12px;color:var(--bs-secondary-color);margin-top:4px;text-align:center}
        .cnt-img .cnt-img-up{flex:1;min-width:220px}
        .cnt-barra{position:sticky;bottom:0;z-index:5;background:var(--bs-body-bg);border-top:1px solid var(--bs-border-color);
            padding:12px 16px;display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;
            box-shadow:0 -8px 20px -12px rgba(0,0,0,.25);border-radius:12px 12px 0 0}
        .cnt-barra .pend{font-size:13.5px;color:var(--bs-secondary-color)}
        .cnt-barra .pend b{color:var(--bs-warning-text-emphasis)}
    </style>

    <div class="app-content">
        <div class="container-fluid">

            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
                <a href="{{ route('admin.conteudo') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left"></i> Todas as páginas</a>
                <a href="{{ $linkPagina }}" target="_blank" rel="noopener" class="btn btn-outline-primary btn-sm"><i class="bi bi-box-arrow-up-right"></i> Ver página no site</a>
            </div>

            @if (session('sucesso'))
                <div id="alerta-sucesso" class="alert alert-success" role="alert">✅ {{ session('sucesso') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">❌ {{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('admin.conteudo.update', $pagina) }}" enctype="multipart/form-data" id="form-conteudo">
                @csrf
                @method('PUT')
                <input type="hidden" name="secao_atual" id="secao-atual">

                <div class="row g-4">
                    <div class="col-lg-3 d-none d-lg-block">
                        <div class="cnt-nav">
                            <div class="list-group" id="cnt-indice">
                                @foreach ($config['secoes'] as $idSecao => $secao)
                                    @php $alteradosSecao = count(array_intersect(array_keys($secao['campos']), array_keys($alterados))); @endphp
                                    <a href="#sec-{{ $idSecao }}" class="list-group-item list-group-item-action" data-sec="{{ $idSecao }}">
                                        <span>{{ $secao['titulo'] }}</span>
                                        @if ($alteradosSecao)
                                            <span class="badge text-bg-success rounded-pill" title="Campos alterados">{{ $alteradosSecao }}</span>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                            <p class="small text-secondary mt-3">
                                <i class="bi bi-info-circle"></i>
                                Em títulos e textos com <b>✦</b>, use <code>*palavra*</code> para o destaque colorido
                                e <code>**palavra**</code> para negrito.
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-9">
                        @foreach ($config['secoes'] as $idSecao => $secao)
                            <div class="card mb-4 cnt-sec" id="sec-{{ $idSecao }}" data-sec="{{ $idSecao }}">
                                <div class="card-header">
                                    <h3 class="card-title me-auto">{{ $secao['titulo'] }}</h3>
                                    @if (!empty($secao['atalho']))
                                        <a href="{{ route($secao['atalho']['rota']) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-box-arrow-up-right"></i> {{ $secao['atalho']['texto'] }}
                                        </a>
                                    @endif
                                    @if (!empty($secao['ajuda']))
                                        <p class="cnt-ajuda"><i class="bi bi-lightbulb"></i> {{ $secao['ajuda'] }}</p>
                                    @endif
                                </div>

                                @if (count($secao['campos']))
                                    <div class="card-body">
                                        @php $grupoAtual = null; @endphp
                                        @foreach ($secao['campos'] as $chave => $campo)
                                            @php
                                                $grupo = $campo['grupo'] ?? null;
                                                $alterado = array_key_exists($chave, $alterados);
                                                $valor = $antigos[$chave] ?? \App\Models\Conteudo::valor($chave);
                                                $idCampo = 'c-' . md5($chave);
                                            @endphp

                                            @if ($grupo && $grupo !== $grupoAtual)
                                                <div class="cnt-grupo">{{ $grupo }}</div>
                                            @endif
                                            @php $grupoAtual = $grupo; @endphp

                                            <div class="cnt-campo" data-original="{{ $valor }}">
                                                <label class="form-label" for="{{ $idCampo }}">
                                                    {{ $campo['rotulo'] }}
                                                    @if (!empty($campo['destaque']))<span class="text-warning" title="Aceita *destaque* e **negrito**">✦</span>@endif
                                                    @if ($alterado)<span class="badge text-bg-success">Alterado</span>@endif
                                                </label>

                                                @if ($campo['tipo'] === 'imagem')
                                                    <div class="cnt-img">
                                                        <figure>
                                                            <img src="{{ conteudo_img($chave) }}" alt="" data-preview="{{ $idCampo }}">
                                                            <figcaption>{{ $alterado ? 'Imagem atual' : 'Imagem original' }}</figcaption>
                                                        </figure>
                                                        @if ($alterado)
                                                            <figure>
                                                                <img src="{{ asset($campo['padrao']) }}" alt="">
                                                                <figcaption>Original</figcaption>
                                                            </figure>
                                                        @endif
                                                        <div class="cnt-img-up">
                                                            <input type="file" class="form-control" id="{{ $idCampo }}" name="arquivos[{{ $chave }}]"
                                                                accept=".jpg,.jpeg,.png,.webp,.gif,.svg,.ico">
                                                            <div class="form-text">JPG, PNG, WEBP, GIF, SVG ou ICO, até 4 MB. A nova imagem aparece ao lado antes de salvar.</div>
                                                            @if ($alterado)
                                                                <div class="form-check mt-2">
                                                                    <input class="form-check-input" type="checkbox" name="restaurar[{{ $chave }}]" value="1" id="r-{{ $idCampo }}">
                                                                    <label class="form-check-label small" for="r-{{ $idCampo }}">Voltar para a imagem original</label>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @elseif (in_array($campo['tipo'], ['textarea', 'lista']))
                                                    <textarea class="form-control" id="{{ $idCampo }}" name="campos[{{ $chave }}]"
                                                        rows="{{ $campo['tipo'] === 'lista' ? max(3, substr_count($valor, "\n") + 1) : max(2, min(6, (int) ceil(mb_strlen($valor) / 90))) }}">{{ $valor }}</textarea>
                                                    @if ($campo['tipo'] === 'lista')
                                                        <div class="form-text">Um item por linha.</div>
                                                    @endif
                                                @else
                                                    <input type="text" class="form-control" id="{{ $idCampo }}" name="campos[{{ $chave }}]" value="{{ $valor }}"
                                                        @if ($campo['tipo'] === 'link') placeholder="Ex.: cardapio, pedidos, contato ou https://..." @endif>
                                                    @if ($campo['tipo'] === 'link')
                                                        <div class="form-text">Página do site (cardapio, pedidos, sobre, contato, regiao) ou um endereço completo.</div>
                                                    @endif
                                                @endif

                                                @if ($alterado && $campo['tipo'] !== 'imagem')
                                                    <div class="cnt-orig">
                                                        <span>Original: <q>{{ \Illuminate\Support\Str::limit($campo['padrao'] !== '' ? $campo['padrao'] : '(vazio)', 140) }}</q></span>
                                                        <span class="form-check m-0">
                                                            <input class="form-check-input" type="checkbox" name="restaurar[{{ $chave }}]" value="1" id="r-{{ $idCampo }}">
                                                            <label class="form-check-label" for="r-{{ $idCampo }}">Voltar ao original</label>
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach

                        <div class="cnt-barra">
                            <span class="pend" id="cnt-pendente">
                                @if (session('sucesso'))
                                    <span class="text-success">✅ {{ session('sucesso') }}</span>
                                @else
                                    Nenhuma alteração ainda.
                                @endif
                            </span>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-lg"></i> Salvar alterações
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
    (function () {
        var form = document.getElementById('form-conteudo');
        var aviso = document.getElementById('cnt-pendente');
        var enviando = false;

        // Conta os campos mexidos e destaca cada um
        function atualizar() {
            var total = 0;
            form.querySelectorAll('.cnt-campo').forEach(function (bloco) {
                var campo = bloco.querySelector('input[type=text], textarea');
                var arquivo = bloco.querySelector('input[type=file]');
                var restaurar = bloco.querySelector('input[name^="restaurar"]');
                var sujo = (campo && campo.value !== bloco.dataset.original) || (arquivo && arquivo.files.length) || (restaurar && restaurar.checked);
                bloco.classList.toggle('is-dirty', !!sujo);
                if (sujo) total++;
            });
            aviso.innerHTML = total ? '<b>' + total + '</b> ' + (total === 1 ? 'campo alterado' : 'campos alterados') + ' — lembre de salvar.' : 'Nenhuma alteração ainda.';
            return total;
        }
        form.addEventListener('input', atualizar);
        form.addEventListener('change', atualizar);

        // Mostra a imagem escolhida antes de salvar
        form.querySelectorAll('input[type=file]').forEach(function (input) {
            input.addEventListener('change', function () {
                var img = form.querySelector('img[data-preview="' + input.id + '"]');
                if (img && input.files[0]) {
                    img.src = URL.createObjectURL(input.files[0]);
                    img.nextElementSibling && (img.nextElementSibling.textContent = 'Nova imagem (salve para publicar)');
                }
            });
        });

        // Avisa antes de sair com alterações sem salvar
        form.addEventListener('submit', function () { enviando = true; });
        window.addEventListener('beforeunload', function (e) {
            if (!enviando && atualizar()) { e.preventDefault(); e.returnValue = ''; }
        });

        // Índice lateral acompanha a seção visível
        var links = document.querySelectorAll('#cnt-indice [data-sec]');
        var campoSecao = document.getElementById('secao-atual');
        var io = new IntersectionObserver(function (entradas) {
            entradas.forEach(function (en) {
                if (!en.isIntersecting) return;
                links.forEach(function (l) { l.classList.toggle('active', l.dataset.sec === en.target.dataset.sec); });
                campoSecao.value = en.target.dataset.sec;
            });
        }, { rootMargin: '-30% 0px -60% 0px' });
        document.querySelectorAll('.cnt-sec').forEach(function (s) { io.observe(s); });

        // Volta para a seção que estava sendo editada
        var voltar = @json(session('secao'));
        if (voltar && document.getElementById('sec-' + voltar)) {
            document.getElementById('sec-' + voltar).scrollIntoView();
        }

        setTimeout(function () {
            var alerta = document.getElementById('alerta-sucesso');
            if (alerta) alerta.style.display = 'none';
        }, 5000);
    })();
    </script>

@endsection
