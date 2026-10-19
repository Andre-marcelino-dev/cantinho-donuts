<!-- Nossos Serviços (redesign animado) -->
@php
    $features = asset('davilla/images/fundoServicos.png');
@endphp

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,500;1,600&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
.fss{--cream:#fdf6ee;--blush:#fbe9e4;--choco:#2a1710;--choco-2:#4a2a1d;--rose:#e07a85;--rose-2:#b94e5c;--gold:#d9b06c;--gold-2:#f3d9a4;--text:#6e5a50;
  position:relative;padding:120px 0 120px;font-family:'Poppins',sans-serif;color:var(--choco);overflow:hidden;isolation:isolate;background:var(--blush)}
.fss *{box-sizing:border-box}
.fss__bg{position:absolute;inset:0;z-index:-3;background-size:cover;background-position:center;opacity:.35}
.fss__overlay{position:absolute;inset:0;z-index:-2;background:radial-gradient(ellipse at 50% 0%,rgba(255,255,255,.9),transparent 60%),linear-gradient(180deg,rgba(251,233,228,.6),rgba(253,246,238,.95))}
.fss__blob{position:absolute;border-radius:50%;filter:blur(90px);z-index:-1;animation:fssBlob 20s ease-in-out infinite}
.fss__blob--1{width:420px;height:420px;background:rgba(224,122,133,.3);top:20%;left:-160px}
.fss__blob--2{width:380px;height:380px;background:rgba(217,176,108,.28);bottom:-120px;right:-100px;animation-delay:-9s}
@keyframes fssBlob{50%{transform:translate(60px,-40px) scale(1.15)}}

/* Cabeçalho */
.fss__top{max-width:1240px;margin:0 auto 54px;padding:0 16px;display:flex;align-items:flex-end;justify-content:space-between;gap:30px}
.fss__eyebrow{display:inline-flex;align-items:center;gap:12px;font-size:13px;font-weight:600;letter-spacing:.32em;text-transform:uppercase;color:var(--rose-2)}
.fss__eyebrow::before{content:"";height:1px;width:0;background:var(--rose);transition:width 1.2s cubic-bezier(.2,.7,.2,1) .2s}
.fss__eyebrow.is-in::before{width:46px}
.fss__title{font-family:'Playfair Display',serif;font-weight:800;font-size:clamp(38px,5.2vw,60px);line-height:1.06;letter-spacing:-.02em;margin:16px 0 14px}
.fss__title em{font-style:italic;font-weight:600;background:linear-gradient(90deg,var(--rose-2),var(--rose),var(--gold),var(--rose-2));background-size:300% 100%;
  -webkit-background-clip:text;background-clip:text;color:transparent;animation:fssShine 6s linear infinite}
@keyframes fssShine{to{background-position:300% 0}}
.fss__sub{font-size:17px;line-height:1.7;color:var(--text);margin:0;font-weight:300;max-width:520px}

.fss__nav{display:flex;gap:12px;flex:none}
.fss__arrow{width:58px;height:58px;border-radius:50%;border:0;cursor:pointer;display:grid;place-items:center;color:var(--choco);background:#fff;
  box-shadow:0 14px 30px -14px rgba(74,42,29,.45),inset 0 0 0 1px rgba(224,122,133,.2);position:relative;overflow:hidden;isolation:isolate;
  transition:color .35s,transform .35s cubic-bezier(.3,1.6,.5,1),opacity .3s}
.fss__arrow::before{content:"";position:absolute;inset:0;z-index:-1;border-radius:50%;background:linear-gradient(135deg,var(--rose),var(--rose-2));transform:scale(0);transition:transform .4s cubic-bezier(.3,1.3,.5,1)}
.fss__arrow:hover{color:#fff;transform:translateY(-3px)}
.fss__arrow:hover::before{transform:scale(1)}
.fss__arrow:disabled{opacity:.35;cursor:default;transform:none}
.fss__arrow:disabled::before{transform:scale(0)}
.fss__arrow svg{width:22px;height:22px}

/* Carrossel */
.fss__viewport{position:relative;max-width:1240px;margin:0 auto;padding:0 16px}
.fss__track{display:flex;gap:28px;overflow-x:auto;scroll-snap-type:x mandatory;scroll-behavior:smooth;padding:30px 4px 60px;margin:-30px -4px -30px;
  scrollbar-width:none;cursor:grab;-webkit-overflow-scrolling:touch}
.fss__track::-webkit-scrollbar{display:none}
.fss__track.is-drag{cursor:grabbing;scroll-snap-type:none;scroll-behavior:auto}
.fss__track.is-drag *{pointer-events:none;user-select:none}
.fss__slide{flex:0 0 calc((100% - 28px * 3) / 4);scroll-snap-align:start}

.fss__card{position:relative;height:100%;text-align:center;padding:46px 28px 38px;border-radius:30px;background:rgba(255,255,255,.82);
  -webkit-backdrop-filter:blur(12px);backdrop-filter:blur(12px);border:1px solid rgba(255,255,255,.9);box-shadow:0 26px 50px -30px rgba(74,42,29,.45);
  transition:transform .55s cubic-bezier(.3,1.4,.5,1),box-shadow .5s,background .5s;overflow:hidden;isolation:isolate}
.fss__card::before{content:"";position:absolute;left:-30%;right:-30%;top:-60%;height:80%;z-index:-1;border-radius:50%;
  background:radial-gradient(circle,rgba(224,122,133,.28),transparent 65%);opacity:0;transform:translateY(-30px);transition:opacity .6s,transform .8s cubic-bezier(.2,.7,.2,1)}
.fss__card:hover{transform:translateY(-14px);background:#fff;box-shadow:0 40px 70px -30px rgba(74,42,29,.55)}
.fss__card:hover::before{opacity:1;transform:none}
.fss__num{position:absolute;top:18px;left:24px;font-family:'Playfair Display',serif;font-weight:800;font-size:15px;color:var(--gold);letter-spacing:.06em}

.fss__media{position:relative;width:170px;height:170px;margin:0 auto 26px;display:grid;place-items:center}
.fss__frame{position:absolute;inset:0;width:100%;height:100%;fill:url(#fssGrad);animation:fssSpin 26s linear infinite;
  filter:drop-shadow(0 16px 24px rgba(185,78,92,.3));transition:transform .8s cubic-bezier(.3,1.4,.5,1)}
.fss__slide:nth-child(3n+2) .fss__frame{fill:url(#fssGrad2)}
.fss__slide:nth-child(3n) .fss__frame{fill:url(#fssGrad3)}
.fss__media::after{content:"";position:absolute;inset:-12px;border-radius:50%;border:1.5px dashed rgba(217,176,108,.55);animation:fssSpin 30s linear infinite reverse;opacity:0;transition:opacity .5s}
.fss__card:hover .fss__media::after{opacity:1}
.fss__card:hover .fss__frame{animation-duration:6s}
.fss__media img{position:relative;width:96px;height:96px;object-fit:contain;filter:drop-shadow(0 10px 10px rgba(42,23,16,.25));
  animation:fssBob 3.4s ease-in-out infinite;transition:transform .6s cubic-bezier(.3,1.7,.5,1)}
.fss__card:hover .fss__media img{transform:scale(1.15) rotate(-8deg)}
@keyframes fssSpin{to{transform:rotate(360deg)}}
@keyframes fssBob{0%,100%{translate:0 0}50%{translate:0 -8px}}

.fss__card h3{font-family:'Playfair Display',serif;font-weight:700;font-size:25px;line-height:1.2;margin:0 0 12px;color:var(--choco)}
.fss__line{width:36px;height:2px;margin:0 auto 16px;border-radius:2px;background:linear-gradient(90deg,var(--rose),var(--gold));transition:width .5s}
.fss__card:hover .fss__line{width:80px}
.fss__card p{font-size:14.5px;line-height:1.75;color:var(--text);margin:0}

/* Progresso */
.fss__progress{max-width:1240px;margin:20px auto 0;padding:0 16px;display:flex;align-items:center;gap:18px}
.fss__bar{flex:1;height:3px;border-radius:3px;background:rgba(74,42,29,.12);overflow:hidden}
.fss__bar i{display:block;height:100%;width:0;border-radius:3px;background:linear-gradient(90deg,var(--rose),var(--gold));transition:width .4s ease}
.fss__counter{font-family:'Playfair Display',serif;font-size:15px;font-weight:700;color:var(--choco-2);white-space:nowrap;min-width:56px;text-align:right}
.fss__counter span{color:var(--muted,#a08d7d);font-weight:600}

/* Revelar */
.fss--js [data-reveal]{opacity:0;transform:translateY(50px);transition:opacity 1s cubic-bezier(.2,.7,.2,1) var(--d,0s),transform 1s cubic-bezier(.2,.7,.2,1) var(--d,0s)}
.fss--js [data-reveal].is-in{opacity:1;transform:none}

@media (max-width:1199px){.fss__slide{flex-basis:calc((100% - 28px * 2) / 3)}}
@media (max-width:860px){.fss__slide{flex-basis:calc((100% - 28px) / 2)}.fss__top{flex-direction:column;align-items:flex-start}}
@media (max-width:560px){
  .fss{padding:90px 0 90px}
  .fss__slide{flex-basis:84%}
  .fss__track{gap:18px}
  .fss__nav{display:none}
}
@media (prefers-reduced-motion:reduce){
  .fss *,.fss *::before,.fss *::after{animation:none!important;transition:none!important}
  .fss--js [data-reveal]{opacity:1;transform:none}
  .fss__track{scroll-behavior:auto}
}
</style>

<section class="fss" id="fss">
    <div class="fss__bg" style="background-image:url('{{ $features }}')"></div>
    <div class="fss__overlay"></div>
    <div class="fss__blob fss__blob--1"></div>
    <div class="fss__blob fss__blob--2"></div>

    <svg width="0" height="0" style="position:absolute" aria-hidden="true">
        <defs>
            <linearGradient id="fssGrad" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#f3a6ae"/><stop offset="1" stop-color="#e07a85"/></linearGradient>
            <linearGradient id="fssGrad2" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#f7dcae"/><stop offset="1" stop-color="#d9b06c"/></linearGradient>
            <linearGradient id="fssGrad3" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#f6cfd0"/><stop offset="1" stop-color="#c98b8f"/></linearGradient>
        </defs>
    </svg>

    <div class="fss__top">
        <div>
            <span class="fss__eyebrow" data-reveal>O que fazemos</span>
            <h2 class="fss__title" data-reveal style="--d:.1s">Nossas <em>especialidades</em></h2>
            <p class="fss__sub" data-reveal style="--d:.2s">De bolos de festa a docinhos finos: conheça as delícias que saem todos os dias da nossa cozinha.</p>
        </div>
        <div class="fss__nav" data-reveal style="--d:.3s">
            <button type="button" class="fss__arrow" data-dir="-1" aria-label="Anterior">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M11 6l-6 6 6 6"/></svg>
            </button>
            <button type="button" class="fss__arrow" data-dir="1" aria-label="Próximo">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </button>
        </div>
    </div>

    <div class="fss__viewport">
        <div class="fss__track">
            @foreach ($filtroCategoria as $linha)
                <div class="fss__slide" data-reveal style="--d:{{ min($loop->index, 4) * 0.1 }}s">
                    <div class="fss__card">
                        <span class="fss__num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <div class="fss__media">
                            <svg class="fss__frame" viewBox="0 0 500 500" aria-hidden="true"><path d="M488.5,274.5L488.5,274.5l1.8-0.5l-2,0.5c-2.4-8.7-4.5-16.9-4.5-24.5c0-8,2.3-16.5,4.7-25.5 c3.5-13,7.1-26.5,3.7-39.5c-3.6-13.2-13.5-23.1-23.1-32.7c-6.5-6.5-12.6-12.6-16.6-19.4c-3.9-6.8-6.1-15.2-8.5-24.1 c-3.5-13.1-7.1-26.7-16.7-36.3c-9.5-9.5-22.9-13.1-35.9-16.6c-9-2.4-17.5-4.6-24.4-8.7c-6.5-3.8-12.5-9.8-18.9-16.2 c-9.7-9.8-19.6-19.8-33.2-23.4c-13.5-3.7-27.3,0.1-40.4,3.7c-8.7,2.4-16.9,4.6-24.5,4.6c-8,0-16.5-2.3-25.5-4.7 c-9.3-2.5-18.8-5-28.1-5c-3.8,0-7.6,0.4-11.3,1.4C172,11.1,162,21.1,152.4,30.7c-6.5,6.5-12.6,12.6-19.4,16.6 c-6.8,3.9-15.2,6.1-24.1,8.5c-13.1,3.5-26.7,7.1-36.3,16.7c-9.5,9.5-13.1,23-16.6,36c-2.4,9-4.6,17.5-8.7,24.4 c-3.8,6.5-9.8,12.5-16.2,18.9c-9.8,9.7-19.7,19.6-23.4,33.2c-3.7,13.5,0.1,27.3,3.7,40.5c2.4,8.7,4.6,16.9,4.6,24.5 c0,8-2.3,16.5-4.6,25.5c-3.5,13-7.1,26.6-3.7,39.5c3.6,13.2,13.5,23.1,23.1,32.7c6.5,6.5,12.6,12.6,16.6,19.4 c3.9,6.8,6.1,15.1,8.5,24c3.5,13.1,7.1,26.8,16.7,36.4c9.5,9.5,23,13.1,35.9,16.6c9,2.4,17.5,4.6,24.4,8.7 c6.5,3.8,12.5,9.8,18.9,16.2c9.7,9.8,19.6,19.8,33.2,23.5c3.8,1,7.6,1.5,11.8,1.5c9.6,0,19.3-2.7,28.5-5.1c8.8-2.4,17-4.6,24.5-4.6 c8,0,16.5,2.3,25.5,4.6c13,3.6,26.6,7.1,39.5,3.7c13.2-3.6,23.1-13.5,32.7-23.1c6.5-6.5,12.6-12.6,19.4-16.6 c6.7-3.9,15.1-6.1,24-8.5c13.1-3.5,26.8-7.1,36.4-16.8c9.5-9.5,13.1-23,16.6-36c2.4-9,4.6-17.5,8.7-24.4c3.8-6.5,9.8-12.5,16.2-18.9 c9.8-9.7,19.9-19.7,23.6-33.3C495.7,301.4,494.4,287.7,488.5,274.5z"></path></svg>
                            <img src="{{ asset('davilla/IMG/cup-cak' . $linha->id_categoria . '.svg') }}" alt="{{ $linha->nome_categoria }}" loading="lazy">
                        </div>
                        <h3>{{ $linha->nome_categoria }}</h3>
                        <div class="fss__line"></div>
                        <p>{{ $linha->descricao_categoria }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="fss__progress" data-reveal style="--d:.2s">
        <div class="fss__bar"><i></i></div>
        <div class="fss__counter"><b class="cur">01</b> <span>/ {{ str_pad($filtroCategoria->count(), 2, '0', STR_PAD_LEFT) }}</span></div>
    </div>
</section>

<script>
(function () {
    var root = document.getElementById('fss');
    if (!root) return;
    root.classList.add('fss--js');
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var track = root.querySelector('.fss__track');
    var slides = root.querySelectorAll('.fss__slide');
    var bar = root.querySelector('.fss__bar i');
    var cur = root.querySelector('.fss__counter .cur');
    var arrows = root.querySelectorAll('.fss__arrow');

    // Revelar ao rolar
    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) {
            if (e.isIntersecting) { e.target.classList.add('is-in'); io.unobserve(e.target); }
        });
    }, { threshold: 0.15 });
    root.querySelectorAll('[data-reveal]').forEach(function (el) { io.observe(el); });

    if (!track || !slides.length) return;

    function step() {
        var s = slides[0];
        return s.getBoundingClientRect().width + parseFloat(getComputedStyle(track).columnGap || 0);
    }
    function maxScroll() { return track.scrollWidth - track.clientWidth; }

    function update() {
        var max = maxScroll();
        var p = max > 0 ? track.scrollLeft / max : 1;
        var visible = Math.max(1, Math.round(track.clientWidth / step()));
        bar.style.width = (Math.min(1, (visible / slides.length) + p * (1 - visible / slides.length)) * 100) + '%';
        var idx = Math.min(slides.length, Math.round(track.scrollLeft / step()) + 1);
        cur.textContent = (idx < 10 ? '0' : '') + idx;
        arrows[0].disabled = track.scrollLeft <= 2;
        arrows[1].disabled = track.scrollLeft >= max - 2;
        if (max <= 2) root.querySelector('.fss__nav').style.visibility = 'hidden';
    }
    track.addEventListener('scroll', function () { requestAnimationFrame(update); }, { passive: true });
    window.addEventListener('resize', update);
    update();

    function go(dir) {
        var max = maxScroll();
        var target = track.scrollLeft + dir * step();
        if (dir > 0 && track.scrollLeft >= max - 2) target = 0;
        track.scrollTo({ left: target, behavior: reduce ? 'auto' : 'smooth' });
    }
    arrows.forEach(function (a) { a.addEventListener('click', function () { go(+a.dataset.dir); restart(); }); });

    // Arrastar com o mouse
    var down = false, startX = 0, startL = 0, moved = false;
    track.addEventListener('pointerdown', function (e) {
        if (e.pointerType !== 'mouse') return;
        down = true; moved = false; startX = e.clientX; startL = track.scrollLeft;
    });
    window.addEventListener('pointermove', function (e) {
        if (!down) return;
        var dx = e.clientX - startX;
        if (Math.abs(dx) > 5) { moved = true; track.classList.add('is-drag'); }
        if (moved) track.scrollLeft = startL - dx;
    });
    window.addEventListener('pointerup', function () {
        if (!down) return;
        down = false;
        if (moved) {
            track.classList.remove('is-drag');
            var i = Math.round(track.scrollLeft / step());
            track.scrollTo({ left: i * step(), behavior: 'smooth' });
        }
    });

    // Autoplay (pausa ao passar o mouse, tocar ou quando fora da tela)
    var timer = null, hover = false, onScreen = false;
    function restart() {
        clearInterval(timer);
        if (reduce) return;
        timer = setInterval(function () { if (!hover && !down && onScreen && !document.hidden) go(1); }, 4500);
    }
    root.addEventListener('mouseenter', function () { hover = true; });
    root.addEventListener('mouseleave', function () { hover = false; });
    track.addEventListener('touchstart', function () { hover = true; }, { passive: true });
    track.addEventListener('touchend', function () { setTimeout(function () { hover = false; }, 3000); });
    new IntersectionObserver(function (es) { onScreen = es[0].isIntersecting; }, { threshold: 0.3 }).observe(track);
    restart();
})();
</script>
<!--Fim Nossos Serviços -->