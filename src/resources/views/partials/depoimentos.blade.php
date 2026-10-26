{{-- Depoimentos aprovados no painel (Conteúdo do Site → Depoimentos).
     Usado na Home e na página Sobre. $depoimentosSite vem do AppServiceProvider. --}}
@php
    $fundoDepoimentos = conteudo_img('geral.depoimentos.imagem_fundo');

    $totalDepo = $depoimentosSite->count();
    $mediaDepo = $totalDepo ? round($depoimentosSite->avg(fn ($d) => max(1, min(5, (int) $d->nota_depoimento))), 1) : 0;
    $coresAvatar = ['#e07a85', '#d9b06c', '#b94e5c', '#8a5a44', '#c98b8f', '#b8893f'];
@endphp

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,500;1,600&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
.fst{--cream:#fdf6ee;--choco:#2a1710;--choco-2:#4a2a1d;--rose:#e07a85;--rose-2:#b94e5c;--gold:#d9b06c;--gold-2:#f3d9a4;--star:#f5b942;
  position:relative;padding:130px 16px 130px;font-family:'Poppins',sans-serif;color:#fff;overflow:hidden;isolation:isolate;background:var(--choco)}
.fst *{box-sizing:border-box}
.fst__bg{position:absolute;inset:-10% 0;z-index:-3;background-size:cover;background-position:center;will-change:transform}
.fst__overlay{position:absolute;inset:0;z-index:-2;background:radial-gradient(ellipse at 50% 40%,rgba(74,42,29,.72),rgba(42,23,16,.96) 70%)}
.fst__blob{position:absolute;border-radius:50%;filter:blur(90px);z-index:-1;animation:fstBlob 20s ease-in-out infinite}
.fst__blob--1{width:420px;height:420px;background:rgba(224,122,133,.3);top:-120px;left:-100px}
.fst__blob--2{width:380px;height:380px;background:rgba(217,176,108,.25);bottom:-120px;right:-80px;animation-delay:-9s}
@keyframes fstBlob{50%{transform:translate(60px,40px) scale(1.15)}}

/* Cabeçalho */
.fst__head{text-align:center;max-width:720px;margin:0 auto 56px}
.fst__eyebrow{display:inline-flex;align-items:center;gap:14px;font-size:13px;font-weight:600;letter-spacing:.32em;text-transform:uppercase;color:var(--gold-2)}
.fst__eyebrow::before,.fst__eyebrow::after{content:"";height:1px;width:0;background:var(--gold);transition:width 1.2s cubic-bezier(.2,.7,.2,1) .2s}
.fst__eyebrow.is-in::before,.fst__eyebrow.is-in::after{width:46px}
.fst__title{font-family:'Playfair Display',serif;font-weight:800;font-size:clamp(36px,5.2vw,58px);line-height:1.08;letter-spacing:-.02em;margin:20px 0 14px;color:#fff}
.fst__title em{font-style:italic;font-weight:600;background:linear-gradient(90deg,var(--gold-2),var(--rose),var(--gold),var(--gold-2));background-size:300% 100%;
  -webkit-background-clip:text;background-clip:text;color:transparent;animation:fstShine 6s linear infinite}
@keyframes fstShine{to{background-position:300% 0}}
.fst__sub{font-size:16px;line-height:1.7;color:rgba(255,255,255,.7);margin:0;font-weight:300}

/* Resumo da nota */
.fst__summary{display:inline-flex;align-items:center;gap:18px;margin-top:28px;padding:12px 24px 12px 14px;border-radius:60px;
  background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.14);-webkit-backdrop-filter:blur(10px);backdrop-filter:blur(10px)}
.fst__score{width:58px;height:58px;border-radius:50%;display:grid;place-items:center;font-family:'Playfair Display',serif;font-weight:800;font-size:22px;color:var(--choco);
  background:linear-gradient(135deg,var(--gold-2),var(--gold));box-shadow:0 10px 24px -8px rgba(217,176,108,.7)}
.fst__summary-txt{text-align:left}
.fst__summary-txt small{display:block;font-size:12px;color:rgba(255,255,255,.6);margin-top:3px}

/* Estrelas */
.fst__stars{display:inline-flex;gap:4px}
.fst__stars svg{width:20px;height:20px;fill:rgba(255,255,255,.18)}
.fst__stars svg.on{fill:var(--star)}
.fst__stars--lg svg{width:26px;height:26px}
.fst__slide .fst__stars svg.on{transform:scale(0) rotate(-90deg)}
.fst__slide.is-active .fst__stars svg.on{transform:none;transition:transform .6s cubic-bezier(.3,1.8,.5,1) calc(var(--s) * 90ms + .25s);filter:drop-shadow(0 0 8px rgba(245,185,66,.55))}

/* Palco do depoimento */
.fst__stage{position:relative;max-width:900px;margin:0 auto;text-align:center}
.fst__quote{position:absolute;top:-96px;left:50%;transform:translateX(-50%);width:120px;height:120px;fill:rgba(243,217,164,.12);animation:fstFloat 6s ease-in-out infinite;pointer-events:none}
@keyframes fstFloat{50%{transform:translateX(-50%) translateY(-10px) rotate(-4deg)}}
.fst__slides{display:grid}
.fst__slide{grid-area:1/1;display:flex;flex-direction:column;align-items:center;opacity:0;visibility:hidden;transform:translateY(24px);filter:blur(8px);
  transition:opacity .7s ease,transform .8s cubic-bezier(.2,.7,.2,1),filter .7s ease,visibility 0s .8s}
.fst__slide.is-active{opacity:1;visibility:visible;transform:none;filter:none;transition:opacity .7s ease .15s,transform .8s cubic-bezier(.2,.7,.2,1) .15s,filter .7s ease .15s,visibility 0s}

.fst__text{position:relative;font-family:'Playfair Display',serif;font-style:italic;font-weight:500;font-size:clamp(20px,2.6vw,28px);line-height:1.55;
  color:#fff;margin:26px 0 30px;white-space:pre-line;max-width:820px}
.fst__person{display:flex;align-items:center;gap:16px;text-align:left}
.fst__photo{position:relative;width:72px;height:72px;flex:none;border-radius:50%;padding:3px;background:conic-gradient(var(--rose),var(--gold),var(--rose))}
.fst__photo img,.fst__photo span{width:100%;height:100%;border-radius:50%;object-fit:cover;display:grid;place-items:center;border:3px solid var(--choco);
  font-family:'Playfair Display',serif;font-weight:700;font-size:28px;color:#fff;background:var(--av,#e07a85)}
.fst__photo::after{content:"";position:absolute;right:-2px;bottom:-2px;width:24px;height:24px;border-radius:50%;border:3px solid var(--choco);
  background:var(--rose) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='3.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M5 12l5 5L20 7'/%3E%3C/svg%3E") center/12px no-repeat}
.fst__name{display:block;font-size:18px;font-weight:600;color:#fff}
.fst__verified{display:block;font-size:12.5px;color:rgba(255,255,255,.55);margin-top:2px}

/* Navegação por avatares */
.fst__nav{display:flex;align-items:center;justify-content:center;gap:18px;margin-top:56px}
.fst__arrow{flex:none;width:48px;height:48px;border-radius:50%;border:0;cursor:pointer;display:grid;place-items:center;color:#fff;background:rgba(255,255,255,.08);
  box-shadow:inset 0 0 0 1px rgba(255,255,255,.18);transition:background .3s,transform .35s cubic-bezier(.3,1.6,.5,1)}
.fst__arrow:hover{background:var(--rose-2);transform:translateY(-2px)}
.fst__arrow svg{width:20px;height:20px}
.fst__dots{display:flex;align-items:center;gap:10px;overflow-x:auto;padding:8px 4px;scrollbar-width:none;max-width:min(560px,70vw)}
.fst__dots::-webkit-scrollbar{display:none}
.fst__dot{position:relative;flex:none;width:52px;height:52px;border-radius:50%;border:0;padding:0;cursor:pointer;background:transparent;opacity:.5;filter:grayscale(.5);
  transition:opacity .4s,filter .4s,transform .45s cubic-bezier(.3,1.6,.5,1)}
.fst__dot:hover{opacity:.85;transform:translateY(-3px)}
.fst__dot.is-active{opacity:1;filter:none;transform:scale(1.12)}
.fst__dot img,.fst__dot span{position:absolute;inset:5px;width:calc(100% - 10px);height:calc(100% - 10px);border-radius:50%;object-fit:cover;display:grid;place-items:center;
  font-family:'Playfair Display',serif;font-weight:700;font-size:17px;color:#fff;background:var(--av,#e07a85)}
.fst__ring{position:absolute;inset:0;width:100%;height:100%;transform:rotate(-90deg)}
.fst__ring circle{fill:none;stroke-width:2.5}
.fst__ring .bg{stroke:rgba(255,255,255,.12)}
.fst__ring .fg{stroke:var(--gold);stroke-linecap:round;stroke-dasharray:151;stroke-dashoffset:151}
.fst__dot.is-active .fst__ring .fg{animation:fstRing var(--dur,7s) linear forwards}
.fst.is-paused .fst__dot.is-active .fst__ring .fg{animation-play-state:paused}
@keyframes fstRing{to{stroke-dashoffset:0}}

/* Chamada para avaliar */
.fst__cta{display:inline-flex;align-items:center;gap:10px;margin-top:46px;padding:14px 28px;border-radius:50px;font-size:14px;font-weight:600;color:var(--choco);
  text-decoration:none;background:linear-gradient(135deg,var(--gold-2),var(--gold));box-shadow:0 16px 34px -14px rgba(217,176,108,.75);
  transition:transform .35s cubic-bezier(.3,1.6,.5,1),box-shadow .35s}
.fst__cta:hover{color:var(--choco);text-decoration:none;transform:translateY(-3px);box-shadow:0 22px 40px -14px rgba(217,176,108,.9)}
.fst__cta svg{width:18px;height:18px;transition:transform .4s}
.fst__cta:hover svg{transform:rotate(-12deg) scale(1.15)}

/* Sem depoimentos */
.fst__empty{max-width:560px;margin:0 auto;text-align:center;padding:44px 30px;border-radius:28px;background:rgba(255,255,255,.06);border:1px dashed rgba(243,217,164,.35)}
.fst__empty svg{width:56px;height:56px;color:var(--gold-2);margin-bottom:14px;animation:fstFloat2 3s ease-in-out infinite}
@keyframes fstFloat2{50%{transform:translateY(-8px)}}
.fst__empty p{font-size:16px;line-height:1.7;color:rgba(255,255,255,.8);margin:0}

/* Revelar */
.fst--js [data-reveal]{opacity:0;transform:translateY(50px);transition:opacity 1s cubic-bezier(.2,.7,.2,1) var(--d,0s),transform 1s cubic-bezier(.2,.7,.2,1) var(--d,0s)}
.fst--js [data-reveal].is-in{opacity:1;transform:none}

@media (max-width:640px){
  .fst{padding:90px 16px 100px}
  .fst__arrow{display:none}
  .fst__dots{max-width:100%}
  .fst__summary{gap:12px;padding-right:18px}
}
@media (prefers-reduced-motion:reduce){
  .fst *,.fst *::before,.fst *::after{animation:none!important;transition:none!important}
  .fst--js [data-reveal]{opacity:1;transform:none}
  .fst__slide .fst__stars svg.on{transform:none}
}
</style>

<section class="fst" id="fst">
    <div class="fst__bg" style="background-image:url('{{ $fundoDepoimentos }}');"></div>
    <div class="fst__overlay"></div>
    <div class="fst__blob fst__blob--1"></div>
    <div class="fst__blob fst__blob--2"></div>

    <div class="fst__head">
        <span class="fst__eyebrow" data-reveal>{{ conteudo('geral.depoimentos.selo') }}</span>
        <h2 class="fst__title" data-reveal style="--d:.1s">{{ conteudo_html('geral.depoimentos.titulo') }}</h2>
        <p class="fst__sub" data-reveal style="--d:.2s">{{ conteudo_html('geral.depoimentos.texto') }}</p>

        @if ($totalDepo > 0)
            <div class="fst__summary" data-reveal style="--d:.3s">
                <span class="fst__score">{{ number_format($mediaDepo, 1, ',', '') }}</span>
                <span class="fst__summary-txt">
                    <span class="fst__stars">
                        @for ($s = 1; $s <= 5; $s++)
                            <svg viewBox="0 0 24 24" class="{{ $s <= round($mediaDepo) ? 'on' : '' }}"><path d="M12 2l2.9 6.3 6.9.7-5.2 4.6 1.5 6.8L12 17l-6.1 3.4 1.5-6.8L2.2 9l6.9-.7z"/></svg>
                        @endfor
                    </span>
                    <small>Média de {{ $totalDepo }} {{ $totalDepo == 1 ? 'avaliação' : 'avaliações' }}</small>
                </span>
            </div>
        @endif
    </div>

    @if ($depoimentosSite->isEmpty())
        <div class="fst__empty" data-reveal>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/><path d="M8 9h8M8 13h5"/></svg>
            <p>{{ conteudo('geral.depoimentos.vazio') }}</p>
            <a href="{{ $loja['app_url'] }}" target="_blank" rel="noopener" class="fst__cta">
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l2.9 6.3 6.9.7-5.2 4.6 1.5 6.8L12 17l-6.1 3.4 1.5-6.8L2.2 9l6.9-.7z"/></svg>
                {{ conteudo('geral.depoimentos.botao_vazio') }}
            </a>
        </div>
    @else
        <div class="fst__stage" data-reveal style="--d:.35s">
            <svg class="fst__quote" viewBox="0 0 24 24" aria-hidden="true"><path d="M9.6 5C5.9 6.3 3.5 9.4 3.5 13.3c0 3 1.8 5.2 4.4 5.2 2.2 0 3.9-1.6 3.9-3.8 0-2.1-1.5-3.6-3.5-3.6-.4 0-.7 0-1 .1.4-1.9 2-3.6 4-4.4L9.6 5zm10 0c-3.7 1.3-6.1 4.4-6.1 8.3 0 3 1.8 5.2 4.4 5.2 2.2 0 3.9-1.6 3.9-3.8 0-2.1-1.5-3.6-3.5-3.6-.4 0-.7 0-1 .1.4-1.9 2-3.6 4-4.4L19.6 5z"/></svg>

            <div class="fst__slides" aria-live="polite">
                @foreach ($depoimentosSite as $depoimento)
                    @php
                        // Primeiro nome + inicial do sobrenome (ex.: "Fernanda O.")
                        $partesNome = preg_split('/\s+/', trim($depoimento->cliente->nome_cliente ?? 'Cliente'));
                        $nomeCurto = $partesNome[0] . (count($partesNome) > 1 ? ' ' . mb_substr(end($partesNome), 0, 1) . '.' : '');
                        $foto = $depoimento->cliente->foto_cliente ?? null;
                        $nota = max(1, min(5, (int) $depoimento->nota_depoimento));
                        $corAvatar = $coresAvatar[crc32($nomeCurto) % count($coresAvatar)];
                    @endphp
                    <article class="fst__slide {{ $loop->first ? 'is-active' : '' }}">
                        <span class="fst__stars fst__stars--lg" title="{{ $nota }} de 5 estrelas" aria-label="{{ $nota }} de 5 estrelas">
                            @for ($s = 1; $s <= 5; $s++)
                                <svg viewBox="0 0 24 24" class="{{ $s <= $nota ? 'on' : '' }}" style="--s:{{ $s }}"><path d="M12 2l2.9 6.3 6.9.7-5.2 4.6 1.5 6.8L12 17l-6.1 3.4 1.5-6.8L2.2 9l6.9-.7z"/></svg>
                            @endfor
                        </span>
                        <blockquote class="fst__text">“{{ $depoimento->texto_depoimento }}”</blockquote>
                        <div class="fst__person">
                            <span class="fst__photo" style="--av:{{ $corAvatar }}">
                                @if ($foto)
                                    <img src="{{ asset('donuts/images/cliente/' . rawurlencode($foto)) }}" alt="{{ $nomeCurto }}" loading="lazy">
                                @else
                                    <span>{{ mb_strtoupper(mb_substr($nomeCurto, 0, 1)) }}</span>
                                @endif
                            </span>
                            <span>
                                <span class="fst__name">{{ $nomeCurto }}</span>
                                <span class="fst__verified">{{ conteudo('geral.depoimentos.verificado') }}</span>
                            </span>
                        </div>
                    </article>
                @endforeach
            </div>

            @if ($totalDepo > 1)
                <div class="fst__nav">
                    <button type="button" class="fst__arrow" data-go="-1" aria-label="Depoimento anterior">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M11 6l-6 6 6 6"/></svg>
                    </button>
                    <div class="fst__dots" role="tablist">
                        @foreach ($depoimentosSite as $depoimento)
                            @php
                                $partesNome = preg_split('/\s+/', trim($depoimento->cliente->nome_cliente ?? 'Cliente'));
                                $nomeCurto = $partesNome[0] . (count($partesNome) > 1 ? ' ' . mb_substr(end($partesNome), 0, 1) . '.' : '');
                                $foto = $depoimento->cliente->foto_cliente ?? null;
                                $corAvatar = $coresAvatar[crc32($nomeCurto) % count($coresAvatar)];
                            @endphp
                            <button type="button" class="fst__dot {{ $loop->first ? 'is-active' : '' }}" data-i="{{ $loop->index }}" aria-label="Depoimento de {{ $nomeCurto }}" style="--av:{{ $corAvatar }}">
                                <svg class="fst__ring" viewBox="0 0 52 52" aria-hidden="true"><circle class="bg" cx="26" cy="26" r="24"/><circle class="fg" cx="26" cy="26" r="24"/></svg>
                                @if ($foto)
                                    <img src="{{ asset('donuts/images/cliente/' . rawurlencode($foto)) }}" alt="" loading="lazy">
                                @else
                                    <span>{{ mb_strtoupper(mb_substr($nomeCurto, 0, 1)) }}</span>
                                @endif
                            </button>
                        @endforeach
                    </div>
                    <button type="button" class="fst__arrow" data-go="1" aria-label="Próximo depoimento">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                    </button>
                </div>
            @endif

            <a href="{{ $loja['app_url'] }}" target="_blank" rel="noopener" class="fst__cta">
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l2.9 6.3 6.9.7-5.2 4.6 1.5 6.8L12 17l-6.1 3.4 1.5-6.8L2.2 9l6.9-.7z"/></svg>
                {{ conteudo('geral.depoimentos.botao') }}
            </a>
        </div>
    @endif
</section>

<script>
(function () {
    var root = document.getElementById('fst');
    if (!root) return;
    root.classList.add('fst--js');
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) {
            if (e.isIntersecting) { e.target.classList.add('is-in'); io.unobserve(e.target); }
        });
    }, { threshold: 0.15 });
    root.querySelectorAll('[data-reveal]').forEach(function (el) { io.observe(el); });

    // Parallax do fundo
    var bg = root.querySelector('.fst__bg'), tick = false;
    if (!reduce && bg) {
        window.addEventListener('scroll', function () {
            if (tick) return; tick = true;
            requestAnimationFrame(function () {
                var r = root.getBoundingClientRect();
                bg.style.transform = 'translate3d(0,' + ((r.top + r.height / 2 - innerHeight / 2) * -0.15) + 'px,0)';
                tick = false;
            });
        }, { passive: true });
    }

    var slides = root.querySelectorAll('.fst__slide');
    var dots = root.querySelectorAll('.fst__dot');
    if (slides.length < 2) return;

    var i = 0, timer = null, DUR = 7000, onScreen = false;
    root.style.setProperty('--dur', DUR / 1000 + 's');

    function show(n) {
        n = (n + slides.length) % slides.length;
        slides[i].classList.remove('is-active');
        dots[i] && dots[i].classList.remove('is-active');
        i = n;
        slides[i].classList.add('is-active');
        if (dots[i]) {
            dots[i].classList.add('is-active');
            var box = dots[i].parentNode;
            box.scrollTo({ left: dots[i].offsetLeft - box.clientWidth / 2 + dots[i].clientWidth / 2, behavior: 'smooth' });
        }
        schedule();
    }

    // Autoplay acompanhando o anel do avatar
    var start = 0, remaining = DUR;
    function schedule() {
        clearTimeout(timer);
        remaining = DUR; start = Date.now();
        if (!reduce && onScreen && !root.classList.contains('is-paused')) timer = setTimeout(function () { show(i + 1); }, remaining);
    }
    function pause() {
        if (root.classList.contains('is-paused')) return;
        root.classList.add('is-paused');
        clearTimeout(timer);
        remaining -= Date.now() - start;
    }
    function resume() {
        if (!root.classList.contains('is-paused')) return;
        root.classList.remove('is-paused');
        start = Date.now();
        if (!reduce && onScreen) timer = setTimeout(function () { show(i + 1); }, Math.max(remaining, 300));
    }

    var stage = root.querySelector('.fst__stage');
    stage.addEventListener('mouseenter', pause);
    stage.addEventListener('mouseleave', resume);
    new IntersectionObserver(function (es) {
        onScreen = es[0].isIntersecting;
        if (onScreen) { resume(); if (!timer) schedule(); } else pause();
    }, { threshold: 0.35 }).observe(stage);

    root.querySelectorAll('[data-go]').forEach(function (b) { b.addEventListener('click', function () { show(i + (+b.dataset.go)); }); });
    dots.forEach(function (d) { d.addEventListener('click', function () { show(+d.dataset.i); }); });

    // Deslizar no celular
    var sx = null;
    stage.addEventListener('touchstart', function (e) { sx = e.touches[0].clientX; }, { passive: true });
    stage.addEventListener('touchend', function (e) {
        if (sx === null) return;
        var dx = e.changedTouches[0].clientX - sx; sx = null;
        if (Math.abs(dx) > 50) show(i + (dx < 0 ? 1 : -1));
    });
})();
</script>