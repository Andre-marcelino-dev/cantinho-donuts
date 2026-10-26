<!-- Fluid Section one (redesign animado) -->
@php
    $fluid = conteudo_img('home.sabor.imagem');
@endphp

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,500;1,600&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
.fsd{--cream:#fdf6ee;--cream-2:#f8e9dc;--choco:#2a1710;--choco-2:#4a2a1d;--rose:#e07a85;--rose-2:#b94e5c;--gold:#d9b06c;--gold-2:#f3d9a4;--text:#6e5a50;
  position:relative;padding:120px 0 0;background:var(--cream);font-family:'Poppins',sans-serif;color:var(--choco);overflow:hidden;isolation:isolate}
.fsd *{box-sizing:border-box}
.fsd__blob{position:absolute;border-radius:50%;filter:blur(90px);z-index:-1;animation:fsdBlob 20s ease-in-out infinite}
.fsd__blob--1{width:480px;height:480px;background:rgba(224,122,133,.28);top:-160px;right:-80px}
.fsd__blob--2{width:380px;height:380px;background:rgba(217,176,108,.25);bottom:40px;left:-140px;animation-delay:-8s}
@keyframes fsdBlob{0%,100%{transform:translate(0,0) scale(1)}50%{transform:translate(-60px,50px) scale(1.15)}}
.fsd__dots{position:absolute;top:90px;left:46%;width:140px;height:140px;z-index:-1;opacity:.5;
  background-image:radial-gradient(var(--rose) 1.5px,transparent 1.5px);background-size:16px 16px;animation:fsdDrift 12s ease-in-out infinite}
@keyframes fsdDrift{50%{transform:translate(14px,-18px)}}

.fsd__wrap{max-width:1200px;margin:0 auto;padding:0 16px;display:grid;grid-template-columns:1.05fr .95fr;gap:60px;align-items:center}

/* Texto */
.fsd__eyebrow{display:inline-flex;align-items:center;gap:10px;padding:8px 18px;border-radius:50px;background:#fff;
  box-shadow:0 10px 30px -15px rgba(185,78,92,.45);font-size:12px;font-weight:600;letter-spacing:.24em;text-transform:uppercase;color:var(--rose-2)}
.fsd__eyebrow i{width:8px;height:8px;border-radius:50%;background:var(--rose);box-shadow:0 0 0 0 rgba(224,122,133,.6);animation:fsdPing 2s infinite}
@keyframes fsdPing{70%{box-shadow:0 0 0 10px rgba(224,122,133,0)}100%{box-shadow:0 0 0 0 rgba(224,122,133,0)}}
.fsd__title{font-family:'Playfair Display',serif;font-weight:800;font-size:clamp(40px,5.8vw,70px);line-height:1.04;letter-spacing:-.02em;margin:24px 0 24px;color:var(--choco)}
.fsd__title .w{display:inline-block;overflow:hidden;vertical-align:bottom;padding-bottom:.08em}
.fsd__title .w>span{display:inline-block}
.fsd--js .fsd__title .w>span{transform:translateY(110%) rotate(6deg);transition:transform 1s cubic-bezier(.2,.8,.2,1) var(--d,0s)}
.fsd__title.is-in .w>span{transform:none}
.fsd__title em{font-style:italic;font-weight:600;background:linear-gradient(90deg,var(--rose-2),var(--rose),var(--gold),var(--rose-2));background-size:300% 100%;
  -webkit-background-clip:text;background-clip:text;color:transparent;animation:fsdShine 6s linear infinite}
@keyframes fsdShine{to{background-position:300% 0}}
.fsd__lead{font-size:17px;line-height:1.8;color:var(--text);max-width:500px;margin:0 0 34px;font-weight:300}
.fsd__lead b{font-weight:600;color:var(--choco)}

.fsd__checks{display:flex;flex-wrap:wrap;gap:12px 22px;list-style:none;padding:0;margin:0 0 40px}
.fsd__checks li{display:flex;align-items:center;gap:8px;font-size:14px;font-weight:500;color:var(--choco-2)}
.fsd__checks svg{width:20px;height:20px;padding:4px;border-radius:50%;background:rgba(224,122,133,.15);color:var(--rose-2)}

.fsd__btns{display:flex;flex-wrap:wrap;gap:16px;align-items:center}
.fsd__btn{position:relative;display:inline-flex;align-items:center;gap:12px;padding:17px 34px;border-radius:60px;font-size:15px;font-weight:600;
  letter-spacing:.02em;text-decoration:none;overflow:hidden;transition:transform .35s cubic-bezier(.3,1.6,.5,1),box-shadow .4s,color .4s}
.fsd__btn svg{width:18px;height:18px;transition:transform .4s}
.fsd__btn:hover{text-decoration:none;transform:translateY(-3px)}
.fsd__btn:hover svg{transform:translateX(5px)}
.fsd__btn--primary{color:#fff;background:linear-gradient(135deg,var(--rose),var(--rose-2));box-shadow:0 18px 40px -14px rgba(185,78,92,.7)}
.fsd__btn--primary::after{content:"";position:absolute;top:0;left:-70%;width:45%;height:100%;background:linear-gradient(115deg,transparent,rgba(255,255,255,.45),transparent);
  transform:skewX(-20deg);animation:fsdSweep 3.5s ease-in-out infinite}
@keyframes fsdSweep{0%,60%{left:-70%}100%{left:130%}}
.fsd__btn--primary:hover{color:#fff;box-shadow:0 24px 50px -14px rgba(185,78,92,.85)}
.fsd__btn--ghost{color:var(--choco);border:1.5px solid rgba(42,23,16,.18);background:transparent}
.fsd__btn--ghost::before{content:"";position:absolute;inset:0;background:var(--choco);transform:scaleY(0);transform-origin:bottom;transition:transform .45s cubic-bezier(.7,0,.2,1);z-index:-1}
.fsd__btn--ghost:hover{color:#fff;border-color:var(--choco)}
.fsd__btn--ghost:hover::before{transform:scaleY(1)}

/* Imagem */
.fsd__visual{position:relative;max-width:520px;width:100%;justify-self:center;aspect-ratio:482/540;transform-style:preserve-3d;transition:transform .3s ease-out}
.fsd__ring{position:absolute;inset:-26px;border-radius:44% 56% 52% 48%/48% 44% 56% 52%;border:2px dashed rgba(217,176,108,.6);animation:fsdMorph 14s ease-in-out infinite,fsdSpin 40s linear infinite}
.fsd__shape{position:absolute;inset:0;overflow:hidden;border-radius:44% 56% 52% 48%/48% 44% 56% 52%;animation:fsdMorph 14s ease-in-out infinite;
  box-shadow:0 50px 90px -35px rgba(74,42,29,.55);background:linear-gradient(135deg,var(--rose),var(--gold))}
.fsd__shape img{width:100%;height:100%;object-fit:cover;display:block;transform:scale(1.12);transition:transform 1.2s cubic-bezier(.2,.7,.2,1)}
.fsd__visual:hover .fsd__shape img{transform:scale(1.2)}
@keyframes fsdMorph{0%,100%{border-radius:44% 56% 52% 48%/48% 44% 56% 52%}33%{border-radius:56% 44% 40% 60%/58% 50% 50% 42%}66%{border-radius:40% 60% 58% 42%/44% 58% 42% 56%}}
@keyframes fsdSpin{to{transform:rotate(360deg)}}

.fsd__badge{position:absolute;width:130px;height:130px;left:-40px;bottom:40px;border-radius:50%;background:var(--choco);display:grid;place-items:center;
  box-shadow:0 20px 40px -15px rgba(42,23,16,.6);transform:translateZ(60px)}
.fsd__badge svg.txt{position:absolute;inset:8px;width:calc(100% - 16px);height:calc(100% - 16px);animation:fsdSpin 16s linear infinite}
.fsd__badge text{font-size:10.5px;letter-spacing:3.2px;fill:var(--gold-2);font-weight:600;text-transform:uppercase}
.fsd__badge .ic{width:42px;height:42px;color:var(--rose)}

.fsd__chip{position:absolute;display:flex;align-items:center;gap:12px;padding:12px 18px 12px 12px;border-radius:18px;background:rgba(255,255,255,.92);
  -webkit-backdrop-filter:blur(10px);backdrop-filter:blur(10px);box-shadow:0 20px 45px -18px rgba(74,42,29,.45);animation:fsdFloat 5s ease-in-out infinite;transform:translateZ(80px)}
.fsd__chip .ico{width:42px;height:42px;border-radius:12px;display:grid;place-items:center;flex:none}
.fsd__chip .ico svg{width:22px;height:22px}
.fsd__chip strong{display:block;font-size:15px;font-weight:600;color:var(--choco);line-height:1.2}
.fsd__chip small{display:block;font-size:12px;color:var(--text)}
.fsd__chip--1{top:30px;right:-30px}
.fsd__chip--1 .ico{background:rgba(224,122,133,.15);color:var(--rose-2)}
.fsd__chip--2{bottom:-10px;right:30px;animation-delay:-2.5s}
.fsd__chip--2 .ico{background:rgba(217,176,108,.2);color:#a87a35}
.fsd__stars{color:#e5a93b;letter-spacing:1px;font-size:12px}
@keyframes fsdFloat{0%,100%{translate:0 0}50%{translate:0 -14px}}

/* Revelar */
.fsd--js [data-reveal]{opacity:0;transform:translateY(40px);transition:opacity 1s cubic-bezier(.2,.7,.2,1) var(--d,0s),transform 1s cubic-bezier(.2,.7,.2,1) var(--d,0s)}
.fsd--js [data-reveal="zoom"]{transform:scale(.85) rotate(-4deg)}
.fsd--js [data-reveal].is-in{opacity:1;transform:none}

/* Faixa rolante */
.fsd__marquee{margin-top:110px;background:var(--choco);padding:22px 0;transform:rotate(-1.5deg) scale(1.03);overflow:hidden;box-shadow:0 20px 40px -20px rgba(42,23,16,.5)}
.fsd__track{display:flex;width:max-content;animation:fsdMarquee 28s linear infinite}
.fsd__marquee:hover .fsd__track{animation-play-state:paused}
.fsd__track span{display:flex;align-items:center;gap:28px;padding-right:28px;font-family:'Playfair Display',serif;font-size:26px;font-style:italic;color:var(--cream);white-space:nowrap}
.fsd__track span:nth-child(even){color:var(--gold-2)}
.fsd__track svg{width:18px;height:18px;fill:var(--rose);flex:none}
@keyframes fsdMarquee{to{transform:translateX(-50%)}}
.fsd__spacer{height:40px}

@media (max-width:991px){
  .fsd{padding-top:90px}
  .fsd__wrap{grid-template-columns:1fr;gap:80px;text-align:center}
  .fsd__lead{margin-left:auto;margin-right:auto}
  .fsd__checks,.fsd__btns{justify-content:center}
  .fsd__visual{max-width:440px}
  .fsd__dots{left:auto;right:10%}
}
@media (max-width:560px){
  .fsd__visual{max-width:300px}
  .fsd__badge{width:100px;height:100px;left:-18px;bottom:20px}
  .fsd__badge text{font-size:8.5px;letter-spacing:2.4px}
  .fsd__badge .ic{width:32px;height:32px}
  .fsd__chip{padding:9px 14px 9px 9px}
  .fsd__chip--1{right:-16px;top:0}
  .fsd__chip--2{right:0;bottom:-26px}
  .fsd__chip .ico{width:34px;height:34px}
  .fsd__track span{font-size:20px}
  .fsd__btn{width:100%;justify-content:center}
}
@media (prefers-reduced-motion:reduce){
  .fsd *,.fsd *::before,.fsd *::after{animation:none!important;transition:none!important}
  .fsd--js [data-reveal],.fsd--js .fsd__title .w>span{opacity:1;transform:none}
}
</style>

<section class="fsd" id="fsd">
    <div class="fsd__blob fsd__blob--1"></div>
    <div class="fsd__blob fsd__blob--2"></div>
    <div class="fsd__dots"></div>

    <div class="fsd__wrap">
        <!-- Texto -->
        <div class="fsd__content">
            <span class="fsd__eyebrow" data-reveal><i></i>{{ conteudo('home.sabor.selo') }}</span>

            <h2 class="fsd__title" data-split>{{ conteudo_html('home.sabor.titulo') }}</h2>

            <p class="fsd__lead" data-reveal style="--d:.5s">{{ conteudo_html('home.sabor.texto') }}</p>

            <ul class="fsd__checks" data-reveal style="--d:.62s">
                @foreach (conteudo_lista('home.sabor.lista') as $item)
                    <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5L20 7"/></svg>{{ $item }}</li>
                @endforeach
            </ul>

            <div class="fsd__btns" data-reveal style="--d:.74s">
                <a href="{{ conteudo_link('home.sabor.botao1_link') }}" class="fsd__btn fsd__btn--primary">{{ conteudo('home.sabor.botao1_texto') }}
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                </a>
                <a href="{{ conteudo_link('home.sabor.botao2_link') }}" class="fsd__btn fsd__btn--ghost">{{ conteudo('home.sabor.botao2_texto') }}</a>
            </div>
        </div>

        <!-- Imagem -->
        <div class="fsd__visual" data-reveal="zoom" style="--d:.2s">
            <div class="fsd__ring"></div>
            <div class="fsd__shape">
                <img src="{{ $fluid }}" alt="Variedade de doces finos da Cantinho Donuts">
            </div>

            <div class="fsd__badge" aria-hidden="true">
                <svg class="txt" viewBox="0 0 100 100">
                    <defs><path id="fsdCircle" d="M50,50 m-40,0 a40,40 0 1,1 80,0 a40,40 0 1,1 -80,0"/></defs>
                    <text><textPath href="#fsdCircle">Cantinho Donuts • feito com amor •</textPath></text>
                </svg>
                <svg class="ic" viewBox="0 0 24 24" fill="currentColor"><path d="M12 21s-8-5-8-11a4.5 4.5 0 0 1 8-2.8A4.5 4.5 0 0 1 20 10c0 6-8 11-8 11z"/></svg>
            </div>

            <div class="fsd__chip fsd__chip--1">
                <div class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 21h16M5 21v-6a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v6"/><path d="M5 17c1.2 0 1.8-1 3-1s1.8 1 3 1 1.8-1 3-1 1.8 1 3 1 1.8-1 2-1"/><path d="M12 13V9"/></svg></div>
                <div><strong>{{ conteudo('home.sabor.selo1_titulo') }}</strong><small>{{ conteudo('home.sabor.selo1_texto') }}</small></div>
            </div>

            <div class="fsd__chip fsd__chip--2">
                <div class="ico"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l2.9 6.3 6.9.7-5.2 4.6 1.5 6.8L12 17l-6.1 3.4 1.5-6.8L2.2 9l6.9-.7z"/></svg></div>
                <div><strong>{{ conteudo('home.sabor.selo2_titulo') }}</strong><small class="fsd__stars">★★★★★</small></div>
            </div>
        </div>
    </div>

    <!-- Faixa rolante -->
    <div class="fsd__marquee" aria-hidden="true">
        <div class="fsd__track">
            @for ($i = 0; $i < 2; $i++)
                @foreach (conteudo_lista('home.sabor.faixa') as $item)
                    <span>{{ $item }} <svg viewBox="0 0 24 24"><path d="M12 2l2.4 7.6L22 12l-7.6 2.4L12 22l-2.4-7.6L2 12l7.6-2.4z"/></svg></span>
                @endforeach
            @endfor
        </div>
    </div>
    <div class="fsd__spacer"></div>
</section>

<script>
(function () {
    var root = document.getElementById('fsd');
    if (!root) return;
    root.classList.add('fsd--js');
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // Título palavra por palavra
    var title = root.querySelector('[data-split]'), n = 0;
    function split(node) {
        Array.prototype.slice.call(node.childNodes).forEach(function (c) {
            if (c.nodeType === 3) {
                var frag = document.createDocumentFragment();
                c.textContent.split(/(\s+)/).forEach(function (part) {
                    if (!part) return;
                    if (/^\s+$/.test(part)) { frag.appendChild(document.createTextNode(' ')); return; }
                    var w = document.createElement('span'); w.className = 'w';
                    var s = document.createElement('span'); s.textContent = part;
                    s.style.setProperty('--d', (0.1 + n++ * 0.08) + 's');
                    w.appendChild(s); frag.appendChild(w);
                });
                node.replaceChild(frag, c);
            } else if (c.nodeType === 1) { split(c); }
        });
    }
    if (title) split(title);

    // Revelar ao rolar
    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) {
            if (e.isIntersecting) { e.target.classList.add('is-in'); io.unobserve(e.target); }
        });
    }, { threshold: 0.2 });
    root.querySelectorAll('[data-reveal], [data-split]').forEach(function (el) { io.observe(el); });

    // Imagem 3D seguindo o mouse
    var vis = root.querySelector('.fsd__visual');
    if (!reduce && vis && window.matchMedia('(hover: hover)').matches) {
        root.addEventListener('mousemove', function (ev) {
            if (!vis.classList.contains('is-in')) return;
            var r = vis.getBoundingClientRect(),
                x = (ev.clientX - (r.left + r.width / 2)) / window.innerWidth,
                y = (ev.clientY - (r.top + r.height / 2)) / window.innerHeight;
            vis.style.transform = 'perspective(1200px) rotateY(' + (x * 12) + 'deg) rotateX(' + (-y * 12) + 'deg)';
        });
        root.addEventListener('mouseleave', function () { vis.style.transform = ''; });
    }
})();
</script>
<!--End Fluid Section one -->