<!-- Our Standards: Nossos compromissos (redesign animado) -->
@php
    $ourStandards = conteudo_img('sobre.compromissos.imagem');

    /*
     | COMPROMISSOS — editados no painel (Conteúdo do Site → Páginas → Sobre).
     | Compromisso sem título não aparece.
     */
    $compromissos = [];
    foreach ([1, 2, 3, 4, 5] as $n) {
        if (conteudo("sobre.compromissos.item{$n}_titulo") === '') continue;
        $compromissos[] = ['titulo' => conteudo("sobre.compromissos.item{$n}_titulo"), 'texto' => conteudo("sobre.compromissos.item{$n}_texto")];
    }
@endphp

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,500;1,600&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
.fsc{--cream:#fdf6ee;--blush:#fbede6;--choco:#2a1710;--choco-2:#4a2a1d;--rose:#e07a85;--rose-2:#b94e5c;--gold:#d9b06c;--gold-2:#f3d9a4;--text:#6e5a50;--muted:#a08d7d;
  position:relative;padding:120px 0;font-family:'Poppins',sans-serif;color:var(--choco);overflow:hidden;isolation:isolate;
  background:linear-gradient(180deg,var(--blush),var(--cream))}
.fsc *{box-sizing:border-box}
.fsc__blob{position:absolute;border-radius:50%;filter:blur(90px);z-index:-1;animation:fscBlob 20s ease-in-out infinite}
.fsc__blob--1{width:440px;height:440px;background:rgba(224,122,133,.22);top:-120px;right:20%}
.fsc__blob--2{width:400px;height:400px;background:rgba(217,176,108,.22);bottom:-140px;left:-120px;animation-delay:-9s}
@keyframes fscBlob{50%{transform:translate(-50px,40px) scale(1.12)}}

.fsc__wrap{max-width:1200px;margin:0 auto;padding:0 20px;display:grid;grid-template-columns:1.1fr .9fr;gap:70px;align-items:center}

/* Texto */
.fsc__eyebrow{display:inline-flex;align-items:center;gap:12px;font-size:13px;font-weight:600;letter-spacing:.32em;text-transform:uppercase;color:var(--rose-2)}
.fsc__eyebrow::before{content:"";height:1px;width:0;background:var(--rose);transition:width 1.2s cubic-bezier(.2,.7,.2,1) .2s}
.fsc__eyebrow.is-in::before{width:46px}
.fsc__title{font-family:'Playfair Display',serif;font-weight:800;font-size:clamp(38px,5.2vw,60px);line-height:1.06;letter-spacing:-.02em;margin:16px 0 16px}
.fsc__title em{font-style:italic;font-weight:600;background:linear-gradient(90deg,var(--rose-2),var(--rose),var(--gold),var(--rose-2));background-size:300% 100%;
  -webkit-background-clip:text;background-clip:text;color:transparent;animation:fscShine 6s linear infinite}
@keyframes fscShine{to{background-position:300% 0}}
.fsc__sub{font-size:16.5px;line-height:1.75;color:var(--text);margin:0 0 40px;font-weight:300;max-width:520px}

/* Lista */
.fsc__list{list-style:none;margin:0;padding:0;display:grid;gap:14px}
.fsc__item{position:relative;display:flex;gap:18px;align-items:flex-start;padding:18px 22px;border-radius:20px;background:rgba(255,255,255,.65);
  border:1px solid rgba(224,122,133,.12);overflow:hidden;isolation:isolate;
  transition:background .5s,border-color .5s,box-shadow .5s,transform .45s cubic-bezier(.3,1.5,.5,1)}
.fsc__item::before{content:"";position:absolute;inset:0;z-index:-1;background:linear-gradient(90deg,rgba(224,122,133,.12),transparent 70%);transform:scaleX(0);transform-origin:left;
  transition:transform .8s cubic-bezier(.6,0,.2,1)}
.fsc__item.is-on::before{transform:scaleX(1)}
.fsc__item:hover{transform:translateX(8px);background:#fff;box-shadow:0 20px 40px -24px rgba(74,42,29,.45);border-color:rgba(224,122,133,.35)}
.fsc__heart{position:relative;flex:none;width:44px;height:44px;display:grid;place-items:center}
.fsc__heart svg{width:30px;height:30px;overflow:visible}
.fsc__heart .outline{fill:none;stroke:var(--rose);stroke-width:1.6}
.fsc__heart .fill{fill:var(--rose-2);transform-origin:12px 13px;transform:scale(0);transition:transform .7s cubic-bezier(.3,1.9,.5,1)}
.fsc__item.is-on .fsc__heart .fill{transform:scale(1)}
.fsc__item.is-on .fsc__heart svg{animation:fscBeat 1.6s ease-in-out .7s 2}
.fsc__item:hover .fsc__heart svg{animation:fscBeat 1.2s ease-in-out infinite}
@keyframes fscBeat{0%,100%{transform:scale(1)}15%{transform:scale(1.25)}30%{transform:scale(.95)}45%{transform:scale(1.15)}}
.fsc__heart::after{content:"";position:absolute;inset:4px;border-radius:50%;border:2px solid var(--rose);opacity:0}
.fsc__item.is-on .fsc__heart::after{animation:fscRipple .9s ease-out .35s}
@keyframes fscRipple{0%{transform:scale(.6);opacity:.8}100%{transform:scale(1.6);opacity:0}}
.fsc__item h3{font-family:'Playfair Display',serif;font-weight:700;font-size:20px;line-height:1.3;margin:2px 0 4px;color:var(--choco)}
.fsc__item p{font-size:14.5px;line-height:1.65;color:var(--text);margin:0}
.fsc__n{margin-left:auto;flex:none;align-self:center;font-family:'Playfair Display',serif;font-weight:800;font-size:26px;color:transparent;-webkit-text-stroke:1px rgba(224,122,133,.4)}

.fsc--js .fsc__item{opacity:0;transform:translateX(-30px)}
.fsc--js .fsc__item.is-show{opacity:1;transform:none;transition:opacity .7s ease,transform .8s cubic-bezier(.2,.7,.2,1),background .5s,border-color .5s,box-shadow .5s}
.fsc--js .fsc__item.is-show:hover{transform:translateX(8px)}

/* Imagem */
.fsc__visual{position:relative;max-width:460px;width:100%;margin:0 auto;aspect-ratio:4/5}
.fsc__card{position:absolute;inset:0;border-radius:30px;overflow:hidden;background:linear-gradient(160deg,#f3c6c9,#f3d9a4);
  box-shadow:0 50px 90px -40px rgba(74,42,29,.6);transform:rotate(3deg);transition:transform .8s cubic-bezier(.3,1.3,.5,1)}
.fsc__visual:hover .fsc__card{transform:rotate(0) scale(1.02)}
.fsc__card img{position:absolute;inset:-8% 0;width:100%;height:116%;object-fit:cover;color:transparent;will-change:transform}
.fsc__back{position:absolute;inset:0;border-radius:30px;border:2px solid var(--gold);transform:rotate(-4deg) translate(-16px,10px);opacity:.6}
.fsc--js .fsc__card{clip-path:inset(0 0 100% 0 round 30px);transition:clip-path 1.5s cubic-bezier(.7,0,.2,1) .2s,transform .8s cubic-bezier(.3,1.3,.5,1)}
.fsc__visual.is-in .fsc__card{clip-path:inset(0 0 0 0 round 30px)}

/* Selo de qualidade */
.fsc__seal{position:absolute;z-index:3;left:-50px;top:40px;width:150px;height:150px;display:grid;place-items:center;text-align:center}
.fsc__seal svg.star{position:absolute;inset:0;width:100%;height:100%;fill:var(--choco);filter:drop-shadow(0 20px 26px rgba(42,23,16,.45));animation:fscSpin 30s linear infinite}
.fsc__seal svg.txt{position:absolute;inset:16px;width:calc(100% - 32px);height:calc(100% - 32px);animation:fscSpin 14s linear infinite reverse}
.fsc__seal text{font-size:9.5px;letter-spacing:2.6px;fill:var(--gold-2);font-weight:600;text-transform:uppercase}
.fsc__seal b{position:relative;font-family:'Playfair Display',serif;font-weight:800;font-size:28px;line-height:1;color:#fff}
.fsc__seal small{position:relative;display:block;font-size:9px;letter-spacing:.2em;text-transform:uppercase;color:var(--gold-2);margin-top:3px}
@keyframes fscSpin{to{transform:rotate(360deg)}}
.fsc--js .fsc__seal{transform:scale(0) rotate(-180deg);transition:transform 1.1s cubic-bezier(.3,1.5,.5,1) 1.1s}
.fsc__visual.is-in .fsc__seal{transform:none}

.fsc__counter{position:absolute;z-index:3;right:-24px;bottom:50px;display:flex;align-items:center;gap:12px;padding:14px 20px 14px 14px;border-radius:20px;background:#fff;
  box-shadow:0 20px 40px -18px rgba(74,42,29,.45);animation:fscFloat 5s ease-in-out infinite}
.fsc__counter .ico{width:44px;height:44px;border-radius:14px;display:grid;place-items:center;background:linear-gradient(135deg,var(--rose),var(--rose-2));color:#fff}
.fsc__counter .ico svg{width:22px;height:22px}
.fsc__counter strong{display:block;font-family:'Playfair Display',serif;font-size:22px;font-weight:800;line-height:1}
.fsc__counter small{display:block;font-size:12px;color:var(--text);margin-top:2px}
@keyframes fscFloat{50%{translate:0 -12px}}

/* Revelar */
.fsc--js [data-reveal]{opacity:0;transform:translateY(40px);transition:opacity 1s cubic-bezier(.2,.7,.2,1) var(--d,0s),transform 1s cubic-bezier(.2,.7,.2,1) var(--d,0s)}
.fsc--js [data-reveal].is-in{opacity:1;transform:none}
.fsc--js .fsc__visual[data-reveal]{transform:none}

@media (max-width:991px){
  .fsc{padding:100px 0}
  .fsc__wrap{grid-template-columns:1fr;gap:80px}
  .fsc__visual{order:-1;max-width:400px}
}
@media (max-width:520px){
  .fsc__visual{max-width:290px}
  .fsc__seal{left:-22px;top:20px;width:112px;height:112px}
  .fsc__seal text{font-size:8px;letter-spacing:1.8px}
  .fsc__seal b{font-size:22px}
  .fsc__counter{right:-12px;bottom:24px}
  .fsc__item{padding:16px}
  .fsc__n{display:none}
}
@media (prefers-reduced-motion:reduce){
  .fsc *,.fsc *::before,.fsc *::after{animation:none!important;transition:none!important}
  .fsc--js [data-reveal],.fsc--js .fsc__item,.fsc--js .fsc__seal{opacity:1;transform:none}
  .fsc--js .fsc__card{clip-path:none}
  .fsc__heart .fill{transform:scale(1)}
}
</style>

<section class="fsc" id="fsc">
    <div class="fsc__blob fsc__blob--1"></div>
    <div class="fsc__blob fsc__blob--2"></div>

    <div class="fsc__wrap">
        <!-- Texto -->
        <div class="fsc__content">
            <span class="fsc__eyebrow" data-reveal>{{ conteudo('sobre.compromissos.selo') }}</span>
            <h2 class="fsc__title" data-reveal style="--d:.1s">{{ conteudo_html('sobre.compromissos.titulo') }}</h2>
            <p class="fsc__sub" data-reveal style="--d:.2s">{{ conteudo_html('sobre.compromissos.texto') }}</p>

            <ul class="fsc__list">
                @foreach ($compromissos as $item)
                    <li class="fsc__item">
                        <span class="fsc__heart" aria-hidden="true">
                            <svg viewBox="0 0 24 24">
                                <path class="outline" d="M12 21s-8-5-8-11a4.5 4.5 0 0 1 8-2.8A4.5 4.5 0 0 1 20 10c0 6-8 11-8 11z"/>
                                <path class="fill" d="M12 21s-8-5-8-11a4.5 4.5 0 0 1 8-2.8A4.5 4.5 0 0 1 20 10c0 6-8 11-8 11z"/>
                            </svg>
                        </span>
                        <div>
                            <h3>{{ $item['titulo'] }}</h3>
                            <p>{{ $item['texto'] }}</p>
                        </div>
                        <span class="fsc__n" aria-hidden="true">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Imagem -->
        <div class="fsc__visual" data-reveal>
            <div class="fsc__back"></div>
            <div class="fsc__card"><img src="{{ $ourStandards }}" alt="Doces artesanais preparados com cuidado"></div>

            <div class="fsc__seal" aria-hidden="true">
                <svg class="star" viewBox="0 0 100 100"><path d="M50 2l7 9 11-4 3 11 12 1-2 11 10 7-7 9 7 9-10 7 2 11-12 1-3 11-11-4-7 9-7-9-11 4-3-11-12-1 2-11-10-7 7-9-7-9 10-7-2-11 12-1 3-11 11 4z"/></svg>
                <svg class="txt" viewBox="0 0 100 100">
                    <defs><path id="fscCircle" d="M50,50 m-40,0 a40,40 0 1,1 80,0 a40,40 0 1,1 -80,0"/></defs>
                    <text><textPath href="#fscCircle">Qualidade garantida • artesanal •</textPath></text>
                </svg>
                <span><b>100%</b><small>artesanal</small></span>
            </div>

            <div class="fsc__counter">
                <span class="ico"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 21s-8-5-8-11a4.5 4.5 0 0 1 8-2.8A4.5 4.5 0 0 1 20 10c0 6-8 11-8 11z"/></svg></span>
                <span><strong><b class="fsc__lit">0</b>/{{ count($compromissos) }}</strong><small>compromissos com você</small></span>
            </div>
        </div>
    </div>
</section>

<script>
(function () {
    var root = document.getElementById('fsc');
    if (!root) return;
    root.classList.add('fsc--js');
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var items = root.querySelectorAll('.fsc__item');
    var lit = root.querySelector('.fsc__lit');

    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) {
            if (e.isIntersecting) { e.target.classList.add('is-in'); io.unobserve(e.target); }
        });
    }, { threshold: 0.2 });
    root.querySelectorAll('[data-reveal]').forEach(function (el) { io.observe(el); });

    // Itens aparecem e os corações se enchem em sequência
    var list = root.querySelector('.fsc__list');
    new IntersectionObserver(function (es, obs) {
        if (!es[0].isIntersecting) return;
        obs.disconnect();
        items.forEach(function (it, i) {
            setTimeout(function () {
                it.classList.add('is-show');
                setTimeout(function () {
                    it.classList.add('is-on');
                    if (lit) lit.textContent = i + 1;
                }, reduce ? 0 : 350);
            }, reduce ? 0 : i * 420);
        });
    }, { threshold: 0.25 }).observe(list);

    // Parallax leve na imagem
    var img = root.querySelector('.fsc__card img'), tick = false;
    if (!reduce && img) {
        window.addEventListener('scroll', function () {
            if (tick) return; tick = true;
            requestAnimationFrame(function () {
                var r = root.getBoundingClientRect();
                img.style.transform = 'translate3d(0,' + ((r.top + r.height / 2 - innerHeight / 2) * -0.07) + 'px,0)';
                tick = false;
            });
        }, { passive: true });
    }
})();
</script>
<!-- End Our Standards -->
