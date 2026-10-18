@extends('layout.admin')

@section('title', 'Clientes | Confeitaria Dashboard')
@section('pg-titulo', 'Clientes')
@section('link-topo', 'Clientes')

@section('content')

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Gerenciamento de Clientes</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal"
                                data-bs-target="#modalNovoCliente">
                                <i class="bi bi-plus-circle"></i>
                                Novo Cliente
                            </button>
                        </div>
                    </div>

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

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mx-3" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $erro)
                                    <li>{{ $erro }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Foto</th>
                                        <th>Tipo</th>
                                        <th>CPF/CNPJ</th>
                                        <th>E-mail</th>
                                        <th>Cidade/UF</th>
                                        <th>Status</th>
                                        <th style="width: 150px">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($listaCliente as $linha)
                                        <tr class="align-middle">
                                            <td>{{ $linha->nome_cliente }}</td>
                                            <td>
                                                @if ($linha->foto_cliente)
                                                    <img src="{{ asset('davilla/images/cliente/' . $linha->foto_cliente) }}" width="50" height="50" style="object-fit: cover; border-radius: 50%;">
                                                @else
                                                    <div class="d-flex align-items-center justify-content-center bg-secondary rounded-circle"
                                                        style="width: 50px; height: 50px;">
                                                        <i class="bi bi-person text-white" style="font-size: 1.5rem;"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <span
                                                    class="badge {{ $linha->tipo_cliente == 'PF' ? 'text-bg-info' : 'text-bg-dark' }}">
                                                    {{ $linha->tipo_cliente == 'PF' ? 'Física' : 'Jurídica' }}
                                                </span>
                                            </td>
                                            <td>{{ $linha->cpf_cnpj_cliente }}</td>
                                            <td>{{ $linha->email_cliente }}</td>
                                            <td>{{ $linha->cidade_cliente }}/{{ $linha->uf_cliente }}</td>

                                            {{-- Status --}}
                                            <td>
                                                @if ($linha->status_cliente == 'ATIVO')
                                                    <span class="badge text-bg-success">Ativo</span>
                                                @else
                                                    <span class="badge text-bg-secondary">Inativo</span>
                                                @endif
                                            </td>

                                            {{-- Ações --}}
                                            <td>
                                                {{-- Botão Ativar/Desativar --}}
                                                <form action="{{ route('admin.cliente.status', $linha->id_cliente) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    @if ($linha->status_cliente == 'ATIVO')
                                                        <button type="submit" class="btn btn-secondary btn-sm"
                                                            title="Desativar">
                                                            <i class="bi bi-toggle-on"></i>
                                                        </button>
                                                    @else
                                                        <button type="submit" class="btn btn-success btn-sm"
                                                            title="Ativar">
                                                            <i class="bi bi-toggle-off"></i>
                                                        </button>
                                                    @endif
                                                </form>

                                                {{-- Botão Editar --}}
                                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#modalEditarCliente{{ $linha->id_cliente }}">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>

                                                {{-- Botão Excluir --}}
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#modalExcluir{{ $linha->id_cliente }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        {{-- MODAL EDITAR CLIENTE --}}
                                        <div class="modal fade" id="modalEditarCliente{{ $linha->id_cliente }}"
                                            tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Editar Cliente: {{ $linha->nome_cliente }}
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form method="POST"
                                                        action="{{ route('admin.cliente.update', $linha->id_cliente) }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="row g-3">

                                                                {{-- Foto --}}
                                                                <div class="col-12">
                                                                    <div
                                                                        class="row align-items-center bg-light p-3 border rounded mb-2">
                                                                        <div class="col-md-2 text-center mb-2 mb-md-0">
                                                                            <div class="avatar-preview d-flex align-items-center justify-content-center border rounded bg-white"
                                                                                style="width: 70px; height: 70px; margin: 0 auto; overflow: hidden;">
                                                                                @if ($linha->foto_cliente)
                                                                                   <img src="{{ asset('davilla/images/cliente/' . $linha->foto_cliente) }}"
                                                                                        style="object-fit: cover; border-radius: 50%;">
                                                                                @else
                                                                                    <div class="d-flex align-items-center justify-content-center bg-secondary rounded-circle"
                                                                                        style="width: 50px; height: 50px;">
                                                                                        <i class="bi bi-person text-white"
                                                                                            style="font-size: 1.5rem;"></i>
                                                                                    </div>
                                                                                @endif


                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-10">
                                                                            <label class="form-label fw-bold">Alterar Foto
                                                                                do Cliente</label>
                                                                            <input type="file" class="form-control"
                                                                                name="foto_cliente" accept="image/*">
                                                                            <div class="form-text">Deixe em branco para
                                                                                manter a foto atual.</div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-8">
                                                                    <label class="form-label">Nome do Cliente <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        name="nome_cliente" required maxlength="50"
                                                                        value="{{ $linha->nome_cliente }}">
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <label class="form-label">Tipo <span
                                                                            class="text-danger">*</span></label>
                                                                    <select class="form-select" name="tipo_cliente"
                                                                        required>
                                                                        <option value="PF"
                                                                            {{ $linha->tipo_cliente == 'PF' ? 'selected' : '' }}>
                                                                            Pessoa Física (PF)</option>
                                                                        <option value="PJ"
                                                                            {{ $linha->tipo_cliente == 'PJ' ? 'selected' : '' }}>
                                                                            Pessoa Jurídica (PJ)</option>
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="form-label">CPF / CNPJ <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        name="cpf_cnpj_cliente" required maxlength="18"
                                                                        value="{{ $linha->cpf_cnpj_cliente }}">
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="form-label">Data de Nascimento</label>
                                                                    <input type="date" class="form-control"
                                                                        name="data_nasc_cliente"
                                                                        value="{{ $linha->data_nasc_cliente?->format('Y-m-d') }}">
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="form-label">E-mail</label>
                                                                    <input type="email" class="form-control"
                                                                        name="email_cliente" maxlength="80"
                                                                        value="{{ $linha->email_cliente }}">
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="form-label">Telefone / Celular <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        name="telefone_cliente" required maxlength="14"
                                                                        value="{{ $linha->telefone_cliente }}"
                                                                        placeholder="(00) 00000-0000">
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="form-label">Nova Senha</label>
                                                                    <input type="password" class="form-control"
                                                                        name="senha_cliente" minlength="6"
                                                                        placeholder="Deixe em branco para manter a atual">
                                                                </div>

                                                                <hr class="text-muted my-2">
                                                                <h6>Endereço</h6>

                                                                <div class="col-md-4">
                                                                    <label class="form-label">CEP</label>
                                                                    <input type="text" class="form-control"
                                                                        name="cep_cliente" maxlength="9"
                                                                        value="{{ $linha->cep_cliente }}">
                                                                </div>

                                                                <div class="col-md-8">
                                                                    <label class="form-label">Endereço</label>
                                                                    <input type="text" class="form-control"
                                                                        name="endereco_cliente" maxlength="40"
                                                                        value="{{ $linha->endereco_cliente }}">
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <label class="form-label">Número</label>
                                                                    <input type="text" class="form-control"
                                                                        name="numero_cliente" maxlength="6"
                                                                        value="{{ $linha->numero_cliente }}">
                                                                </div>

                                                                <div class="col-md-8">
                                                                    <label class="form-label">Complemento</label>
                                                                    <input type="text" class="form-control"
                                                                        name="complemento_cliente" maxlength="50"
                                                                        value="{{ $linha->complemento_cliente }}">
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="form-label">Bairro</label>
                                                                    <input type="text" class="form-control"
                                                                        name="bairro_cliente" maxlength="40"
                                                                        value="{{ $linha->bairro_cliente }}">
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <label class="form-label">Cidade</label>
                                                                    <input type="text" class="form-control"
                                                                        name="cidade_cliente" maxlength="40"
                                                                        value="{{ $linha->cidade_cliente }}">
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <label class="form-label">UF</label>
                                                                    <input type="text" class="form-control"
                                                                        name="uf_cliente" maxlength="2"
                                                                        value="{{ $linha->uf_cliente }}">
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancelar</button>
                                                            <button type="submit" class="btn btn-primary">Salvar
                                                                Alterações</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- MODAL EXCLUIR CLIENTE --}}
                                        <div class="modal fade" id="modalExcluir{{ $linha->id_cliente }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content border-0 shadow">
                                                    <div class="modal-header bg-danger text-white border-0 py-3">
                                                        <h5 class="modal-title fw-bold">
                                                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                                            Confirmar Exclusão
                                                        </h5>
                                                        <button type="button" class="btn-close btn-close-white"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body p-4 text-center">
                                                        <p class="text-muted mb-2">Você tem certeza que deseja remover o
                                                            cadastro de:</p>
                                                        <h5 class="fw-bold text-dark mb-4">{{ $linha->nome_cliente }}</h5>
                                                        <div class="alert alert-warning border-0 small text-start d-flex align-items-start mb-0"
                                                            role="alert">
                                                            <i
                                                                class="bi bi-info-circle-fill me-2 fs-5 mt-1 text-warning"></i>
                                                            <div>
                                                                <strong>Atenção:</strong> Esta ação é definitiva e removerá
                                                                permanentemente os dados deste cliente.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="modal-footer border-0 bg-light py-3 d-flex justify-content-between">
                                                        <button type="button" class="btn btn-secondary px-4"
                                                            data-bs-dismiss="modal">Cancelar</button>
                                                        <form
                                                            action="{{ route('admin.cliente.destroy', $linha->id_cliente) }}"
                                                            method="POST" class="m-0">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger px-4 fw-bold">Sim, Excluir
                                                                Cadastro</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Nenhum cliente cadastrado.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL NOVO CLIENTE --}}
    <div class="modal fade" id="modalNovoCliente" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cadastrar Novo Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('admin.cliente.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">

                            <div class="col-12">
                                <div class="row align-items-center bg-light p-3 border rounded mb-2">
                                    <div class="col-md-2 text-center mb-2 mb-md-0">
                                        <div class="avatar-preview d-flex align-items-center justify-content-center border rounded bg-white"
                                            style="width: 70px; height: 70px; margin: 0 auto;">
                                            <i class="bi bi-person text-secondary" style="font-size: 2rem;"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <label class="form-label fw-bold">Foto do Cliente</label>
                                        <input type="file" class="form-control" name="foto_cliente" accept="image/*">
                                        <div class="form-text">Formatos permitidos: JPG, JPEG, PNG ou WEBP. Máx: 2MB.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <label class="form-label">Nome do Cliente <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nome_cliente" required maxlength="50"
                                    placeholder="Nome Completo">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Tipo <span class="text-danger">*</span></label>
                                <select class="form-select" name="tipo_cliente" required>
                                    <option value="PF" selected>Pessoa Física (PF)</option>
                                    <option value="PJ">Pessoa Jurídica (PJ)</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">CPF / CNPJ <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="cpf_cnpj_cliente" required
                                    maxlength="18" placeholder="Apenas números">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Data de Nascimento</label>
                                <input type="date" class="form-control" name="data_nasc_cliente">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">E-mail</label>
                                <input type="email" class="form-control" name="email_cliente" maxlength="80"
                                    placeholder="exemplo@email.com">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Telefone / Celular</label>
                                <input type="text" class="form-control" name="telefone_cliente" maxlength="14"
                                    placeholder="(00) 00000-0000">
                            </div>

                            {{-- Senha --}}
                            <div class="col-6 mb-3">
                                <label class="form-label">Senha</label>
                                <input type="password" class="form-control" name="senha_cliente" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label">Confirmar Senha</label>
                                <input type="password" class="form-control" name="senha_cliente_confirmation" required>
                            </div>

                            <hr class="text-muted my-2">
                            <h6>Endereço</h6>

                            <div class="col-md-4">
                                <label class="form-label">CEP</label>
                                <input type="text" class="form-control" name="cep_cliente" maxlength="9"
                                    placeholder="00000-000">
                            </div>

                            <div class="col-md-8">
                                <label class="form-label">Endereço</label>
                                <input type="text" class="form-control" name="endereco_cliente" maxlength="40"
                                    placeholder="Rua, Av, etc.">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Número</label>
                                <input type="text" class="form-control" name="numero_cliente" maxlength="6"
                                    placeholder="Nº">
                            </div>

                            <div class="col-md-8">
                                <label class="form-label">Complemento</label>
                                <input type="text" class="form-control" name="complemento_cliente" maxlength="50"
                                    placeholder="Apto, Bloco, etc.">
                            </div>

                            <div class="col-md-5">
                                <label class="form-label">Bairro</label>
                                <input type="text" class="form-control" name="bairro_cliente" maxlength="40"
                                    placeholder="Bairro">
                            </div>

                            <div class="col-md-5">
                                <label class="form-label">Cidade</label>
                                <input type="text" class="form-control" name="cidade_cliente" maxlength="40"
                                    placeholder="Cidade">
                            </div>

                            <div class="col-md-2">
                                <label class="form-label">UF</label>
                                <input type="text" class="form-control" name="uf_cliente" maxlength="2"
                                    placeholder="SP">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        setTimeout(function() {
            let alertaSucesso = document.getElementById('alerta-sucesso');
            if (alertaSucesso) alertaSucesso.style.display = 'none';
        }, 3000);

        setTimeout(function() {
            let alertaErro = document.getElementById('alerta-erro');
            if (alertaErro) alertaErro.style.display = 'none';
        }, 3000);
    </script>

@endsection
