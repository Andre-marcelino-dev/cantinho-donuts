@extends('layout.admin')

@section('title', 'Fornecedores | Confeitaria Dashboard')
@section('pg-titulo', 'Fornecedores')
@section('link-topo', 'Fornecedores')

@section('content')

    @php
        // "11987654321" → "(11) 98765-4321"
        $telefone = function ($numero) {
            $n = preg_replace('/\D/', '', (string) $numero);
            if (strlen($n) === 11) return sprintf('(%s) %s-%s', substr($n, 0, 2), substr($n, 2, 5), substr($n, 7));
            if (strlen($n) === 10) return sprintf('(%s) %s-%s', substr($n, 0, 2), substr($n, 2, 4), substr($n, 6));
            return $numero;
        };
    @endphp

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Fornecedores de matéria-prima</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal"
                                data-bs-target="#modalNovoFornecedor">
                                <i class="bi bi-plus-circle"></i>
                                Novo Fornecedor
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

                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Fornecedor</th>
                                    <th>Representante</th>
                                    <th>Contato</th>
                                    <th>Matérias-primas</th>
                                    <th>Status</th>
                                    <th style="width: 140px">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($fornecedores as $linha)
                                    <tr class="align-middle">
                                        <td><strong>{{ $linha->nome_fornecedor }}</strong></td>
                                        <td>{{ $linha->representante_fornecedor }}</td>
                                        <td>
                                            {{ $telefone($linha->telefone_fornecedor) }}<br>
                                            <a href="mailto:{{ $linha->email_fornecedor }}" class="small">{{ $linha->email_fornecedor }}</a>
                                        </td>
                                        <td>{{ $linha->materias_primas_count }}</td>
                                        <td>
                                            @if ($linha->status_fornecedor === 'ATIVO')
                                                <span class="badge text-bg-success">Ativo</span>
                                            @else
                                                <span class="badge text-bg-danger">Inativo</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- Ativar/Desativar --}}
                                            <form action="{{ route('admin.fornecedor.status', $linha->id_fornecedor) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                @if ($linha->status_fornecedor === 'ATIVO')
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
                                                data-bs-target="#modalEditarFornecedor{{ $linha->id_fornecedor }}">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Nenhum fornecedor cadastrado</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL NOVO --}}
    <div class="modal fade" id="modalNovoFornecedor" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Novo Fornecedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.fornecedor.store') }}">
                        @csrf
                        @include('admin.fornecedor.campos', ['fornecedor' => null])
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Salvar Fornecedor</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAIS EDITAR --}}
    @foreach ($fornecedores as $linha)
        <div class="modal fade" id="modalEditarFornecedor{{ $linha->id_fornecedor }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Fornecedor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('admin.fornecedor.update', $linha->id_fornecedor) }}">
                            @csrf
                            @method('PUT')
                            @include('admin.fornecedor.campos', ['fornecedor' => $linha])
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Salvar Fornecedor</button>
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
