<nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                <i class="bi bi-list"></i>
              </a>
            </li>
            <li class="nav-item d-none d-md-block">
              <a href="{{ route('home') }}" class="nav-link">Home</a>
            </li>
            
          </ul>
          <!--end::Start Navbar Links-->

          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">
            <!--begin::Navbar Search-->
            <li class="nav-item">
              <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="bi bi-search"></i>
              </a>
            </li>
            <!--end::Navbar Search-->

            <!--begin::Messages Dropdown Menu-->
            <li class="nav-item dropdown">
              <a class="nav-link" data-bs-toggle="dropdown" href="#" title="Mensagens do Fale Conosco">
                <i class="bi bi-chat-text"></i>
                @if ($totalMensagensNovas > 0)
                  <span class="navbar-badge badge text-bg-danger">{{ $totalMensagensNovas }}</span>
                @endif
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <span class="dropdown-item dropdown-header">
                  {{ $totalMensagensNovas }} mensagem(ns) nova(s)
                </span>
                @forelse ($ultimasMensagens as $mensagem)
                  <div class="dropdown-divider"></div>
                  <a href="{{ route('admin.contato', ['status' => 'ENVIADO']) }}" class="dropdown-item">
                    <h3 class="dropdown-item-title">{{ $mensagem->nome_contato }}</h3>
                    <p class="fs-7 mb-0 text-truncate">{{ $mensagem->assunto_contato ?: $mensagem->mensagem_contato }}</p>
                    <p class="fs-7 text-secondary mb-0">
                      <i class="bi bi-clock-fill me-1"></i>
                      {{ \Carbon\Carbon::parse($mensagem->criado_em_contato)->format('d/m/Y H:i') }}
                    </p>
                  </a>
                @empty
                  <div class="dropdown-divider"></div>
                  <span class="dropdown-item text-secondary">Nenhuma mensagem nova.</span>
                @endforelse
                <div class="dropdown-divider"></div>
                <a href="{{ route('admin.contato') }}" class="dropdown-item dropdown-footer">Ver todas as mensagens</a>
              </div>
            </li>
            <!--end::Messages Dropdown Menu-->

            <!--begin::Notifications Dropdown Menu-->
            <li class="nav-item dropdown">
              <a class="nav-link" data-bs-toggle="dropdown" href="#" title="Notificações">
                <i class="bi bi-bell-fill"></i>
                @if ($totalNotificacoes > 0)
                  <span class="navbar-badge badge text-bg-warning">{{ $totalNotificacoes }}</span>
                @endif
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <span class="dropdown-item dropdown-header">{{ $totalNotificacoes }} notificação(ões)</span>
                @forelse ($notificacoes as $notificacao)
                  <div class="dropdown-divider"></div>
                  <a href="{{ $notificacao['link'] }}" class="dropdown-item">
                    <i class="bi {{ $notificacao['icone'] }} me-2"></i>
                    {{ $notificacao['total'] }} {{ $notificacao['texto'] }}
                  </a>
                @empty
                  <div class="dropdown-divider"></div>
                  <span class="dropdown-item text-secondary">Tudo em dia por aqui. 🎉</span>
                @endforelse
              </div>
            </li>
            <!--end::Notifications Dropdown Menu-->

            <!--begin::Fullscreen Toggle-->
            <li class="nav-item">
              <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
              </a>
            </li>
            <!--end::Fullscreen Toggle-->

            <!--begin::User Menu Dropdown-->

            @php
            
            $usuarioLogado = auth('admin')->user();
            // Foto real do usuário (ou o boneco padrão)
            $fotoUser = $usuarioLogado ? $usuarioLogado->urlFoto() : asset('dash/assets/img/user/user.png');

            @endphp

            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img
                  src="{{ $fotoUser }}"
                  class="user-image rounded-circle shadow"
                  alt="{{ $usuarioLogado->nome_usuario}}"
                />
                <span class="d-none d-md-inline">{{ $usuarioLogado->nome_usuario }}</span>

                <br>

              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <!--begin::User Image-->
                <li class="user-header text-bg-primary">
                  <img
                    src="{{ $fotoUser }}"
                    class="rounded-circle shadow"
                    style="object-fit: cover;"
                    alt="{{ $usuarioLogado->nome_usuario }}"
                  />
                  <p>
                    {{ $usuarioLogado->nome_usuario}}
                    <small>{{ $usuarioLogado->email_usuario }} | {{ date('d/m/Y',strtotime($usuarioLogado->criado_em_usuario))}}</small>
                  </p>
                </li>
                <!--end::User Image-->
                <!--begin::Menu Body-->
          
                <!--end::Menu Body-->
                <!--begin::Menu Footer-->
                <li class="user-footer">
                <a href="#" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalPerfil">Perfil</a>

                  <form action="{{ route('admin.logout') }}" method="POST" class="float-end">
                  @csrf
                  <button type="submit" class="btn btn-outline-danger float-end">Sair</button>
                  </form>
                </li>

                <!--end::Menu Footer-->
              </ul>
            </li>
            <!--end::User Menu Dropdown-->
          </ul>
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav>
      <!--end::Header-->
      
      <div class="modal fade" id="modalPerfil" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title">Meu Perfil</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body text-center pt-2">
        <div class="mb-3">
          <img src="{{ $fotoUser }}"
               class="rounded-circle border border-3"
               style="width:90px; height:90px; object-fit:cover;"
               alt="{{ $usuarioLogado->nome_usuario }}">
        </div>
        <h5 class="fw-semibold mb-0">{{ $usuarioLogado->nome_usuario }}</h5>
        <p class="text-muted small mb-3">{{ $usuarioLogado->perfil_usuario }}</p>

        <ul class="list-group list-group-flush text-start">
          <li class="list-group-item d-flex align-items-center gap-2">
            <i class="bi bi-envelope text-secondary"></i>
            <div>
              <p class="text-muted small mb-0">Email</p>
              <span class="fw-semibold small">{{ $usuarioLogado->email_usuario }}</span>
            </div>
          </li>
          <li class="list-group-item d-flex align-items-center gap-2">
            <i class="bi bi-calendar text-secondary"></i>
            <div>
              <p class="text-muted small mb-0">Membro desde</p>
              <span class="fw-semibold small">{{ date('d/m/Y', strtotime($usuarioLogado->criado_em_usuario)) }}</span>
            </div>
          </li>
          <li class="list-group-item d-flex align-items-center gap-2">
            <i class="bi bi-shield-check text-success"></i>
            <div>
              <p class="text-muted small mb-0">Status</p>
              <span class="badge bg-success-subtle text-success">Ativo</span>
            </div>
          </li>
        </ul>
      </div>

      <div class="modal-footer border-0">
        <a href="{{ route('admin.perfil') }}" class="btn btn-primary btn-sm">
          <i class="bi bi-pencil"></i> Editar meu perfil
        </a>
        <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>
      </div>

    </div>
  </div>
</div>