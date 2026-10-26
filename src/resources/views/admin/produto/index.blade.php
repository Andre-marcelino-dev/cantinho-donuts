@extends('layout.admin')

@section('title', 'Produto | Confeitaria Dashboard')
@section('pg-titulo', 'Produto')
@section('link-topo', 'Produto')

@section('content')

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Gerenciamento de Produtos</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal"
                                data-bs-target="#modalNovoProduto">
                                <i class="bi bi-plus-circle"></i>
                                Novo Produto
                            </button>
                        </div>
                    </div>

                    {{-- MENSAGENS DE FEEDBACK --}}
                    @if (session('sucesso'))
                        <div id="alerta-sucesso" class="alert alert-success alert-dismissible fade show mx-3"
                            role="alert">
                            ✅ {{ session('sucesso') }}
                        </div>
                    @endif

                    @if (session('erro'))
                        <div id="alerta-erro" class="alert alert-danger alert-dismissible fade show mx-3" role="alert">
                            ❌ {{ session('erro') }}
                        </div>
                    @endif

                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 40px">Foto</th>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Status</th>
                                    <th style="width: 200px">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($listaProduto as $linha)
                                    <tr class="align-middle">

                                        {{-- Imagem clicável --}}
                                        <td>
                                            <img src="{{ asset('donuts/images/' . $linha->foto_produto) }}" width="80"
                                                style="cursor:pointer; border-radius: 6px;" data-bs-toggle="modal"
                                                data-bs-target="#modalVerProduto{{ $linha->id_produto }}">
                                        </td>

                                        <td>{{ $linha->nome_produto }}</td>
                                        <td>{{ $linha->descricao_produto }}</td>
                                        <td>
                                            @if ($linha->status_produto === 'ATIVO')
                                                <span class="badge text-bg-success">Ativo</span>
                                            @else
                                                <span class="badge text-bg-danger">Inativo</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-1 align-items-center">

                                                {{-- 1. BOTÃO ALTERAR STATUS --}}
                                                <form action="{{ route('admin.produto.status', $linha->id_produto) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    @if ($linha->status_produto === 'ATIVO')
                                                        <button type="submit" class="btn btn-secondary"
                                                            title="Desativar Produto">
                                                            <i class="bi bi-toggle-on"></i>
                                                        </button>
                                                    @else
                                                        <button type="submit" class="btn btn-success"
                                                            title="Ativar Produto">
                                                            <i class="bi bi-toggle-off"></i>
                                                        </button>
                                                    @endif
                                                </form>

                                                {{-- 2. BOTÃO EDITAR --}}
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#modalEditarProduto{{ $linha->id_produto }}">
                                                    <i class="bi bi-pencil"></i>
                                                </button>

                                                {{-- Novo Botão Excluir (Chama o Modal Profissional) --}}
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#modalExcluir{{ $linha->id_produto }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>

                                            </div>
                                        </td>
                                    </tr>

                                    {{-- MODAL VER PRODUTO --}}
                                    <div class="modal fade" id="modalVerProduto{{ $linha->id_produto }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{ $linha->nome_produto }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-5 text-center">
                                                            <img src="{{ asset('donuts/images/' . $linha->foto_produto) }}"
                                                                alt="{{ $linha->nome_produto }}"
                                                                class="img-fluid rounded shadow img-modal-fade">
                                                        </div>
                                                        <div class="col-md-7">
                                                            <h4 class="mb-3">{{ $linha->nome_produto }}</h4>
                                                            <p class="text-muted mb-3">{{ $linha->descricao_produto }}</p>
                                                            <ul class="list-group list-group-flush">
                                                                <li class="list-group-item d-flex justify-content-between">
                                                                    <span><strong>Tamanho</strong></span>
                                                                    <span>{{ $linha->tamanho_produto }}</span>
                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">
                                                                    <span><strong>Unidade</strong></span>
                                                                    <span>{{ $linha->unid_medida_produto }}</span>
                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">
                                                                    <span><strong>Valor</strong></span>
                                                                    <span class="fw-bold text-success">R$
                                                                        {{ number_format($linha->valor_produto, 2, ',', '.') }}</span>
                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">
                                                                    <span><strong>Status</strong></span>
                                                                    <span>
                                                                        @if ($linha->status_produto === 'ATIVO')
                                                                            <span class="badge text-bg-success">Ativo</span>
                                                                        @else
                                                                            <span
                                                                                class="badge text-bg-danger">Inativo</span>
                                                                        @endif
                                                                    </span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- MODAL EDITAR PRODUTO --}}
                                    <div class="modal fade" id="modalEditarProduto{{ $linha->id_produto }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Editar Produto</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST"
                                                        action="{{ route('admin.produto.update', $linha->id_produto) }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="card-body">

                                                            <div class="row">
                                                                <div class="col-8 mb-3">
                                                                    <label class="form-label">Nome</label>
                                                                    <input type="text" class="form-control"
                                                                        name="nome_produto" required
                                                                        value="{{ $linha->nome_produto }}">
                                                                </div>
                                                                <div class="col-4 mb-3">
                                                                    <label class="form-label">Ordem</label>
                                                                    <input type="number" class="form-control"
                                                                        name="ordem_produto" required
                                                                        value="{{ $linha->ordem_produto }}">
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Slug</label>
                                                                <input type="text" class="form-control"
                                                                    name="slug_produto" required
                                                                    value="{{ $linha->slug_produto }}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Descrição</label>
                                                                <textarea class="form-control" name="descricao_produto" rows="3" required>{{ $linha->descricao_produto }}</textarea>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-4 mb-3">
                                                                    <label class="form-label">Tamanho</label>
                                                                    <select class="form-select" name="tamanho_produto"
                                                                        required>
                                                                        <option value="">Selecione</option>
                                                                        @foreach (['Pequeno', 'Médio', 'Grande'] as $tamanho)
                                                                            <option value="{{ $tamanho }}"
                                                                                {{ $linha->tamanho_produto == $tamanho ? 'selected' : '' }}>
                                                                                {{ $tamanho }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-4 mb-3">
                                                                    <label class="form-label">Unid. Medida</label>
                                                                    <select class="form-select" name="unid_medida_produto"
                                                                        required>
                                                                        <option value="">Selecione</option>
                                                                        @foreach (['CX', 'FT', 'ML', 'UN'] as $unidade)
                                                                            <option value="{{ $unidade }}"
                                                                                {{ $linha->unid_medida_produto == $unidade ? 'selected' : '' }}>
                                                                                {{ $unidade }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-4 mb-3">
                                                                    <label class="form-label">Valor (R$)</label>
                                                                    <input type="number" step="0.01"
                                                                        class="form-control" name="valor_produto" required
                                                                        value="{{ $linha->valor_produto }}">
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-4 mb-3">
                                                                    <label class="form-label">Status</label>
                                                                    <select class="form-select" name="status_produto"
                                                                        required>
                                                                        <option value="">Selecione</option>
                                                                        @foreach (['ATIVO', 'INATIVO'] as $status)
                                                                            <option value="{{ $status }}"
                                                                                {{ $linha->status_produto == $status ? 'selected' : '' }}>
                                                                                {{ $status }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-4 mb-3">
                                                                    <label class="form-label">Destaque</label>
                                                                    <select class="form-select" name="destaque_produto"
                                                                        required>
                                                                        <option value="">Selecione</option>
                                                                        @foreach (['SIM', 'NAO'] as $destaque)
                                                                            <option value="{{ $destaque }}"
                                                                                {{ $linha->destaque_produto == $destaque ? 'selected' : '' }}>
                                                                                {{ $destaque == 'NAO' ? 'NÃO' : $destaque }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-4 mb-3">
                                                                    <label class="form-label">Categoria</label>
                                                                    <select class="form-select" name="id_categoria"
                                                                        required>
                                                                        <option value="">Selecione</option>
                                                                        @foreach ($categorias as $categoria)
                                                                            <option value="{{ $categoria->id_categoria }}"
                                                                                {{ $linha->id_categoria == $categoria->id_categoria ? 'selected' : '' }}>
                                                                                {{ $categoria->nome_categoria }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Foto atual</label><br>
                                                                <img src="{{ asset('donuts/images/' . $linha->foto_produto) }}"
                                                                    width="80" class="mb-2 rounded">
                                                                <input type="file" class="form-control"
                                                                    name="foto_produto" accept="image/*">
                                                                <div class="form-text">Deixe em branco para manter a foto
                                                                    atual</div>
                                                            </div>

                                                            <div class="modal-footer mb-3 btn-modal">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cancelar</button>
                                                                <button type="submit" class="btn btn-primary">Salvar
                                                                    Alterações</button>
                                                            </div>

                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- MODAL EXCLUIR PRODUTO (NOVO) --}}
                                    <div class="modal fade" id="modalExcluir{{ $linha->id_produto }}" tabindex="-1" aria-labelledby="modalExcluirLabel{{ $linha->id_produto }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0 shadow">
                                                
                                                <div class="modal-header bg-danger text-white border-0 py-3">
                                                    <h5 class="modal-title fw-bold" id="modalExcluirLabel{{ $linha->id_produto }}">
                                                        <i class="bi bi-exclamation-triangle-fill me-2"></i> Confirmar Exclusão
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                
                                                <div class="modal-body p-4 text-center">
                                                    <p class="text-muted mb-2">Você tem certeza que deseja remover o produto:</p>
                                                    <h5 class="fw-bold text-dark mb-3">{{ $linha->nome_produto }}</h5>
                                                    <img src="{{ asset('donuts/images/' . $linha->foto_produto) }}" width="70" class="mb-4 rounded shadow-sm">
                                                    
                                                    <div class="alert alert-warning border-0 small text-start d-flex align-items-start mb-0" role="alert">
                                                        <i class="bi bi-info-circle-fill me-2 fs-5 mt-1 text-warning"></i>
                                                        <div>
                                                            <strong>Atenção:</strong> Esta ação removerá o item permanentemente do cardápio e do banco de dados.
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="modal-footer border-0 bg-light py-3 d-flex justify-content-between">
                                                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                                                        Cancelar
                                                    </button>
                                                    
                                                    <form action="{{ route('admin.produto.destroy', $linha->id_produto) }}" method="POST" class="m-0">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger px-4 fw-bold">
                                                            Sim, Excluir Produto
                                                        </button>
                                                    </form>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>

                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Nenhum produto cadastrado</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Novo Produto --}}
    @include('admin.produto.modal.criar')

    <script>
        // Gera slug automaticamente a partir do nome
        document.getElementById('nome_produto').addEventListener('input', function() {
            const slug = this.value
                .toLowerCase()
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .replace(/[^a-z0-9\s-]/g, '')
                .trim()
                .replace(/\s+/g, '-');
            document.getElementById('slug_produto').value = slug;
        });

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