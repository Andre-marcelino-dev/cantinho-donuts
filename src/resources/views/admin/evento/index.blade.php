@extends('layout.admin')

@section('title', 'Eventos | Confeitaria Dashboard')
@section('pg-titulo', 'Feira Livre / Eventos')
@section('link-topo', 'Eventos')

@section('content')

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Gerenciamento de Eventos (Feira Livre)</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal"
                                data-bs-target="#modalNovoEvento">
                                <i class="bi bi-plus-circle"></i>
                                Novo Evento
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
                                    <th>Evento</th>
                                    <th>Data</th>
                                    <th>Endereço</th>
                                    <th>Status</th>
                                    <th style="width: 200px">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($listaEvento as $linha)
                                    <tr class="align-middle">

                                        <td>
                                            @if ($linha->foto_evento)
                                                <img src="{{ asset('davilla/images/' . $linha->foto_evento) }}" width="80"
                                                    style="cursor:pointer; border-radius: 6px;" data-bs-toggle="modal"
                                                    data-bs-target="#modalVerEvento{{ $linha->id_evento }}">
                                            @else
                                                <span class="text-muted small">Sem foto</span>
                                            @endif
                                        </td>

                                        <td>
                                            <strong>{{ $linha->nome_evento }}</strong><br>
                                            <small class="text-muted">{{ $linha->titulo_evento }}</small>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($linha->data_evento)->format('d/m/Y') }}<br>
                                            <small class="text-muted">{{ $linha->horario_evento }}</small>
                                        </td>
                                        <td>{{ $linha->endereco_evento }}</td>
                                        <td>
                                            @if ($linha->status_evento === 'ATIVO')
                                                <span class="badge text-bg-success">Ativo</span>
                                            @else
                                                <span class="badge text-bg-danger">Inativo</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-1 align-items-center">

                                                {{-- 1. BOTÃO ALTERAR STATUS --}}
                                                <form action="{{ route('admin.evento.status', $linha->id_evento) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    @if ($linha->status_evento === 'ATIVO')
                                                        <button type="submit" class="btn btn-secondary"
                                                            title="Desativar Evento">
                                                            <i class="bi bi-toggle-on"></i>
                                                        </button>
                                                    @else
                                                        <button type="submit" class="btn btn-success"
                                                            title="Ativar Evento">
                                                            <i class="bi bi-toggle-off"></i>
                                                        </button>
                                                    @endif
                                                </form>

                                                {{-- 2. BOTÃO EDITAR --}}
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#modalEditarEvento{{ $linha->id_evento }}">
                                                    <i class="bi bi-pencil"></i>
                                                </button>

                                                {{-- 3. BOTÃO EXCLUIR --}}
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#modalExcluirEvento{{ $linha->id_evento }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>

                                            </div>
                                        </td>
                                    </tr>

                                    {{-- MODAL VER EVENTO --}}
                                    <div class="modal fade" id="modalVerEvento{{ $linha->id_evento }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{ $linha->nome_evento }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-5 text-center">
                                                            @if ($linha->foto_evento)
                                                                <img src="{{ asset('davilla/images/' . $linha->foto_evento) }}"
                                                                    alt="{{ $linha->nome_evento }}"
                                                                    class="img-fluid rounded shadow">
                                                            @endif
                                                        </div>
                                                        <div class="col-md-7">
                                                            <p class="text-muted mb-1">{{ $linha->titulo_evento }}</p>
                                                            <h4 class="mb-3">{{ $linha->nome_evento }}</h4>
                                                            @if ($linha->descricao_evento)
                                                                <p class="mb-3">{{ $linha->descricao_evento }}</p>
                                                            @endif
                                                            <ul class="list-group list-group-flush">
                                                                <li class="list-group-item d-flex justify-content-between">
                                                                    <span><strong>Data</strong></span>
                                                                    <span>{{ \Carbon\Carbon::parse($linha->data_evento)->format('d/m/Y') }}</span>
                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">
                                                                    <span><strong>Horário</strong></span>
                                                                    <span>{{ $linha->horario_evento }}</span>
                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">
                                                                    <span><strong>Endereço</strong></span>
                                                                    <span>{{ $linha->endereco_evento }}</span>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <strong>Produtos do dia</strong><br>
                                                                    <span>{{ $linha->tags_evento ?: '—' }}</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- MODAL EDITAR EVENTO --}}
                                    <div class="modal fade" id="modalEditarEvento{{ $linha->id_evento }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Editar Evento</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST"
                                                        action="{{ route('admin.evento.update', $linha->id_evento) }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="card-body">

                                                            <div class="row">
                                                                <div class="col-4 mb-3">
                                                                    <label class="form-label">Selo (ex: FEIRA LIVRE)</label>
                                                                    <input type="text" class="form-control"
                                                                        name="titulo_evento" maxlength="30" required
                                                                        value="{{ $linha->titulo_evento }}">
                                                                </div>
                                                                <div class="col-6 mb-3">
                                                                    <label class="form-label">Nome do evento</label>
                                                                    <input type="text" class="form-control"
                                                                        name="nome_evento" maxlength="120" required
                                                                        value="{{ $linha->nome_evento }}">
                                                                </div>
                                                                <div class="col-2 mb-3">
                                                                    <label class="form-label">Ordem</label>
                                                                    <input type="number" class="form-control"
                                                                        name="ordem_evento" required
                                                                        value="{{ $linha->ordem_evento }}">
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Descrição curta</label>
                                                                <input type="text" class="form-control"
                                                                    name="descricao_evento" maxlength="160"
                                                                    value="{{ $linha->descricao_evento }}">
                                                                <div class="form-text">Ex: "Doce Ponto Confeitaria vai estar por lá"</div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-4 mb-3">
                                                                    <label class="form-label">Data</label>
                                                                    <input type="date" class="form-control"
                                                                        name="data_evento" required
                                                                        value="{{ \Carbon\Carbon::parse($linha->data_evento)->format('Y-m-d') }}">
                                                                </div>
                                                                <div class="col-4 mb-3">
                                                                    <label class="form-label">Horário</label>
                                                                    <input type="text" class="form-control"
                                                                        name="horario_evento" maxlength="30" required
                                                                        value="{{ $linha->horario_evento }}"
                                                                        placeholder="Ex: 9h às 14h">
                                                                </div>
                                                                <div class="col-4 mb-3">
                                                                    <label class="form-label">Status</label>
                                                                    <select class="form-select" name="status_evento"
                                                                        required>
                                                                        @foreach (['ATIVO', 'INATIVO'] as $status)
                                                                            <option value="{{ $status }}"
                                                                                {{ $linha->status_evento == $status ? 'selected' : '' }}>
                                                                                {{ $status }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Endereço</label>
                                                                <input type="text" class="form-control"
                                                                    name="endereco_evento" maxlength="160" required
                                                                    value="{{ $linha->endereco_evento }}">
                                                            </div>

                                                            <div class="mb-3"><h1></h1>
                                                                <label class="form-label">Link do local (Google Maps, opcional)</label>
                                                                <input type="text" class="form-control"
                                                                    name="link_local_evento"
                                                                    value="{{ $linha->link_local_evento }}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Produtos do dia (separados por vírgula)</label>
                                                                <input type="text" class="form-control"
                                                                    name="tags_evento" maxlength="255"
                                                                    value="{{ $linha->tags_evento }}"
                                                                    placeholder="Ex: Bolos no pote, Brigadeiros, Tortinhas, Cookies">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Foto atual</label><br>
                                                                @if ($linha->foto_evento)
                                                                    <img src="{{ asset('davilla/images/' . $linha->foto_evento) }}"
                                                                        width="80" class="mb-2 rounded">
                                                                @endif
                                                                <input type="file" class="form-control"
                                                                    name="foto_evento" accept="image/*">
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

                                    {{-- MODAL EXCLUIR EVENTO --}}
                                    <div class="modal fade" id="modalExcluirEvento{{ $linha->id_evento }}" tabindex="-1"
                                        aria-labelledby="modalExcluirEventoLabel{{ $linha->id_evento }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0 shadow">

                                                <div class="modal-header bg-danger text-white border-0 py-3">
                                                    <h5 class="modal-title fw-bold"
                                                        id="modalExcluirEventoLabel{{ $linha->id_evento }}">
                                                        <i class="bi bi-exclamation-triangle-fill me-2"></i> Confirmar
                                                        Exclusão
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body p-4 text-center">
                                                    <p class="text-muted mb-2">Você tem certeza que deseja remover o
                                                        evento:</p>
                                                    <h5 class="fw-bold text-dark mb-3">{{ $linha->nome_evento }}</h5>

                                                    <div class="alert alert-warning border-0 small text-start d-flex align-items-start mb-0"
                                                        role="alert">
                                                        <i class="bi bi-info-circle-fill me-2 fs-5 mt-1 text-warning"></i>
                                                        <div>
                                                            <strong>Atenção:</strong> Esta ação removerá o evento
                                                            permanentemente do site e do banco de dados.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer border-0 bg-light py-3 d-flex justify-content-between">
                                                    <button type="button" class="btn btn-secondary px-4"
                                                        data-bs-dismiss="modal">
                                                        Cancelar
                                                    </button>

                                                    <form action="{{ route('admin.evento.destroy', $linha->id_evento) }}"
                                                        method="POST" class="m-0">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger px-4 fw-bold">
                                                            Sim, Excluir Evento
                                                        </button>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Nenhum evento cadastrado</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Novo Evento --}}
    @include('admin.evento.modal.criar')

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
