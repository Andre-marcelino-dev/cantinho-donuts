@extends('layout.admin')

@section('title', 'Banners | Confeitaria Dashboard')
@section('pg-titulo', 'Banners')
@section('link-topo', 'Banners')

@section('content')

    @php
        // Algumas fotos antigas foram gravadas com "banner/" na frente
        $urlImagem = fn ($foto) => asset('davilla/images/banner/' . basename($foto));
    @endphp

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Banners da Home do site e do app</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal"
                                data-bs-target="#modalNovoBanner">
                                <i class="bi bi-plus-circle"></i>
                                Novo Banner
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
                        Só os banners <strong>ativos</strong> aparecem. No app, seguem o campo "Ordem" (menor primeiro);
                        na Home do site, aparecem em ordem aleatória.
                        Tamanho ideal da imagem: <strong>1920 × 800 px</strong>, até <strong>2 MB</strong>
                        (imagens grandes deixam o site e o app lentos).
                    </p>

                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 180px">Imagem</th>
                                    <th>Nome</th>
                                    <th style="width: 80px">Ordem</th>
                                    <th>Status</th>
                                    <th style="width: 200px">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($banners as $linha)
                                    <tr class="align-middle">
                                        <td>
                                            <img src="{{ $urlImagem($linha->foto_banner) }}" alt="{{ $linha->nome_banner }}"
                                                style="width: 160px; height: 67px; object-fit: cover; border-radius: 6px; background: #eee;">
                                        </td>
                                        <td>{{ $linha->nome_banner }}</td>
                                        <td>{{ $linha->ordem_banner }}</td>
                                        <td>
                                            @if ($linha->status_banner === 'ATIVO')
                                                <span class="badge text-bg-success">Ativo</span>
                                            @else
                                                <span class="badge text-bg-danger">Inativo</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- Ativar/Desativar --}}
                                            <form action="{{ route('admin.banner.status', $linha->id_banner) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                @if ($linha->status_banner === 'ATIVO')
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
                                                data-bs-target="#modalEditarBanner{{ $linha->id_banner }}">
                                                <i class="bi bi-pencil"></i>
                                            </button>

                                            {{-- Excluir --}}
                                            <form action="{{ route('admin.banner.destroy', $linha->id_banner) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('Excluir o banner {{ addslashes($linha->nome_banner) }}?');">
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
                                        <td colspan="5" class="text-center">Nenhum banner cadastrado</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL NOVO BANNER --}}
    <div class="modal fade" id="modalNovoBanner" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Novo Banner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.banner.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nome</label>
                            <input type="text" class="form-control" name="nome_banner" maxlength="30" required value="{{ old('nome_banner') }}">
                        </div>

                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label">Ordem</label>
                                <input type="number" class="form-control" name="ordem_banner" min="0" required value="{{ old('ordem_banner', 0) }}">
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status_banner" required>
                                    <option value="ATIVO">ATIVO</option>
                                    <option value="INATIVO">INATIVO</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Imagem</label>
                            <input type="file" class="form-control" name="foto_banner" accept="image/jpeg,image/png,image/webp" required>
                            <div class="form-text">JPG, PNG ou WEBP, até 2 MB. Ideal: 1920 × 800 px.</div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Salvar Banner</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAIS EDITAR — um por banner --}}
    @foreach ($banners as $linha)
        <div class="modal fade" id="modalEditarBanner{{ $linha->id_banner }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Banner</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('admin.banner.update', $linha->id_banner) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <img src="{{ $urlImagem($linha->foto_banner) }}" alt="{{ $linha->nome_banner }}"
                                class="mb-3" style="width: 100%; max-height: 180px; object-fit: cover; border-radius: 6px; background: #eee;">

                            <div class="mb-3">
                                <label class="form-label">Nome</label>
                                <input type="text" class="form-control" name="nome_banner" maxlength="30" required value="{{ $linha->nome_banner }}">
                            </div>

                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="form-label">Ordem</label>
                                    <input type="number" class="form-control" name="ordem_banner" min="0" required value="{{ $linha->ordem_banner }}">
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label">Status</label>
                                    <select class="form-select" name="status_banner" required>
                                        @foreach (['ATIVO', 'INATIVO'] as $status)
                                            <option value="{{ $status }}" {{ $linha->status_banner === $status ? 'selected' : '' }}>{{ $status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Trocar imagem (opcional)</label>
                                <input type="file" class="form-control" name="foto_banner" accept="image/jpeg,image/png,image/webp">
                                <div class="form-text">Deixe vazio para manter a imagem atual.</div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Salvar Banner</button>
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
        }, 5000);
    </script>

@endsection
