<!-- Team Section (redesign animado) -->
@php
    /*
     | EQUIPE
     | ⚠️ Troque os dados de exemplo abaixo pelas pessoas reais da confeitaria.
     | - foto: arquivo dentro de public/davilla/IMG/
     | - instagram / whatsapp / facebook: deixe vazio ('') para esconder o ícone
     | - whatsapp: só números com DDD, ex.: 5511999990000
     */
    $equipe = [
        [
            'nome'          => 'Nome da Confeiteira',
            'cargo'         => 'Confeiteira-chefe e fundadora',
            'bio'           => 'Transformou as receitas de família em negócio e cuida pessoalmente de cada bolo que sai da nossa cozinha.',
            'especialidade' => 'Bolos de festa',
            'foto'          => 'chefe1.jpg',
            'instagram'     => '',
            'whatsapp'      => '',
            'facebook'      => '',
        ],
        [
            'nome'          => 'Nome Sobrenome',
            'cargo'         => 'Chef de doces finos',
            'bio'           => 'Detalhista e apaixonado por técnica francesa. É quem cria os macarons, bombons e docinhos para casamentos.',
            'especialidade' => 'Doces finos',
            'foto'          => 'chefe1.jpg',
            'instagram'     => '',
            'whatsapp'      => '',
            'facebook'      => '',
        ],
        [
            'nome'          => 'Nome Sobrenome',
            'cargo'         => 'Confeiteira',
            'bio'           => 'Mestre das tortas e do brigadeiro perfeito. Sempre testando um sabor novo para a vitrine.',
            'especialidade' => 'Tortas e brigadeiros',
            'foto'          => 'chefe1.jpg',
            'instagram'     => '',
            'whatsapp'      => '',
            'facebook'      => '',
        ],
        [
            'nome'          => 'Nome Sobrenome',
            'cargo'         => 'Atendimento e encomendas',
            'bio'           => 'Ajuda você a escolher o doce ideal para a sua festa e garante que tudo chegue no dia e na hora certos.',
            'especialidade' => 'Encomendas personalizadas',
            'foto'          => 'chefe1.jpg',
            'instagram'     => '',
            'whatsapp'      => '',
            'facebook'      => '',
        ],
    ];
@endphp

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,500;1,600&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
.ftm{--cream:#fdf6ee;--blush:#fbede6;--choco:#2a1710;--choco-2:#4a2a1d;--rose:#e07a85;--rose-2:#b94e5c;--gold:#d9b06c;--gold-2:#f3d9a4;--text:#6e5a50;--muted:#a08d7d;
  position:relative;padding:120px 0 130px;font-family:'Poppins',sans-serif;color:var(--choco);overflow:hidden;isolation:isolate;
  background:radial-gradient(ellipse at 50% 0%,#fff,transparent 60%),linear-gradient(180deg,var(--blush),var(--cream))}
.ftm *{box-sizing:border-box}
.ftm__blob{position:absolute;border-radius:50%;filter:blur(90px);z-index:-1;animation:ftmBlob 20s ease-in-out infinite}
.ftm__blob--1{width:440px;height:440px;background:rgba(224,122,133,.22);top:-140px;right:-120px}
.ftm__blob--2{width:400px;height:400px;background:rgba(217,176,108,.22);bottom:-140px;left:-120px;animation-delay:-9s}
@keyframes ftmBlob{50%{transform:translate(-50px,40px) scale(1.12)}}

/* Cabeçalho */
.ftm__head{text-align:center;max-width:700px;margin:0 auto 70px;padding:0 16px}
.ftm__eyebrow{display:inline-flex;align-items:center;gap:14px;font-size:13px;font-weight:600;letter-spacing:.32em;text-transform:uppercase;color:var(--rose-2)}
.ftm__eyebrow::before,.ftm__eyebrow::after{content:"";height:1px;width:0;background:var(--rose);transition:width 1.2s cubic-bezier(.2,.7,.2,1) .2s}
.ftm__eyebrow.is-in::before,.ftm__eyebrow.is-in::after{width:46px}
.ftm__title{font-family:'Playfair Display',serif;font-weight:800;font-size:clamp(38px,5.4vw,62px);line-height:1.06;letter-spacing:-.02em;margin:20px 0 16px}
.ftm__title em{font-style:italic;font-weight:600;background:linear-gradient(90deg,var(--rose-2),var(--rose),var(--gold),var(--rose-2));background-size:300% 100%;
  -webkit-background-clip:text;background-clip:text;color:transparent;animation:ftmShine 6s linear infinite}
@keyframes ftmShine{to{background-position:300% 0}}
.ftm__sub{font-size:17px;line-height:1.7;color:var(--text);margin:0;font-weight:300}

/* Grade */
.ftm__grid{max-width:1240px;margin:0 auto;padding:0 20px;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(100%,250px),1fr));gap:30px;perspective:1400px}

/* Card */
.ftm__card{position:relative;text-align:center;transform-style:preserve-3d;transition:transform .2s ease-out;--mx:50%;--my:50%}
.ftm__photo{position:relative;z-index:1;aspect-ratio:4/5;border-radius:200px 200px 28px 28px;overflow:hidden;isolation:isolate;
  background:linear-gradient(160deg,#f3c6c9,#f3d9a4);box-shadow:0 30px 60px -32px rgba(74,42,29,.55);transition:box-shadow .5s,border-radius .7s cubic-bezier(.3,1.3,.5,1)}
.ftm__card:hover .ftm__photo{box-shadow:0 46px 80px -32px rgba(74,42,29,.7);border-radius:28px}
.ftm__photo img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center top;color:transparent;transition:transform 1.2s cubic-bezier(.2,.7,.2,1),filter .8s}
.ftm__card:hover .ftm__photo img{transform:scale(1.1);filter:saturate(1.1)}
.ftm__photo::before{content:"";position:absolute;inset:0;z-index:1;opacity:0;transition:opacity .4s;pointer-events:none;
  background:radial-gradient(360px circle at var(--mx) var(--my),rgba(255,255,255,.3),transparent 45%)}
.ftm__card:hover .ftm__photo::before{opacity:1}

/* Moldura tracejada girando */
.ftm__ring{position:absolute;z-index:0;pointer-events:none;inset:-12px -12px auto;aspect-ratio:1;border-radius:50%;border:1.5px dashed rgba(217,176,108,.6);
  animation:ftmSpin 30s linear infinite;transition:opacity .5s}
.ftm__card:hover .ftm__ring{opacity:0}
@keyframes ftmSpin{to{transform:rotate(360deg)}}

/* Camada da bio */
.ftm__over{position:absolute;inset:0;z-index:2;display:flex;flex-direction:column;justify-content:flex-end;padding:26px 22px;color:#fff;text-align:left;
  background:linear-gradient(180deg,rgba(42,23,16,0) 25%,rgba(42,23,16,.6) 55%,rgba(42,23,16,.94));opacity:0;transition:opacity .5s}
.ftm__card:hover .ftm__over,.ftm__card:focus-within .ftm__over{opacity:1}
.ftm__chip{align-self:flex-start;display:inline-flex;align-items:center;gap:6px;padding:5px 12px;border-radius:30px;font-size:10.5px;font-weight:600;letter-spacing:.14em;
  text-transform:uppercase;background:rgba(255,255,255,.16);border:1px solid rgba(255,255,255,.28);-webkit-backdrop-filter:blur(8px);backdrop-filter:blur(8px);
  margin-bottom:12px;transform:translateY(16px);opacity:0;transition:transform .5s cubic-bezier(.2,.7,.2,1) .05s,opacity .4s .05s}
.ftm__chip svg{width:13px;height:13px;color:var(--gold-2)}
.ftm__bio{font-size:13.5px;line-height:1.65;margin:0 0 16px;color:rgba(255,255,255,.88);transform:translateY(16px);opacity:0;transition:transform .5s cubic-bezier(.2,.7,.2,1) .12s,opacity .4s .12s}
.ftm__social{display:flex;gap:10px;list-style:none;margin:0;padding:0}
.ftm__social li{transform:translateY(20px);opacity:0;transition:transform .5s cubic-bezier(.3,1.6,.5,1),opacity .4s}
.ftm__social li:nth-child(1){transition-delay:.18s}
.ftm__social li:nth-child(2){transition-delay:.24s}
.ftm__social li:nth-child(3){transition-delay:.3s}
.ftm__card:hover .ftm__chip,.ftm__card:hover .ftm__bio,.ftm__card:hover .ftm__social li,
.ftm__card:focus-within .ftm__chip,.ftm__card:focus-within .ftm__bio,.ftm__card:focus-within .ftm__social li{transform:none;opacity:1}
.ftm__social a{width:40px;height:40px;border-radius:50%;display:grid;place-items:center;color:var(--choco);background:#fff;text-decoration:none;
  box-shadow:0 8px 18px -8px rgba(0,0,0,.5);transition:background .3s,color .3s,transform .35s cubic-bezier(.3,1.6,.5,1)}
.ftm__social a:hover{background:var(--rose);color:#fff;transform:translateY(-3px) rotate(-8deg)}
.ftm__social svg{width:18px;height:18px}

/* Nome */
.ftm__info{padding:24px 10px 0;transform:translateZ(30px)}
.ftm__name{position:relative;display:inline-block;font-family:'Playfair Display',serif;font-weight:700;font-size:24px;line-height:1.2;margin:0;color:var(--choco)}
.ftm__swash{display:block;width:70px;height:22px;margin:6px auto 8px;fill:var(--rose);opacity:.85}
.ftm__swash path{clip-path:inset(0 100% 0 0);transition:clip-path 1.2s cubic-bezier(.6,0,.2,1) calc(var(--d,0s) + .6s)}
.ftm__reveal.is-in .ftm__swash path{clip-path:inset(0 0 0 0)}
.ftm__card:hover .ftm__swash{animation:ftmWiggle .8s ease}
@keyframes ftmWiggle{25%{transform:rotate(-6deg)}75%{transform:rotate(6deg)}}
.ftm__role{display:block;font-size:13px;font-weight:500;letter-spacing:.12em;text-transform:uppercase;color:var(--rose-2)}

/* Revelar */
.ftm--js [data-reveal]{opacity:0;transform:translateY(60px) scale(.95);transition:opacity 1s cubic-bezier(.2,.7,.2,1) var(--d,0s),transform 1s cubic-bezier(.2,.7,.2,1) var(--d,0s)}
.ftm--js [data-reveal].is-in{opacity:1;transform:none}

/* Toque (celular): a bio fica sempre visível sobre a foto */
@media (hover:none){
  .ftm__over{opacity:1}
  .ftm__chip,.ftm__bio,.ftm__social li{transform:none;opacity:1}
  .ftm__photo::before{display:none}
}
@media (max-width:640px){.ftm{padding:90px 0 100px}}
@media (prefers-reduced-motion:reduce){
  .ftm *,.ftm *::before,.ftm *::after{animation:none!important;transition:none!important}
  .ftm--js [data-reveal]{opacity:1;transform:none}
  .ftm__swash path{clip-path:none}
}
</style>

<section class="ftm" id="ftm">
    <div class="ftm__blob ftm__blob--1"></div>
    <div class="ftm__blob ftm__blob--2"></div>

    <div class="ftm__head">
        <span class="ftm__eyebrow" data-reveal>Quem faz acontecer</span>
        <h2 class="ftm__title" data-reveal style="--d:.1s">Nossa equipe <em>criativa</em></h2>
        <p class="ftm__sub" data-reveal style="--d:.2s">Mãos talentosas e corações apaixonados por confeitaria. Conheça quem prepara cada doce com tanto carinho.</p>
    </div>

    <div class="ftm__grid">
        @foreach ($equipe as $pessoa)
            @php
                $wa = preg_replace('/\D/', '', $pessoa['whatsapp'] ?? '');
                $temRede = !empty($pessoa['instagram']) || $wa || !empty($pessoa['facebook']);
            @endphp
            <div class="ftm__reveal" data-reveal style="--d:{{ min($loop->index, 4) * 0.12 }}s">
                <article class="ftm__card">
                    <span class="ftm__ring" aria-hidden="true"></span>
                    <div class="ftm__photo">
                        <img src="{{ asset('davilla/IMG/' . $pessoa['foto']) }}" alt="{{ $pessoa['nome'] }}, {{ $pessoa['cargo'] }}" loading="lazy">
                        <div class="ftm__over">
                            @if (!empty($pessoa['especialidade']))
                                <span class="ftm__chip">
                                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l2.4 7.6L22 12l-7.6 2.4L12 22l-2.4-7.6L2 12l7.6-2.4z"/></svg>
                                    {{ $pessoa['especialidade'] }}
                                </span>
                            @endif
                            @if (!empty($pessoa['bio']))
                                <p class="ftm__bio">{{ $pessoa['bio'] }}</p>
                            @endif
                            @if ($temRede)
                                <ul class="ftm__social">
                                    @if (!empty($pessoa['instagram']))
                                        <li><a href="{{ $pessoa['instagram'] }}" target="_blank" rel="noopener" aria-label="Instagram de {{ $pessoa['nome'] }}">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r=".6" fill="currentColor"/></svg>
                                        </a></li>
                                    @endif
                                    @if ($wa)
                                        <li><a href="https://wa.me/{{ $wa }}" target="_blank" rel="noopener" aria-label="WhatsApp de {{ $pessoa['nome'] }}">
                                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.5 14.4c-.3-.1-1.8-.9-2-1-.3-.1-.5-.1-.7.1-.2.3-.8 1-.9 1.2-.2.2-.3.2-.6.1-.3-.1-1.3-.5-2.4-1.5-.9-.8-1.5-1.8-1.7-2.1-.2-.3 0-.5.1-.6l.4-.5c.2-.2.2-.3.3-.5.1-.2 0-.4 0-.5l-.9-2.2c-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.5s1.1 2.9 1.2 3.1c.1.2 2.1 3.2 5.1 4.5.7.3 1.3.5 1.7.6.7.2 1.4.2 1.9.1.6-.1 1.8-.7 2-1.4.3-.7.3-1.3.2-1.4-.1-.2-.3-.3-.6-.4zM12 21.8c-1.8 0-3.5-.5-5-1.4l-.4-.2-3.7 1 1-3.6-.2-.4c-1-1.6-1.5-3.4-1.5-5.2C2.2 6.6 6.6 2.2 12 2.2c2.6 0 5.1 1 6.9 2.9 1.9 1.9 2.9 4.3 2.9 6.9 0 5.4-4.4 9.8-9.8 9.8zm8.4-18.2C18.2 1.3 15.2 0 12 0 5.4 0 0 5.4 0 12c0 2.1.6 4.2 1.6 6L0 24l6.2-1.6c1.8 1 3.8 1.5 5.8 1.5 6.6 0 12-5.4 12-12 0-3.2-1.2-6.2-3.6-8.3z"/></svg>
                                        </a></li>
                                    @endif
                                    @if (!empty($pessoa['facebook']))
                                        <li><a href="{{ $pessoa['facebook'] }}" target="_blank" rel="noopener" aria-label="Facebook de {{ $pessoa['nome'] }}">
                                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M14 8.5V6.8c0-.8.2-1.3 1.4-1.3H17V2.3c-.3 0-1.3-.1-2.5-.1-2.5 0-4.2 1.5-4.2 4.3v2H7.5v3.4h2.8V22H14v-10.1h2.8l.4-3.4H14z"/></svg>
                                        </a></li>
                                    @endif
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="ftm__info">
                        <h3 class="ftm__name">{{ $pessoa['nome'] }}</h3>
                        <svg class="ftm__swash" viewBox="0 0 50 15.8" aria-hidden="true"><path d="M9.1,0.9c6.6-0.6,11,3.3,16.6,6.1c5.3,2.6,11.9,4.3,17.7,2.6c2.2-0.7,6.1-2.5,4.8-5.7c-0.4-0.9-1.2-1.8-1.9-1 c-0.7,0.7-0.6,3.7-2.2,1.9C42.6,3,43.7-0.2,46.1,0c2.6,0.3,4.4,3.9,3.8,6.3c-1.5,6.4-10.8,7-15.8,6.3c-3.3-0.5-6.4-1.7-9.4-3.1 c-3-1.4-5.3-3.4-8-5.2C13.8,2.5,11,2.4,7.8,3.2C5.4,3.8,2.2,4.5,1.7,7.5c-0.4,2.7,1.3,5.1,3.7,6.1c1.3,0.5,2.4,0.4,3.6-0.2 c1.2-0.5,2.7-1.9,4-2.1c1.2-0.1,2.3,1.5,1.8,2.7c-0.5,1.1-2.7,1.6-3.7,1.7c-1.4,0.1-3.5-0.3-4.9-0.7c-1.4-0.4-2.7-1.1-3.8-2.2 c-1.7-1.7-2.9-4.6-2.1-7.1C1.2,2.6,6.4,1.9,9.1,0.9z"/></svg>
                        <span class="ftm__role">{{ $pessoa['cargo'] }}</span>
                    </div>
                </article>
            </div>
        @endforeach
    </div>
</section>

<script>
(function () {
    var root = document.getElementById('ftm');
    if (!root) return;
    root.classList.add('ftm--js');
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) {
            if (e.isIntersecting) { e.target.classList.add('is-in'); io.unobserve(e.target); }
        });
    }, { threshold: 0.15 });
    root.querySelectorAll('[data-reveal]').forEach(function (el) { io.observe(el); });

    if (!reduce && window.matchMedia('(hover: hover)').matches) {
        root.querySelectorAll('.ftm__card').forEach(function (c) {
            c.addEventListener('mousemove', function (ev) {
                var r = c.getBoundingClientRect(),
                    x = (ev.clientX - r.left) / r.width,
                    y = (ev.clientY - r.top) / r.height;
                c.style.setProperty('--mx', (x * 100) + '%');
                c.style.setProperty('--my', (y * 100) + '%');
                c.style.transform = 'rotateX(' + ((0.5 - y) * 8) + 'deg) rotateY(' + ((x - 0.5) * 10) + 'deg) translateY(-8px)';
            });
            c.addEventListener('mouseleave', function () {
                c.style.transition = 'transform .7s cubic-bezier(.2,.7,.2,1)';
                c.style.transform = '';
                setTimeout(function () { c.style.transition = ''; }, 700);
            });
        });
    }
})();
</script>
<!--End Team Section -->