<!-- Portfolio Section (redesign animado) -->
@if ($listaProduto->count() > 0)
@php
    $categoriasVitrine = $listaProduto->pluck('descricao_categoria')->filter()->unique()->values();
@endphp

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,500;1,600&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
.fsp{--cream:#fdf6ee;--choco:#2a1710;--choco-2:#4a2a1d;--rose:#e07a85;--rose-2:#b94e5c;--gold:#d9b06c;--gold-2:#f3d9a4;--text:#6e5a50;
  position:relative;padding:120px 0 130px;background:var(--cream);font-family:'Poppins',sans-serif;color:var(--choco);overflow:hidden;isolation:isolate}
.fsp *{box-sizing:border-box}
.fsp__blob{position:absolute;border-radius:50%;filter:blur(90px);z-index:-1;animation:fspBlob 22s ease-in-out infinite}
.fsp__blob--1{width:460px;height:460px;background:rgba(224,122,133,.2);top:-150px;right:-120px}
.fsp__blob--2{width:420px;height:420px;background:rgba(217,176,108,.2);bottom:-160px;left:-140px;animation-delay:-10s}
@keyframes fspBlob{50%{transform:translate(-50px,50px) scale(1.12)}}

/* Cabeçalho */
.fsp__head{text-align:center;max-width:700px;margin:0 auto 46px;padding:0 16px}
.fsp__eyebrow{display:inline-flex;align-items:center;gap:14px;font-size:13px;font-weight:600;letter-spacing:.32em;text-transform:uppercase;color:var(--rose-2)}
.fsp__eyebrow::before,.fsp__eyebrow::after{content:"";height:1px;width:0;background:var(--rose);transition:width 1.2s cubic-bezier(.2,.7,.2,1) .2s}
.fsp__eyebrow.is-in::before,.fsp__eyebrow.is-in::after{width:46px}
.fsp__title{font-family:'Playfair Display',serif;font-weight:800;font-size:clamp(38px,5.4vw,62px);line-height:1.06;letter-spacing:-.02em;margin:20px 0 16px}
.fsp__title em{font-style:italic;font-weight:600;background:linear-gradient(90deg,var(--rose-2),var(--rose),var(--gold),var(--rose-2));background-size:300% 100%;
  -webkit-background-clip:text;background-clip:text;color:transparent;animation:fspShine 6s linear infinite}
@keyframes fspShine{to{background-position:300% 0}}
.fsp__sub{font-size:17px;line-height:1.7;color:var(--text);margin:0;font-weight:300}

/* Filtros */
.fsp__filters{display:flex;flex-wrap:wrap;justify-content:center;gap:10px;margin:0 auto 54px;padding:0 16px;max-width:1000px}
.fsp__filter{position:relative;border:0;cursor:pointer;font-family:inherit;font-size:14px;font-weight:500;color:var(--choco-2);padding:11px 22px;border-radius:50px;
  background:#fff;box-shadow:0 8px 22px -14px rgba(74,42,29,.45),inset 0 0 0 1px rgba(224,122,133,.18);overflow:hidden;isolation:isolate;
  transition:color .35s,transform .35s cubic-bezier(.3,1.6,.5,1),box-shadow .35s}
.fsp__filter::before{content:"";position:absolute;inset:0;z-index:-1;border-radius:inherit;background:linear-gradient(135deg,var(--rose),var(--rose-2));
  transform:scale(0);transition:transform .45s cubic-bezier(.3,1.3,.5,1)}
.fsp__filter:hover{transform:translateY(-2px)}
.fsp__filter.is-active{color:#fff;box-shadow:0 14px 28px -12px rgba(185,78,92,.7)}
.fsp__filter.is-active::before{transform:scale(1)}
.fsp__filter span{display:inline-grid;place-items:center;min-width:22px;height:22px;margin-left:8px;padding:0 6px;border-radius:20px;font-size:11px;font-weight:600;
  background:rgba(224,122,133,.14);color:var(--rose-2);transition:background .35s,color .35s}
.fsp__filter.is-active span{background:rgba(255,255,255,.25);color:#fff}

/* Grade */
.fsp__grid{max-width:1400px;margin:0 auto;padding:0 24px;display:grid;grid-template-columns:repeat(4,1fr);gap:26px;perspective:1400px}
.fsp__item{transition:opacity .45s ease,transform .55s cubic-bezier(.3,1.3,.5,1)}
#fsp .fsp__item.is-out{opacity:0;transform:scale(.85) translateY(20px);pointer-events:none}
.fsp__item.is-hidden{display:none}

.fsp__card{position:relative;display:block;aspect-ratio:4/5;border-radius:26px;overflow:hidden;text-decoration:none;color:#fff;isolation:isolate;
  background:linear-gradient(135deg,#f3c6c9,#f3d9a4);box-shadow:0 26px 50px -28px rgba(74,42,29,.55);
  transform-style:preserve-3d;transition:transform .2s ease-out,box-shadow .5s;--mx:50%;--my:50%}
.fsp__card:hover{text-decoration:none;color:#fff;box-shadow:0 40px 70px -30px rgba(74,42,29,.7)}
.fsp__card img{position:absolute;inset:0;color:transparent;font-size:0;width:100%;height:100%;object-fit:cover;transform:scale(1.04);transition:transform 1.1s cubic-bezier(.2,.7,.2,1),filter .8s}
.fsp__card:hover img{transform:scale(1.16) rotate(1deg);filter:saturate(1.15)}
.fsp__card::before{content:"";position:absolute;inset:0;z-index:1;transition:opacity .6s;
  background:linear-gradient(180deg,rgba(42,23,16,0) 35%,rgba(42,23,16,.55) 70%,rgba(42,23,16,.92) 100%)}
.fsp__card::after{content:"";position:absolute;inset:0;z-index:2;opacity:0;transition:opacity .4s;pointer-events:none;
  background:radial-gradient(380px circle at var(--mx) var(--my),rgba(255,255,255,.28),transparent 45%)}
.fsp__card:hover::after{opacity:1}
.fsp__veil{position:absolute;inset:0;z-index:1;background:linear-gradient(160deg,rgba(224,122,133,.55),rgba(74,42,29,.75));opacity:0;transition:opacity .6s}
.fsp__card:hover .fsp__veil{opacity:1}

/* Anel central */
.fsp__ring{position:absolute;z-index:3;top:38%;left:50%;width:110px;height:110px;margin:-55px 0 0 -55px;display:grid;place-items:center;
  opacity:0;transform:scale(.4) rotate(-90deg);transition:opacity .5s,transform .8s cubic-bezier(.3,1.5,.5,1)}
.fsp__card:hover .fsp__ring{opacity:1;transform:scale(1) rotate(0)}
.fsp__ring svg.circ{position:absolute;inset:0;width:100%;height:100%;fill:var(--gold-2);animation:fspSpin 10s linear infinite}
.fsp__ring .eye{width:58px;height:58px;border-radius:50%;background:#fff;color:var(--rose-2);display:grid;place-items:center;box-shadow:0 10px 24px -8px rgba(0,0,0,.45)}
.fsp__ring .eye svg{width:24px;height:24px}
@keyframes fspSpin{to{transform:rotate(360deg)}}

/* Conteúdo */
.fsp__body{position:absolute;z-index:3;left:0;right:0;bottom:0;padding:24px 24px 22px;transform:translateZ(40px)}
.fsp__cat{display:inline-block;padding:5px 12px;border-radius:30px;font-size:10.5px;font-weight:600;letter-spacing:.18em;text-transform:uppercase;
  background:rgba(255,255,255,.18);-webkit-backdrop-filter:blur(8px);backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,.25);color:#fff;margin-bottom:10px}
.fsp__name{font-family:'Playfair Display',serif;font-weight:700;font-size:23px;line-height:1.2;margin:0;color:#fff;transition:transform .5s cubic-bezier(.2,.7,.2,1)}
.fsp__more{display:flex;align-items:center;gap:8px;font-size:13px;font-weight:600;letter-spacing:.04em;color:var(--gold-2);
  max-height:0;opacity:0;overflow:hidden;transform:translateY(10px);transition:max-height .5s,opacity .4s,transform .5s cubic-bezier(.2,.7,.2,1),margin .5s}
.fsp__more svg{width:16px;height:16px;transition:transform .4s}
.fsp__card:hover .fsp__more{max-height:30px;opacity:1;transform:none;margin-top:12px}
.fsp__card:hover .fsp__more svg{transform:translateX(5px)}

/* Revelar */
.fsp--js [data-reveal]{opacity:0;transform:translateY(50px);transition:opacity 1s cubic-bezier(.2,.7,.2,1) var(--d,0s),transform 1s cubic-bezier(.2,.7,.2,1) var(--d,0s)}
.fsp--js [data-reveal].is-in{opacity:1;transform:none}
.fsp--js .fsp__item[data-reveal]{transform:translateY(60px) scale(.94)}
.fsp--js .fsp__item[data-reveal].is-in{transform:none}

.fsp__empty{display:none;text-align:center;color:var(--text);padding:30px 16px;font-size:15px}
.fsp__empty.is-on{display:block}

@media (max-width:1199px){.fsp__grid{grid-template-columns:repeat(3,1fr)}}
@media (max-width:860px){.fsp__grid{grid-template-columns:repeat(2,1fr);gap:18px;padding:0 16px}.fsp__name{font-size:19px}.fsp__body{padding:18px}}
@media (max-width:520px){
  .fsp{padding:90px 0 100px}
  .fsp__grid{grid-template-columns:1fr}
  .fsp__filters{flex-wrap:nowrap;justify-content:flex-start;overflow-x:auto;padding-bottom:8px;scrollbar-width:none}
  .fsp__filters::-webkit-scrollbar{display:none}
  .fsp__filter{flex:none}
}
@media (hover:none){
  .fsp__more{max-height:30px;opacity:1;transform:none;margin-top:12px}
}
@media (prefers-reduced-motion:reduce){
  .fsp *,.fsp *::before,.fsp *::after{animation:none!important;transition:none!important}
  .fsp--js [data-reveal]{opacity:1;transform:none}
}
</style>

<section class="fsp" id="fsp">
    <div class="fsp__blob fsp__blob--1"></div>
    <div class="fsp__blob fsp__blob--2"></div>

    <div class="fsp__head">
        <span class="fsp__eyebrow" data-reveal>Nossa vitrine</span>
        <h2 class="fsp__title" data-reveal style="--d:.1s">Nossos <em>doces trabalhos</em></h2>
        <p class="fsp__sub" data-reveal style="--d:.2s">Cada criação é feita à mão, com carinho e ingredientes selecionados. Escolha o seu favorito.</p>
    </div>

    @if ($categoriasVitrine->count() > 1)
        <div class="fsp__filters" data-reveal style="--d:.3s" role="tablist" aria-label="Filtrar por categoria">
            <button type="button" class="fsp__filter is-active" data-filter="*">Todos<span>{{ $listaProduto->count() }}</span></button>
            @foreach ($categoriasVitrine as $categoria)
                <button type="button" class="fsp__filter" data-filter="{{ \Illuminate\Support\Str::slug($categoria) }}">
                    {{ $categoria }}<span>{{ $listaProduto->where('descricao_categoria', $categoria)->count() }}</span>
                </button>
            @endforeach
        </div>
    @endif

    <div class="fsp__grid">
        @foreach ($listaProduto as $linha)
            <div class="fsp__item" data-reveal data-cat="{{ \Illuminate\Support\Str::slug($linha->descricao_categoria) }}" style="--d:{{ ($loop->index % 4) * 0.1 }}s">
                <a href="{{ route('cardapio.produto', $linha->slug_produto) }}" class="fsp__card">
                    <img src="{{ asset('davilla/images/' . $linha->foto_produto) }}" alt="{{ $linha->nome_produto }}" loading="lazy">
                    <div class="fsp__veil"></div>

                    <div class="fsp__ring" aria-hidden="true">
                        <svg class="circ" viewBox="0 0 300 300"><path d="M284.9,154.4c-0.3,75.9-57.6,133.1-133.4,133.2c-36.6,0-70.7-13.3-96-37.5 c-26-24.8-40.4-59-40.4-96.3C15.1,75.9,75.6,12.4,150,12.4c3.3,0,6,2.7,6,6c0,3.3-2.7,6-6,6C82.2,24.4,27,82.4,27,153.8 c0,69.5,53.5,121.9,124.5,121.9c69.1,0,121.3-52.3,121.4-121.6c-0.2-62.6-51.2-113.4-113.8-113.3c-62.7,0-113.8,51.1-113.7,113.8 c0,3.3-2.7,6-6,6c-3.3,0-6-2.7-6-6c0-69.3,56.3-125.7,125.7-125.7c69.1,0,125.3,55.9,125.7,124.9h0L284.9,154.4z"/></svg>
                        <span class="eye"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg></span>
                    </div>

                    <div class="fsp__body">
                        @if ($linha->descricao_categoria)
                            <span class="fsp__cat">{{ $linha->descricao_categoria }}</span>
                        @endif
                        <h3 class="fsp__name">{{ $linha->nome_produto }}</h3>
                        <span class="fsp__more">Ver detalhes
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                        </span>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <p class="fsp__empty">Nenhum doce nesta categoria no momento.</p>
</section>

<script>
(function () {
    var root = document.getElementById('fsp');
    if (!root) return;
    root.classList.add('fsp--js');
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // Revelar ao rolar
    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) {
            if (e.isIntersecting) { e.target.classList.add('is-in'); io.unobserve(e.target); }
        });
    }, { threshold: 0.12 });
    root.querySelectorAll('[data-reveal]').forEach(function (el) { io.observe(el); });

    // Filtro por categoria
    var items = Array.prototype.slice.call(root.querySelectorAll('.fsp__item'));
    var empty = root.querySelector('.fsp__empty'), timer;
    root.querySelectorAll('.fsp__filter').forEach(function (btn) {
        btn.addEventListener('click', function () {
            root.querySelectorAll('.fsp__filter').forEach(function (b) { b.classList.remove('is-active'); });
            btn.classList.add('is-active');
            var f = btn.dataset.filter;
            items.forEach(function (it) { it.classList.add('is-in'); if (!it.classList.contains('is-hidden')) it.classList.add('is-out'); });
            clearTimeout(timer);
            timer = setTimeout(function () {
                var shown = 0;
                items.forEach(function (it) {
                    var match = f === '*' || it.dataset.cat === f;
                    it.classList.toggle('is-hidden', !match);
                    if (match) {
                        it.style.transitionDelay = reduce ? '0s' : (shown * 0.06) + 's';
                        shown++;
                    }
                });
                requestAnimationFrame(function () {
                    requestAnimationFrame(function () {
                        items.forEach(function (it) { if (!it.classList.contains('is-hidden')) it.classList.remove('is-out'); });
                    });
                });
                setTimeout(function () { items.forEach(function (it) { it.style.transitionDelay = ''; }); }, 900);
                if (empty) empty.classList.toggle('is-on', shown === 0);
            }, reduce ? 0 : 380);
        });
    });

    // Efeito 3D + brilho seguindo o mouse
    if (!reduce && window.matchMedia('(hover: hover)').matches) {
        root.querySelectorAll('.fsp__card').forEach(function (c) {
            c.addEventListener('mousemove', function (ev) {
                var r = c.getBoundingClientRect(),
                    x = (ev.clientX - r.left) / r.width,
                    y = (ev.clientY - r.top) / r.height;
                c.style.setProperty('--mx', (x * 100) + '%');
                c.style.setProperty('--my', (y * 100) + '%');
                c.style.transform = 'rotateX(' + ((0.5 - y) * 10) + 'deg) rotateY(' + ((x - 0.5) * 10) + 'deg) translateY(-8px)';
            });
            c.addEventListener('mouseleave', function () {
                c.style.transition = 'transform .7s cubic-bezier(.2,.7,.2,1), box-shadow .5s';
                c.style.transform = '';
                setTimeout(function () { c.style.transition = ''; }, 700);
            });
        });
    }
})();
</script>
@endif
<!-- End Portfolio Section -->