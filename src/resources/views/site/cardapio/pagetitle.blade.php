<!-- Page Title: Cardápio -->
@php
    $tituloPagina    = 'Nosso cardápio';
    $subtituloPagina = 'Escolha o doce perfeito para o seu momento';
    $fundoPagina     = asset('davilla/cardapio_img/banner.png');
@endphp

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,500;1,600&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
.fpt{--cream:#fdf6ee;--choco:#2a1710;--choco-2:#4a2a1d;--rose:#e07a85;--rose-2:#b94e5c;--gold:#d9b06c;--gold-2:#f3d9a4;
  position:relative;min-height:440px;display:grid;place-items:center;padding:150px 16px 150px;font-family:'Poppins',sans-serif;color:#fff;
  text-align:center;overflow:hidden;isolation:isolate;background:var(--choco)}
.fpt *{box-sizing:border-box}
.fpt__bg{position:absolute;inset:-4%;z-index:-3;background-size:cover;background-position:center;animation:fptZoom 24s ease-in-out infinite alternate;will-change:transform}
@keyframes fptZoom{from{transform:scale(1)}to{transform:scale(1.12) translate(-1%,-1%)}}
.fpt__overlay{position:absolute;inset:0;z-index:-2;
  background:radial-gradient(ellipse at 50% 40%,rgba(74,42,29,.55),rgba(42,23,16,.92) 75%),linear-gradient(180deg,rgba(42,23,16,.6),rgba(42,23,16,.85))}
.fpt__blob{position:absolute;border-radius:50%;filter:blur(80px);z-index:-1;animation:fptBlob 18s ease-in-out infinite}
.fpt__blob--1{width:380px;height:380px;background:rgba(224,122,133,.35);top:-120px;left:-80px}
.fpt__blob--2{width:340px;height:340px;background:rgba(217,176,108,.28);bottom:-80px;right:-80px;animation-delay:-8s}
@keyframes fptBlob{50%{transform:translate(50px,30px) scale(1.15)}}

/* Confeitos */
.fpt__decor{position:absolute;inset:0;z-index:-1;pointer-events:none}
.fpt__decor span{position:absolute;display:block;animation:fptFloat var(--t,9s) ease-in-out infinite;animation-delay:var(--dl,0s)}
.fpt__decor .sp{width:6px;height:20px;border-radius:6px;opacity:.8}
@keyframes fptFloat{0%,100%{transform:translateY(0) rotate(var(--r,0deg))}50%{transform:translateY(-26px) rotate(calc(var(--r,0deg) + 45deg))}}

/* Conteúdo */
.fpt__inner{position:relative;max-width:820px}
.fpt__eyebrow{display:inline-flex;align-items:center;gap:10px;padding:7px 16px;border-radius:50px;border:1px solid rgba(243,217,164,.35);background:rgba(217,176,108,.1);
  font-size:11.5px;font-weight:600;letter-spacing:.26em;text-transform:uppercase;color:var(--gold-2)}
.fpt__eyebrow svg{width:14px;height:14px;animation:fptSpin 6s linear infinite}
@keyframes fptSpin{to{transform:rotate(360deg)}}
.fpt__title{font-family:'Playfair Display',serif;font-weight:800;font-size:clamp(44px,8vw,92px);line-height:1;letter-spacing:-.02em;margin:22px 0 18px;color:#fff}
.fpt__title .w{display:inline-block;overflow:hidden;vertical-align:bottom;padding:0 .02em .1em}
.fpt__title .w>span{display:inline-block;transform:translateY(110%) rotate(8deg);animation:fptUp 1s cubic-bezier(.2,.8,.2,1) forwards;animation-delay:var(--d)}
.fpt__title .w:last-child>span{font-style:italic;font-weight:600;background:linear-gradient(90deg,var(--gold-2),var(--rose),var(--gold),var(--gold-2));background-size:300% 100%;
  -webkit-background-clip:text;background-clip:text;color:transparent;animation:fptUp 1s cubic-bezier(.2,.8,.2,1) forwards,fptShine 6s linear infinite;animation-delay:var(--d),0s}
@keyframes fptUp{to{transform:none}}
@keyframes fptShine{to{background-position:300% 0}}
.fpt__swash{display:block;width:200px;height:20px;margin:0 auto 18px}
.fpt__swash path{fill:none;stroke:var(--gold);stroke-width:3;stroke-linecap:round;stroke-dasharray:300;stroke-dashoffset:300;animation:fptDraw 1.6s cubic-bezier(.6,0,.2,1) .8s forwards}
@keyframes fptDraw{to{stroke-dashoffset:0}}
.fpt__sub{font-size:17px;line-height:1.7;color:rgba(255,255,255,.75);margin:0 auto 30px;max-width:560px;font-weight:300}

/* Breadcrumb */
.fpt__crumb{display:inline-flex;align-items:center;gap:4px;list-style:none;margin:0;padding:6px;border-radius:50px;background:rgba(255,255,255,.08);
  border:1px solid rgba(255,255,255,.14);-webkit-backdrop-filter:blur(10px);backdrop-filter:blur(10px)}
.fpt__crumb li{display:flex;align-items:center;gap:4px;font-size:13.5px;font-weight:500}
.fpt__crumb a{display:inline-flex;align-items:center;gap:7px;padding:7px 14px;border-radius:50px;color:rgba(255,255,255,.8);text-decoration:none;transition:background .3s,color .3s}
.fpt__crumb a:hover{background:rgba(255,255,255,.12);color:#fff;text-decoration:none}
.fpt__crumb a svg{width:15px;height:15px}
.fpt__crumb .sep{width:14px;height:14px;color:rgba(255,255,255,.4)}
.fpt__crumb .cur{padding:7px 16px;border-radius:50px;background:linear-gradient(135deg,var(--rose),var(--rose-2));color:#fff;box-shadow:0 8px 18px -8px rgba(185,78,92,.8)}

.fpt__fade{opacity:0;transform:translateY(24px);animation:fptIn 1s cubic-bezier(.2,.7,.2,1) forwards;animation-delay:var(--d,0s)}
@keyframes fptIn{to{opacity:1;transform:none}}

/* Indicador de rolagem */
.fpt__scroll{position:absolute;left:50%;bottom:96px;width:26px;height:42px;margin-left:-13px;border-radius:20px;border:2px solid rgba(255,255,255,.35)}
.fpt__scroll::after{content:"";position:absolute;left:50%;top:8px;width:4px;height:8px;margin-left:-2px;border-radius:4px;background:var(--gold-2);animation:fptWheel 1.8s ease-in-out infinite}
@keyframes fptWheel{0%{opacity:0;transform:translateY(-4px)}40%{opacity:1}100%{opacity:0;transform:translateY(12px)}}

/* Onda inferior */
.fpt__wave{position:absolute;left:0;right:0;bottom:-1px;height:80px;overflow:hidden;pointer-events:none}
.fpt__wave svg{position:absolute;bottom:0;left:0;width:200%;height:100%}
.fpt__wave .w1{fill:var(--cream);animation:fptWave 14s linear infinite}
.fpt__wave .w2{fill:var(--rose);opacity:.35;animation:fptWave 9s linear infinite reverse}
@keyframes fptWave{to{transform:translateX(-50%)}}

@media (max-width:640px){
  .fpt{min-height:360px;padding:120px 16px 130px}
  .fpt__scroll{display:none}
  .fpt__crumb li{font-size:12.5px}
}
@media (prefers-reduced-motion:reduce){
  .fpt *,.fpt *::before,.fpt *::after{animation:none!important;transition:none!important}
  .fpt__title .w>span,.fpt__fade{opacity:1;transform:none}
  .fpt__swash path{stroke-dashoffset:0}
}
</style>

<!-- Page Title -->
<section class="fpt">
    <div class="fpt__bg" style="background-image:url('{{ $fundoPagina }}');"></div>
    <div class="fpt__overlay"></div>
    <div class="fpt__blob fpt__blob--1"></div>
    <div class="fpt__blob fpt__blob--2"></div>

    <div class="fpt__decor" aria-hidden="true">
        <span class="sp" style="top:22%;left:9%;background:#e07a85;--r:30deg;--t:8s"></span>
        <span class="sp" style="top:30%;left:86%;background:#d9b06c;--r:-40deg;--t:10s;--dl:-2s"></span>
        <span class="sp" style="top:66%;left:16%;background:#f3d9a4;--r:70deg;--t:11s;--dl:-4s"></span>
        <span class="sp" style="top:58%;left:78%;background:#e07a85;--r:10deg;--t:9s;--dl:-1s"></span>
        <span style="top:18%;left:70%;--t:7s;--dl:-3s"><svg width="16" height="16" viewBox="0 0 24 24" fill="#f3d9a4"><path d="M12 2l2.4 7.6L22 12l-7.6 2.4L12 22l-2.4-7.6L2 12l7.6-2.4z"/></svg></span>
        <span style="top:72%;left:62%;--t:9s;--dl:-6s"><svg width="18" height="18" viewBox="0 0 24 24" fill="#e07a85" opacity=".8"><path d="M12 21s-8-5-8-11a4.5 4.5 0 0 1 8-2.8A4.5 4.5 0 0 1 20 10c0 6-8 11-8 11z"/></svg></span>
        <span style="top:40%;left:24%;--t:10s;--dl:-2s"><svg width="12" height="12" viewBox="0 0 24 24" fill="#fff" opacity=".6"><path d="M12 2l2.4 7.6L22 12l-7.6 2.4L12 22l-2.4-7.6L2 12l7.6-2.4z"/></svg></span>
    </div>

    <div class="fpt__inner">
        <span class="fpt__eyebrow fpt__fade" style="--d:.1s">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l2.4 7.6L22 12l-7.6 2.4L12 22l-2.4-7.6L2 12l7.6-2.4z"/></svg>
            Confeitaria artesanal
        </span>

        <h1 class="fpt__title">
            @foreach (preg_split('/\s+/', trim($tituloPagina)) as $palavra)
                <span class="w"><span style="--d:{{ 0.25 + $loop->index * 0.12 }}s">{{ $palavra }}</span></span>
            @endforeach
        </h1>

        <svg class="fpt__swash" viewBox="0 0 200 20" aria-hidden="true"><path d="M4 12 C 36 2, 72 2, 100 10 S 164 20, 196 6"/></svg>

        @if ($subtituloPagina)
            <p class="fpt__sub fpt__fade" style="--d:.7s">{{ $subtituloPagina }}</p>
        @endif

        <nav aria-label="Você está em" class="fpt__fade" style="--d:.85s">
            <ol class="fpt__crumb">
                <li>
                    <a href="{{ url('/') }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 10.5 12 3l9 7.5V20a1 1 0 0 1-1 1h-5v-6h-6v6H4a1 1 0 0 1-1-1z"/></svg>
                        Início
                    </a>
                </li>
                <li>
                    <svg class="sep" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 6l6 6-6 6"/></svg>
                    <span class="cur" aria-current="page">{{ $tituloPagina }}</span>
                </li>
            </ol>
        </nav>
    </div>

    <span class="fpt__scroll" aria-hidden="true"></span>

    <div class="fpt__wave" aria-hidden="true">
        <svg viewBox="0 0 2880 80" preserveAspectRatio="none"><path class="w2" d="M0,36 Q180,0 360,36 T720,36 T1080,36 T1440,36 T1800,36 T2160,36 T2520,36 T2880,36 V80 H0Z"/></svg>
        <svg viewBox="0 0 2880 80" preserveAspectRatio="none"><path class="w1" d="M0,50 Q240,18 480,50 T960,50 T1440,50 T1920,50 T2400,50 T2880,50 V80 H0Z"/></svg>
    </div>
</section>
<!-- End Page Title -->