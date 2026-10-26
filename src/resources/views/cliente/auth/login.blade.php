<!doctype html>
<html lang="pt-BR">
<head>
    @include('admin.partials.head')
    <link rel="stylesheet" href="{{ asset('xyzcode/login.css') }}">
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
                <div class="logo-sub">Área do Cliente</div>  {{-- ← mudou aqui --}}
            </div>

            <hr class="divider">

            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-warning" role="alert">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                    Verifique seu e-mail e senha.
                </div>
            @endif

            <form action="{{ route('cliente.autenticar') }}" method="POST">  {{-- ← mudou aqui --}}
                @csrf

                <div class="field">
                    <label for="email_cliente">E-mail</label>  {{-- ← mudou aqui --}}
                    <div class="input-wrap">
                        <svg class="input-icon" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        <input type="email" id="email_cliente" name="email_cliente" placeholder="seu@email.com" value="{{ old('email_cliente') }}" required autofocus />
                    </div>
                </div>

                <div class="field">
                    <label for="senha_cliente">Senha</label>  {{-- ← mudou aqui --}}
                    <div class="input-wrap">
                        <svg class="input-icon" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                        <input type="password" id="senha_cliente" name="senha_cliente" placeholder="••••••••" required />  {{-- ← mudou aqui --}}
                    </div>
                </div>

                <button type="submit" class="btn-submit">Entrar</button>

            </form>

            <div class="footer">© {{ date('Y') }} Cantinho Donuts · Todos os direitos reservados</div>

        </div>
    </div>

</body>
</html>
