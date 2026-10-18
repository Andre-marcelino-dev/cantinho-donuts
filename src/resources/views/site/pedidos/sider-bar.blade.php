  @php
      $formatarValor = fn ($valor) => 'R$ ' . number_format($valor, 2, ',', '.');
      // Link do WhatsApp da loja já com a mensagem pronta
      $linkWhatsapp = fn ($texto) => 'https://wa.me/' . $whatsapp . '?text=' . rawurlencode($texto);
  @endphp

  <style>
      .passos-pedido { margin-bottom: 40px; }
      .passos-pedido .passo {
          background: #fff;
          border: 1px solid #f1e6dd;
          border-radius: 10px;
          padding: 22px 20px;
          height: 100%;
          text-align: center;
      }
      .passos-pedido .numero {
          display: inline-block;
          width: 42px; height: 42px; line-height: 42px;
          border-radius: 50%;
          background: #e8932e; color: #fff;
          font-weight: 700; font-size: 18px;
          margin-bottom: 12px;
      }
      .passos-pedido h4 { margin-bottom: 8px; }
      .passos-pedido p { margin-bottom: 14px; }
      .shop-item .lower-content .categoria { color: #999; font-size: 14px; margin-bottom: 4px; }
      .sidebar-widget .texto-widget { margin-bottom: 14px; }
  </style>

  <!--Sidebar Page Container-->
  <div class="sidebar-page-container">
      <div class="auto-container">
          <div class="row clearfix">

              <!--Content Side-->
              <div class="content-side col-lg-9 col-md-12 col-sm-12">

                  {{-- Como pedir --}}
                  <div class="passos-pedido">
                      <div class="sec-title">
                          <h2>Como fazer seu pedido</h2>
                      </div>

                      <div class="row clearfix">
                          <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                              <div class="passo">
                                  <span class="numero">1</span>
                                  <h4>Pelo app</h4>
                                  <p>Monte sua sacola, use cupons, escolha entrega ou retirada e acompanhe o pedido.</p>
                                  <a href="{{ $linkApp }}" target="_blank" rel="noopener" class="theme-btn">Abrir o app</a>
                              </div>
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                              <div class="passo">
                                  <span class="numero">2</span>
                                  <h4>Pelo WhatsApp</h4>
                                  <p>Escolha um produto abaixo e toque em "Pedir pelo WhatsApp", ou fale direto com a gente.</p>
                                  <a href="{{ $linkWhatsapp('Olá! Gostaria de fazer um pedido.') }}" target="_blank" rel="noopener" class="theme-btn">Chamar no WhatsApp</a>
                              </div>
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                              <div class="passo">
                                  <span class="numero">3</span>
                                  <h4>Encomendas</h4>
                                  <p>Bolos para festas, kits e quantidades maiores: conte o que precisa e mandamos o orçamento.</p>
                                  <a href="{{ route('contato') }}#fale-conosco" class="theme-btn">Pedir orçamento</a>
                              </div>
                          </div>
                      </div>
                  </div>

                  {{-- Produtos --}}
                  <div class="our-shop">
                      <div class="shop-upper-box clearfix">
                          <div class="items-label">Mais pedidos — veja todos no <a href="{{ route('cardapio.index') }}">Cardápio</a></div>
                      </div>

                      <div class="row clearfix">
                          @forelse ($produtos as $produto)
                              <!-- Shop Item -->
                              <div class="shop-item col-lg-4 col-md-6 col-sm-12">
                                  <div class="inner-box">
                                      <div class="image-box">
                                          @if ($produto->destaque_produto === 'SIM')
                                              <div class="sale-tag">destaque</div>
                                          @endif
                                          <figure class="image">
                                              <a href="{{ route('cardapio.produto', $produto->slug_produto) }}">
                                                  <img src="{{ asset('davilla/images/' . $produto->foto_produto) }}" alt="{{ $produto->nome_produto }}">
                                              </a>
                                          </figure>
                                          <div class="btn-box">
                                              <a href="{{ $linkWhatsapp('Olá! Quero pedir: ' . $produto->nome_produto . ' (' . $formatarValor($produto->valor_produto) . ').') }}"
                                                  target="_blank" rel="noopener">Pedir pelo WhatsApp</a>
                                          </div>
                                      </div>
                                      <div class="lower-content">
                                          <div class="categoria">{{ $produto->CategoriaProduto->nome_categoria ?? '' }}</div>
                                          <h4 class="name"><a href="{{ route('cardapio.produto', $produto->slug_produto) }}">{{ $produto->nome_produto }}</a></h4>
                                          <div class="price">{{ $formatarValor($produto->valor_produto) }}</div>
                                      </div>
                                  </div>
                              </div>
                          @empty
                              <div class="col-12">
                                  <p>Nenhum produto disponível no momento.</p>
                              </div>
                          @endforelse
                      </div>
                  </div>
              </div>

              <!--Sidebar Side-->
              <div class="sidebar-side sticky-container col-lg-3 col-md-12 col-sm-12">
                  <aside class="sidebar theiaStickySidebar">
                      <div class="sticky-sidebar">

                          <!-- App -->
                          <div class="sidebar-widget">
                              <div class="widget-content">
                                  <h3 class="widget-title">Peça pelo app</h3>
                                  <p class="texto-widget">Peça em poucos toques, use cupons de desconto e acompanhe cada etapa do seu pedido.</p>
                                  <a href="{{ $linkApp }}" target="_blank" rel="noopener" class="theme-btn">Abrir o app</a>
                              </div>
                          </div>

                          <!-- WhatsApp -->
                          <div class="sidebar-widget">
                              <div class="widget-content">
                                  <h3 class="widget-title">Fale no WhatsApp</h3>
                                  <p class="texto-widget">Tire dúvidas sobre sabores, prazos e entregas.</p>
                                  <a href="{{ $linkWhatsapp('Olá! Tenho uma dúvida sobre os produtos.') }}" target="_blank" rel="noopener" class="theme-btn">Chamar no WhatsApp</a>
                              </div>
                          </div>

                          <!-- Tags Widget -->
                          <div class="sidebar-widget tags-widget">
                              <h3 class="widget-title">Categorias</h3>

                              <ul class="tag-list clearfix">
                                  @foreach($filtroCategoria->where('status_categoria', 'ATIVO') as $categoria)
                                  <li>
                                      <a href="{{ route('cardapio.categoria', $categoria->id_categoria) }}">
                                          {{ $categoria->nome_categoria }}
                                      </a>
                                  </li>
                                  @endforeach
                              </ul>
                          </div>
                      </div>
                  </aside>
              </div>
          </div>
      </div>
  </div>
  <!--End Sidebar Page Container-->
