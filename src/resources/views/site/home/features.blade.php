<!-- Features Section Two (redesign animado) -->
@php
    $features = asset('davilla/IMG/banner3.png');
@endphp

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,500;1,600&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
.fsx{--cream:#fdf6ee;--choco:#2a1710;--choco-2:#4a2a1d;--rose:#e07a85;--rose-2:#b94e5c;--gold:#d9b06c;--gold-2:#f3d9a4;
  position:relative;padding:130px 0 0;font-family:'Poppins',sans-serif;color:#fff;overflow:hidden;isolation:isolate;background:var(--choco)}
.fsx *{box-sizing:border-box}

/* Fundo com parallax */
.fsx__bg{position:absolute;inset:-12% 0;background-size:cover;background-position:center;z-index:-4;will-change:transform;transform:scale(1.1)}
.fsx__overlay{position:absolute;inset:0;z-index:-3;
  background:radial-gradient(ellipse at 15% 0%,rgba(224,122,133,.35),transparent 55%),
             radial-gradient(ellipse at 90% 35%,rgba(217,176,108,.22),transparent 50%),
             linear-gradient(180deg,rgba(42,23,16,.84) 0%,rgba(42,23,16,.95) 100%)}
.fsx__blob{position:absolute;border-radius:50%;filter:blur(80px);opacity:.45;z-index:-2;animation:fsxBlob 18s ease-in-out infinite}
.fsx__blob--1{width:420px;height:420px;background:var(--rose);top:-140px;left:-120px}
.fsx__blob--2{width:360px;height:360px;background:var(--gold);top:38%;right:-120px;animation-delay:-6s;opacity:.3}
.fsx__blob--3{width:300px;height:300px;background:var(--rose-2);bottom:60px;left:30%;animation-delay:-11s;opacity:.25}
@keyframes fsxBlob{0%,100%{transform:translate(0,0) scale(1)}33%{transform:translate(70px,40px) scale(1.15)}66%{transform:translate(-40px,70px) scale(.9)}}

/* Confeitos flutuando */
.fsx__decor{position:absolute;inset:0;z-index:-1;pointer-events:none}
.fsx__decor span{position:absolute;display:block;animation:fsxFloat var(--t,9s) ease-in-out infinite;animation-delay:var(--dl,0s)}
.fsx__decor .sp{width:6px;height:22px;border-radius:6px;opacity:.8}
.fsx__decor svg{display:block}
@keyframes fsxFloat{0%,100%{transform:translateY(0) rotate(var(--r,0deg))}50%{transform:translateY(-30px) rotate(calc(var(--r,0deg) + 40deg))}}

/* Cabeçalho */
.fsx__head{text-align:center;max-width:720px;margin:0 auto 72px;padding:0 16px}
.fsx__eyebrow{display:inline-flex;align-items:center;gap:10px;padding:8px 18px;border-radius:50px;border:1px solid rgba(217,176,108,.35);
  background:rgba(217,176,108,.08);font-size:12px;letter-spacing:.26em;text-transform:uppercase;color:var(--gold-2);font-weight:500}
.fsx__eyebrow svg{width:16px;height:16px;animation:fsxSpin 6s linear infinite}
.fsx__title{font-family:'Playfair Display',serif;font-size:clamp(36px,5.6vw,60px);line-height:1.1;margin:22px 0 0;font-weight:800;color:#fff;letter-spacing:-.01em}
.fsx__shine{font-style:italic;font-weight:600;background:linear-gradient(90deg,var(--gold-2),var(--rose),var(--gold),var(--gold-2));background-size:300% 100%;
  -webkit-background-clip:text;background-clip:text;color:transparent;animation:fsxShine 6s linear infinite}
@keyframes fsxShine{to{background-position:300% 0}}
.fsx__swash{display:block;width:220px;height:22px;margin:10px auto 18px}
.fsx__swash path{fill:none;stroke:var(--gold);stroke-width:3;stroke-linecap:round;stroke-dasharray:320;stroke-dashoffset:320;transition:stroke-dashoffset 1.6s cubic-bezier(.6,0,.2,1) .5s}
.fsx__swash.is-in path{stroke-dashoffset:0}
.fsx__sub{font-size:17px;line-height:1.75;color:rgba(255,255,255,.75);margin:0;font-weight:300}

/* Revelar ao rolar */
.fsx--js [data-reveal]{opacity:0;transform:translateY(60px) scale(.97);filter:blur(6px);
  transition:opacity 1s cubic-bezier(.2,.7,.2,1) var(--d,0s),transform 1s cubic-bezier(.2,.7,.2,1) var(--d,0s),filter 1s ease var(--d,0s)}
.fsx--js [data-reveal].is-in{opacity:1;transform:none;filter:none}

/* Cards */
.fsx__grid{display:grid;grid-template-columns:repeat(3,1fr);gap:32px;max-width:1170px;margin:0 auto;padding:0 16px;perspective:1200px}
.fsx__card{position:relative;height:100%;border-radius:28px;padding:64px 34px 44px;text-align:center;overflow:hidden;
  background:linear-gradient(160deg,rgba(255,255,255,.10),rgba(255,255,255,.03));border:1px solid rgba(255,255,255,.13);
  -webkit-backdrop-filter:blur(14px);backdrop-filter:blur(14px);box-shadow:0 30px 60px -30px rgba(0,0,0,.6);
  transform-style:preserve-3d;transition:transform .2s ease-out,box-shadow .5s,border-color .5s;--mx:50%;--my:50%}
.fsx__card::before{content:"";position:absolute;inset:0;border-radius:inherit;pointer-events:none;opacity:0;transition:opacity .4s;
  background:radial-gradient(420px circle at var(--mx) var(--my),rgba(243,217,164,.22),transparent 45%)}
.fsx__card::after{content:"";position:absolute;top:0;left:-60%;width:40%;height:100%;pointer-events:none;
  background:linear-gradient(115deg,transparent,rgba(255,255,255,.22),transparent);transform:skewX(-20deg) translateX(-150%)}
.fsx__card:hover{border-color:rgba(243,217,164,.4);box-shadow:0 40px 80px -30px rgba(0,0,0,.75),0 0 0 1px rgba(243,217,164,.15)}
.fsx__card:hover::before{opacity:1}
.fsx__card:hover::after{animation:fsxSweep 1s ease}
@keyframes fsxSweep{to{transform:skewX(-20deg) translateX(450%)}}

.fsx__card--featured{background:linear-gradient(160deg,var(--rose) 0%,var(--rose-2) 100%);border-color:transparent;
  box-shadow:0 40px 90px -30px rgba(224,122,133,.7)}
.fsx__card--featured:hover{border-color:rgba(255,255,255,.4)}
.fsx__badge{position:absolute;top:20px;left:50%;transform:translateX(-50%);padding:6px 16px;border-radius:50px;background:#fff;color:var(--rose-2);
  font-size:11px;font-weight:600;letter-spacing:.12em;text-transform:uppercase;white-space:nowrap;animation:fsxPulse 2.4s ease-in-out infinite}
@keyframes fsxPulse{0%,100%{box-shadow:0 0 0 0 rgba(255,255,255,.55)}50%{box-shadow:0 0 0 10px rgba(255,255,255,0)}}

.fsx__num{position:absolute;top:16px;right:24px;font-family:'Playfair Display',serif;font-size:64px;line-height:1;font-weight:800;
  color:transparent;-webkit-text-stroke:1px rgba(243,217,164,.35);transition:transform .5s}
.fsx__card--featured .fsx__num{-webkit-text-stroke-color:rgba(255,255,255,.4)}
.fsx__card:hover .fsx__num{transform:translateY(-4px) scale(1.08)}

.fsx__icon{position:relative;width:132px;height:132px;margin:0 auto 28px;display:grid;place-items:center;transform:translateZ(50px)}
.fsx__icon::before{content:"";position:absolute;inset:-10px;border-radius:50%;border:1.5px dashed rgba(243,217,164,.4);animation:fsxSpin 22s linear infinite reverse}
.fsx__frame{position:absolute;inset:0;width:100%;height:100%;fill:var(--gold);animation:fsxSpin 14s linear infinite}
.fsx__card--featured .fsx__frame{fill:#fff}
.fsx__card--featured .fsx__icon::before{border-color:rgba(255,255,255,.5)}
.fsx__icon-inner{width:90px;height:90px;border-radius:50%;display:grid;place-items:center;color:var(--gold-2);
  background:radial-gradient(circle at 30% 30%,rgba(255,255,255,.14),rgba(255,255,255,.03));box-shadow:inset 0 0 0 1px rgba(255,255,255,.1);
  animation:fsxBob 3.2s ease-in-out infinite;transition:transform .5s cubic-bezier(.3,1.6,.5,1)}
.fsx__card--featured .fsx__icon-inner{color:#fff;background:rgba(255,255,255,.16)}
.fsx__card:hover .fsx__icon-inner{transform:scale(1.12) rotate(-8deg)}
.fsx__icon-inner svg{width:42px;height:42px}
@keyframes fsxSpin{to{transform:rotate(360deg)}}
@keyframes fsxBob{0%,100%{translate:0 0}50%{translate:0 -6px}}

.fsx__card h3{font-family:'Playfair Display',serif;font-size:30px;color:#fff;margin:0 0 14px;font-weight:700;transform:translateZ(40px)}
.fsx__divider{width:44px;height:2px;margin:0 auto 20px;border-radius:2px;background:linear-gradient(90deg,var(--gold),var(--rose));transition:width .5s}
.fsx__card--featured .fsx__divider{background:#fff}
.fsx__card:hover .fsx__divider{width:90px}
.fsx__card p{font-size:15px;line-height:1.8;color:rgba(255,255,255,.72);margin:0 0 32px;transform:translateZ(25px)}
.fsx__card--featured p{color:rgba(255,255,255,.9)}

.fsx__btn{position:relative;display:inline-flex;align-items:center;gap:10px;padding:14px 30px;border-radius:50px;font-size:14px;font-weight:500;
  letter-spacing:.03em;text-decoration:none;color:var(--gold-2);border:1.5px solid rgba(217,176,108,.6);overflow:hidden;transform:translateZ(35px);
  transition:color .4s,border-color .4s,box-shadow .4s}
.fsx__btn::before{content:"";position:absolute;inset:0;background:linear-gradient(90deg,var(--gold),var(--gold-2));transform:scaleX(0);transform-origin:right;
  transition:transform .5s cubic-bezier(.7,0,.2,1);z-index:-1}
.fsx__btn:hover{color:var(--choco);border-color:var(--gold);text-decoration:none;box-shadow:0 12px 30px -10px rgba(217,176,108,.7)}
.fsx__btn:hover::before{transform:scaleX(1);transform-origin:left}
.fsx__btn svg{width:16px;height:16px;transition:transform .4s}
.fsx__btn:hover svg{transform:translateX(5px)}
.fsx__card--featured .fsx__btn{background:#fff;color:var(--rose-2);border-color:#fff}
.fsx__card--featured .fsx__btn::before{background:var(--choco)}
.fsx__card--featured .fsx__btn:hover{color:#fff;border-color:var(--choco)}

/* Números */
.fsx__stats{display:grid;grid-template-columns:repeat(4,1fr);max-width:1170px;margin:80px auto 0;padding:0 16px}
.fsx__stats-inner{grid-column:1/-1;display:grid;grid-template-columns:repeat(4,1fr);border-radius:24px;padding:38px 20px;
  background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);-webkit-backdrop-filter:blur(10px);backdrop-filter:blur(10px)}
.fsx__stat{text-align:center;padding:0 10px;position:relative}
.fsx__stat+.fsx__stat::before{content:"";position:absolute;left:0;top:15%;height:70%;width:1px;background:linear-gradient(transparent,rgba(243,217,164,.35),transparent)}
.fsx__stat strong{display:block;font-family:'Playfair Display',serif;font-size:clamp(34px,4vw,46px);font-weight:800;line-height:1.1;
  background:linear-gradient(180deg,#fff,var(--gold-2));-webkit-background-clip:text;background-clip:text;color:transparent}
.fsx__stat span{display:block;margin-top:6px;font-size:13px;letter-spacing:.12em;text-transform:uppercase;color:rgba(255,255,255,.6)}

/* Onda animada */
.fsx__wave{position:relative;height:110px;margin-top:90px;overflow:hidden}
.fsx__wave svg{position:absolute;bottom:0;left:0;width:200%;height:100%}
.fsx__wave .w1{fill:var(--cream);animation:fsxWave 14s linear infinite}
.fsx__wave .w2{fill:var(--rose);opacity:.35;animation:fsxWave 9s linear infinite reverse}
@keyframes fsxWave{to{transform:translateX(-50%)}}

@media (max-width:991px){
  .fsx__grid{grid-template-columns:repeat(2,1fr)}
  .fsx__grid>div:last-child{grid-column:1/-1;max-width:520px;justify-self:center;width:100%}
  .fsx__stats-inner{grid-template-columns:repeat(2,1fr);row-gap:30px}
  .fsx__stat:nth-child(3)::before{display:none}
}
@media (max-width:640px){
  .fsx{padding-top:90px}
  .fsx__grid{grid-template-columns:1fr}
  .fsx__grid>div:last-child{max-width:none}
  .fsx__head{margin-bottom:54px}
}
@media (prefers-reduced-motion:reduce){
  .fsx *,.fsx *::before,.fsx *::after{animation:none!important;transition:none!important}
  .fsx--js [data-reveal]{opacity:1;transform:none;filter:none}
  .fsx__swash path{stroke-dashoffset:0}
}
</style>

<section class="fsx" id="fsx">
    <div class="fsx__bg" style="background-image:url('{{ $features }}');"></div>
    <div class="fsx__overlay"></div>
    <div class="fsx__blob fsx__blob--1"></div>
    <div class="fsx__blob fsx__blob--2"></div>
    <div class="fsx__blob fsx__blob--3"></div>

    <!-- confeitos -->
    <div class="fsx__decor" aria-hidden="true">
        <span class="sp" style="top:12%;left:8%;background:#e07a85;--r:30deg;--t:8s"></span>
        <span class="sp" style="top:22%;left:88%;background:#d9b06c;--r:-40deg;--t:10s;--dl:-2s"></span>
        <span class="sp" style="top:55%;left:4%;background:#f3d9a4;--r:70deg;--t:11s;--dl:-4s"></span>
        <span class="sp" style="top:70%;left:94%;background:#e07a85;--r:10deg;--t:9s;--dl:-1s"></span>
        <span class="sp" style="top:8%;left:62%;background:#fff;opacity:.5;--r:-60deg;--t:12s;--dl:-5s"></span>
        <span class="sp" style="top:42%;left:52%;background:#d9b06c;opacity:.4;--r:45deg;--t:13s;--dl:-7s"></span>
        <span style="top:16%;left:30%;--t:7s;--dl:-3s"><svg width="18" height="18" viewBox="0 0 24 24" fill="#f3d9a4"><path d="M12 2l2.4 7.6L22 12l-7.6 2.4L12 22l-2.4-7.6L2 12l7.6-2.4z"/></svg></span>
        <span style="top:62%;left:80%;--t:9s;--dl:-6s"><svg width="14" height="14" viewBox="0 0 24 24" fill="#fff" opacity=".7"><path d="M12 2l2.4 7.6L22 12l-7.6 2.4L12 22l-2.4-7.6L2 12l7.6-2.4z"/></svg></span>
        <span style="top:30%;left:14%;--t:10s;--dl:-2s;--r:-15deg"><svg width="20" height="20" viewBox="0 0 24 24" fill="#e07a85" opacity=".8"><path d="M12 21s-8-5-8-11a4.5 4.5 0 0 1 8-2.8A4.5 4.5 0 0 1 20 10c0 6-8 11-8 11z"/></svg></span>
        <span style="top:84%;left:20%;--t:8s;--dl:-4s"><svg width="16" height="16" viewBox="0 0 24 24" fill="#d9b06c"><circle cx="12" cy="12" r="8"/></svg></span>
        <span style="top:12%;left:78%;--t:11s;--dl:-8s;--r:20deg"><svg width="22" height="22" viewBox="0 0 24 24" fill="#e07a85" opacity=".6"><path d="M12 21s-8-5-8-11a4.5 4.5 0 0 1 8-2.8A4.5 4.5 0 0 1 20 10c0 6-8 11-8 11z"/></svg></span>
    </div>

    <div class="fsx__head">
        <span class="fsx__eyebrow" data-reveal>
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l2.4 7.6L22 12l-7.6 2.4L12 22l-2.4-7.6L2 12l7.6-2.4z"/></svg>
            Por que nos escolher
        </span>
        <h2 class="fsx__title" data-reveal style="--d:.12s">Feito à mão,<br><span class="fsx__shine">feito com amor</span></h2>
        <svg class="fsx__swash" viewBox="0 0 220 22" aria-hidden="true"><path d="M4 14 C 40 2, 80 2, 110 12 S 180 22, 216 8"/></svg>
        <p class="fsx__sub" data-reveal style="--d:.24s">Cada doce nasce de receitas cuidadosas, ingredientes selecionados e o carinho de quem vive a confeitaria todos os dias.</p>
    </div>

    <div class="fsx__grid">
        <!-- Card 1 -->
        <div data-reveal style="--d:.05s">
            <div class="fsx__card">
                <span class="fsx__num">01</span>
                <div class="fsx__icon">
                    <svg class="fsx__frame" viewBox="0 0 850.4 850.4"><path d="M436.7,850.4C195.9,850.4,0,659.7,0,425.2c0-10.4,8.2-18.8,18.4-18.8s18.4,8.4,18.4,18.8c0,213.7,179.4,387.6,399.9,387.6 c214.8,0,376.8-168.7,376.8-392.3c0-217.9-161.4-382.3-375.6-382.9C244.6,38.2,87.5,198.8,87.5,396.2 C87.5,594,245.2,754.9,439,754.9c10.2,0,18.4,8.4,18.4,18.8c0,10.4-8.2,18.8-18.4,18.8c-214.1,0-388.4-177.7-388.4-396.2 C50.7,178.5,223.6,1.3,436.7,0v0l2.3,0c234.7,1.2,411.4,181.5,411.4,420.5c0,115.2-41.2,222.7-116.1,302.7 C657.5,805.2,551.8,850.4,436.7,850.4z"></path></svg>
                    <div class="fsx__icon-inner">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M4 21h16M5 21v-6a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v6"/><path d="M5 17c1.2 0 1.8-1 3-1s1.8 1 3 1 1.8-1 3-1 1.8 1 3 1 1.8-1 2-1"/><path d="M12 13V9M12 6.5c-.8-.8-.8-1.8 0-3 .8 1.2.8 2.2 0 3z"/></svg>
                    </div>
                </div>
                <h3>Tradição</h3>
                <div class="fsx__divider"></div>
                <p>Receitas de família preservadas há gerações, com o sabor autêntico que desperta memórias afetivas.</p>
                <a href="#" class="fsx__btn">Veja nossa vitrine <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
            </div>
        </div>

        <!-- Card 2 (destaque) -->
        <div data-reveal style="--d:.2s">
            <div class="fsx__card fsx__card--featured">
                <span class="fsx__badge">Mais pedido</span>
                <span class="fsx__num">02</span>
                <div class="fsx__icon">
                    <svg class="fsx__frame" viewBox="0 0 850.4 850.4"><path d="M436.7,850.4C195.9,850.4,0,659.7,0,425.2c0-10.4,8.2-18.8,18.4-18.8s18.4,8.4,18.4,18.8c0,213.7,179.4,387.6,399.9,387.6 c214.8,0,376.8-168.7,376.8-392.3c0-217.9-161.4-382.3-375.6-382.9C244.6,38.2,87.5,198.8,87.5,396.2 C87.5,594,245.2,754.9,439,754.9c10.2,0,18.4,8.4,18.4,18.8c0,10.4-8.2,18.8-18.4,18.8c-214.1,0-388.4-177.7-388.4-396.2 C50.7,178.5,223.6,1.3,436.7,0v0l2.3,0c234.7,1.2,411.4,181.5,411.4,420.5c0,115.2-41.2,222.7-116.1,302.7 C657.5,805.2,551.8,850.4,436.7,850.4z"></path></svg>
                    <div class="fsx__icon-inner">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l1.8 4.2L18 9l-4.2 1.8L12 15l-1.8-4.2L6 9l4.2-1.8z"/><path d="M19 15l.8 1.7 1.7.8-1.7.8L19 20l-.8-1.7-1.7-.8 1.7-.8zM5 15l.6 1.4 1.4.6-1.4.6L5 19l-.6-1.4L3 17l1.4-.6z"/></svg>
                    </div>
                </div>
                <h3>Criatividade</h3>
                <div class="fsx__divider"></div>
                <p>Bolos e doces personalizados que transformam sua ideia em uma peça única para cada celebração.</p>
                <a href="#" class="fsx__btn">Veja nossa vitrine <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
            </div>
        </div>

        <!-- Card 3 -->
        <div data-reveal style="--d:.35s">
            <div class="fsx__card">
                <span class="fsx__num">03</span>
                <div class="fsx__icon">
                    <svg class="fsx__frame" viewBox="0 0 850.4 850.4"><path d="M436.7,850.4C195.9,850.4,0,659.7,0,425.2c0-10.4,8.2-18.8,18.4-18.8s18.4,8.4,18.4,18.8c0,213.7,179.4,387.6,399.9,387.6 c214.8,0,376.8-168.7,376.8-392.3c0-217.9-161.4-382.3-375.6-382.9C244.6,38.2,87.5,198.8,87.5,396.2 C87.5,594,245.2,754.9,439,754.9c10.2,0,18.4,8.4,18.4,18.8c0,10.4-8.2,18.8-18.4,18.8c-214.1,0-388.4-177.7-388.4-396.2 C50.7,178.5,223.6,1.3,436.7,0v0l2.3,0c234.7,1.2,411.4,181.5,411.4,420.5c0,115.2-41.2,222.7-116.1,302.7 C657.5,805.2,551.8,850.4,436.7,850.4z"></path></svg>
                    <div class="fsx__icon-inner">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20s-7-4.4-7-10a4 4 0 0 1 7-2.6A4 4 0 0 1 19 10c0 5.6-7 10-7 10z"/></svg>
                    </div>
                </div>
                <h3>Paixão</h3>
                <div class="fsx__divider"></div>
                <p>Ingredientes selecionados e um cuidado artesanal em cada detalhe, do forno até a sua mesa.</p>
                <a href="#" class="fsx__btn">Veja nossa vitrine <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
            </div>
        </div>
    </div>

    <!-- Números (ajuste para os dados reais da confeitaria) -->
    <div class="fsx__stats">
        <div class="fsx__stats-inner" data-reveal style="--d:.1s">
            <div class="fsx__stat"><strong data-count="15" data-suffix="+">0</strong><span>Anos de história</span></div>
            <div class="fsx__stat"><strong data-count="12000" data-suffix="+">0</strong><span>Clientes felizes</span></div>
            <div class="fsx__stat"><strong data-count="180" data-suffix="">0</strong><span>Receitas exclusivas</span></div>
            <div class="fsx__stat"><strong data-count="100" data-suffix="%">0</strong><span>Artesanal</span></div>
        </div>
    </div>

    <div class="fsx__wave" aria-hidden="true">
        <svg viewBox="0 0 2880 110" preserveAspectRatio="none"><path class="w2" d="M0,55 Q180,10 360,55 T720,55 T1080,55 T1440,55 T1800,55 T2160,55 T2520,55 T2880,55 V110 H0Z"/></svg>
        <svg viewBox="0 0 2880 110" preserveAspectRatio="none"><path class="w1" d="M0,70 Q240,30 480,70 T960,70 T1440,70 T1920,70 T2400,70 T2880,70 V110 H0Z"/></svg>
    </div>
</section>

<script>
(function () {
    var root = document.getElementById('fsx');
    if (!root) return;
    root.classList.add('fsx--js');
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // Contadores
    function count(el) {
        var end = +el.dataset.count, suf = el.dataset.suffix || '';
        if (reduce) { el.textContent = end.toLocaleString('pt-BR') + suf; return; }
        var dur = 2000, t0 = performance.now();
        (function step(t) {
            var p = Math.min((t - t0) / dur, 1), e = 1 - Math.pow(1 - p, 3);
            el.textContent = Math.round(end * e).toLocaleString('pt-BR') + suf;
            if (p < 1) requestAnimationFrame(step);
        })(t0);
    }

    // Revelar ao rolar
    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) {
            if (!e.isIntersecting) return;
            e.target.classList.add('is-in');
            if (e.target.dataset.count !== undefined) count(e.target);
            io.unobserve(e.target);
        });
    }, { threshold: 0.2 });
    root.querySelectorAll('[data-reveal], [data-count], .fsx__swash').forEach(function (el) { io.observe(el); });

    // Cards 3D que seguem o mouse
    if (!reduce && window.matchMedia('(hover: hover)').matches) {
        root.querySelectorAll('.fsx__card').forEach(function (c) {
            c.addEventListener('mousemove', function (ev) {
                var r = c.getBoundingClientRect(),
                    x = (ev.clientX - r.left) / r.width,
                    y = (ev.clientY - r.top) / r.height;
                c.style.setProperty('--mx', (x * 100) + '%');
                c.style.setProperty('--my', (y * 100) + '%');
                c.style.transform = 'rotateX(' + ((0.5 - y) * 14) + 'deg) rotateY(' + ((x - 0.5) * 14) + 'deg) translateY(-10px)';
            });
            c.addEventListener('mouseleave', function () {
                c.style.transition = 'transform .7s cubic-bezier(.2,.7,.2,1), box-shadow .5s, border-color .5s';
                c.style.transform = '';
                setTimeout(function () { c.style.transition = ''; }, 700);
            });
        });
    }

    // Parallax do fundo
    if (!reduce) {
        var bg = root.querySelector('.fsx__bg'), ticking = false;
        function parallax() {
            var r = root.getBoundingClientRect();
            var off = (r.top + r.height / 2 - window.innerHeight / 2) * -0.18;
            bg.style.transform = 'translate3d(0,' + off + 'px,0) scale(1.1)';
            ticking = false;
        }
        window.addEventListener('scroll', function () {
            if (!ticking) { ticking = true; requestAnimationFrame(parallax); }
        }, { passive: true });
        parallax();
    }
})();
</script>
<!-- End Features Section -->
