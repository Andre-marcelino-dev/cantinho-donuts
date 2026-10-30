@extends('layout.admin')

@section('title', 'Categoria | Confeitaria Dashboard')
@section('pg-titulo', 'Categoria')
@section('link-topo', 'Categoria')

@section('content')

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Gerenciamento de Categorias</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal"
                                data-bs-target="#modalNovaCategoria">
                                <i class="bi bi-plus-circle"></i>
                                Nova Categoria
                            </button>
                        </div>
                    </div>

                    {{-- MENSAGENS DE FEEDBACK --}}
                    @if (session('sucesso'))
                        <div id="alerta-sucesso" class="alert alert-success alert-dismissible fade show mx-3" role="alert">
                            ✅ {{ session('sucesso') }}
                        </div>
                    @endif

                    @if (session('erro') || $errors->any())
                        <div id="alerta-erro" class="alert alert-danger alert-dismissible fade show mx-3" role="alert">
                            ❌ {{ session('erro') ?? $errors->first() }}
                        </div>
                    @endif

                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 40px">Ordem</th>
                                    <th style="width: 60px">Imagem</th>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Status</th>
                                    <th style="width: 200px">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categorias as $linha)
                                    <tr class="align-middle">
                                        <td>{{ $linha->ordem_categoria }}</td>
                                        <td>
                                            <img src="{{ $linha->urlFoto() }}" alt="{{ $linha->nome_categoria }}" width="44" height="44" style="object-fit: contain;">
                                        </td>
                                        <td>{{ $linha->nome_categoria }}</td>
                                        <td>{{ $linha->descricao_categoria }}</td>
                                        <td>
                                            @if ($linha->status_categoria === 'ATIVO')
                                                <span class="badge text-bg-success">Ativo</span>
                                            @else
                                                <span class="badge text-bg-danger">Inativo</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- Botão Ativar/Desativar --}}
                                            <form action="{{ route('admin.categoria.status', $linha->id_categoria) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                @if ($linha->status_categoria === 'ATIVO')
                                                    <button type="submit" class="btn btn-secondary">
                                                        <i class="bi bi-toggle-on"></i>
                                                    </button>
                                                @else
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="bi bi-toggle-off"></i>
                                                    </button>
                                                @endif
                                            </form>

                                            {{-- Botão Editar --}}
                                            <button type="button" class="btn btn-warning"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalEditarCategoria{{ $linha->id_categoria }}">
                                                <i class="bi bi-arrow-counterclockwise"></i>
                                            </button>

                                            {{-- Botão Excluir (só aparece para categorias inativas) --}}
                                            @if ($linha->status_categoria === 'INATIVO')
                                                <form action="{{ route('admin.categoria.destroy', $linha->id_categoria) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Tem certeza que deseja excluir esta categoria?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- MODAL EDITAR — um por categoria, dados via Blade --}}
                                    <div class="modal fade" id="modalEditarCategoria{{ $linha->id_categoria }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Editar Categoria</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{ route('admin.categoria.update', $linha->id_categoria) }}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="card-body">

                                                            <div class="mb-3">
                                                                <label class="form-label">Nome</label>
                                                                <input type="text" class="form-control" name="nome_categoria" required value="{{ $linha->nome_categoria }}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Descrição</label>
                                                                <textarea class="form-control" name="descricao_categoria" rows="3" required>{{ $linha->descricao_categoria }}</textarea>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Imagem</label>
                                                                <div class="d-flex align-items-center gap-3">
                                                                    <img src="{{ $linha->urlFoto() }}" alt="{{ $linha->nome_categoria }}" width="60" height="60" style="object-fit: contain;">
                                                                    <input type="file" class="form-control" name="foto_categoria" accept="image/png,image/jpeg,image/webp">
                                                                </div>
                                                                <div class="form-text">
                                                                    Envie uma nova só se quiser trocar (JPG, PNG ou WEBP, até 2 MB).
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-6 mb-3">
                                                                    <label class="form-label">Ordem</label>
                                                                    <input type="number" class="form-control" name="ordem_categoria" required value="{{ $linha->ordem_categoria }}">
                                                                </div>
                                                                <div class="col-6 mb-3">
                                                                    <label class="form-label">Status</label>
                                                                    <select class="form-select" name="status_categoria" required>
                                                                        <option value="">Selecione</option>
                                                                        @foreach(['ATIVO', 'INATIVO'] as $status)
                                                                            <option value="{{ $status }}" {{ $linha->status_categoria == $status ? 'selected' : '' }}>
                                                                                {{ $status }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer mb-3 btn-modal">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                                <button type="submit" class="btn btn-primary">Salvar Categoria</button>
                                                            </div>

                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Nenhuma categoria cadastrada</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Nova Categoria --}}
    @include('admin.categoria.modal.criar')

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
        }, 3000);
    </script>

@endsection
