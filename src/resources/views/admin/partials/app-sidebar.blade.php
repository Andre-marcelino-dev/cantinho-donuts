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

              <li class="nav-item">
                <a href="{{ route('admin.kit') }}" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Kits</p>
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
                <a href="{{ route('admin.pedido') }}" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Pedidos</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin.cupom') }}" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Cupons</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin.novidades') }}" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Novidades e promoções</p>
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
                <a href="{{ route('admin.materia') }}" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Matérias-primas</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin.movimentacao') }}" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Movimentações de estoque</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin.fornecedor') }}" class="nav-link">
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
                <a href="{{ route('admin.conteudo') }}" class="nav-link">
                  <i class="nav-icon bi bi-pencil-square"></i>
                  <p>Páginas, textos e imagens</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin.banner') }}" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Banners</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin.receita') }}" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Livro de receitas</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin.evento') }}" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Feira Livre / Eventos</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin.contato') }}" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Mensagens de contato</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin.depoimento') }}" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Depoimentos</p>
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
                <a href="{{ route('admin.configuracao') }}" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Configurações da loja</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin.zona-entrega') }}" class="nav-link">
                  <i class="nav-icon bi bi-geo-alt"></i>
                  <p>Zonas de entrega</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin.perfil') }}" class="nav-link">
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
