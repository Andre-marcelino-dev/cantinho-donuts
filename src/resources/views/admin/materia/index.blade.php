@extends('layout.admin')

@section('title', 'Matérias-primas | Confeitaria Dashboard')
@section('pg-titulo', 'Matérias-primas')
@section('link-topo', 'Matérias-primas')

@section('content')

    @php
        // 25.000 → "25"; 2.500 → "2,5"
        $qtd = fn ($valor) => rtrim(rtrim(number_format((float) $valor, 3, ',', '.'), '0'), ',');
    @endphp

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Matérias-primas e estoque atual</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal"
                                data-bs-target="#modalNovaMateria">
                                <i class="bi bi-plus-circle"></i>
                                Nova Matéria-prima
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
                        A quantidade muda só pelas <a href="{{ route('admin.movimentacao') }}">movimentações de estoque</a>
                        (entradas e saídas), para o histórico sempre explicar o número atual.
                    </p>

                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Matéria-prima</th>
                                    <th>Fornecedor</th>
                                    <th>Estoque atual</th>
                                    <th style="width: 220px">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($materias as $linha)
                                    <tr class="align-middle">
                                        <td><strong>{{ $linha->nome_materia_prima }}</strong></td>
                                        <td>
                                            {{ $linha->fornecedor->nome_fornecedor ?? '-' }}
                                            @if ($linha->fornecedor && $linha->fornecedor->status_fornecedor !== 'ATIVO')
                                                <span class="badge text-bg-secondary">inativo</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="fs-5 fw-semibold {{ (float) $linha->qtde_atual_materia_prima <= 0 ? 'text-danger' : '' }}">
                                                {{ $qtd($linha->qtde_atual_materia_prima) }}
                                            </span>
                                            {{ $linha->unid_med_materia_prima }}
                                            @if ((float) $linha->qtde_atual_materia_prima <= 0)
                                                <span class="badge text-bg-danger">sem estoque</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- Movimentar (abre a tela de movimentações já filtrada) --}}
                                            <a href="{{ route('admin.movimentacao', ['materia' => $linha->id_materia_prima]) }}"
                                                class="btn btn-info" title="Entrada / saída">
                                                <i class="bi bi-arrow-left-right"></i>
                                            </a>

                                            {{-- Editar --}}
                                            <button type="button" class="btn btn-warning" title="Editar"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalEditarMateria{{ $linha->id_materia_prima }}">
                                                <i class="bi bi-pencil"></i>
                                            </button>

                                            {{-- Excluir (só sem movimentações) --}}
                                            @if ($linha->movimentacoes_count === 0)
                                                <form action="{{ route('admin.materia.destroy', $linha->id_materia_prima) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Excluir {{ addslashes($linha->nome_materia_prima) }}?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" title="Excluir">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Nenhuma matéria-prima cadastrada</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL NOVA --}}
    <div class="modal fade" id="modalNovaMateria" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nova Matéria-prima</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.materia.store') }}">
                        @csrf
                        @include('admin.materia.campos', ['materia' => null])
                        <div class="mb-3">
                            <label class="form-label">Estoque inicial (opcional)</label>
                            <input type="text" inputmode="decimal" class="form-control" name="qtde_inicial" placeholder="Ex.: 10 ou 2,5"
                                value="{{ old('qtde_inicial') }}">
                            <div class="form-text">Vira uma entrada "Estoque inicial" no histórico.</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAIS EDITAR --}}
    @foreach ($materias as $linha)
        <div class="modal fade" id="modalEditarMateria{{ $linha->id_materia_prima }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Matéria-prima</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('admin.materia.update', $linha->id_materia_prima) }}">
                            @csrf
                            @method('PUT')
                            @include('admin.materia.campos', ['materia' => $linha])
                            <p class="text-secondary small mb-0">
                                Estoque atual: {{ $qtd($linha->qtde_atual_materia_prima) }} {{ $linha->unid_med_materia_prima }}
                                — para mudar, registre uma entrada ou saída.
                            </p>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Salvar</button>
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
        setTimeout(function() {
            let alertaErro = document.getElementById('alerta-erro');
            if (alertaErro) alertaErro.style.display = 'none';
        }, 6000);
    </script>

@endsection
