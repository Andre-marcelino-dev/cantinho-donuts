@if ($listaEvento->count() > 0)
<!-- Eventos (redesign animado) -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,500;1,600&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
.fse{--cream:#fdf6ee;--paper:#fffaf4;--choco:#2a1710;--choco-2:#4a2a1d;--rose:#e07a85;--rose-2:#b94e5c;--gold:#d9b06c;--gold-2:#f3d9a4;--green:#3f6b45;--text:#6e5a50;--muted:#a08d7d;--line:#ecdccb;
  position:relative;padding:120px 0 130px;background:linear-gradient(180deg,var(--cream),#f7ece1);font-family:'Poppins',sans-serif;color:var(--choco);overflow:hidden;isolation:isolate}
.fse *{box-sizing:border-box}
.fse__blob{position:absolute;border-radius:50%;filter:blur(90px);z-index:-1;animation:fseBlob 20s ease-in-out infinite}
.fse__blob--1{width:440px;height:440px;background:rgba(224,122,133,.22);top:-120px;left:-140px}
.fse__blob--2{width:400px;height:400px;background:rgba(217,176,108,.22);bottom:-120px;right:-120px;animation-delay:-9s}
@keyframes fseBlob{50%{transform:translate(60px,-40px) scale(1.12)}}

/* Cabeçalho */
.fse__head{text-align:center;max-width:680px;margin:0 auto 64px;padding:0 16px}
.fse__eyebrow{display:inline-flex;align-items:center;gap:10px;padding:8px 18px;border-radius:50px;background:#fff;box-shadow:0 10px 30px -15px rgba(185,78,92,.45);
  font-size:12px;font-weight:600;letter-spacing:.24em;text-transform:uppercase;color:var(--rose-2)}
.fse__eyebrow svg{width:16px;height:16px;animation:fseSwing 2.6s ease-in-out infinite;transform-origin:50% 0}
@keyframes fseSwing{0%,100%{transform:rotate(-10deg)}50%{transform:rotate(10deg)}}
.fse__title{font-family:'Playfair Display',serif;font-weight:800;font-size:clamp(38px,5.4vw,62px);line-height:1.06;letter-spacing:-.02em;margin:22px 0 16px}
.fse__title em{font-style:italic;font-weight:600;background:linear-gradient(90deg,var(--rose-2),var(--rose),var(--gold),var(--rose-2));background-size:300% 100%;
  -webkit-background-clip:text;background-clip:text;color:transparent;animation:fseShine 6s linear infinite}
@keyframes fseShine{to{background-position:300% 0}}
.fse__sub{font-size:17px;line-height:1.7;color:var(--text);margin:0;font-weight:300}

/* Grade */
.fse__grid{max-width:1240px;margin:0 auto;padding:0 16px;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(100%,330px),1fr));gap:34px;align-items:start}
.fse__grid--1{max-width:520px}
.fse__grid--2{max-width:900px}

/* Card (ingresso) */
.fse__card{position:relative;background:var(--paper);border-radius:26px;box-shadow:0 30px 60px -32px rgba(74,42,29,.45);
  transition:transform .5s cubic-bezier(.3,1.4,.5,1),box-shadow .5s;filter:drop-shadow(0 0 0 transparent)}
.fse__card:hover{transform:translateY(-10px) rotate(-.4deg);box-shadow:0 44px 80px -34px rgba(74,42,29,.6)}

.fse__header{position:relative;overflow:hidden;border-radius:26px 26px 0 0;padding:26px 26px 24px 26px;padding-right:112px;color:#fff;
  background:radial-gradient(circle at 100% 0%,rgba(224,122,133,.45),transparent 55%),linear-gradient(150deg,var(--choco-2),var(--choco))}
.fse__header::after{content:"";position:absolute;top:0;left:-60%;width:40%;height:100%;background:linear-gradient(115deg,transparent,rgba(255,255,255,.14),transparent);
  transform:skewX(-20deg);animation:fseSweep 5s ease-in-out infinite}
@keyframes fseSweep{0%,65%{left:-60%}100%{left:140%}}
.fse__eyebrow-card{display:flex;align-items:center;gap:8px;font-size:11px;letter-spacing:.2em;text-transform:uppercase;color:var(--gold-2);font-weight:600;margin-bottom:10px}
.fse__eyebrow-card::before{content:"";width:22px;height:1px;background:var(--gold)}
.fse__card-title{font-family:'Playfair Display',serif;font-style:italic;font-weight:600;font-size:28px;line-height:1.18;margin:0 0 10px;color:#fff}
.fse__card-sub{font-size:14px;line-height:1.6;margin:0;color:rgba(255,255,255,.75)}
.fse__card-sub strong{color:#fff}

/* Selo de data */
.fse__date{position:absolute;top:22px;right:22px;width:72px;border-radius:16px;overflow:hidden;text-align:center;background:#fff;color:var(--choco);
  box-shadow:0 14px 28px -12px rgba(0,0,0,.55);transform-origin:50% 0}
.fse__date b{display:block;background:linear-gradient(135deg,var(--rose),var(--rose-2));color:#fff;font-size:11px;letter-spacing:.16em;text-transform:uppercase;padding:5px 0;font-weight:600}
.fse__date strong{display:block;font-family:'Playfair Display',serif;font-size:32px;font-weight:800;line-height:1;padding:8px 0 2px}
.fse__date small{display:block;font-size:10px;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);padding-bottom:8px}
.fse--js .fse__date{transform:perspective(400px) rotateX(-95deg);opacity:0;transition:transform 1s cubic-bezier(.3,1.5,.5,1) calc(var(--d,0s) + .35s),opacity .4s ease calc(var(--d,0s) + .35s)}
.fse__reveal.is-in .fse__date{transform:none;opacity:1}

/* Contagem */
.fse__count{display:inline-flex;align-items:center;gap:8px;margin-top:16px;padding:6px 14px;border-radius:50px;font-size:12px;font-weight:600;
  background:rgba(255,255,255,.12);color:#fff;border:1px solid rgba(255,255,255,.18)}
.fse__count i{width:8px;height:8px;border-radius:50%;background:var(--gold)}
.fse__count--hoje{background:var(--rose);border-color:var(--rose)}
.fse__count--hoje i,.fse__count--amanha i{background:#fff;animation:fsePing 1.6s infinite}
.fse__count--past{opacity:.6}
@keyframes fsePing{0%{box-shadow:0 0 0 0 rgba(255,255,255,.8)}80%,100%{box-shadow:0 0 0 9px rgba(255,255,255,0)}}

/* Mapa */
.fse__map{position:relative;height:220px;background:#f6d9d3;overflow:hidden;background-size:cover;background-position:center}
.fse__map iframe{position:absolute;inset:0;width:100%;height:100%;border:0;filter:grayscale(.55) sepia(.25) contrast(.95);transform:scale(1.02);transition:filter .6s,transform .8s cubic-bezier(.2,.7,.2,1)}
.fse__card:hover .fse__map iframe{filter:none;transform:scale(1.06)}
.fse__map::after{content:"";position:absolute;inset:0;pointer-events:none;background:linear-gradient(180deg,rgba(42,23,16,.15),transparent 30%,transparent 65%,rgba(42,23,16,.35))}
.fse__map-empty{position:absolute;inset:0;display:grid;place-items:center;color:var(--rose-2)}
.fse__map-empty svg{width:54px;height:54px;animation:fseBounce 2s ease-in-out infinite}
.fse__local{position:absolute;z-index:2;bottom:16px;left:50%;transform:translateX(-50%);display:inline-flex;align-items:center;gap:8px;white-space:nowrap;
  background:var(--green);color:#fff;font-size:12px;font-weight:600;letter-spacing:.06em;padding:10px 18px 10px 14px;border-radius:50px;text-decoration:none;
  box-shadow:0 10px 24px -8px rgba(30,60,35,.7);transition:background .3s,box-shadow .3s,transform .35s cubic-bezier(.3,1.6,.5,1)}
.fse__local svg{width:16px;height:16px;animation:fseBounce 1.6s ease-in-out infinite}
.fse__local:hover{color:#fff;text-decoration:none;background:#2f5535;transform:translateX(-50%) translateY(-3px);box-shadow:0 16px 30px -8px rgba(30,60,35,.8)}
@keyframes fseBounce{0%,100%{translate:0 0}50%{translate:0 -4px}}

/* Infos */
.fse__info{padding:24px 26px 8px}
.fse__row{display:flex;gap:14px;align-items:flex-start;margin-bottom:18px}
.fse__row .ico{flex:none;width:40px;height:40px;border-radius:12px;display:grid;place-items:center;background:rgba(224,122,133,.12);color:var(--rose-2);
  transition:transform .5s cubic-bezier(.3,1.6,.5,1),background .4s,color .4s}
.fse__card:hover .fse__row .ico{background:var(--rose-2);color:#fff;transform:rotate(-8deg) scale(1.06)}
.fse__card:hover .fse__row:nth-child(2) .ico{transition-delay:.06s}
.fse__card:hover .fse__row:nth-child(3) .ico{transition-delay:.12s}
.fse__row .ico svg{width:19px;height:19px}
.fse__label{display:block;font-size:10.5px;letter-spacing:.14em;text-transform:uppercase;color:var(--muted);margin-bottom:2px;font-weight:500}
.fse__valor{display:block;font-size:15px;font-weight:600;color:#3a2a22;line-height:1.45}

/* Picote do ingresso */
.fse__perf{position:relative;height:28px;margin:0}
.fse__perf::before,.fse__perf::after{content:"";position:absolute;top:50%;width:28px;height:28px;border-radius:50%;background:#f9efe5;transform:translateY(-50%);
  box-shadow:inset 0 0 0 0 transparent}
.fse__perf::before{left:-14px}
.fse__perf::after{right:-14px}
.fse__perf i{position:absolute;left:24px;right:24px;top:50%;border-top:2px dashed var(--line)}

/* Tags */
.fse__tags-wrap{padding:6px 26px 26px}
.fse__tags-title{display:flex;align-items:center;gap:8px;font-family:'Playfair Display',serif;font-style:italic;font-weight:600;font-size:18px;color:var(--rose-2);margin:0 0 14px}
.fse__tags-title svg{width:18px;height:18px}
.fse__tags{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:16px}
.fse__tag{border:1px solid var(--line);border-radius:50px;padding:7px 15px;font-size:12.5px;font-weight:500;color:var(--choco-2);background:#fff;
  transition:background .3s,color .3s,border-color .3s,transform .35s cubic-bezier(.3,1.6,.5,1)}
.fse__tag:hover{background:var(--rose);border-color:var(--rose);color:#fff;transform:translateY(-3px)}
.fse--js .fse__tag{opacity:0;transform:scale(.6)}
.fse__reveal.is-in .fse__tag{opacity:1;transform:none;transition:opacity .4s ease var(--td),transform .6s cubic-bezier(.3,1.7,.5,1) var(--td),background .3s,color .3s,border-color .3s}
.fse__reveal.is-in .fse__tag:hover{transform:translateY(-3px)}
.fse__rodape{display:flex;align-items:center;gap:8px;font-size:13.5px;font-weight:500;color:var(--text);margin:0}
.fse__rodape svg{width:18px;height:18px;color:var(--rose);animation:fseBeat 1.4s ease-in-out infinite}
@keyframes fseBeat{0%,100%{transform:scale(1)}20%{transform:scale(1.25)}40%{transform:scale(.95)}60%{transform:scale(1.15)}}

/* Revelar */
.fse--js [data-reveal]{opacity:0;transform:translateY(50px);transition:opacity 1s cubic-bezier(.2,.7,.2,1) var(--d,0s),transform 1s cubic-bezier(.2,.7,.2,1) var(--d,0s)}
.fse--js [data-reveal].is-in{opacity:1;transform:none}

@media (max-width:640px){
  .fse{padding:90px 0 100px}
  .fse__header{padding-right:100px}
  .fse__card-title{font-size:24px}
  .fse__date{width:64px}
  .fse__date strong{font-size:28px}
}
@media (prefers-reduced-motion:reduce){
  .fse *,.fse *::before,.fse *::after{animation:none!important;transition:none!important}
  .fse--js [data-reveal],.fse--js .fse__date,.fse--js .fse__tag{opacity:1;transform:none}
}
</style>

<section class="fse" id="fse">
    <div class="fse__blob fse__blob--1"></div>
    <div class="fse__blob fse__blob--2"></div>

    <div class="fse__head">
        <span class="fse__eyebrow" data-reveal>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
            {{ conteudo('home.agenda.selo') }}
        </span>
        <h2 class="fse__title" data-reveal style="--d:.1s">{{ conteudo_html('home.agenda.titulo') }}</h2>
        <p class="fse__sub" data-reveal style="--d:.2s">{{ conteudo_html('home.agenda.texto') }}</p>
    </div>

    @php
        $totalEventos = $listaEvento->count();
        $hoje = \Carbon\Carbon::today();
    @endphp

    <div class="fse__grid {{ $totalEventos <= 2 ? 'fse__grid--' . $totalEventos : '' }}">
        @foreach ($listaEvento as $linha)
            @php
                $data = \Carbon\Carbon::parse($linha->data_evento)->locale('pt_BR');
                $dias = (int) $hoje->diffInDays($data->copy()->startOfDay(), false);
            @endphp
            <div class="fse__reveal" data-reveal style="--d:{{ min($loop->index, 5) * 0.12 }}s">
                <article class="fse__card">
                    <div class="fse__header">
                        <span class="fse__eyebrow-card">{{ $linha->titulo_evento }}</span>
                        <h3 class="fse__card-title">{{ $linha->nome_evento }}</h3>
                        @if ($linha->descricao_evento)
                            <p class="fse__card-sub">{{ $linha->descricao_evento }}</p>
                        @endif

                        @if ($dias === 0)
                            <span class="fse__count fse__count--hoje"><i></i>É hoje!</span>
                        @elseif ($dias === 1)
                            <span class="fse__count fse__count--amanha"><i></i>É amanhã</span>
                        @elseif ($dias > 1)
                            <span class="fse__count"><i></i>Faltam {{ $dias }} dias</span>
                        @else
                            <span class="fse__count fse__count--past"><i></i>Evento encerrado</span>
                        @endif

                        <div class="fse__date" aria-hidden="true">
                            <b>{{ mb_substr($data->translatedFormat('M'), 0, 3) }}</b>
                            <strong>{{ $data->format('d') }}</strong>
                            <small>{{ mb_substr($data->translatedFormat('l'), 0, 3) }}</small>
                        </div>
                    </div>

                    <div class="fse__map"
                        @if (!$linha->link_local_evento && $linha->foto_evento) style="background-image:url('{{ asset('davilla/images/' . $linha->foto_evento) }}')" @endif>
                        @if ($linha->link_local_evento)
                            <iframe src="{{ $linha->link_local_evento }}" title="Mapa: {{ $linha->nome_evento }}" loading="lazy"
                                allowfullscreen referrerpolicy="no-referrer-when-downgrade"></iframe>
                            <a href="{{ $linha->link_local_evento }}" target="_blank" rel="noopener" class="fse__local">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a7 7 0 0 0-7 7c0 5.2 7 13 7 13s7-7.8 7-13a7 7 0 0 0-7-7zm0 9.5A2.5 2.5 0 1 1 12 6.5a2.5 2.5 0 0 1 0 5z"/></svg>
                                Local do evento
                            </a>
                        @elseif (!$linha->foto_evento)
                            <div class="fse__map-empty">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a7 7 0 0 0-7 7c0 5.2 7 13 7 13s7-7.8 7-13a7 7 0 0 0-7-7zm0 9.5A2.5 2.5 0 1 1 12 6.5a2.5 2.5 0 0 1 0 5z"/></svg>
                            </div>
                        @endif
                    </div>

                    <div class="fse__info">
                        <div class="fse__row">
                            <span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="3"/><path d="M16 2v4M8 2v4M3 10h18"/></svg></span>
                            <div>
                                <span class="fse__label">Data</span>
                                <span class="fse__valor">{{ ucfirst($data->translatedFormat('l, d \d\e F')) }}</span>
                            </div>
                        </div>
                        <div class="fse__row">
                            <span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></span>
                            <div>
                                <span class="fse__label">Horário</span>
                                <span class="fse__valor">{{ $linha->horario_evento }}</span>
                            </div>
                        </div>
                        <div class="fse__row">
                            <span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s7-7.8 7-13a7 7 0 0 0-14 0c0 5.2 7 13 7 13z"/><circle cx="12" cy="9" r="2.5"/></svg></span>
                            <div>
                                <span class="fse__label">Endereço</span>
                                <span class="fse__valor">{{ $linha->endereco_evento }}</span>
                            </div>
                        </div>
                    </div>

                    @if ($linha->tags_array)
                        <div class="fse__perf"><i></i></div>
                        <div class="fse__tags-wrap">
                            <p class="fse__tags-title">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l1.5-5h15L21 9"/><path d="M3 9h18v2a3 3 0 0 1-6 0 3 3 0 0 1-6 0 3 3 0 0 1-6 0z"/><path d="M5 13v8h14v-8"/></svg>
                                {{ conteudo('home.agenda.tags_titulo') }}
                            </p>
                            <div class="fse__tags">
                                @foreach ($linha->tags_array as $tag)
                                    <span class="fse__tag" style="--td:{{ 0.5 + min($loop->index, 12) * 0.06 }}s">{{ $tag }}</span>
                                @endforeach
                            </div>
                            <p class="fse__rodape">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 21s-8-5-8-11a4.5 4.5 0 0 1 8-2.8A4.5 4.5 0 0 1 20 10c0 6-8 11-8 11z"/></svg>
                                {{ conteudo('home.agenda.tags_rodape') }}
                            </p>
                        </div>
                    @endif
                </article>
            </div>
        @endforeach
    </div>
</section>

<script>
(function () {
    var root = document.getElementById('fse');
    if (!root) return;
    root.classList.add('fse--js');
    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) {
            if (e.isIntersecting) { e.target.classList.add('is-in'); io.unobserve(e.target); }
        });
    }, { threshold: 0.15 });
    root.querySelectorAll('[data-reveal]').forEach(function (el) { io.observe(el); });
})();
</script>
<!-- End Eventos -->
@endif