@extends('layout.admin')

@section('title', 'Zonas de entrega | Confeitaria Dashboard')
@section('pg-titulo', 'Zonas de entrega')
@section('link-topo', 'Zonas de entrega')

@section('content')

    @php
        $km = fn ($v) => rtrim(rtrim(number_format((float) $v, 1, ',', ''), '0'), ',');
        $metodos = [
            'cep'       => 'pela faixa de CEP cadastrada',
            'bairro'    => 'pelo nome do bairro',
            'distancia' => 'pela distância até a loja',
        ];
    @endphp

    <div class="app-content">
        <div class="container-fluid">

            {{-- MENSAGENS DE FEEDBACK --}}
            @if (session('sucesso'))
                <div id="alerta-sucesso" class="alert alert-success alert-dismissible fade show" role="alert">
                    ✅ {{ session('sucesso') }}
                </div>
            @endif

            @if ($errors->any())
                <div id="alerta-erro" class="alert alert-danger alert-dismissible fade show" role="alert">
                    ❌ {{ $errors->first() }}
                </div>
            @endif

            <div class="row">
                {{-- Zonas --}}
                <div class="col-xl-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Zonas de entrega</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal"
                                    data-bs-target="#modalNovaZona">
                                    <i class="bi bi-plus-circle"></i>
                                    Nova Zona
                                </button>
                            </div>
                        </div>

                        <p class="text-secondary mx-3 mt-3 mb-2">
                            Cada zona cobre uma faixa de distância a partir da loja. A taxa da zona é a cobrada nos pedidos
                            com entrega do app e é a que aparece na página <a href="{{ route('regiao.index') }}" target="_blank">Região</a> do site.
                        </p>

                        <div class="card-body p-0">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>Zona</th>
                                        <th>Distância</th>
                                        <th>Taxa</th>
                                        <th>Prazo</th>
                                        <th>Bairros</th>
                                        <th style="width: 170px">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($zonas as $linha)
                                        <tr class="align-middle {{ $linha->status_zona_entrega === 'ATIVO' ? '' : 'opacity-50' }}">
                                            <td>
                                                <span class="d-inline-block rounded-circle me-1"
                                                    style="width:10px;height:10px;background:{{ $linha->corHex() }}"></span>
                                                <strong>{{ $linha->nome_zona_entrega }}</strong>
                                                @if ($linha->status_zona_entrega !== 'ATIVO')
                                                    <span class="badge text-bg-danger">Inativa</span>
                                                @endif
                                                @if ($linha->apelido_zona_entrega)
                                                    <div class="small text-secondary">{{ $linha->apelido_zona_entrega }}</div>
                                                @endif
                                            </td>
                                            <td>{{ $linha->faixaKm() }}</td>
                                            <td>{{ $linha->taxaFormatada() }}</td>
                                            <td>{{ $linha->prazo_zona_entrega }}</td>
                                            <td class="small">
                                                {{ $linha->bairros->pluck('nome_bairro_entrega')->implode(', ') ?: '—' }}
                                            </td>
                                            <td>
                                                {{-- Ativar/Desativar --}}
                                                <form action="{{ route('admin.zona-entrega.status', $linha->id_zona_entrega) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    @if ($linha->status_zona_entrega === 'ATIVO')
                                                        <button type="submit" class="btn btn-secondary" title="Desativar">
                                                            <i class="bi bi-toggle-on"></i>
                                                        </button>
                                                    @else
                                                        <button type="submit" class="btn btn-success" title="Ativar">
                                                            <i class="bi bi-toggle-off"></i>
                                                        </button>
                                                    @endif
                                                </form>

                                                {{-- Editar --}}
                                                <button type="button" class="btn btn-warning" title="Editar"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalEditarZona{{ $linha->id_zona_entrega }}">
                                                    <i class="bi bi-pencil"></i>
                                                </button>

                                                {{-- Excluir --}}
                                                <form action="{{ route('admin.zona-entrega.destroy', $linha->id_zona_entrega) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Excluir a {{ $linha->nome_zona_entrega }} e os bairros dela?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" title="Excluir">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">
                                                Nenhuma zona cadastrada. Sem zonas, o app usa a taxa padrão das Configurações da loja.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Testar CEP --}}
                <div class="col-xl-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Testar um CEP</h3>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('admin.zona-entrega') }}" class="d-flex gap-2 mb-3">
                                <input type="text" class="form-control" name="cep" inputmode="numeric" maxlength="9"
                                    placeholder="00000-000" value="{{ $cepTeste ? \App\Services\AreaEntrega::formatarCep($cepTeste) : '' }}" required>
                                <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                            </form>

                            @if ($teste)
                                @php
                                    $onde = trim(($teste['bairro'] ?? '') . ($teste['cidade'] ? ' · ' . $teste['cidade'] . '/' . $teste['uf'] : ''), ' ·');
                                @endphp
                                @if ($teste['status'] === 'ok')
                                    <div class="alert alert-success mb-0">
                                        <strong>{{ $teste['zona']->nome_zona_entrega }}</strong> · {{ $teste['zona']->taxaFormatada() }} · {{ $teste['zona']->prazo_zona_entrega }}
                                        <div class="small mt-1">
                                            {{ $onde ?: $teste['cep'] }}<br>
                                            Encontrado {{ $metodos[$teste['metodo']] }}@if ($teste['distancia_km'] !== null) ({{ $km($teste['distancia_km']) }} km)@endif.
                                        </div>
                                    </div>
                                @elseif ($teste['status'] === 'fora')
                                    <div class="alert alert-warning mb-0">
                                        <strong>Fora da área de entrega</strong>
                                        <div class="small mt-1">{{ $onde }}<br>Fica a {{ $km($teste['distancia_km']) }} km da loja.</div>
                                    </div>
                                @elseif ($teste['status'] === 'cep_invalido')
                                    <div class="alert alert-danger mb-0">CEP não encontrado nos Correios.</div>
                                @else
                                    <div class="alert alert-secondary mb-0">
                                        <strong>Não deu para calcular</strong>
                                        <div class="small mt-1">
                                            {{ $onde ?: $teste['cep'] }}<br>
                                            Não achamos a localização desse CEP. Cadastre o bairro ou a faixa de CEP em uma zona.
                                            No app, o pedido usa a taxa padrão das Configurações da loja.
                                        </div>
                                    </div>
                                @endif
                            @endif

                            <hr>
                            <div class="small text-secondary">
                                <i class="bi bi-shop"></i> Localização da loja:
                                @if ($lojaCoordenadas)
                                    <a href="https://www.google.com/maps?q={{ $lojaCoordenadas[0] }},{{ $lojaCoordenadas[1] }}" target="_blank">
                                        {{ round($lojaCoordenadas[0], 5) }}, {{ round($lojaCoordenadas[1], 5) }}
                                    </a>
                                    <br>Se o ponto estiver errado, corrija em
                                    <a href="{{ route('admin.configuracao') }}">Configurações da loja</a>.
                                @else
                                    <span class="text-danger">não encontrada.</span>
                                    Informe a latitude e a longitude em <a href="{{ route('admin.configuracao') }}">Configurações da loja</a>
                                    para o cálculo por distância funcionar.
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL NOVA ZONA --}}
    <div class="modal fade" id="modalNovaZona" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nova Zona</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.zona-entrega.store') }}">
                        @csrf
                        @include('admin.zona-entrega.campos', ['zona' => null])
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Salvar Zona</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAIS EDITAR — um por zona --}}
    @foreach ($zonas as $linha)
        <div class="modal fade" id="modalEditarZona{{ $linha->id_zona_entrega }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar {{ $linha->nome_zona_entrega }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('admin.zona-entrega.update', $linha->id_zona_entrega) }}">
                            @csrf
                            @method('PUT')
                            @include('admin.zona-entrega.campos', ['zona' => $linha])
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Salvar Zona</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        setTimeout(function() {
            let alertaSucesso = document.getElementById('alerta-sucesso');
            if (alertaSucesso) alertaSucesso.style.display = 'none';
        }, 3000);
    </script>

@endsection
