  <!--begin::Sidebar-->
  <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
      <!--begin::Brand Link-->
      <a href="./index.html" class="brand-link">
        <!--begin::Brand Image-->
        <img
          src="{{asset ('davilla/IMG/logo-davilla.svg')}}"
          alt="Confeitaria"
          class="brand-image opacity-75 shadow" />
        <!--end::Brand Image-->
        <!--begin::Brand Text-->
        <span class="brand-text fw-light">Davilla</span>
        <!--end::Brand Text-->
      </a>
      <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
      <nav class="mt-2">
        <!--begin::Sidebar Menu-->
        <ul
          class="nav sidebar-menu flex-column"
          data-lte-toggle="treeview"
          role="navigation"
          aria-label="Main navigation"
          data-accordion="false"
          id="navigation">
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon bi bi-speedometer"></i>
              <p>
                GESTÃO DE CATÁLOGO
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Catáldfsdfdfogo</p>
                </a>
                <a href="{{ route('admin.categoria') }}" class="nav-link active">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Categofdfdfdfrias</p>
                </a>
                <a href="./index.html" class="nav-link active">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Produtos</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-box-seam-fill"></i>
                  <p>
                    GESTÃO COMERCIAL
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="./widgets/small-box.html" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>clientes</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="./widgets/info-box.html" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Pedidos</p>
                    </a>
                  </li>

                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-clipboard-fill"></i>
                  <p>
                    GESTÃO DE ESTOQUE
                    <span class="nav-badge badge text-bg-secondary me-3"></span>
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="./layout/unfixed-sidebar.html" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Materias-primas</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="./layout/fixed-sidebar.html" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Movimentação de estoque</p>
                    </a>
                  </li>
                  <a href="./layout/fixed-sidebar.html" class="nav-link">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>Fornecedores</p>
                  </a>
              </li>


            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-tree-fill"></i>
              <p>
                SITE
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./UI/general.html" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Banners</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./UI/icons.html" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Mensgens de contato</p>
                </a>
              </li>

            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-pencil-square"></i>
              <p>
                SISTEMA
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./forms/general.html" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>General Elements</p>
                </a>
              </li>
            </ul>
          </li>






        </ul>
        <!--end::Sidebar Menu-->
      </nav>
    </div>
    <!--end::Sidebar Wrapper-->
  </aside>
  <!--end::Sidebar-->
  <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">

    {{-- Logo / Marca --}}
    <div class="sidebar-brand">
      <a href="{{ route('admin.dash') }}" class="brand-link">

        {{-- Caso queira usar logo depois, pode ativar este bloco --}}
        {{--
            <img
                src="{{ asset('dash/assets/img/AdminLTELogo.png') }}"
        alt="DaVilla Logo"
        class="brand-image opacity-75 shadow">
        --}}

        <span class="brand-text fw-light">DaVilla Admin</span>
      </a>
    </div>

    {{-- Menu lateral --}}
    <div class="sidebar-wrapper">

      <nav class="mt-2">

        <ul
          class="nav sidebar-menu flex-column"
          data-lte-toggle="treeview"
          role="navigation"
          aria-label="Menu principal"
          data-accordion="false"
          id="navigation">

          {{-- Dashboard --}}
          <li class="nav-item">
            <a href="{{ route('admin.dash') }}" class="nav-link active">
              <i class="nav-icon bi bi-speedometer"></i>
              <p>Dashboard</p>
            </a>
          </li>

          {{-- Gestão de Catálogo --}}
          <li class="nav-header">GESTÃO DE CATÁLOGO</li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-shop"></i>
              <p>
                Catálogo
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{route('admin.categoria'  ) }}" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Categorias</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('admin.produto'  ) }}" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Produtos</p>
                </a>
              </li>

            </ul>
          </li>

          {{-- Gestão Comercial --}}
          <li class="nav-header">GESTÃO COMERCIAL</li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-cash-coin"></i>
              <p>
                Comercial
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{ route('admin.cliente') }}" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Clientes</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Pedidos</p>
                </a>
              </li>

            </ul>
          </li>

          {{-- Gestão de Estoque --}}
          <li class="nav-header">GESTÃO DE ESTOQUE</li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-box-seam"></i>
              <p>
                Estoque
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Matérias-primas</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Movimentações de estoque</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Fornecedores</p>
                </a>
              </li>

            </ul>
          </li>

          {{-- Site --}}
          <li class="nav-header">SITE</li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-window"></i>
              <p>
                Conteúdo do Site
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Banners</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin.evento') }}" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Feira Livre / Eventos</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Mensagens de contato</p>
                </a>
              </li>

            </ul>
          </li>

          {{-- Sistema --}}
          {{-- Sistema --}}
          <li class="nav-header">SISTEMA</li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-gear"></i>
              <p>
                Sistema
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{ route('admin.usuarios.index') }}" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Usuários</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-person-circle"></i>
                  <p>Meu Perfil</p>
                </a>
              </li>

            </ul>
          </li>

        </ul>

      </nav>

    </div>

  </aside>
