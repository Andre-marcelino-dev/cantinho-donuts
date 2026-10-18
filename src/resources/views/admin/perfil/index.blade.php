@extends('layout.admin')

@section('title', 'Meu Perfil | Confeitaria Dashboard')
@section('pg-titulo', 'Meu Perfil')
@section('link-topo', 'Meu Perfil')

@section('content')

    <div class="app-content">
        <div class="container-fluid">

            {{-- MENSAGENS DE FEEDBACK --}}
            @if (session('sucesso'))
                <div id="alerta-sucesso" class="alert alert-success alert-dismissible fade show" role="alert">
                    ✅ {{ session('sucesso') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    ❌ {{ $errors->first() }}
                </div>
            @endif

            <div class="row">
                {{-- Dados --}}
                <div class="col-lg-7">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Meus dados</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.perfil.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="d-flex align-items-center gap-3 mb-4">
                                    <img src="{{ $usuario->urlFoto() }}" alt="{{ $usuario->nome_usuario }}"
                                        class="rounded-circle border border-3"
                                        style="width: 90px; height: 90px; object-fit: cover;">
                                    <div>
                                        <h5 class="mb-0">{{ $usuario->nome_usuario }}</h5>
                                        <span class="badge text-bg-primary">{{ $usuario->perfil_usuario }}</span>
                                        <div class="text-secondary small mt-1">
                                            Membro desde {{ optional($usuario->criado_em_usuario)->format('d/m/Y') }}
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Nome</label>
                                    <input type="text" class="form-control" name="nome_usuario" maxlength="50" required
                                        value="{{ old('nome_usuario', $usuario->nome_usuario) }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">E-mail (usado no login)</label>
                                    <input type="email" class="form-control" name="email_usuario" maxlength="80" required
                                        value="{{ old('email_usuario', $usuario->email_usuario) }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Trocar foto (opcional)</label>
                                    <input type="file" class="form-control" name="foto_usuario" accept="image/jpeg,image/png,image/webp">
                                    <div class="form-text">JPG, PNG ou WEBP, até 2 MB. Deixe vazio para manter a foto atual.</div>
                                </div>

                                <p class="text-secondary small">
                                    O cargo ({{ $usuario->perfil_usuario }}) e o status são alterados em Sistema → Usuários.
                                </p>

                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-lg"></i> Salvar dados
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Senha --}}
                <div class="col-lg-5">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Trocar senha</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.perfil.senha') }}">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label class="form-label">Senha atual</label>
                                    <input type="password" class="form-control" name="senha_atual" required autocomplete="current-password">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Nova senha</label>
                                    <input type="password" class="form-control" name="nova_senha" minlength="8" required autocomplete="new-password">
                                    <div class="form-text">Pelo menos 8 caracteres.</div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Repita a nova senha</label>
                                    <input type="password" class="form-control" name="nova_senha_confirmation" minlength="8" required autocomplete="new-password">
                                </div>

                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-key"></i> Trocar senha
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        setTimeout(function() {
            let alertaSucesso = document.getElementById('alerta-sucesso');
            if (alertaSucesso) alertaSucesso.style.display = 'none';
        }, 4000);
    </script>

@endsection
