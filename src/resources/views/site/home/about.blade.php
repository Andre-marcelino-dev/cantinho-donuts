<!-- About Section (redesign animado) -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,500;1,600&family=Poppins:wght@300;400;500;600&family=Great+Vibes&display=swap" rel="stylesheet">

<style>
.fsa{--cream:#fdf6ee;--blush:#fbede6;--choco:#2a1710;--choco-2:#4a2a1d;--rose:#e07a85;--rose-2:#b94e5c;--gold:#d9b06c;--gold-2:#f3d9a4;--text:#6e5a50;
  position:relative;padding:140px 0 130px;font-family:'Poppins',sans-serif;color:var(--choco);overflow:hidden;isolation:isolate;
  background:radial-gradient(ellipse at 50% 0%,#fff 0%,transparent 60%),linear-gradient(180deg,var(--blush),var(--cream))}
.fsa *{box-sizing:border-box}

/* Texto gigante de fundo */
.fsa__giant{position:absolute;top:50%;left:0;z-index:-2;white-space:nowrap;pointer-events:none;will-change:transform;
  font-family:'Playfair Display',serif;font-style:italic;font-weight:800;font-size:clamp(140px,20vw,300px);line-height:1;
  color:transparent;-webkit-text-stroke:1.5px rgba(224,122,133,.18);transform:translate3d(0,-50%,0)}

/* Ilustrações nos cantos */
.fsa__art{position:absolute;z-index:-1;width:170px;height:170px;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;animation:fsaFloat 7s ease-in-out infinite}
.fsa__art--l{left:5%;top:16%;stroke:var(--rose);--r:-8deg}
.fsa__art--r{right:5%;bottom:14%;stroke:var(--gold);animation-delay:-3.5s;--r:10deg}
.fsa__art path,.fsa__art circle,.fsa__art ellipse{stroke-dasharray:600;stroke-dashoffset:600;transition:stroke-dashoffset 2.6s cubic-bezier(.6,0,.2,1) .3s}
.fsa__art.is-in path,.fsa__art.is-in circle,.fsa__art.is-in ellipse{stroke-dashoffset:0}
@keyframes fsaFloat{0%,100%{transform:translateY(0) rotate(var(--r))}50%{transform:translateY(-18px) rotate(calc(var(--r) * -1))}}

.fsa__decor span{position:absolute;z-index:-1;width:6px;height:20px;border-radius:6px;opacity:.75;animation:fsaSpr var(--t,9s) ease-in-out infinite;animation-delay:var(--dl,0s)}
@keyframes fsaSpr{0%,100%{transform:translateY(0) rotate(var(--r,0deg))}50%{transform:translateY(-24px) rotate(calc(var(--r,0deg) + 50deg))}}

.fsa__inner{max-width:860px;margin:0 auto;padding:0 16px;text-align:center}

/* Cabeçalho */
.fsa__eyebrow{display:inline-flex;align-items:center;gap:14px;font-size:13px;font-weight:600;letter-spacing:.32em;text-transform:uppercase;color:var(--rose-2)}
.fsa__eyebrow::before,.fsa__eyebrow::after{content:"";height:1px;width:0;background:var(--rose);transition:width 1.2s cubic-bezier(.2,.7,.2,1) .2s}
.fsa__eyebrow.is-in::before,.fsa__eyebrow.is-in::after{width:46px}
.fsa__title{font-family:'Playfair Display',serif;font-weight:800;font-size:clamp(42px,7vw,84px);line-height:1.02;letter-spacing:-.02em;margin:22px 0 10px;color:var(--choco)}
.fsa__title em{font-style:italic;font-weight:600;background:linear-gradient(90deg,var(--rose-2),var(--rose),var(--gold),var(--rose-2));background-size:300% 100%;
  -webkit-background-clip:text;background-clip:text;color:transparent;animation:fsaShine 6s linear infinite}
.fsa__title em .ch{background:inherit;background-size:inherit;-webkit-background-clip:text;background-clip:text;color:transparent;animation:inherit}
@keyframes fsaShine{to{background-position:300% 0}}
.fsa__title .wd{display:inline-block;white-space:nowrap}
.fsa__title .ch{display:inline-block}
.fsa--js .fsa__title .ch{opacity:0;transform:translateY(-60px) rotate(-12deg) scale(.6);
  transition:opacity .6s ease var(--d),transform .9s cubic-bezier(.3,1.5,.5,1) var(--d)}
.fsa__title.is-in .ch{opacity:1;transform:none}

/* Divisor com bolo desenhado */
.fsa__divider{display:flex;align-items:center;justify-content:center;gap:18px;margin:16px 0 46px}
.fsa__divider i{display:block;height:2px;width:0;border-radius:2px;background:linear-gradient(90deg,transparent,var(--gold));transition:width 1.2s cubic-bezier(.2,.7,.2,1) .9s}
.fsa__divider i:last-child{background:linear-gradient(90deg,var(--gold),transparent)}
.fsa__divider.is-in i{width:90px}
.fsa__divider svg{width:58px;height:58px;fill:none;stroke:var(--rose-2);stroke-width:1.6;stroke-linecap:round;stroke-linejoin:round}
.fsa__divider svg *{stroke-dasharray:120;stroke-dashoffset:120;transition:stroke-dashoffset 1.8s cubic-bezier(.6,0,.2,1) .4s}
.fsa__divider.is-in svg *{stroke-dashoffset:0}
.fsa__divider .flame{fill:var(--gold);stroke:none;transform-origin:50% 100%;transform-box:fill-box;animation:fsaFlame 1.4s ease-in-out infinite;opacity:0;transition:opacity .6s 2s}
.fsa__divider.is-in .flame{opacity:1}
@keyframes fsaFlame{0%,100%{transform:scale(1) rotate(-4deg)}50%{transform:scale(1.18,.9) rotate(4deg)}}

/* Texto que acende ao rolar */
.fsa__text{font-size:clamp(18px,2vw,22px);line-height:1.75;font-weight:400;color:var(--choco-2);margin:0 0 28px}
.fsa__text strong{font-weight:600;color:var(--rose-2)}
.fsa__text .tw{transition:opacity .35s ease,color .35s ease}
.fsa--js .fsa__text .tw{opacity:.16}
.fsa--js .fsa__text .tw.on{opacity:1}

/* Frase final */
.fsa__closing{position:relative;display:inline-block;margin:26px 0 0;font-family:'Playfair Display',serif;font-style:italic;font-weight:600;
  font-size:clamp(24px,3.2vw,34px);color:var(--choco);padding:0 34px}
.fsa__closing::after{content:"";position:absolute;left:34px;right:34px;bottom:-6px;height:10px;border-radius:10px;background:rgba(224,122,133,.25);z-index:-1;
  transform:scaleX(0);transform-origin:left;transition:transform 1.1s cubic-bezier(.7,0,.2,1) .5s}
.fsa__closing.is-in::after{transform:scaleX(1)}
.fsa__closing svg{position:absolute;width:22px;height:22px;fill:var(--gold);animation:fsaTwinkle 2.4s ease-in-out infinite}
.fsa__closing svg:first-of-type{left:0;top:-6px}
.fsa__closing svg:last-of-type{right:0;bottom:-2px;width:16px;height:16px;fill:var(--rose);animation-delay:-1.2s}
@keyframes fsaTwinkle{0%,100%{transform:scale(.6) rotate(0);opacity:.5}50%{transform:scale(1.15) rotate(90deg);opacity:1}}

/* Assinatura */
.fsa__sign{display:block;margin-top:34px;font-family:'Great Vibes',cursive;font-size:clamp(36px,4vw,46px);color:var(--rose-2);line-height:1.2}
.fsa--js .fsa__sign{clip-path:inset(0 100% 0 0);transition:clip-path 2s cubic-bezier(.6,0,.2,1) .4s}
.fsa__signwrap.is-in .fsa__sign{clip-path:inset(0 0 0 0)}

/* Valores */
.fsa__values{display:grid;grid-template-columns:repeat(3,1fr);gap:22px;max-width:980px;margin:80px auto 0;padding:0 16px}
.fsa__value{display:flex;align-items:center;gap:16px;padding:22px 24px;border-radius:22px;background:rgba(255,255,255,.7);text-align:left;
  -webkit-backdrop-filter:blur(8px);backdrop-filter:blur(8px);border:1px solid rgba(224,122,133,.15);box-shadow:0 18px 40px -24px rgba(74,42,29,.4);
  transition:transform .45s cubic-bezier(.3,1.6,.5,1),box-shadow .45s,border-color .45s}
.fsa__value:hover{transform:translateY(-8px);box-shadow:0 28px 50px -24px rgba(74,42,29,.5);border-color:rgba(224,122,133,.45)}
.fsa__value .ico{flex:none;width:52px;height:52px;border-radius:16px;display:grid;place-items:center;color:#fff;
  background:linear-gradient(135deg,var(--rose),var(--rose-2));box-shadow:0 10px 22px -10px rgba(185,78,92,.8);transition:transform .6s cubic-bezier(.3,1.6,.5,1)}
.fsa__value:nth-child(2) .ico{background:linear-gradient(135deg,var(--gold),#b8893f);box-shadow:0 10px 22px -10px rgba(184,137,63,.8)}
.fsa__value:nth-child(3) .ico{background:linear-gradient(135deg,var(--choco-2),var(--choco));box-shadow:0 10px 22px -10px rgba(42,23,16,.8)}
.fsa__value:hover .ico{transform:rotate(-12deg) scale(1.1)}
.fsa__value .ico svg{width:24px;height:24px}
.fsa__value strong{display:block;font-size:15px;font-weight:600;color:var(--choco)}
.fsa__value small{display:block;font-size:13px;color:var(--text);margin-top:2px}

/* Revelar */
.fsa--js [data-reveal]{opacity:0;transform:translateY(40px);transition:opacity .9s cubic-bezier(.2,.7,.2,1) var(--d,0s),transform .9s cubic-bezier(.2,.7,.2,1) var(--d,0s)}
.fsa--js [data-reveal].is-in{opacity:1;transform:none}

@media (max-width:991px){.fsa__art{width:110px;height:110px;opacity:.6}.fsa__values{grid-template-columns:1fr;max-width:460px}}
@media (max-width:640px){.fsa{padding:100px 0 90px}.fsa__art--l{left:-20px;top:40px}.fsa__art--r{right:-20px;bottom:30px}.fsa__divider.is-in i{width:50px}}
@media (prefers-reduced-motion:reduce){
  .fsa *,.fsa *::before,.fsa *::after{animation:none!important;transition:none!important}
  .fsa--js [data-reveal],.fsa--js .fsa__title .ch{opacity:1;transform:none}
  .fsa--js .fsa__text .tw{opacity:1}
  .fsa--js .fsa__sign{clip-path:none}
}
</style>

<section class="fsa" id="fsa">
    <div class="fsa__giant" aria-hidden="true">Bem-vindo · Bem-vindo · Bem-vindo · Bem-vindo</div>

    <!-- cupcake em traço -->
    <svg class="fsa__art fsa__art--l" viewBox="0 0 120 120" aria-hidden="true">
        <path d="M30 62 L38 104 H82 L90 62"/>
        <path d="M46 62 L50 104 M60 62 V104 M74 62 L70 104"/>
        <path d="M26 62 C18 62 18 46 30 46 C28 32 46 28 50 38 C54 24 76 26 74 40 C88 36 96 50 88 58 C92 62 90 62 86 62 Z"/>
        <circle cx="60" cy="22" r="6"/>
        <path d="M60 16 C62 10 66 8 70 8"/>
    </svg>
    <!-- macaron em traço -->
    <svg class="fsa__art fsa__art--r" viewBox="0 0 120 120" aria-hidden="true">
        <ellipse cx="60" cy="44" rx="40" ry="16"/>
        <path d="M22 54 C26 60 30 58 34 62 C38 58 42 64 46 60 C50 64 54 60 58 64 C62 60 66 64 70 60 C74 64 78 58 82 62 C86 58 92 60 98 54"/>
        <path d="M22 66 C26 72 30 70 34 74 C38 70 42 76 46 72 C50 76 54 72 58 76 C62 72 66 76 70 72 C74 76 78 70 82 74 C86 70 92 72 98 66"/>
        <ellipse cx="60" cy="82" rx="40" ry="16"/>
    </svg>

    <div class="fsa__decor" aria-hidden="true">
        <span style="top:10%;left:30%;background:#e07a85;--r:30deg;--t:8s"></span>
        <span style="top:24%;right:22%;background:#d9b06c;--r:-40deg;--t:10s;--dl:-2s"></span>
        <span style="top:62%;left:12%;background:#d9b06c;--r:70deg;--t:11s;--dl:-4s"></span>
        <span style="bottom:22%;right:30%;background:#e07a85;--r:10deg;--t:9s;--dl:-1s"></span>
        <span style="top:46%;right:8%;background:#4a2a1d;opacity:.35;--r:-60deg;--t:12s;--dl:-5s"></span>
    </div>

    <div class="fsa__inner">
        <span class="fsa__eyebrow" data-reveal>Seja bem-vindo a</span>

        <h1 class="fsa__title" data-letters>Esse Doce é <em>para você</em></h1>

        <div class="fsa__divider" data-watch>
            <i></i>
            <svg viewBox="0 0 48 48" aria-hidden="true">
                <path d="M8 42 H40"/>
                <path d="M11 42 V28 H37 V42"/>
                <path d="M11 33 C15 36 19 30 24 33 C29 36 33 30 37 33"/>
                <path d="M15 28 V20 H33 V28"/>
                <path d="M24 20 V13"/>
                <path class="flame" d="M24 4 C27 8 27 11 24 12 C21 11 21 8 24 4 Z"/>
            </svg>
            <i></i>
        </div>

        <p class="fsa__text" data-words>
            Na <strong>Esse Doce é para você</strong>, cada detalhe é pensado para transformar simples momentos em experiências inesquecíveis.
            Nossos bolos e doces são preparados com ingredientes selecionados, combinando sabor, qualidade e um toque especial de carinho em cada receita.
        </p>
        <p class="fsa__text" data-words>
            Mais do que uma confeitaria, somos um lugar onde aromas encantam, sabores surpreendem e memórias são criadas.
            Do primeiro olhar à última mordida, queremos fazer parte dos seus melhores momentos.
        </p>

        <p class="fsa__closing" data-watch>
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2l2.4 7.6L22 12l-7.6 2.4L12 22l-2.4-7.6L2 12l7.6-2.4z"/></svg>
            Descubra o prazer de saborear o extraordinário.
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2l2.4 7.6L22 12l-7.6 2.4L12 22l-2.4-7.6L2 12l7.6-2.4z"/></svg>
        </p>

        <div class="fsa__signwrap" data-watch><span class="fsa__sign">com carinho, Esse Doce</span></div>
    </div>

    <div class="fsa__values">
        <div class="fsa__value" data-reveal style="--d:.05s">
            <div class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.5 19 2c1 2 2 4.2 2 8 0 5.5-4.8 10-10 10Z"/><path d="M2 21c0-3 1.9-5.4 5.1-6"/></svg></div>
            <div><strong>Ingredientes selecionados</strong><small>Qualidade em cada receita</small></div>
        </div>
        <div class="fsa__value" data-reveal style="--d:.18s">
            <div class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20s-7-4.4-7-10a4 4 0 0 1 7-2.6A4 4 0 0 1 19 10c0 5.6-7 10-7 10z"/></svg></div>
            <div><strong>Feito com carinho</strong><small>Preparado à mão, sem pressa</small></div>
        </div>
        <div class="fsa__value" data-reveal style="--d:.31s">
            <div class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 12v9H4v-9"/><path d="M2 7h20v5H2z"/><path d="M12 21V7"/><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"/><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"/></svg></div>
            <div><strong>Momentos especiais</strong><small>Para celebrar quem você ama</small></div>
        </div>
    </div>
</section>

<script>
(function () {
    var root = document.getElementById('fsa');
    if (!root) return;
    root.classList.add('fsa--js');
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // Título letra por letra
    var title = root.querySelector('[data-letters]'), n = 0;
    function letters(node) {
        Array.prototype.slice.call(node.childNodes).forEach(function (c) {
            if (c.nodeType === 3) {
                var frag = document.createDocumentFragment();
                c.textContent.split(/(\s+)/).forEach(function (part) {
                    if (!part) return;
                    if (/^\s+$/.test(part)) { frag.appendChild(document.createTextNode(' ')); return; }
                    var wd = document.createElement('span'); wd.className = 'wd';
                    Array.from(part).forEach(function (l) {
                        var s = document.createElement('span'); s.className = 'ch'; s.textContent = l;
                        s.style.setProperty('--d', (0.15 + n++ * 0.045) + 's');
                        wd.appendChild(s);
                    });
                    frag.appendChild(wd);
                });
                node.replaceChild(frag, c);
            } else if (c.nodeType === 1) { letters(c); }
        });
    }
    if (title) letters(title);

    // Parágrafos palavra por palavra
    var paras = root.querySelectorAll('[data-words]');
    function words(node) {
        Array.prototype.slice.call(node.childNodes).forEach(function (c) {
            if (c.nodeType === 3) {
                var frag = document.createDocumentFragment();
                c.textContent.split(/(\s+)/).forEach(function (part) {
                    if (!part) return;
                    if (/^\s+$/.test(part)) { frag.appendChild(document.createTextNode(' ')); return; }
                    var s = document.createElement('span'); s.className = 'tw'; s.textContent = part; frag.appendChild(s);
                });
                node.replaceChild(frag, c);
            } else if (c.nodeType === 1) { words(c); }
        });
    }
    paras.forEach(words);

    // Revelar ao rolar
    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) {
            if (e.isIntersecting) { e.target.classList.add('is-in'); io.unobserve(e.target); }
        });
    }, { threshold: 0.25 });
    root.querySelectorAll('[data-reveal], [data-letters], [data-watch], .fsa__art').forEach(function (el) { io.observe(el); });

    // Texto acendendo + texto gigante andando conforme a rolagem
    var giant = root.querySelector('.fsa__giant'), ticking = false;
    function update() {
        var vh = window.innerHeight;
        paras.forEach(function (p) {
            var ws = p.querySelectorAll('.tw'), r = p.getBoundingClientRect();
            var prog = reduce ? 1 : (vh * 0.85 - r.top) / (vh * 0.5 + r.height * 0.5);
            prog = Math.max(0, Math.min(1, prog));
            var lit = Math.round(prog * ws.length);
            ws.forEach(function (w, i) { w.classList.toggle('on', i < lit); });
        });
        if (!reduce && giant) {
            var rr = root.getBoundingClientRect();
            var x = (rr.top / (vh + rr.height)) * 500 - 250;
            giant.style.transform = 'translate3d(' + x + 'px,-50%,0)';
        }
        ticking = false;
    }
    window.addEventListener('scroll', function () {
        if (!ticking) { ticking = true; requestAnimationFrame(update); }
    }, { passive: true });
    window.addEventListener('resize', update);
    update();
})();
</script>
<!--End About Section -->
