<!doctype html>
<html lang="pt-BR">
<head>
    @include('admin.partials.head')
    <link rel="stylesheet" href="{{ asset('xyzcode/login.css') }}">
    <style>
        /* Os dois forms ocupam a mesma célula do grid: o wrapper
           cresce até a altura do maior, sem cortar o botão */
        .forms-wrapper {
            display: grid;
            overflow: hidden;
        }

        .form-painel {
            grid-area: 1 / 1;
            width: 100%;
            pointer-events: none;
            transition: transform 0.5s cubic-bezier(0.77, 0, 0.18, 1), opacity 0.5s ease;
        }

        /* Só o form visível recebe cliques */
        #form-admin:not(.saiu),
        #form-cliente.entrou {
            pointer-events: auto;
        }

        /* Admin começa visível (posição 0) */
        #form-admin {
            transform: translateX(0%);
            opacity: 1;
        }

        /* Cliente começa fora da tela à direita */
        #form-cliente {
            transform: translateX(110%);
            opacity: 0;
        }

        /* Quando admin sai → vai para esquerda */
        #form-admin.saiu {
            transform: translateX(-110%);
            opacity: 0;
        }

        /* Quando cliente entra → vem da direita */
        #form-cliente.entrou {
            transform: translateX(0%);
            opacity: 1;
        }

        /* Quando cliente sai → vai para direita */
        #form-cliente.saiu {
            transform: translateX(110%);
            opacity: 0;
        }

        /* Quando admin volta → vem da esquerda */
        #form-admin.entrou {
            transform: translateX(0%);
            opacity: 1;
        }

        .tabs {
            display: flex;
            gap: 8px;
            margin-bottom: 24px;
        }

        .tab-btn {
            flex: 1;
            padding: 10px;
            border-radius: 8px;
            border: 2px solid #c8a165;
            background: transparent;
            color: #c8a165;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .tab-btn.ativo {
            background: #c8a165;
            color: #fff;
        }
    </style>
</head>
<body>

    <div class="login-wrapper">
        <div class="login-card">

            <div class="logo-area">
                <div class="logo-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 2c0 0-1 1.5-1 2.5S12 7 12 7s1-1.5 1-2.5S12 2 12 2z"/>
                        <rect x="3" y="11" width="18" height="10" rx="2"/>
                        <path d="M3 11c0-2.2 1.8-4 4-4h10c2.2 0 4 1.8 4 4"/>
                        <path d="M7 7h10"/>
                    </svg>
                </div>
                <div class="logo-title"><span>Cantinho</span> Donuts</div>
                <div class="logo-sub" id="subtitulo">Painel Administrativo</div>
            </div>

            <hr class="divider">

            @if(session('erro') || session('error'))
                <div class="alert alert-danger" role="alert">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    {{ session('erro') ?? session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-warning" role="alert">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                    Verifique seu e-mail e senha.
                </div>
            @endif

            {{-- Abas --}}
            <div class="tabs">
                <button class="tab-btn ativo" id="btn-admin" onclick="trocarAba('admin')">
                    🔐 Administrador
                </button>
                <button class="tab-btn" id="btn-cliente" onclick="trocarAba('cliente')">
                    👤 Cliente
                </button>
            </div>

            {{-- Formulários --}}
            <div class="forms-wrapper">

                {{-- Form Admin --}}
                <div id="form-admin" class="form-painel">
                    <form action="{{ route('admin.login.autenticar') }}" method="POST">
                        @csrf
                        <div class="field">
                            <label for="email_usuario">E-mail</label>
                            <div class="input-wrap">
                                <svg class="input-icon" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                <input type="email" id="email_usuario" name="email_usuario" placeholder="seu@email.com" value="{{ old('email_usuario') }}" required autofocus />
                            </div>
                        </div>
                        <div class="field">
                            <label for="senha_usuario">Senha</label>
                            <div class="input-wrap">
                                <svg class="input-icon" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                                <input type="password" id="senha_usuario" name="senha_usuario" placeholder="••••••••" required />
                            </div>
                        </div>
                        <button type="submit" class="btn-submit">Entrar</button>
                    </form>
                </div>

                {{-- Form Cliente --}}
                <div id="form-cliente" class="form-painel">
                    <form action="{{ route('cliente.autenticar') }}" method="POST">
                        @csrf
                        <div class="field">
                            <label for="email_cliente">E-mail</label>
                            <div class="input-wrap">
                                <svg class="input-icon" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                <input type="email" id="email_cliente" name="email_cliente" placeholder="seu@email.com" value="{{ old('email_cliente') }}" />
                            </div>
                        </div>
                        <div class="field">
                            <label for="senha_cliente">Senha</label>
                            <div class="input-wrap">
                                <svg class="input-icon" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                                <input type="password" id="senha_cliente" name="senha_cliente" placeholder="••••••••" />
                            </div>
                        </div>
                        <button type="submit" class="btn-submit">Entrar</button>
                    </form>
                </div>

            </div>

            <div class="footer" style="margin-top: 24px;">© {{ date('Y') }} Cantinho Donuts · Todos os direitos reservados</div>

        </div>
    </div>

<script>
    let abaAtual = 'admin';

    function trocarAba(aba) {
        if (aba === abaAtual) return;

        const formAdmin   = document.getElementById('form-admin');
        const formCliente = document.getElementById('form-cliente');
        const btnAdmin    = document.getElementById('btn-admin');
        const btnCliente  = document.getElementById('btn-cliente');
        const subtitulo   = document.getElementById('subtitulo');

        if (aba === 'cliente') {
            formAdmin.classList.add('saiu');
            formAdmin.classList.remove('ativo');       // ← bloqueia admin
            formCliente.classList.add('entrou', 'ativo'); // ← libera cliente
            formCliente.classList.remove('saiu');
            btnAdmin.classList.remove('ativo');
            btnCliente.classList.add('ativo');
            subtitulo.textContent = 'Área do Cliente';

        } else {
            formCliente.classList.remove('entrou', 'ativo'); // ← bloqueia cliente
            formCliente.classList.add('saiu');
            formAdmin.classList.remove('saiu');
            formAdmin.classList.add('ativo');              // ← libera admin
            btnCliente.classList.remove('ativo');
            btnAdmin.classList.add('ativo');
            subtitulo.textContent = 'Painel Administrativo';
        }

        abaAtual = aba;
    }
</script>
</body>
</html>
