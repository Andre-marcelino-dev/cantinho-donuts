<!-- Features Section: Nossa missão (redesign animado) -->
@php
    // Textos editados no painel (Conteúdo do Site → Páginas → Sobre → Nossa missão)
    // Palavras que se alternam na frase da missão
    $palavrasMissao = conteudo_lista('sobre.missao.palavras') ?: ['alegria'];

    $valores = [];
    foreach (['tradicao', 'qualidade', 'criatividade', 'paixao'] as $n => $icone) {
        $n++;
        if (conteudo("sobre.missao.valor{$n}_titulo") === '') continue;
        $valores[] = ['titulo' => conteudo("sobre.missao.valor{$n}_titulo"), 'texto' => conteudo("sobre.missao.valor{$n}_texto"), 'icone' => $icone];
    }
    $iconesValores = [
        'tradicao'     => '<path d="M4 21h16M5 21v-6a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v6"/><path d="M5 17c1.2 0 1.8-1 3-1s1.8 1 3 1 1.8-1 3-1 1.8 1 3 1 1.8-1 2-1"/><path d="M12 13V9M12 6.5c-.8-.8-.8-1.8 0-3 .8 1.2.8 2.2 0 3z"/>',
        'qualidade'    => '<circle cx="12" cy="9" r="6"/><path d="M8.5 13.8 7 22l5-3 5 3-1.5-8.2"/><path d="M9.8 9l1.5 1.5L14.5 7.5"/>',
        'criatividade' => '<path d="M12 3l1.8 4.2L18 9l-4.2 1.8L12 15l-1.8-4.2L6 9l4.2-1.8z"/><path d="M19 15l.8 1.7 1.7.8-1.7.8L19 20l-.8-1.7-1.7-.8 1.7-.8zM5 15l.6 1.4 1.4.6-1.4.6L5 19l-.6-1.4L3 17l1.4-.6z"/>',
        'paixao'       => '<path d="M12 20s-7-4.4-7-10a4 4 0 0 1 7-2.6A4 4 0 0 1 19 10c0 5.6-7 10-7 10z"/>',
    ];
@endphp

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,500;1,600&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
.fsm{--cream:#fdf6ee;--choco:#2a1710;--choco-2:#4a2a1d;--rose:#e07a85;--rose-2:#b94e5c;--gold:#d9b06c;--gold-2:#f3d9a4;
  position:relative;padding:130px 0 140px;font-family:'Poppins',sans-serif;color:#fff;overflow:hidden;isolation:isolate;
  background:radial-gradient(ellipse at 50% 0%,rgba(224,122,133,.25),transparent 55%),linear-gradient(180deg,var(--choco-2),var(--choco))}
.fsm *{box-sizing:border-box}
.fsm::before{content:"";position:absolute;inset:0;z-index:-2;opacity:.07;
  background-image:radial-gradient(var(--gold-2) 1.2px,transparent 1.2px);background-size:26px 26px;animation:fsmDots 40s linear infinite}
@keyframes fsmDots{to{background-position:260px 260px}}
.fsm__blob{position:absolute;border-radius:50%;filter:blur(90px);z-index:-1;animation:fsmBlob 20s ease-in-out infinite}
.fsm__blob--1{width:420px;height:420px;background:rgba(224,122,133,.25);bottom:-120px;left:-120px}
.fsm__blob--2{width:380px;height:380px;background:rgba(217,176,108,.2);top:20%;right:-120px;animation-delay:-9s}
@keyframes fsmBlob{50%{transform:translate(60px,-40px) scale(1.15)}}

/* Frase da missão */
.fsm__head{text-align:center;max-width:960px;margin:0 auto 90px;padding:0 16px}
.fsm__eyebrow{display:inline-flex;align-items:center;gap:14px;font-size:13px;font-weight:600;letter-spacing:.32em;text-transform:uppercase;color:var(--gold-2)}
.fsm__eyebrow::before,.fsm__eyebrow::after{content:"";height:1px;width:0;background:var(--gold);transition:width 1.2s cubic-bezier(.2,.7,.2,1) .2s}
.fsm__eyebrow.is-in::before,.fsm__eyebrow.is-in::after{width:46px}
.fsm__statement{font-family:'Playfair Display',serif;font-weight:700;font-size:clamp(32px,5vw,58px);line-height:1.18;letter-spacing:-.015em;margin:24px 0 22px;color:#fff}
.fsm__rotator{position:relative;display:inline-grid;vertical-align:bottom;text-align:left;overflow:hidden;padding:0 .08em .12em;margin-bottom:-.12em}
.fsm__rotator span{grid-area:1/1;font-style:italic;font-weight:600;white-space:nowrap;
  background:linear-gradient(90deg,var(--gold-2),var(--rose),var(--gold));-webkit-background-clip:text;background-clip:text;color:transparent;
  transform:translateY(110%) rotate(6deg);opacity:0;transition:transform .8s cubic-bezier(.2,.8,.2,1),opacity .5s}
.fsm__rotator span.is-on{transform:none;opacity:1}
.fsm__rotator span.is-out{transform:translateY(-110%) rotate(-6deg);opacity:0}
.fsm__rotator::after{content:"";position:absolute;left:.08em;right:.08em;bottom:.08em;height:.09em;border-radius:1em;background:linear-gradient(90deg,var(--rose),var(--gold));
  transform-origin:left;animation:fsmBar 3s cubic-bezier(.6,0,.2,1) infinite}
@keyframes fsmBar{0%{transform:scaleX(0)}40%,80%{transform:scaleX(1)}100%{transform:scaleX(1);opacity:0}}
.fsm__sub{font-size:17px;line-height:1.75;color:rgba(255,255,255,.7);margin:0 auto;max-width:640px;font-weight:300}

/* Valores */
.fsm__values{position:relative;max-width:1240px;margin:0 auto;padding:0 20px;display:grid;grid-template-columns:repeat(4,1fr);gap:26px}
.fsm__track{position:absolute;left:12.5%;right:12.5%;top:70px;height:2px;z-index:0;background-image:linear-gradient(90deg,rgba(243,217,164,.35) 50%,transparent 50%);background-size:14px 2px}
.fsm__track i{position:absolute;inset:0;background:linear-gradient(90deg,var(--rose),var(--gold));transform:scaleX(0);transform-origin:left;transition:transform 2.2s cubic-bezier(.6,0,.2,1) .5s}
.fsm__values.is-in .fsm__track i{transform:scaleX(1)}

.fsm__value{position:relative;z-index:1;text-align:center;padding:0 10px}
.fsm__icon{position:relative;width:140px;height:140px;margin:0 auto 30px;display:grid;place-items:center}
.fsm__frame{position:absolute;inset:0;width:100%;height:100%;fill:var(--choco-2);stroke:rgba(243,217,164,.45);stroke-width:6;
  transition:fill .6s,stroke .6s,transform 1s cubic-bezier(.3,1.4,.5,1)}
.fsm__value:hover .fsm__frame{fill:var(--rose-2);stroke:var(--gold-2);transform:rotate(45deg) scale(1.06)}
.fsm__icon svg.ic{position:relative;width:48px;height:48px;fill:none;stroke:var(--gold-2);stroke-width:1.6;stroke-linecap:round;stroke-linejoin:round;
  transition:transform .6s cubic-bezier(.3,1.7,.5,1),stroke .4s}
.fsm__value:hover svg.ic{transform:scale(1.15) rotate(-8deg);stroke:#fff}
.fsm__icon svg.ic *{stroke-dasharray:120;stroke-dashoffset:120;transition:stroke-dashoffset 1.6s cubic-bezier(.6,0,.2,1) calc(var(--d,0s) + .6s)}
.fsm__value.is-in svg.ic *{stroke-dashoffset:0}
.fsm__num{position:absolute;top:-4px;right:-4px;width:38px;height:38px;border-radius:50%;display:grid;place-items:center;font-family:'Playfair Display',serif;
  font-weight:700;font-size:14px;color:var(--choco);background:linear-gradient(135deg,var(--gold-2),var(--gold));box-shadow:0 8px 18px -6px rgba(217,176,108,.7)}
.fsm--js .fsm__num{transform:scale(0);transition:transform .6s cubic-bezier(.3,1.8,.5,1) calc(var(--d,0s) + 1s)}
.fsm__value.is-in .fsm__num{transform:none}
.fsm__pulse{position:absolute;inset:-6px;border-radius:50%;border:1.5px solid rgba(224,122,133,.5);opacity:0}
.fsm__value:hover .fsm__pulse{animation:fsmPulse 1.4s ease-out infinite}
@keyframes fsmPulse{0%{transform:scale(.9);opacity:.8}100%{transform:scale(1.35);opacity:0}}

.fsm__value h3{font-family:'Playfair Display',serif;font-weight:700;font-size:26px;margin:0 0 12px;color:#fff;transition:color .4s}
.fsm__value:hover h3{color:var(--gold-2)}
.fsm__value p{font-size:14.5px;line-height:1.75;color:rgba(255,255,255,.68);margin:0 auto;max-width:260px}

/* Revelar */
.fsm--js [data-reveal]{opacity:0;transform:translateY(50px);transition:opacity 1s cubic-bezier(.2,.7,.2,1) var(--d,0s),transform 1s cubic-bezier(.2,.7,.2,1) var(--d,0s)}
.fsm--js [data-reveal].is-in{opacity:1;transform:none}

@media (max-width:991px){
  .fsm__values{grid-template-columns:repeat(2,1fr);row-gap:60px}
  .fsm__track{display:none}
}
@media (max-width:560px){
  .fsm{padding:90px 0 100px}
  .fsm__values{grid-template-columns:1fr}
  .fsm__head{margin-bottom:64px}
}
@media (prefers-reduced-motion:reduce){
  .fsm *,.fsm *::before,.fsm *::after{animation:none!important;transition:none!important}
  .fsm--js [data-reveal],.fsm--js .fsm__num{opacity:1;transform:none}
  .fsm__icon svg.ic *{stroke-dashoffset:0}
}
</style>

<section class="fsm" id="fsm">
    <div class="fsm__blob fsm__blob--1"></div>
    <div class="fsm__blob fsm__blob--2"></div>

    <div class="fsm__head">
        <span class="fsm__eyebrow" data-reveal>{{ conteudo('sobre.missao.selo') }}</span>
        <h2 class="fsm__statement" data-reveal style="--d:.1s">
            {{ conteudo('sobre.missao.frase_inicio') }}
            <span class="fsm__rotator" aria-live="polite">
                @foreach ($palavrasMissao as $palavra)
                    <span class="{{ $loop->first ? 'is-on' : '' }}">{{ $palavra }}</span>
                @endforeach
            </span>
            <br>{{ conteudo('sobre.missao.frase_fim') }}
        </h2>
        <p class="fsm__sub" data-reveal style="--d:.2s">{{ conteudo_html('sobre.missao.texto') }}</p>
    </div>

    <div class="fsm__values" data-watch>
        <span class="fsm__track" aria-hidden="true"><i></i></span>
        @foreach ($valores as $valor)
            <div class="fsm__value" data-reveal style="--d:{{ $loop->index * 0.15 }}s">
                <div class="fsm__icon">
                    <svg class="fsm__frame" viewBox="0 0 500 500" aria-hidden="true"><path d="M488.5,274.5L488.5,274.5l1.8-0.5l-2,0.5c-2.4-8.7-4.5-16.9-4.5-24.5c0-8,2.3-16.5,4.7-25.5 c3.5-13,7.1-26.5,3.7-39.5c-3.6-13.2-13.5-23.1-23.1-32.7c-6.5-6.5-12.6-12.6-16.6-19.4c-3.9-6.8-6.1-15.2-8.5-24.1 c-3.5-13.1-7.1-26.7-16.7-36.3c-9.5-9.5-22.9-13.1-35.9-16.6c-9-2.4-17.5-4.6-24.4-8.7c-6.5-3.8-12.5-9.8-18.9-16.2 c-9.7-9.8-19.6-19.8-33.2-23.4c-13.5-3.7-27.3,0.1-40.4,3.7c-8.7,2.4-16.9,4.6-24.5,4.6c-8,0-16.5-2.3-25.5-4.7 c-9.3-2.5-18.8-5-28.1-5c-3.8,0-7.6,0.4-11.3,1.4C172,11.1,162,21.1,152.4,30.7c-6.5,6.5-12.6,12.6-19.4,16.6 c-6.8,3.9-15.2,6.1-24.1,8.5c-13.1,3.5-26.7,7.1-36.3,16.7c-9.5,9.5-13.1,23-16.6,36c-2.4,9-4.6,17.5-8.7,24.4 c-3.8,6.5-9.8,12.5-16.2,18.9c-9.8,9.7-19.7,19.6-23.4,33.2c-3.7,13.5,0.1,27.3,3.7,40.5c2.4,8.7,4.6,16.9,4.6,24.5 c0,8-2.3,16.5-4.6,25.5c-3.5,13-7.1,26.6-3.7,39.5c3.6,13.2,13.5,23.1,23.1,32.7c6.5,6.5,12.6,12.6,16.6,19.4 c3.9,6.8,6.1,15.1,8.5,24c3.5,13.1,7.1,26.8,16.7,36.4c9.5,9.5,23,13.1,35.9,16.6c9,2.4,17.5,4.6,24.4,8.7 c6.5,3.8,12.5,9.8,18.9,16.2c9.7,9.8,19.6,19.8,33.2,23.5c3.8,1,7.6,1.5,11.8,1.5c9.6,0,19.3-2.7,28.5-5.1c8.8-2.4,17-4.6,24.5-4.6 c8,0,16.5,2.3,25.5,4.6c13,3.6,26.6,7.1,39.5,3.7c13.2-3.6,23.1-13.5,32.7-23.1c6.5-6.5,12.6-12.6,19.4-16.6 c6.7-3.9,15.1-6.1,24-8.5c13.1-3.5,26.8-7.1,36.4-16.8c9.5-9.5,13.1-23,16.6-36c2.4-9,4.6-17.5,8.7-24.4c3.8-6.5,9.8-12.5,16.2-18.9 c9.8-9.7,19.9-19.7,23.6-33.3C495.7,301.4,494.4,287.7,488.5,274.5z"/></svg>
                    <span class="fsm__pulse" aria-hidden="true"></span>
                    <svg class="ic" viewBox="0 0 24 24" aria-hidden="true">{!! $iconesValores[$valor['icone']] !!}</svg>
                    <span class="fsm__num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                </div>
                <h3>{{ $valor['titulo'] }}</h3>
                <p>{{ $valor['texto'] }}</p>
            </div>
        @endforeach
    </div>
</section>

<script>
(function () {
    var root = document.getElementById('fsm');
    if (!root) return;
    root.classList.add('fsm--js');
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) {
            if (e.isIntersecting) { e.target.classList.add('is-in'); io.unobserve(e.target); }
        });
    }, { threshold: 0.2 });
    root.querySelectorAll('[data-reveal], [data-watch]').forEach(function (el) { io.observe(el); });

    // Palavra que se alterna na frase
    var words = root.querySelectorAll('.fsm__rotator span');
    if (words.length < 2 || reduce) return;
    var i = 0;
    setInterval(function () {
        if (document.hidden) return;
        var cur = words[i];
        cur.classList.remove('is-on'); cur.classList.add('is-out');
        setTimeout(function () { cur.classList.remove('is-out'); }, 800);
        i = (i + 1) % words.length;
        words[i].classList.add('is-on');
    }, 3000);
})();
</script>
<!-- End Features Section -->
