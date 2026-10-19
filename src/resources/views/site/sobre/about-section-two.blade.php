<!-- About Section Two: Nossa história (redesign animado) -->
@php
    $sobre = asset('davilla/IMG/bannerbolocerto.png');

    /*
     | LINHA DO TEMPO
     | ⚠️ Troque pelos marcos reais da confeitaria (ano ou etapa + título + texto curto).
     */
    $historia = [
        ['marco' => 'O começo',  'titulo' => 'Uma receita de família',     'texto' => 'Tudo começou na cozinha de casa, com as receitas da avó e o sonho de adoçar o dia das pessoas.'],
        ['marco' => 'O primeiro passo', 'titulo' => 'As primeiras encomendas', 'texto' => 'Os bolos conquistaram amigos e vizinhos, e as encomendas começaram a chegar pelo boca a boca.'],
        ['marco' => 'Crescendo', 'titulo' => 'Nossa própria confeitaria', 'texto' => 'Com uma equipe apaixonada, ganhamos um espaço só nosso para criar doces ainda mais especiais.'],
        ['marco' => 'Hoje',      'titulo' => 'Presentes nos seus momentos', 'texto' => 'Seguimos fazendo tudo à mão, com o mesmo carinho, para aniversários, casamentos e o café da tarde.'],
    ];
@endphp

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,500;1,600&family=Poppins:wght@300;400;500;600&family=Great+Vibes&display=swap" rel="stylesheet">

<style>
.fsh{--cream:#fdf6ee;--blush:#fbede6;--choco:#2a1710;--choco-2:#4a2a1d;--rose:#e07a85;--rose-2:#b94e5c;--gold:#d9b06c;--gold-2:#f3d9a4;--text:#6e5a50;--muted:#a08d7d;
  position:relative;padding:130px 0;font-family:'Poppins',sans-serif;color:var(--choco);overflow:hidden;isolation:isolate;
  background:linear-gradient(180deg,var(--cream),var(--blush))}
.fsh *{box-sizing:border-box}
.fsh__blob{position:absolute;border-radius:50%;filter:blur(90px);z-index:-1;animation:fshBlob 20s ease-in-out infinite}
.fsh__blob--1{width:460px;height:460px;background:rgba(224,122,133,.2);top:-120px;left:-140px}
.fsh__blob--2{width:420px;height:420px;background:rgba(217,176,108,.22);bottom:-120px;right:-120px;animation-delay:-9s}
@keyframes fshBlob{50%{transform:translate(60px,40px) scale(1.12)}}

.fsh__wrap{max-width:1200px;margin:0 auto;padding:0 20px;display:grid;grid-template-columns:.95fr 1.05fr;gap:80px;align-items:start}

/* Imagem */
.fsh__visual{position:sticky;top:110px}
.fsh__frame{position:relative;aspect-ratio:4/5;max-width:500px;margin:0 auto}
.fsh__frame::before{content:"";position:absolute;inset:-22px 22px 22px -22px;border-radius:220px 220px 30px 30px;border:2px solid var(--gold);opacity:.6}
.fsh__img{position:absolute;inset:0;border-radius:220px 220px 30px 30px;overflow:hidden;box-shadow:0 50px 90px -40px rgba(74,42,29,.6);
  background:linear-gradient(160deg,#f3c6c9,#f3d9a4)}
.fsh__img img{position:absolute;inset:-8% 0;width:100%;height:116%;object-fit:cover;color:transparent;will-change:transform}
.fsh--js .fsh__img{clip-path:inset(100% 0 0 0 round 220px 220px 30px 30px);transition:clip-path 1.6s cubic-bezier(.7,0,.2,1) .2s}
.fsh--js .fsh__visual.is-in .fsh__img{clip-path:inset(0 0 0 0 round 220px 220px 30px 30px)}

.fsh__badge{position:absolute;right:-30px;bottom:60px;width:150px;height:150px;border-radius:50%;display:grid;place-items:center;text-align:center;
  background:var(--choco);color:#fff;box-shadow:0 26px 50px -20px rgba(42,23,16,.7)}
.fsh__badge svg.txt{position:absolute;inset:10px;width:calc(100% - 20px);height:calc(100% - 20px);animation:fshSpin 18s linear infinite}
.fsh__badge text{font-size:10px;letter-spacing:3px;fill:var(--gold-2);font-weight:600;text-transform:uppercase}
.fsh__badge b{position:relative;font-family:'Great Vibes',cursive;font-weight:400;font-size:30px;line-height:1;color:var(--rose)}
@keyframes fshSpin{to{transform:rotate(360deg)}}
.fsh--js .fsh__badge{transform:scale(0) rotate(-120deg);transition:transform 1s cubic-bezier(.3,1.5,.5,1) 1.2s}
.fsh--js .fsh__visual.is-in .fsh__badge{transform:none}

.fsh__chip{position:absolute;left:-26px;top:70px;display:flex;align-items:center;gap:10px;padding:12px 18px 12px 12px;border-radius:18px;background:#fff;
  box-shadow:0 20px 40px -18px rgba(74,42,29,.45);animation:fshFloat 5s ease-in-out infinite}
.fsh__chip .ico{width:40px;height:40px;border-radius:12px;display:grid;place-items:center;background:rgba(224,122,133,.14);color:var(--rose-2)}
.fsh__chip .ico svg{width:22px;height:22px}
.fsh__chip strong{display:block;font-size:14px;font-weight:600;line-height:1.2}
.fsh__chip small{display:block;font-size:12px;color:var(--text)}
@keyframes fshFloat{50%{translate:0 -12px}}

/* Texto */
.fsh__eyebrow{display:inline-flex;align-items:center;gap:12px;font-size:13px;font-weight:600;letter-spacing:.32em;text-transform:uppercase;color:var(--rose-2)}
.fsh__eyebrow::before{content:"";height:1px;width:0;background:var(--rose);transition:width 1.2s cubic-bezier(.2,.7,.2,1) .2s}
.fsh__eyebrow.is-in::before{width:46px}
.fsh__title{font-family:'Playfair Display',serif;font-weight:800;font-size:clamp(38px,5.2vw,60px);line-height:1.06;letter-spacing:-.02em;margin:18px 0 22px}
.fsh__title em{font-style:italic;font-weight:600;background:linear-gradient(90deg,var(--rose-2),var(--rose),var(--gold),var(--rose-2));background-size:300% 100%;
  -webkit-background-clip:text;background-clip:text;color:transparent;animation:fshShine 6s linear infinite}
@keyframes fshShine{to{background-position:300% 0}}
.fsh__lead{font-size:17px;line-height:1.8;color:var(--text);margin:0 0 50px;font-weight:300}
.fsh__lead b{font-weight:600;color:var(--choco)}

/* Linha do tempo */
.fsh__timeline{position:relative;margin:0 0 50px;padding:0 0 0 58px}
.fsh__steps{list-style:none;margin:0;padding:0}
.fsh__line{position:absolute;left:19px;top:8px;bottom:8px;width:2px;border-radius:2px;background:rgba(74,42,29,.12);overflow:hidden}
.fsh__line i{position:absolute;left:0;top:0;width:100%;height:0;border-radius:2px;background:linear-gradient(180deg,var(--rose),var(--gold))}
.fsh__step{position:relative;padding-bottom:36px}
.fsh__step:last-child{padding-bottom:0}
.fsh__dot{position:absolute;left:-58px;top:0;width:40px;height:40px;border-radius:50%;display:grid;place-items:center;background:#fff;color:var(--muted);
  box-shadow:0 0 0 2px rgba(74,42,29,.12);font-family:'Playfair Display',serif;font-weight:700;font-size:15px;
  transition:background .5s,color .5s,box-shadow .5s,transform .6s cubic-bezier(.3,1.7,.5,1)}
.fsh__step.is-on .fsh__dot{background:linear-gradient(135deg,var(--rose),var(--rose-2));color:#fff;box-shadow:0 0 0 6px rgba(224,122,133,.18),0 10px 20px -8px rgba(185,78,92,.7);transform:scale(1.08)}
.fsh__marco{display:inline-block;font-size:11px;font-weight:600;letter-spacing:.18em;text-transform:uppercase;color:var(--rose-2);margin-bottom:6px}
.fsh__step h3{font-family:'Playfair Display',serif;font-weight:700;font-size:23px;line-height:1.25;margin:0 0 8px;color:var(--choco)}
.fsh__step p{font-size:15px;line-height:1.75;color:var(--text);margin:0}
.fsh__step .card{padding:2px 0;transition:opacity .6s,transform .7s cubic-bezier(.2,.7,.2,1)}
.fsh--js .fsh__step .card{opacity:.35;transform:translateX(16px)}
.fsh--js .fsh__step.is-on .card{opacity:1;transform:none}

/* Assinatura + botão */
.fsh__end{display:flex;align-items:center;gap:30px;flex-wrap:wrap}
.fsh__sign{font-family:'Great Vibes',cursive;font-size:40px;line-height:1.1;color:var(--rose-2)}
.fsh--js .fsh__sign{clip-path:inset(0 100% 0 0);transition:clip-path 1.8s cubic-bezier(.6,0,.2,1) .3s}
.fsh__end.is-in .fsh__sign{clip-path:inset(0 0 0 0)}
.fsh__btn{position:relative;display:inline-flex;align-items:center;gap:12px;padding:17px 32px;border-radius:60px;overflow:hidden;font-size:15px;font-weight:600;
  color:#fff;text-decoration:none;background:linear-gradient(135deg,var(--rose),var(--rose-2));box-shadow:0 18px 40px -14px rgba(185,78,92,.7);
  transition:transform .35s cubic-bezier(.3,1.6,.5,1),box-shadow .35s}
.fsh__btn:hover{color:#fff;text-decoration:none;transform:translateY(-3px);box-shadow:0 24px 50px -14px rgba(185,78,92,.85)}
.fsh__btn svg{width:18px;height:18px;transition:transform .4s}
.fsh__btn:hover svg{transform:translateX(5px)}
.fsh__btn::after{content:"";position:absolute;top:0;left:-70%;width:45%;height:100%;background:linear-gradient(115deg,transparent,rgba(255,255,255,.45),transparent);transform:skewX(-20deg);animation:fshSweep 3.5s ease-in-out infinite}
@keyframes fshSweep{0%,60%{left:-70%}100%{left:130%}}

/* Revelar */
.fsh--js [data-reveal]{opacity:0;transform:translateY(40px);transition:opacity 1s cubic-bezier(.2,.7,.2,1) var(--d,0s),transform 1s cubic-bezier(.2,.7,.2,1) var(--d,0s)}
.fsh--js [data-reveal].is-in{opacity:1;transform:none}
.fsh--js .fsh__visual[data-reveal]{transform:none}

@media (max-width:991px){
  .fsh{padding:100px 0}
  .fsh__wrap{grid-template-columns:1fr;gap:70px}
  .fsh__visual{position:relative;top:0}
  .fsh__frame{max-width:420px}
}
@media (max-width:560px){
  .fsh__frame{max-width:300px}
  .fsh__badge{width:116px;height:116px;right:-14px;bottom:30px}
  .fsh__badge text{font-size:8px;letter-spacing:2.2px}
  .fsh__badge b{font-size:24px}
  .fsh__chip{left:-12px;top:30px}
  .fsh__timeline{padding-left:52px}
  .fsh__dot{left:-52px;width:36px;height:36px}
  .fsh__line{left:17px}
}
@media (prefers-reduced-motion:reduce){
  .fsh *,.fsh *::before,.fsh *::after{animation:none!important;transition:none!important}
  .fsh--js [data-reveal],.fsh--js .fsh__step .card,.fsh--js .fsh__badge{opacity:1;transform:none}
  .fsh--js .fsh__img,.fsh--js .fsh__sign{clip-path:none}
}
</style>

<section class="fsh" id="fsh">
    <div class="fsh__blob fsh__blob--1"></div>
    <div class="fsh__blob fsh__blob--2"></div>

    <div class="fsh__wrap">
        <!-- Imagem -->
        <div class="fsh__visual" data-reveal>
            <div class="fsh__frame">
                <div class="fsh__img"><img src="{{ $sobre }}" alt="Bolo artesanal da nossa confeitaria"></div>

                <div class="fsh__chip">
                    <span class="ico"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 21s-8-5-8-11a4.5 4.5 0 0 1 8-2.8A4.5 4.5 0 0 1 20 10c0 6-8 11-8 11z"/></svg></span>
                    <span><strong>Feito à mão</strong><small>Receitas de família</small></span>
                </div>

                <div class="fsh__badge" aria-hidden="true">
                    <svg class="txt" viewBox="0 0 100 100">
                        <defs><path id="fshCircle" d="M50,50 m-40,0 a40,40 0 1,1 80,0 a40,40 0 1,1 -80,0"/></defs>
                        <text><textPath href="#fshCircle">Nossa história • com amor •</textPath></text>
                    </svg>
                    <b>desde<br>sempre</b>
                </div>
            </div>
        </div>

        <!-- Texto -->
        <div class="fsh__content">
            <span class="fsh__eyebrow" data-reveal>Quem somos</span>
            <h2 class="fsh__title" data-reveal style="--d:.1s">Nossa <em>história</em></h2>
            <p class="fsh__lead" data-reveal style="--d:.2s">
                Somos uma confeitaria artesanal que nasceu do amor pelos doces e pelas pessoas. Cada bolo, torta e docinho é preparado
                <b>à mão</b>, com ingredientes selecionados e o mesmo cuidado de quando tudo começou.
            </p>

            <div class="fsh__timeline">
                <span class="fsh__line" aria-hidden="true"><i></i></span>
                <ol class="fsh__steps">
                @foreach ($historia as $etapa)
                    <li class="fsh__step">
                        <span class="fsh__dot">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <div class="card">
                            <span class="fsh__marco">{{ $etapa['marco'] }}</span>
                            <h3>{{ $etapa['titulo'] }}</h3>
                            <p>{{ $etapa['texto'] }}</p>
                        </div>
                    </li>
                @endforeach
                </ol>
            </div>

            <div class="fsh__end" data-reveal>
                {{-- Troque o "#" pelo link da sua página de cardápio/vitrine --}}
                <a href="#" class="fsh__btn">Conheça nossos doces
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                </a>
                <span class="fsh__sign">com carinho, da nossa cozinha</span>
            </div>
        </div>
    </div>
</section>

<script>
(function () {
    var root = document.getElementById('fsh');
    if (!root) return;
    root.classList.add('fsh--js');
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) {
            if (e.isIntersecting) { e.target.classList.add('is-in'); io.unobserve(e.target); }
        });
    }, { threshold: 0.2 });
    root.querySelectorAll('[data-reveal]').forEach(function (el) { io.observe(el); });

    var tl = root.querySelector('.fsh__timeline'), fill = root.querySelector('.fsh__line i');
    var steps = root.querySelectorAll('.fsh__step');
    var img = root.querySelector('.fsh__img img'), tick = false;

    function update() {
        var vh = innerHeight, mark = vh * 0.6;
        var r = tl.getBoundingClientRect();
        var p = reduce ? 1 : Math.max(0, Math.min(1, (mark - r.top) / r.height));
        fill.style.height = (p * 100) + '%';
        steps.forEach(function (s) {
            var d = s.querySelector('.fsh__dot').getBoundingClientRect();
            s.classList.toggle('is-on', reduce || d.top + d.height / 2 < mark);
        });
        if (!reduce && img) {
            var ri = root.getBoundingClientRect();
            img.style.transform = 'translate3d(0,' + ((ri.top + ri.height / 2 - vh / 2) * -0.06) + 'px,0)';
        }
        tick = false;
    }
    window.addEventListener('scroll', function () { if (!tick) { tick = true; requestAnimationFrame(update); } }, { passive: true });
    window.addEventListener('resize', update);
    update();
})();
</script>
<!--End About Section -->
