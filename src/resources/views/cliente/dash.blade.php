<!DOCTYPE html>
<html lang="pt-BR">

<head>
    @include('admin.partials.head')
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

    <div class="app-wrapper">

        {{-- Navbar --}}
        <nav class="app-header navbar navbar-expand bg-body">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-list" style="font-size: 1.5rem;"></i>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#"
                            data-bs-toggle="dropdown">
                            @if (auth('cliente')->user()->foto_cliente)
                                <img src="{{ asset('donuts/images/cliente/' . auth('cliente')->user()->foto_cliente) }}"
                                    width="35" height="35" style="object-fit: cover; border-radius: 50%;">
                            @else
                                <i class="bi bi-person-circle" style="font-size: 1.4rem;"></i>
                            @endif
                            {{ auth('cliente')->user()->nome_cliente }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form action="{{ route('cliente.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i> Sair
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        {{-- Conteúdo --}}
        <main class="app-main">
            <div class="app-content-header py-3 px-4">
                <h3 class="mb-0">Minha Área</h3>
            </div>

            <div class="app-content">
                <div class="container-fluid">

                    {{-- Boas-vindas --}}
                    <div class="alert alert-success">
                        <i class="bi bi-emoji-smile me-2"></i>
                        Bem-vindo(a), <strong>{{ auth('cliente')->user()->nome_cliente }}</strong>! 🎂
                    </div>

                    {{-- Cards --}}
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="card text-bg-primary">
                                <div class="card-body d-flex align-items-center gap-3">
                                    <i class="bi bi-bag-heart" style="font-size: 2.5rem;"></i>
                                    <div>
                                        <div class="fs-5 fw-bold">Meus Pedidos</div>
                                        <div class="small">Acompanhe seus pedidos</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card text-bg-success">
                                <div class="card-body d-flex align-items-center gap-3">
                                    <i class="bi bi-person-check" style="font-size: 2.5rem;"></i>
                                    <div>
                                        <div class="fs-5 fw-bold">Meus Dados</div>
                                        <div class="small">Edite seu perfil</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card text-bg-warning">
                                <div class="card-body d-flex align-items-center gap-3">
                                    <i class="bi bi-heart" style="font-size: 2.5rem;"></i>
                                    <div>
                                        <div class="fs-5 fw-bold">Favoritos</div>
                                        <div class="small">Seus produtos favoritos</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Dados do cliente --}}
                    <div class="card mt-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bi bi-person me-2"></i> Meus Dados
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="text-muted small">Nome</label>
                                    <p class="fw-bold">{{ auth('cliente')->user()->nome_cliente }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-muted small">E-mail</label>
                                    <p class="fw-bold">{{ auth('cliente')->user()->email_cliente }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-muted small">Telefone</label>
                                    <p class="fw-bold">{{ auth('cliente')->user()->telefone_cliente ?? '—' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-muted small">Cidade/UF</label>
                                    <p class="fw-bold">
                                        {{ auth('cliente')->user()->cidade_cliente ?? '—' }}
                                        /{{ auth('cliente')->user()->uf_cliente ?? '—' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>

        @include('admin.partials.app-footer')

    </div>

    @include('admin.partials.script')

</body>

</html>
