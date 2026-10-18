    <!-- Main Header-->
    <header class="main-header">
        <!-- Menu Wave -->
        <div class="menu_wave"></div>

        <!-- Main box -->
        <div class="main-box">
            <div class="menu-box">
                <div class="logo"><a href="index.html"><img src="{{ asset('davilla/IMG/logo-davilla.svg') }}" alt="" title=""></a></div>

                <!--Nav Box-->
                <div class="nav-outer clearfix">
                    <!-- Main Menu -->
                    <nav class="main-menu navbar-expand-md navbar-light">
                        <div class="collapse navbar-collapse clearfix" id="navbarSupportedContent">
                            <ul class="navigation menu-left clearfix">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="{{ route('sobre') }}">Sobre</a></li>
                                <li class="dropdown"><a href="{{ route('cardapio.index') }}">Cardápio</a>
                                    <ul>
                                        @forelse($categorias as $linha)

                                        <li>
                                            <a href="{{ route('cardapio.categoria', $linha->id_categoria) }}">
                                                {{ $linha->nome_categoria }}
                                            </a>
                                        </li>
                                        @empty
                                        <li>Nenhuma Categoria </li>
                                        @endforelse
                                    </ul>
                                </li>
                            </ul>

                            <ul class="navigation menu-right clearfix">
                                <li><a href="{{ route('pedidos') }}"> Pedidos </a></li>
                                <li class="dropdown"><a href="{{ route('regiao.index') }}">Região</a>
                                    <ul>
                                        <li><a href="#">Região nivel 1</a></li>
                                        <li class="dropdown"><a href="#">Região nivel 1</a>
                                            <ul>
                                                <li><a href="#">Região nivel 2</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('contato') }}">Contato</a></li>


                            </ul>
                        </div>
                    </nav>
                    <!-- Main Menu End-->

                    <div class="outer-box clearfix"
                        style="display: flex; justify-content: flex-end; align-items: center; gap: 20px;">

                        <!-- Admin -->
                        <div class="cart-btn">
                            <a href="{{ route('admin.login') }}">
                                <i class="fa fa-user-shield"></i>
                                <span class="count"></span>
                            </a>
                        </div>

                        <!-- Faça seu pedido (o site não tem carrinho: o pedido é pelo app ou WhatsApp) -->
                        <div class="cart-btn">
                            <a href="{{ route('pedidos') }}" title="Faça seu pedido">
                                <i class="icon flaticon-commerce"></i>
                            </a>
                        </div>

                        <!-- Busca -->
                        <div class="search-box">
                            <button class="search-btn">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>

                    </div>


                    <!-- Sticky Header  -->
                    <div class="sticky-header">
                        <div class="auto-container clearfix">
                            <!--Logo-->
                            <div class="logo">
                                <a href="#" title="Sticky Logo"><img src="{{ asset('davilla/IMG/logo-davilla.svg') }}" alt="Sticky Logo"></a>
                            </div>

                            <!--Nav Outer-->
                            <div class="nav-outer">
                                <!-- Main Menu -->
                                <nav class="main-menu">
                                    <!--Keep This Empty / Menu will come through Javascript-->
                                </nav><!-- Main Menu End-->
                            </div>
                        </div>
                    </div><!-- End Sticky Menu -->

                    <!-- Mobile Header -->
                    <div class="mobile-header">
                        <div class="logo"><a href="index.html"><img src="{{ asset('davilla/images/the-gusta-texto.svg') }}" alt="" title=""></a></div>

                        <!--Nav Box-->
                        <div class="nav-outer clearfix">
                            <!--Keep This Empty / Menu will come through Javascript-->
                        </div>
                    </div>

                    <!-- Mobile Menu  -->
                    <div class="mobile-menu">
                        <nav class="menu-box">
                            <div class="nav-logo"><a href="index.html"><img src="{{ asset('davilla/images/the-gusta-texto.svg') }}" alt="" title=""></a></div>
                            <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                        </nav>
                    </div><!-- End Mobile Menu -->

                    <!-- Header Search -->
                    <div class="search-popup">
                        <span class="search-back-drop"></span>

                        <div class="search-inner">
                            <button class="close-search"><span class="fa fa-times"></span></button>
                            <form method="post" action="blog-showcase.html">
                                <div class="form-group">
                                    <input type="search" name="search-field" value="" placeholder="Search..." required="">
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- End Header Search -->

    </header>
    <!--End Main Header -->