@extends('layout.admin')

@section('title', 'Páginas do site | Confeitaria Dashboard')
@section('pg-titulo', 'Páginas, textos e imagens')
@section('link-topo', 'Conteúdo do site')

@section('content')

    <style>
        .cnt-card{display:flex;flex-direction:column;height:100%;padding:22px;border:1px solid var(--bs-border-color);border-radius:14px;background:var(--bs-body-bg);
            color:inherit;text-decoration:none;transition:transform .2s ease,box-shadow .2s ease,border-color .2s ease}
        .cnt-card:hover{transform:translateY(-3px);box-shadow:0 12px 28px -14px rgba(0,0,0,.35);border-color:var(--bs-primary);color:inherit}
        .cnt-card .ico{width:46px;height:46px;border-radius:12px;display:grid;place-items:center;font-size:22px;margin-bottom:14px;
            background:rgba(var(--bs-primary-rgb),.1);color:var(--bs-primary)}
        .cnt-card h4{font-size:18px;margin:0 0 4px;font-weight:600}
        .cnt-card p{font-size:13.5px;color:var(--bs-secondary-color);margin:0 0 16px;flex:1}
        .cnt-card .meta{display:flex;flex-wrap:wrap;gap:6px;font-size:12px}
        .cnt-card .go{margin-top:14px;font-size:13.5px;font-weight:500;color:var(--bs-primary)}
    </style>

    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Escolha a página que você quer editar</h3>
                </div>
                <div class="card-body">
                    <p class="text-secondary mb-4">
                        Aqui você troca os textos, as fotos e os botões de cada parte do site, sem mexer em código.
                        Os produtos, kits, categorias, eventos, banners e depoimentos continuam nas telas próprias do menu.
                    </p>

                    <div class="row g-3">
                        @foreach ($paginas as $slug => $pagina)
                            <div class="col-sm-6 col-xl-3">
                                <a href="{{ route('admin.conteudo.edit', $slug) }}" class="cnt-card">
                                    <span class="ico"><i class="bi {{ $pagina['icone'] ?? 'bi-file-earmark-text' }}"></i></span>
                                    <h4>{{ $pagina['titulo'] }}</h4>
                                    <p>{{ $pagina['descricao'] ?? '' }}</p>
                                    <div class="meta">
                                        <span class="badge text-bg-light border">{{ count($pagina['secoes']) }} seções</span>
                                        <span class="badge text-bg-light border">{{ $resumo[$slug]['campos'] }} campos</span>
                                        @if ($resumo[$slug]['imagens'])
                                            <span class="badge text-bg-light border"><i class="bi bi-image"></i> {{ $resumo[$slug]['imagens'] }}</span>
                                        @endif
                                        @if ($resumo[$slug]['alterados'])
                                            <span class="badge text-bg-success">{{ $resumo[$slug]['alterados'] }} alterado(s)</span>
                                        @endif
                                    </div>
                                    <span class="go">Editar <i class="bi bi-arrow-right"></i></span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
