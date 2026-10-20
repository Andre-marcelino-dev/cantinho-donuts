<!-- Cardápio com filtro (redesign animado) -->
@php
    // Categoria que já vem selecionada ('all' ou '.categoria-ID'), igual ao código anterior
    $filtroInicial = $categoriaAtiva ?? 'all';
    $whatsLoja = isset($loja['whatsapp']) ? preg_replace('/\D/', '', $loja['whatsapp']) : null;
    $porPagina = 12; // quantos produtos aparecem antes do botão "Ver mais"
@endphp

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,500;1,600&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
.fcd{--cream:#fdf6ee;--paper:#fffaf4;--choco:#2a1710;--choco-2:#4a2a1d;--rose:#e07a85;--rose-2:#b94e5c;--gold:#d9b06c;--gold-2:#f3d9a4;--text:#6e5a50;--muted:#a08d7d;--line:#ecdccb;--wa:#25d366;--wa-2:#128c4a;
  position:relative;padding:40px 0 120px;background:var(--cream);font-family:'Poppins',sans-serif;color:var(--choco);overflow:hidden;isolation:isolate}
.fcd *{box-sizing:border-box}
.fcd__blob{position:absolute;border-radius:50%;filter:blur(90px);z-index:-1;animation:fcdBlob 22s ease-in-out infinite}
.fcd__blob--1{width:460px;height:460px;background:rgba(224,122,133,.18);top:200px;right:-160px}
.fcd__blob--2{width:420px;height:420px;background:rgba(217,176,108,.18);bottom:100px;left:-160px;animation-delay:-10s}
@keyframes fcdBlob{50%{transform:translate(-50px,50px) scale(1.12)}}

/* Barra de ferramentas */
.fcd__bar{position:sticky;top:0;z-index:20;max-width:1320px;margin:0 auto 40px;padding:14px 20px}
.fcd__bar-in{display:flex;flex-direction:column;gap:16px;padding:18px;border-radius:26px;background:rgba(255,250,244,.82);
  -webkit-backdrop-filter:blur(14px);backdrop-filter:blur(14px);border:1px solid rgba(255,255,255,.9);box-shadow:0 24px 50px -32px rgba(74,42,29,.5)}
.fcd__top{display:flex;align-items:center;gap:16px;flex-wrap:wrap}
.fcd__search{position:relative;flex:1 1 280px}
.fcd__search svg{position:absolute;left:18px;top:50%;width:19px;height:19px;margin-top:-9.5px;color:var(--muted);pointer-events:none;transition:color .3s}
.fcd__search input{width:100%;height:52px;padding:0 46px 0 50px;border-radius:50px;border:1px solid var(--line);background:#fff;font-family:inherit;font-size:15px;color:var(--choco);
  outline:none;transition:border-color .3s,box-shadow .3s}
.fcd__search input::placeholder{color:var(--muted)}
.fcd__search input:focus{border-color:var(--rose);box-shadow:0 0 0 4px rgba(224,122,133,.15)}
.fcd__search input:focus~svg{color:var(--rose-2)}
.fcd__clear{position:absolute;right:10px;top:50%;width:32px;height:32px;margin-top:-16px;border:0;border-radius:50%;background:rgba(224,122,133,.12);color:var(--rose-2);
  cursor:pointer;display:none;place-items:center}
.fcd__clear svg{position:static;width:14px;height:14px;margin:0;color:inherit}
.fcd__search.has-text .fcd__clear{display:grid}
.fcd__info{font-size:13.5px;color:var(--text);white-space:nowrap}
.fcd__info b{color:var(--rose-2);font-weight:600}

.fcd__filters{display:flex;gap:10px;overflow-x:auto;padding:4px 2px 14px;margin-bottom:-10px;scrollbar-width:none;-webkit-mask:linear-gradient(90deg,#000 92%,transparent)}
.fcd__filters::-webkit-scrollbar{display:none}
.fcd__filter{position:relative;flex:none;border:0;cursor:pointer;font-family:inherit;font-size:14px;font-weight:500;color:var(--choco-2);padding:10px 18px;border-radius:50px;
  background:#fff;box-shadow:inset 0 0 0 1px var(--line);overflow:hidden;isolation:isolate;transition:color .35s,transform .35s cubic-bezier(.3,1.6,.5,1),box-shadow .35s}
.fcd__filter::before{content:"";position:absolute;inset:0;z-index:-1;border-radius:inherit;background:linear-gradient(135deg,var(--rose),var(--rose-2));transform:scale(0);
  transition:transform .45s cubic-bezier(.3,1.3,.5,1)}
.fcd__filter:hover{transform:translateY(-2px)}
.fcd__filter.is-active{color:#fff;box-shadow:0 12px 24px -12px rgba(185,78,92,.7)}
.fcd__filter.is-active::before{transform:scale(1)}
.fcd__filter span{display:inline-grid;place-items:center;min-width:22px;height:22px;margin-left:8px;padding:0 6px;border-radius:20px;font-size:11px;font-weight:600;
  background:rgba(224,122,133,.14);color:var(--rose-2);transition:background .35s,color .35s}
.fcd__filter.is-active span{background:rgba(255,255,255,.25);color:#fff}

/* Grade */
.fcd__grid{max-width:1320px;margin:0 auto;padding:0 20px;display:grid;grid-template-columns:repeat(3,1fr);gap:30px}
.fcd__item{transition:opacity .45s ease,transform .55s cubic-bezier(.3,1.3,.5,1)}
.fcd__item.is-hidden{display:none}
#fcd .fcd__item.is-out{opacity:0;transform:scale(.9) translateY(20px)}

.fcd__card{position:relative;height:100%;display:flex;flex-direction:column;background:var(--paper);border-radius:28px;overflow:hidden;
  box-shadow:0 26px 50px -32px rgba(74,42,29,.5);transition:transform .55s cubic-bezier(.3,1.4,.5,1),box-shadow .5s}
.fcd__card:hover{transform:translateY(-10px);box-shadow:0 40px 70px -32px rgba(74,42,29,.62)}
.fcd__media{position:relative;display:block;text-decoration:none;aspect-ratio:4/3;overflow:hidden;background:linear-gradient(135deg,#f3c6c9,#f3d9a4)}
.fcd__media img{width:100%;height:100%;object-fit:cover;display:block;color:transparent;transition:transform 1.1s cubic-bezier(.2,.7,.2,1),filter .8s}
.fcd__card:hover .fcd__media img{transform:scale(1.12) rotate(1deg);filter:saturate(1.1)}
.fcd__media::after{content:"";position:absolute;inset:0;background:linear-gradient(180deg,transparent 50%,rgba(42,23,16,.4));opacity:.7;transition:opacity .5s}
.fcd__card:hover .fcd__media::after{opacity:1}
.fcd__view{position:absolute;z-index:2;left:50%;top:50%;width:96px;height:96px;margin:-48px 0 0 -48px;display:grid;place-items:center;
  opacity:0;transform:scale(.4) rotate(-90deg);transition:opacity .5s,transform .8s cubic-bezier(.3,1.5,.5,1)}
.fcd__card:hover .fcd__view{opacity:1;transform:none}
.fcd__view svg.ring{position:absolute;inset:0;width:100%;height:100%;fill:none;stroke:var(--gold-2);stroke-width:2;stroke-dasharray:6 7;animation:fcdSpin 12s linear infinite}
.fcd__view span{width:58px;height:58px;border-radius:50%;background:#fff;color:var(--rose-2);display:grid;place-items:center;box-shadow:0 10px 24px -8px rgba(0,0,0,.45)}
.fcd__view span svg{width:24px;height:24px}
@keyframes fcdSpin{to{transform:rotate(360deg)}}
.fcd__cat{position:absolute;z-index:2;left:14px;top:14px;padding:6px 12px;border-radius:30px;font-size:10.5px;font-weight:600;letter-spacing:.16em;text-transform:uppercase;
  color:#fff;background:rgba(42,23,16,.35);-webkit-backdrop-filter:blur(8px);backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,.25)}

.fcd__body{display:flex;flex-direction:column;flex:1;padding:22px 24px 24px}
.fcd__name{font-family:'Playfair Display',serif;font-weight:700;font-size:23px;line-height:1.25;margin:0 0 8px}
.fcd__name a{color:var(--choco);text-decoration:none;background:linear-gradient(var(--rose),var(--rose)) 0 100%/0 2px no-repeat;transition:background-size .5s,color .3s}
.fcd__name a:hover{color:var(--rose-2);background-size:100% 2px}
.fcd__desc{font-size:14px;line-height:1.65;color:var(--text);margin:0 0 20px}
.fcd__foot{margin-top:auto;display:flex;align-items:center;justify-content:space-between;gap:12px;padding-top:16px;border-top:1.5px dashed var(--line)}
.fcd__price{display:flex;align-items:flex-start;gap:3px;font-family:'Playfair Display',serif;font-weight:800;line-height:1;color:var(--rose-2)}
.fcd__price small{font-family:'Poppins',sans-serif;font-size:13px;font-weight:600;margin-top:4px}
.fcd__price b{font-size:30px;font-weight:800}
.fcd__price--ask{font-family:'Poppins',sans-serif;font-size:13px;font-weight:600;color:var(--muted)}
.fcd__actions{display:flex;gap:8px}
.fcd__btn{width:44px;height:44px;border-radius:50%;display:grid;place-items:center;text-decoration:none;transition:transform .35s cubic-bezier(.3,1.6,.5,1),box-shadow .35s,background .3s,color .3s}
.fcd__btn svg{width:20px;height:20px}
.fcd__btn--wa{color:#fff;background:linear-gradient(135deg,var(--wa),var(--wa-2));box-shadow:0 10px 20px -10px rgba(18,140,74,.8)}
.fcd__btn--wa:hover{color:#fff;transform:translateY(-3px) rotate(-10deg)}
.fcd__btn--go{color:var(--choco);background:#fff;box-shadow:inset 0 0 0 1px var(--line)}
.fcd__btn--go:hover{color:#fff;background:var(--rose-2);box-shadow:none;transform:translateY(-3px)}
.fcd__btn--go:hover svg{animation:fcdNudge .6s ease}
@keyframes fcdNudge{50%{transform:translateX(4px)}}

/* Vazio e Ver mais */
.fcd__empty{display:none;max-width:480px;margin:20px auto 0;text-align:center;padding:40px 24px;border-radius:26px;border:1.5px dashed var(--line);background:rgba(255,255,255,.6)}
.fcd__empty.is-on{display:block;animation:fcdPop .6s cubic-bezier(.3,1.5,.5,1)}
.fcd__empty svg{width:54px;height:54px;color:var(--rose);margin-bottom:12px;animation:fcdBob 3s ease-in-out infinite}
.fcd__empty h3{font-family:'Playfair Display',serif;font-size:22px;margin:0 0 6px}
.fcd__empty p{margin:0;font-size:14.5px;color:var(--text)}
@keyframes fcdPop{from{opacity:0;transform:scale(.9)}}
@keyframes fcdBob{50%{transform:translateY(-8px)}}
.fcd__more-wrap{text-align:center;margin-top:56px}
.fcd__more{position:relative;display:inline-flex;align-items:center;gap:12px;padding:17px 34px;border:0;border-radius:60px;cursor:pointer;overflow:hidden;
  font-family:inherit;font-size:15px;font-weight:600;color:#fff;background:linear-gradient(135deg,var(--choco-2),var(--choco));box-shadow:0 18px 40px -14px rgba(42,23,16,.7);
  transition:transform .35s cubic-bezier(.3,1.6,.5,1),box-shadow .35s}
.fcd__more:hover{transform:translateY(-3px);box-shadow:0 24px 50px -14px rgba(42,23,16,.85)}
.fcd__more svg{width:18px;height:18px;transition:transform .4s}
.fcd__more:hover svg{transform:translateY(3px)}
.fcd__more small{font-weight:400;opacity:.7}
.fcd__more[hidden]{display:none}

/* Revelar */
.fcd--js [data-reveal]{opacity:0;transform:translateY(50px) scale(.96);transition:opacity .9s cubic-bezier(.2,.7,.2,1) var(--d,0s),transform .9s cubic-bezier(.2,.7,.2,1) var(--d,0s)}
.fcd--js [data-reveal].is-in{opacity:1;transform:none}

@media (max-width:1100px){.fcd__grid{grid-template-columns:repeat(2,1fr)}}
@media (max-width:640px){
  .fcd{padding:20px 0 90px}
  .fcd__bar{padding:10px 12px;margin-bottom:28px}
  .fcd__bar-in{padding:14px;border-radius:22px}
  .fcd__info{width:100%;text-align:center}
  .fcd__grid{grid-template-columns:1fr;padding:0 16px;gap:22px}
}
@media (hover:none){.fcd__view{display:none}}
@media (prefers-reduced-motion:reduce){
  .fcd *,.fcd *::before,.fcd *::after{animation:none!important;transition:none!important}
  .fcd--js [data-reveal]{opacity:1;transform:none}
}
</style>

<section class="fcd" id="fcd" data-start="{{ $filtroInicial }}" data-per-page="{{ $porPagina }}">
    <div class="fcd__blob fcd__blob--1"></div>
    <div class="fcd__blob fcd__blob--2"></div>

    <!-- Busca e filtros -->
    <div class="fcd__bar">
        <div class="fcd__bar-in">
            <div class="fcd__top">
                <label class="fcd__search">
                    <input type="search" placeholder="Buscar doce pelo nome..." aria-label="Buscar no cardápio" autocomplete="off">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="M20 20l-3.5-3.5"/></svg>
                    <button type="button" class="fcd__clear" aria-label="Limpar busca"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M6 6l12 12M18 6L6 18"/></svg></button>
                </label>
                <span class="fcd__info" aria-live="polite"><b class="fcd__count">{{ $listaProduto->count() }}</b> doces no cardápio</span>
            </div>
            <div class="fcd__filters" role="tablist" aria-label="Filtrar por categoria">
                <button type="button" class="fcd__filter" data-filter="all">Todos<span>{{ $listaProduto->count() }}</span></button>
                @foreach ($filtroCategoria as $linha)
                    <button type="button" class="fcd__filter" data-filter=".categoria-{{ $linha->id_categoria }}">
                        {{ $linha->nome_categoria }}<span>{{ $listaProduto->where('id_categoria', $linha->id_categoria)->count() }}</span>
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Produtos -->
    <div class="fcd__grid">
        @foreach ($listaProduto as $linha)
            @php
                $linkProduto = route('cardapio.produto', $linha->slug_produto);
                $valor = (float) $linha->valor_produto;
                $categoriaProduto = $filtroCategoria->firstWhere('id_categoria', $linha->id_categoria)->nome_categoria ?? null;
            @endphp
            <div class="fcd__item categoria-{{ $linha->id_categoria }}" data-cat=".categoria-{{ $linha->id_categoria }}"
                data-name="{{ \Illuminate\Support\Str::lower(\Illuminate\Support\Str::ascii($linha->nome_produto . ' ' . $categoriaProduto)) }}"
                data-reveal style="--d:{{ ($loop->index % 3) * 0.1 }}s">
                <article class="fcd__card">
                    <a href="{{ $linkProduto }}" class="fcd__media" aria-label="Ver {{ $linha->nome_produto }}">
                        <img src="{{ asset('davilla/images/' . $linha->foto_produto) }}" alt="{{ $linha->nome_produto }}" loading="lazy">
                        @if ($categoriaProduto)
                            <span class="fcd__cat">{{ $categoriaProduto }}</span>
                        @endif
                        <span class="fcd__view" aria-hidden="true">
                            <svg class="ring" viewBox="0 0 100 100"><circle cx="50" cy="50" r="47"/></svg>
                            <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg></span>
                        </span>
                    </a>
                    <div class="fcd__body">
                        <h3 class="fcd__name"><a href="{{ $linkProduto }}">{{ $linha->nome_produto }}</a></h3>
                        @if ($linha->descricao_produto)
                            <p class="fcd__desc">{{ \Illuminate\Support\Str::limit($linha->descricao_produto, 100) }}</p>
                        @endif
                        <div class="fcd__foot">
                            @if ($valor > 0)
                                <span class="fcd__price"><small>R$</small><b>{{ number_format($valor, 2, ',', '.') }}</b></span>
                            @else
                                <span class="fcd__price--ask">Preço sob consulta</span>
                            @endif
                            <span class="fcd__actions">
                                @if ($whatsLoja)
                                    <a href="https://wa.me/{{ $whatsLoja }}?text={{ rawurlencode('Olá! Gostaria de encomendar: ' . $linha->nome_produto) }}"
                                        target="_blank" rel="noopener" class="fcd__btn fcd__btn--wa" aria-label="Encomendar {{ $linha->nome_produto }} pelo WhatsApp">
                                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.5 14.4c-.3-.1-1.8-.9-2-1-.3-.1-.5-.1-.7.1-.2.3-.8 1-.9 1.2-.2.2-.3.2-.6.1-.3-.1-1.3-.5-2.4-1.5-.9-.8-1.5-1.8-1.7-2.1-.2-.3 0-.5.1-.6l.4-.5c.2-.2.2-.3.3-.5.1-.2 0-.4 0-.5l-.9-2.2c-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.5s1.1 2.9 1.2 3.1c.1.2 2.1 3.2 5.1 4.5.7.3 1.3.5 1.7.6.7.2 1.4.2 1.9.1.6-.1 1.8-.7 2-1.4.3-.7.3-1.3.2-1.4-.1-.2-.3-.3-.6-.4zM12 21.8c-1.8 0-3.5-.5-5-1.4l-.4-.2-3.7 1 1-3.6-.2-.4c-1-1.6-1.5-3.4-1.5-5.2C2.2 6.6 6.6 2.2 12 2.2c2.6 0 5.1 1 6.9 2.9 1.9 1.9 2.9 4.3 2.9 6.9 0 5.4-4.4 9.8-9.8 9.8zm8.4-18.2C18.2 1.3 15.2 0 12 0 5.4 0 0 5.4 0 12c0 2.1.6 4.2 1.6 6L0 24l6.2-1.6c1.8 1 3.8 1.5 5.8 1.5 6.6 0 12-5.4 12-12 0-3.2-1.2-6.2-3.6-8.3z"/></svg>
                                    </a>
                                @endif
                                <a href="{{ $linkProduto }}" class="fcd__btn fcd__btn--go" aria-label="Ver detalhes de {{ $linha->nome_produto }}">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                                </a>
                            </span>
                        </div>
                    </div>
                </article>
            </div>
        @endforeach
    </div>

    <div class="fcd__empty" role="status">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="M20 20l-3.5-3.5"/><path d="M8.5 11h5"/></svg>
        <h3>Nenhum doce encontrado</h3>
        <p>Tente outro nome ou escolha outra categoria.</p>
    </div>

    <div class="fcd__more-wrap">
        <button type="button" class="fcd__more" hidden>
            Ver mais doces <small class="fcd__left"></small>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M6 13l6 6 6-6"/></svg>
        </button>
    </div>
</section>

<script>
(function () {
    var root = document.getElementById('fcd');
    if (!root) return;
    root.classList.add('fcd--js');
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var items = Array.prototype.slice.call(root.querySelectorAll('.fcd__item'));
    var filters = root.querySelectorAll('.fcd__filter');
    var input = root.querySelector('.fcd__search input');
    var searchBox = root.querySelector('.fcd__search');
    var countEl = root.querySelector('.fcd__count');
    var info = root.querySelector('.fcd__info');
    var empty = root.querySelector('.fcd__empty');
    var more = root.querySelector('.fcd__more');
    var left = root.querySelector('.fcd__left');
    var perPage = parseInt(root.dataset.perPage, 10) || 12;

    var state = { filter: root.dataset.start || 'all', q: '', limit: perPage };
    if (!root.querySelector('.fcd__filter[data-filter="' + state.filter + '"]')) state.filter = 'all';

    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('is-in'); io.unobserve(e.target); } });
    }, { threshold: 0.1 });

    function norm(s) { return (s || '').toLowerCase().normalize('NFD').replace(/[̀-ͯ]/g, ''); }

    function apply(animate) {
        filters.forEach(function (f) { f.classList.toggle('is-active', f.dataset.filter === state.filter); });
        var q = norm(state.q.trim());
        var matches = items.filter(function (it) {
            return (state.filter === 'all' || it.dataset.cat === state.filter) && (!q || it.dataset.name.indexOf(q) !== -1);
        });

        function render() {
            var shown = 0;
            items.forEach(function (it) {
                var idx = matches.indexOf(it);
                var visible = idx !== -1 && idx < state.limit;
                it.classList.toggle('is-hidden', !visible);
                if (visible) {
                    if (animate && !reduce) { it.classList.add('is-in', 'is-out'); it.style.transitionDelay = (shown % perPage) * 0.05 + 's'; }
                    else io.observe(it);
                    shown++;
                }
            });
            if (animate && !reduce) {
                requestAnimationFrame(function () { requestAnimationFrame(function () {
                    items.forEach(function (it) { it.classList.remove('is-out'); });
                    setTimeout(function () { items.forEach(function (it) { it.style.transitionDelay = ''; }); }, 900);
                }); });
            }
            countEl.textContent = matches.length;
            info.lastChild.textContent = matches.length === 1 ? ' doce encontrado' : (q || state.filter !== 'all' ? ' doces encontrados' : ' doces no cardápio');
            empty.classList.toggle('is-on', matches.length === 0);
            var rest = matches.length - state.limit;
            more.hidden = rest <= 0;
            if (rest > 0) left.textContent = '(+' + rest + ')';
        }

        if (animate && !reduce) {
            items.forEach(function (it) { if (!it.classList.contains('is-hidden')) it.classList.add('is-out'); });
            setTimeout(render, 320);
        } else render();
    }

    filters.forEach(function (f) {
        f.addEventListener('click', function () {
            if (state.filter === f.dataset.filter) return;
            state.filter = f.dataset.filter; state.limit = perPage;
            f.scrollIntoView({ behavior: reduce ? 'auto' : 'smooth', block: 'nearest', inline: 'center' });
            apply(true);
        });
    });

    var t;
    input.addEventListener('input', function () {
        searchBox.classList.toggle('has-text', !!input.value);
        clearTimeout(t);
        t = setTimeout(function () { state.q = input.value; state.limit = perPage; apply(true); }, 250);
    });
    root.querySelector('.fcd__clear').addEventListener('click', function () {
        input.value = ''; searchBox.classList.remove('has-text'); state.q = ''; apply(true); input.focus();
    });

    more.addEventListener('click', function () {
        var before = state.limit;
        state.limit += perPage;
        apply(false);
        var firstNew = items.filter(function (it) { return !it.classList.contains('is-hidden'); })[before];
        if (firstNew) firstNew.scrollIntoView({ behavior: reduce ? 'auto' : 'smooth', block: 'center' });
    });

    apply(false);
})();
</script>
<!-- End Cardápio -->