@extends('layout.admin')

@section('title', 'Cupons | Confeitaria Dashboard')
@section('pg-titulo', 'Cupons')
@section('link-topo', 'Cupons')

@section('content')

    @php
        $data = fn ($valor) => \Carbon\Carbon::parse($valor)->format('d/m/Y');
        // Situação real do cupom: ativo no cadastro não quer dizer válido hoje
        $situacao = function ($cupom) use ($hoje) {
            $inicio = substr($cupom->data_inicio_cupom, 0, 10);
            $fim = substr($cupom->data_fim_cupom, 0, 10);
            if ($cupom->status_cupom !== 'ATIVO') return ['Inativo', 'danger'];
            if ($fim < $hoje) return ['Expirado', 'secondary'];
            if ($inicio > $hoje) return ['Agendado', 'info'];
            return ['Valendo', 'success'];
        };
    @endphp

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Cupons de desconto</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal"
                                data-bs-target="#modalNovoCupom">
                                <i class="bi bi-plus-circle"></i>
                                Novo Cupom
                            </button>
                        </div>
                    </div>

                    {{-- MENSAGENS DE FEEDBACK --}}
                    @if (session('sucesso'))
                        <div id="alerta-sucesso" class="alert alert-success alert-dismissible fade show mx-3 mt-3" role="alert">
                            ✅ {{ session('sucesso') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div id="alerta-erro" class="alert alert-danger alert-dismissible fade show mx-3 mt-3" role="alert">
                            ❌ {{ $errors->first() }}
                        </div>
                    @endif

                    <p class="text-secondary mx-3 mt-3 mb-2">
                        O cliente digita o código na Sacola do app. O desconto é uma <strong>porcentagem sobre os produtos</strong>
                        (a taxa de entrega não tem desconto) e só vale entre as datas de início e fim.
                    </p>

                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Desconto</th>
                                    <th>Validade</th>
                                    <th>Situação</th>
                                    <th>Usos</th>
                                    <th style="width: 200px">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($cupons as $linha)
                                    @php [$rotulo, $cor] = $situacao($linha); @endphp
                                    <tr class="align-middle">
                                        <td><strong>{{ $linha->codigo_cupom }}</strong></td>
                                        <td>{{ rtrim(rtrim(number_format($linha->valor_desconto_cupom, 2, ',', ''), '0'), ',') }}%</td>
                                        <td>{{ $data($linha->data_inicio_cupom) }} até {{ $data($linha->data_fim_cupom) }}</td>
                                        <td><span class="badge text-bg-{{ $cor }}">{{ $rotulo }}</span></td>
                                        <td>{{ $usos[$linha->id_cupom] ?? 0 }}</td>
                                        <td>
                                            {{-- Ativar/Desativar --}}
                                            <form action="{{ route('admin.cupom.status', $linha->id_cupom) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                @if ($linha->status_cupom === 'ATIVO')
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
                                                data-bs-target="#modalEditarCupom{{ $linha->id_cupom }}">
                                                <i class="bi bi-pencil"></i>
                                            </button>

                                            {{-- Excluir --}}
                                            <form action="{{ route('admin.cupom.destroy', $linha->id_cupom) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('Excluir o cupom {{ $linha->codigo_cupom }}?');">
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
                                        <td colspan="6" class="text-center">Nenhum cupom cadastrado</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL NOVO CUPOM --}}
    <div class="modal fade" id="modalNovoCupom" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Novo Cupom</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.cupom.store') }}">
                        @csrf
                        @include('admin.cupom.campos', ['cupom' => null])
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Salvar Cupom</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAIS EDITAR — um por cupom --}}
    @foreach ($cupons as $linha)
        <div class="modal fade" id="modalEditarCupom{{ $linha->id_cupom }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Cupom</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('admin.cupom.update', $linha->id_cupom) }}">
                            @csrf
                            @method('PUT')
                            @include('admin.cupom.campos', ['cupom' => $linha])
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Salvar Cupom</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        // ALERTA SUCESSO
        setTimeout(function() {
            let alertaSucesso = document.getElementById('alerta-sucesso');
            if (alertaSucesso) alertaSucesso.style.display = 'none';
        }, 3000);

        // ALERTA ERRO
        setTimeout(function() {
            let alertaErro = document.getElementById('alerta-erro');
            if (alertaErro) alertaErro.style.display = 'none';
        }, 6000);
    </script>

@endsection
