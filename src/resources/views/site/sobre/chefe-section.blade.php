<!-- Chef Section (redesign animado) -->
@php
    /*
     | DADOS DA CHEF — editados no painel (Conteúdo do Site → Páginas → Sobre → Chef).
     | Número vazio não aparece; sem nenhum, os contadores somem.
     */
    $numerosChef = [];
    foreach ([1, 2, 3] as $n) {
        if (!preg_match('/^\s*(\d+)\s*(.*)$/', conteudo("sobre.chef.numero{$n}"), $partes)) continue;
        $numerosChef[] = ['valor' => (int) $partes[1], 'sufixo' => $partes[2], 'rotulo' => conteudo("sobre.chef.numero{$n}_texto")];
    }

    $chef = [
        'nome'        => conteudo('sobre.chef.nome'),
        'cargo'       => conteudo('sobre.chef.cargo'),
        'frase'       => conteudo('sobre.chef.frase'),
        'bio'         => conteudo('sobre.chef.bio'),
        'assinatura'  => conteudo('sobre.chef.assinatura'),
        'foto'        => conteudo_img('sobre.chef.foto'),
        'numeros'     => $numerosChef,
        'botao_texto' => conteudo('sobre.chef.botao_texto'),
        'botao_link'  => conteudo_link('sobre.chef.botao_link'),
    ];
@endphp

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,500;1,600&family=Poppins:wght@300;400;500;600&family=Great+Vibes&display=swap" rel="stylesheet">

<style>
.fch{--cream:#fdf6ee;--blush:#fbede6;--choco:#2a1710;--choco-2:#4a2a1d;--rose:#e07a85;--rose-2:#b94e5c;--gold:#d9b06c;--gold-2:#f3d9a4;--text:#6e5a50;
  position:relative;padding:120px 0;font-family:'Poppins',sans-serif;color:var(--choco);overflow:hidden;isolation:isolate;background:var(--cream)}
.fch *{box-sizing:border-box}
.fch__blob{position:absolute;border-radius:50%;filter:blur(90px);z-index:-1;animation:fchBlob 20s ease-in-out infinite}
.fch__blob--1{width:480px;height:480px;background:rgba(224,122,133,.22);top:-120px;left:10%}
.fch__blob--2{width:400px;height:400px;background:rgba(217,176,108,.22);bottom:-140px;right:-100px;animation-delay:-9s}
@keyframes fchBlob{50%{transform:translate(50px,40px) scale(1.12)}}

.fch__wrap{max-width:1200px;margin:0 auto;padding:0 20px;display:grid;grid-template-columns:1fr 1fr;gap:70px;align-items:center}

/* Imagem com órbita */
.fch__visual{position:relative;width:100%;max-width:520px;aspect-ratio:1;margin:0 auto}
.fch__disc{position:absolute;inset:8%;border-radius:50%;background:radial-gradient(circle at 35% 30%,#f6c9cd,var(--rose) 60%,var(--rose-2));
  box-shadow:0 50px 90px -40px rgba(185,78,92,.7),inset 0 -30px 60px rgba(42,23,16,.18)}
.fch--js .fch__disc{transform:scale(0);transition:transform 1.2s cubic-bezier(.3,1.4,.5,1)}
.fch__visual.is-in .fch__disc{transform:none}
.fch__orbit{position:absolute;inset:0;border-radius:50%;border:1.5px dashed rgba(217,176,108,.65);animation:fchSpin 40s linear infinite}
.fch__orbit--2{inset:-6%;border-color:rgba(224,122,133,.35);animation-duration:60s;animation-direction:reverse}
.fch__planet{position:absolute;width:56px;height:56px;margin:-28px 0 0 -28px;border-radius:50%;display:grid;place-items:center;background:#fff;
  box-shadow:0 14px 28px -12px rgba(74,42,29,.5);color:var(--rose-2)}
.fch__planet svg{width:26px;height:26px;animation:fchSpin 40s linear infinite reverse}
.fch__planet:nth-child(1){left:50%;top:0}
.fch__planet:nth-child(2){left:100%;top:50%;color:#b8893f}
.fch__planet:nth-child(3){left:50%;top:100%}
.fch__planet:nth-child(4){left:0;top:50%;color:var(--choco-2)}
@keyframes fchSpin{to{transform:rotate(360deg)}}

.fch__photo{position:absolute;left:8%;right:8%;bottom:8%;top:-4%;border-radius:0 0 50% 50%/0 0 46% 46%;overflow:hidden;display:flex;align-items:flex-end;justify-content:center}
.fch__photo img{width:100%;height:100%;object-fit:contain;object-position:bottom center;color:transparent;filter:drop-shadow(0 20px 30px rgba(42,23,16,.3));will-change:transform}
.fch--js .fch__photo img{transform:translateY(30%);opacity:0;transition:transform 1.3s cubic-bezier(.2,.8,.2,1) .35s,opacity .8s .35s}
.fch__visual.is-in .fch__photo img{transform:none;opacity:1}

.fch__badge{position:absolute;z-index:3;right:0;bottom:12%;width:128px;height:128px;border-radius:50%;display:grid;place-items:center;background:var(--choco);
  box-shadow:0 20px 40px -16px rgba(42,23,16,.7)}
.fch__badge svg.txt{position:absolute;inset:8px;width:calc(100% - 16px);height:calc(100% - 16px);animation:fchSpin 16s linear infinite}
.fch__badge text{font-size:10.5px;letter-spacing:3px;fill:var(--gold-2);font-weight:600;text-transform:uppercase}
.fch__badge .ic{width:40px;height:40px;color:var(--gold-2)}
.fch--js .fch__badge{transform:scale(0) rotate(-120deg);transition:transform 1s cubic-bezier(.3,1.5,.5,1) 1s}
.fch__visual.is-in .fch__badge{transform:none}

/* Texto */
.fch__eyebrow{display:inline-flex;align-items:center;gap:12px;font-size:13px;font-weight:600;letter-spacing:.32em;text-transform:uppercase;color:var(--rose-2)}
.fch__eyebrow::before{content:"";height:1px;width:0;background:var(--rose);transition:width 1.2s cubic-bezier(.2,.7,.2,1) .2s}
.fch__eyebrow.is-in::before{width:46px}
.fch__name{font-family:'Playfair Display',serif;font-weight:800;font-size:clamp(40px,5.4vw,64px);line-height:1.04;letter-spacing:-.02em;margin:16px 0 8px}
.fch__role{display:inline-block;font-size:14px;font-weight:600;letter-spacing:.14em;text-transform:uppercase;
  background:linear-gradient(90deg,var(--rose-2),var(--gold));-webkit-background-clip:text;background-clip:text;color:transparent}
.fch__quote{position:relative;margin:30px 0 22px;padding:22px 26px 22px 64px;border-radius:22px;background:#fff;box-shadow:0 20px 40px -26px rgba(74,42,29,.4);
  font-family:'Playfair Display',serif;font-style:italic;font-weight:500;font-size:20px;line-height:1.55;color:var(--choco-2)}
.fch__quote svg{position:absolute;left:20px;top:20px;width:32px;height:32px;fill:var(--rose);opacity:.85}
.fch__bio{font-size:16px;line-height:1.85;color:var(--text);margin:0 0 34px;font-weight:300}

.fch__stats{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:38px}
.fch__stat{padding:18px 12px;border-radius:18px;text-align:center;background:rgba(255,255,255,.75);border:1px solid rgba(224,122,133,.16);
  transition:transform .45s cubic-bezier(.3,1.6,.5,1),box-shadow .45s}
.fch__stat:hover{transform:translateY(-6px);box-shadow:0 20px 36px -22px rgba(74,42,29,.5)}
.fch__stat strong{display:block;font-family:'Playfair Display',serif;font-weight:800;font-size:34px;line-height:1.1;color:var(--rose-2)}
.fch__stat span{display:block;margin-top:4px;font-size:11.5px;letter-spacing:.1em;text-transform:uppercase;color:var(--text)}

.fch__end{display:flex;align-items:center;gap:30px;flex-wrap:wrap}
.fch__btn{position:relative;display:inline-flex;align-items:center;gap:12px;padding:17px 32px;border-radius:60px;overflow:hidden;font-size:15px;font-weight:600;
  color:#fff;text-decoration:none;background:linear-gradient(135deg,var(--choco-2),var(--choco));box-shadow:0 18px 40px -14px rgba(42,23,16,.7);
  transition:transform .35s cubic-bezier(.3,1.6,.5,1),box-shadow .35s}
.fch__btn:hover{color:#fff;text-decoration:none;transform:translateY(-3px);box-shadow:0 24px 50px -14px rgba(42,23,16,.85)}
.fch__btn svg{width:18px;height:18px;transition:transform .4s}
.fch__btn:hover svg{transform:translateX(5px)}
.fch__btn::after{content:"";position:absolute;top:0;left:-70%;width:45%;height:100%;background:linear-gradient(115deg,transparent,rgba(243,217,164,.35),transparent);transform:skewX(-20deg);animation:fchSweep 3.5s ease-in-out infinite}
@keyframes fchSweep{0%,60%{left:-70%}100%{left:130%}}
.fch__sign{font-family:'Great Vibes',cursive;font-size:44px;line-height:1;color:var(--rose-2)}
.fch--js .fch__sign{clip-path:inset(0 100% 0 0);transition:clip-path 1.8s cubic-bezier(.6,0,.2,1) .4s}
.fch__end.is-in .fch__sign{clip-path:inset(0 0 0 0)}

/* Revelar */
.fch--js [data-reveal]{opacity:0;transform:translateY(40px);transition:opacity 1s cubic-bezier(.2,.7,.2,1) var(--d,0s),transform 1s cubic-bezier(.2,.7,.2,1) var(--d,0s)}
.fch--js [data-reveal].is-in{opacity:1;transform:none}
.fch--js .fch__visual[data-reveal]{transform:none}

@media (max-width:991px){
  .fch{padding:100px 0}
  .fch__wrap{grid-template-columns:1fr;gap:60px}
  .fch__visual{max-width:440px}
}
@media (max-width:520px){
  .fch__visual{max-width:320px}
  .fch__planet{width:44px;height:44px;margin:-22px 0 0 -22px}
  .fch__planet svg{width:20px;height:20px}
  .fch__badge{width:100px;height:100px}
  .fch__badge text{font-size:8.5px;letter-spacing:2.4px}
  .fch__stats{grid-template-columns:1fr 1fr 1fr;gap:8px}
  .fch__stat strong{font-size:26px}
  .fch__stat span{font-size:10px}
  .fch__quote{font-size:17px;padding:18px 18px 18px 54px}
}
@media (prefers-reduced-motion:reduce){
  .fch *,.fch *::before,.fch *::after{animation:none!important;transition:none!important}
  .fch--js [data-reveal],.fch--js .fch__disc,.fch--js .fch__photo img,.fch--js .fch__badge{opacity:1;transform:none}
  .fch--js .fch__sign{clip-path:none}
}
</style>

<section class="fch" id="fch">
    <div class="fch__blob fch__blob--1"></div>
    <div class="fch__blob fch__blob--2"></div>

    <div class="fch__wrap">
        <!-- Imagem -->
        <div class="fch__visual" data-reveal>
            <div class="fch__disc"></div>
            <div class="fch__orbit fch__orbit--2"></div>
            <div class="fch__orbit">
                <span class="fch__planet"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 21h16M5 21v-6a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v6"/><path d="M5 17c1.2 0 1.8-1 3-1s1.8 1 3 1 1.8-1 3-1 1.8 1 3 1 1.8-1 2-1"/><path d="M12 13V9M12 6.5c-.8-.8-.8-1.8 0-3 .8 1.2.8 2.2 0 3z"/></svg></span>
                <span class="fch__planet"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l2.4 7.6L22 12l-7.6 2.4L12 22l-2.4-7.6L2 12l7.6-2.4z"/></svg></span>
                <span class="fch__planet"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 21s-8-5-8-11a4.5 4.5 0 0 1 8-2.8A4.5 4.5 0 0 1 20 10c0 6-8 11-8 11z"/></svg></span>
                <span class="fch__planet"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 13h12l-1.5 8h-9z"/><path d="M5 13c-1.5 0-2-2.5 0-3.5C4.5 6 8 5 9.5 7c.5-3 5.5-3 6 0 1.5-2 5-1 4.5 2.5 2 1 1.5 3.5 0 3.5"/></svg></span>
            </div>
            <div class="fch__photo"><img src="{{ $chef['foto'] }}" alt="{{ $chef['nome'] }}, {{ $chef['cargo'] }}"></div>
            <div class="fch__badge" aria-hidden="true">
                <svg class="txt" viewBox="0 0 100 100">
                    <defs><path id="fchCircle" d="M50,50 m-40,0 a40,40 0 1,1 80,0 a40,40 0 1,1 -80,0"/></defs>
                    <text><textPath href="#fchCircle">Chef confeiteira • com amor •</textPath></text>
                </svg>
                <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M6 13.9A4 4 0 0 1 7.5 6a5 5 0 0 1 9 0A4 4 0 0 1 18 13.9V20H6z"/><path d="M6 17h12"/></svg>
            </div>
        </div>

        <!-- Texto -->
        <div class="fch__content">
            <span class="fch__eyebrow" data-reveal>{{ conteudo('sobre.chef.selo') }}</span>
            <h2 class="fch__name" data-reveal style="--d:.1s">{{ $chef['nome'] }}</h2>
            <span class="fch__role" data-reveal style="--d:.15s">{{ $chef['cargo'] }}</span>

            <blockquote class="fch__quote" data-reveal style="--d:.25s">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M9.6 5C5.9 6.3 3.5 9.4 3.5 13.3c0 3 1.8 5.2 4.4 5.2 2.2 0 3.9-1.6 3.9-3.8 0-2.1-1.5-3.6-3.5-3.6-.4 0-.7 0-1 .1.4-1.9 2-3.6 4-4.4L9.6 5zm10 0c-3.7 1.3-6.1 4.4-6.1 8.3 0 3 1.8 5.2 4.4 5.2 2.2 0 3.9-1.6 3.9-3.8 0-2.1-1.5-3.6-3.5-3.6-.4 0-.7 0-1 .1.4-1.9 2-3.6 4-4.4L19.6 5z"/></svg>
                {{ $chef['frase'] }}
            </blockquote>

            <p class="fch__bio" data-reveal style="--d:.3s">{{ $chef['bio'] }}</p>

            @if (!empty($chef['numeros']))
                <div class="fch__stats" data-reveal style="--d:.35s">
                    @foreach ($chef['numeros'] as $n)
                        <div class="fch__stat">
                            <strong data-count="{{ $n['valor'] }}" data-suffix="{{ $n['sufixo'] }}">{{ number_format($n['valor'], 0, ',', '.') }}{{ $n['sufixo'] }}</strong>
                            <span>{{ $n['rotulo'] }}</span>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="fch__end" data-reveal style="--d:.4s">
                <a href="{{ $chef['botao_link'] }}" class="fch__btn">{{ $chef['botao_texto'] }}
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                </a>
                <span class="fch__sign">{{ $chef['assinatura'] }}</span>
            </div>
        </div>
    </div>
</section>

<script>
(function () {
    var root = document.getElementById('fch');
    if (!root) return;
    root.classList.add('fch--js');
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    function count(el) {
        var end = +el.dataset.count, suf = el.dataset.suffix || '';
        if (reduce || !end) return;
        var dur = 1800, t0 = performance.now();
        (function step(t) {
            var p = Math.min((t - t0) / dur, 1), e = 1 - Math.pow(1 - p, 3);
            el.textContent = Math.round(end * e).toLocaleString('pt-BR') + suf;
            if (p < 1) requestAnimationFrame(step);
        })(t0);
    }

    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) {
            if (!e.isIntersecting) return;
            e.target.classList.add('is-in');
            e.target.querySelectorAll('[data-count]').forEach(count);
            io.unobserve(e.target);
        });
    }, { threshold: 0.2 });
    root.querySelectorAll('[data-reveal]').forEach(function (el) { io.observe(el); });

    // Foto acompanha levemente o mouse
    var vis = root.querySelector('.fch__visual'), img = root.querySelector('.fch__photo img');
    if (!reduce && window.matchMedia('(hover: hover)').matches) {
        vis.addEventListener('mousemove', function (e) {
            if (!vis.classList.contains('is-in')) return;
            var r = vis.getBoundingClientRect(), x = (e.clientX - r.left) / r.width - .5, y = (e.clientY - r.top) / r.height - .5;
            img.style.transition = 'transform .3s ease-out';
            img.style.transform = 'translate(' + (x * 14) + 'px,' + (y * 10) + 'px)';
        });
        vis.addEventListener('mouseleave', function () { img.style.transition = 'transform .8s cubic-bezier(.2,.7,.2,1)'; img.style.transform = ''; });
    }
})();
</script>
<!-- End Chef Section -->
