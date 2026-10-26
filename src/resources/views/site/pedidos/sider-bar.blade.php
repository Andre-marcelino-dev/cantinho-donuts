@php
    $formatarValor = fn ($valor) => 'R$ ' . number_format($valor, 2, ',', '.');
    // Link do WhatsApp da loja já com a mensagem pronta
    $linkWhatsapp = fn ($texto) => 'https://wa.me/' . $whatsapp . '?text=' . rawurlencode($texto);
    $numeroWhats = preg_replace('/\D/', '', $whatsapp);
@endphp

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,500;1,600&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
.fpd{--cream:#fdf6ee;--paper:#fffaf4;--choco:#2a1710;--choco-2:#4a2a1d;--rose:#e07a85;--rose-2:#b94e5c;--gold:#d9b06c;--gold-2:#f3d9a4;--text:#6e5a50;--muted:#a08d7d;--line:#ecdccb;
  --wa:#25d366;--wa-2:#128c4a;
  position:relative;padding:60px 0 120px;background:var(--cream);font-family:'Poppins',sans-serif;color:var(--choco);isolation:isolate}
.fpd *{box-sizing:border-box}
.fpd [hidden]{display:none!important}
.fpd__glow{position:absolute;inset:0;z-index:-1;overflow:hidden;pointer-events:none}
.fpd__glow i{position:absolute;border-radius:50%;filter:blur(90px);animation:fpdBlob 22s ease-in-out infinite}
.fpd__glow i:nth-child(1){width:460px;height:460px;background:rgba(224,122,133,.18);top:40px;right:-160px}
.fpd__glow i:nth-child(2){width:420px;height:420px;background:rgba(217,176,108,.18);top:50%;left:-160px;animation-delay:-10s}
@keyframes fpdBlob{50%{transform:translate(-50px,50px) scale(1.12)}}

.fpd__wrap{max-width:1320px;margin:0 auto;padding:0 20px;display:grid;grid-template-columns:minmax(0,1fr) 340px;gap:40px;align-items:start}

/* Títulos */
.fpd__eyebrow{display:inline-flex;align-items:center;gap:12px;font-size:12.5px;font-weight:600;letter-spacing:.3em;text-transform:uppercase;color:var(--rose-2)}
.fpd__eyebrow::before{content:"";height:1px;width:0;background:var(--rose);transition:width 1.2s cubic-bezier(.2,.7,.2,1) .2s}
.fpd__eyebrow.is-in::before{width:40px}
.fpd__h2{font-family:'Playfair Display',serif;font-weight:800;font-size:clamp(32px,4.4vw,48px);line-height:1.08;letter-spacing:-.015em;margin:14px 0 32px}
.fpd__h2 em{font-style:italic;font-weight:600;background:linear-gradient(90deg,var(--rose-2),var(--rose),var(--gold),var(--rose-2));background-size:300% 100%;
  -webkit-background-clip:text;background-clip:text;color:transparent;animation:fpdShine 6s linear infinite}
@keyframes fpdShine{to{background-position:300% 0}}

/* Passos */
.fpd__steps{position:relative;display:grid;grid-template-columns:repeat(3,1fr);gap:22px;margin-bottom:80px}
.fpd__steps::before{content:"";position:absolute;left:16%;right:16%;top:44px;height:2px;z-index:0;
  background-image:linear-gradient(90deg,rgba(217,176,108,.6) 50%,transparent 50%);background-size:14px 2px}
.fpd__step{position:relative;z-index:1;display:flex;flex-direction:column;align-items:center;text-align:center;padding:0 22px 26px;border-radius:28px;background:var(--paper);
  box-shadow:0 26px 50px -34px rgba(74,42,29,.5);border:1px solid rgba(255,255,255,.9);transition:transform .5s cubic-bezier(.3,1.4,.5,1),box-shadow .5s}
.fpd__step:hover{transform:translateY(-10px);box-shadow:0 40px 70px -34px rgba(74,42,29,.6)}
.fpd__badge{position:relative;width:88px;height:88px;margin:0 0 18px;display:grid;place-items:center;border-radius:50%;color:#fff;
  background:linear-gradient(135deg,var(--rose),var(--rose-2));box-shadow:0 0 0 8px var(--cream),0 18px 30px -12px rgba(185,78,92,.7);transition:transform .7s cubic-bezier(.3,1.5,.5,1)}
.fpd__step:nth-child(2) .fpd__badge{background:linear-gradient(135deg,var(--wa),var(--wa-2));box-shadow:0 0 0 8px var(--cream),0 18px 30px -12px rgba(18,140,74,.7)}
.fpd__step:nth-child(3) .fpd__badge{background:linear-gradient(135deg,var(--gold),#b8893f);box-shadow:0 0 0 8px var(--cream),0 18px 30px -12px rgba(184,137,63,.7)}
.fpd__step:hover .fpd__badge{transform:rotate(-12deg) scale(1.06)}
.fpd__badge svg{width:36px;height:36px}
.fpd__badge b{position:absolute;top:-2px;right:-2px;width:30px;height:30px;border-radius:50%;display:grid;place-items:center;font-family:'Playfair Display',serif;font-size:14px;
  color:var(--choco);background:#fff;box-shadow:0 6px 12px -4px rgba(0,0,0,.25)}
.fpd__step{margin-top:44px}
.fpd__step .fpd__badge{margin-top:-44px}
.fpd__step h3{font-family:'Playfair Display',serif;font-weight:700;font-size:22px;margin:0 0 8px}
.fpd__step p{font-size:14px;line-height:1.65;color:var(--text);margin:0 0 20px;flex:1}
.fpd__link{display:inline-flex;align-items:center;gap:8px;padding:12px 20px;border-radius:50px;font-size:13.5px;font-weight:600;text-decoration:none;color:var(--choco);
  background:#fff;box-shadow:inset 0 0 0 1px var(--line);transition:background .3s,color .3s,box-shadow .3s,transform .35s cubic-bezier(.3,1.6,.5,1)}
.fpd__link:hover{color:#fff;background:var(--choco);box-shadow:none;text-decoration:none;transform:translateY(-2px)}
.fpd__link svg{width:16px;height:16px;transition:transform .4s}
.fpd__link:hover svg{transform:translateX(4px)}

/* Topo dos produtos */
.fpd__shop-top{display:flex;align-items:flex-end;justify-content:space-between;gap:20px;flex-wrap:wrap;margin-bottom:28px}
.fpd__shop-top .fpd__h2{margin-bottom:0}
.fpd__all{display:inline-flex;align-items:center;gap:8px;font-size:14px;font-weight:600;color:var(--rose-2);text-decoration:none}
.fpd__all:hover{color:var(--rose-2);text-decoration:none}
.fpd__all svg{width:16px;height:16px;transition:transform .4s}
.fpd__all:hover svg{transform:translateX(5px)}

/* Produtos */
.fpd__grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px}
.fpd__card{position:relative;display:flex;flex-direction:column;height:100%;border-radius:26px;overflow:hidden;background:var(--paper);box-shadow:0 26px 50px -34px rgba(74,42,29,.5);
  transition:transform .55s cubic-bezier(.3,1.4,.5,1),box-shadow .5s}
.fpd__card:hover{transform:translateY(-8px);box-shadow:0 40px 70px -34px rgba(74,42,29,.62)}
.fpd__card.is-added{animation:fpdBump .6s cubic-bezier(.3,1.6,.5,1)}
@keyframes fpdBump{40%{transform:translateY(-8px) scale(1.03)}}
.fpd__media{position:relative;display:block;aspect-ratio:1/1;overflow:hidden;background:linear-gradient(135deg,#f3c6c9,#f3d9a4);text-decoration:none}
.fpd__media img{width:100%;height:100%;object-fit:cover;display:block;color:transparent;transition:transform 1.1s cubic-bezier(.2,.7,.2,1)}
.fpd__card:hover .fpd__media img{transform:scale(1.1)}
.fpd__tag{position:absolute;z-index:2;top:12px;left:12px;display:inline-flex;align-items:center;gap:6px;padding:6px 12px 6px 9px;border-radius:30px;font-size:10.5px;font-weight:600;
  letter-spacing:.14em;text-transform:uppercase;color:#fff;background:linear-gradient(135deg,var(--rose),var(--rose-2));box-shadow:0 8px 16px -6px rgba(185,78,92,.7)}
.fpd__tag svg{width:13px;height:13px;animation:fpdSpin 6s linear infinite}
@keyframes fpdSpin{to{transform:rotate(360deg)}}
.fpd__qwa{position:absolute;z-index:2;top:12px;right:12px;width:40px;height:40px;border-radius:50%;display:grid;place-items:center;color:#fff;
  background:linear-gradient(135deg,var(--wa),var(--wa-2));box-shadow:0 10px 18px -8px rgba(18,140,74,.8);opacity:0;transform:scale(.6);
  transition:opacity .35s,transform .45s cubic-bezier(.3,1.6,.5,1)}
.fpd__card:hover .fpd__qwa{opacity:1;transform:none}
.fpd__qwa svg{width:20px;height:20px}
.fpd__body{display:flex;flex-direction:column;flex:1;padding:18px 20px 20px}
.fpd__cat{font-size:11px;font-weight:600;letter-spacing:.16em;text-transform:uppercase;color:var(--rose-2);margin-bottom:4px}
.fpd__name{font-family:'Playfair Display',serif;font-weight:700;font-size:20px;line-height:1.25;margin:0 0 14px}
.fpd__name a{color:var(--choco);text-decoration:none}
.fpd__name a:hover{color:var(--rose-2);text-decoration:none}
.fpd__foot{margin-top:auto;display:flex;align-items:center;justify-content:space-between;gap:10px}
.fpd__price{font-family:'Playfair Display',serif;font-weight:800;font-size:24px;color:var(--rose-2);line-height:1}
.fpd__price small{font-family:'Poppins',sans-serif;font-size:12px;font-weight:600;margin-right:2px}
.fpd__price--ask{font-size:12.5px;font-weight:600;color:var(--muted)}
.fpd__add{position:relative;display:inline-flex;align-items:center;gap:6px;height:42px;padding:0 16px;border:0;border-radius:50px;cursor:pointer;font-family:inherit;
  font-size:13.5px;font-weight:600;color:#fff;background:linear-gradient(135deg,var(--choco-2),var(--choco));box-shadow:0 10px 20px -10px rgba(42,23,16,.7);
  transition:transform .35s cubic-bezier(.3,1.6,.5,1),background .3s}
.fpd__add:hover{transform:translateY(-2px)}
.fpd__add svg{width:16px;height:16px}
.fpd__add .q{display:none;min-width:20px;height:20px;padding:0 5px;border-radius:20px;font-size:11px;background:rgba(255,255,255,.25);place-items:center}
.fpd__add.has-qty{background:linear-gradient(135deg,var(--rose),var(--rose-2))}
.fpd__add.has-qty .q{display:inline-grid}
.fpd__empty{grid-column:1/-1;text-align:center;padding:40px 20px;border-radius:24px;border:1.5px dashed var(--line);color:var(--text)}

/* Lateral */
.fpd__side{position:sticky;top:100px;display:grid;gap:20px}
.fpd__box{border-radius:26px;padding:24px;background:var(--paper);box-shadow:0 26px 50px -34px rgba(74,42,29,.5);border:1px solid rgba(255,255,255,.9)}
.fpd__box h3{display:flex;align-items:center;gap:10px;font-family:'Playfair Display',serif;font-weight:700;font-size:20px;margin:0 0 6px}
.fpd__box h3 svg{width:22px;height:22px;color:var(--rose-2)}
.fpd__box p{font-size:13.5px;line-height:1.6;color:var(--text);margin:0 0 16px}

/* Sacola */
.fpd__bag{background:linear-gradient(170deg,var(--choco-2),var(--choco));color:#fff;border:0}
.fpd__bag h3{color:#fff}
.fpd__bag h3 svg{color:var(--gold-2)}
.fpd__bag h3 .n{margin-left:auto;min-width:28px;height:28px;padding:0 8px;border-radius:20px;display:grid;place-items:center;font-family:'Poppins',sans-serif;font-size:12px;font-weight:600;
  color:var(--choco);background:var(--gold-2)}
.fpd__bag h3 .n.pop{animation:fpdPop .5s cubic-bezier(.3,1.8,.5,1)}
@keyframes fpdPop{50%{transform:scale(1.4)}}
.fpd__bag-empty{display:flex;flex-direction:column;align-items:center;text-align:center;gap:6px;padding:16px 4px 6px;font-size:13.5px;color:rgba(255,255,255,.6)}
.fpd__bag-empty svg{width:42px;height:42px;color:rgba(243,217,164,.5);animation:fpdBob 3s ease-in-out infinite}
@keyframes fpdBob{50%{transform:translateY(-6px)}}
.fpd__items{list-style:none;margin:14px 0 0;padding:0;max-height:300px;overflow-y:auto;scrollbar-width:thin;scrollbar-color:rgba(255,255,255,.2) transparent}
.fpd__items li{display:flex;align-items:center;gap:10px;padding:10px 0;border-bottom:1px solid rgba(255,255,255,.08);animation:fpdIn .4s cubic-bezier(.3,1.4,.5,1)}
@keyframes fpdIn{from{opacity:0;transform:translateX(-10px)}}
.fpd__items .nm{flex:1;min-width:0;font-size:13.5px;line-height:1.35}
.fpd__items .nm small{display:block;font-size:12px;color:var(--gold-2)}
.fpd__qty{display:flex;align-items:center;gap:2px;flex:none;border-radius:30px;background:rgba(255,255,255,.08)}
.fpd__qty button{width:28px;height:28px;border:0;border-radius:50%;cursor:pointer;background:transparent;color:#fff;font-size:16px;line-height:1;display:grid;place-items:center;transition:background .2s}
.fpd__qty button:hover{background:rgba(255,255,255,.15)}
.fpd__qty span{min-width:20px;text-align:center;font-size:13px;font-weight:600}
.fpd__total{display:flex;justify-content:space-between;align-items:baseline;margin:16px 0 4px;font-size:14px;color:rgba(255,255,255,.7)}
.fpd__total b{font-family:'Playfair Display',serif;font-size:26px;font-weight:800;color:var(--gold-2)}
.fpd__obs{display:block;font-size:11.5px;color:rgba(255,255,255,.45);margin-bottom:14px}
.fpd__send{display:flex;align-items:center;justify-content:center;gap:10px;width:100%;padding:15px;border:0;border-radius:16px;cursor:pointer;font-family:inherit;font-size:15px;font-weight:600;
  color:#fff;background:linear-gradient(135deg,var(--wa),var(--wa-2));box-shadow:0 16px 30px -14px rgba(18,140,74,.8);transition:transform .35s cubic-bezier(.3,1.6,.5,1),opacity .3s}
.fpd__send:hover{transform:translateY(-3px)}
.fpd__send svg{width:20px;height:20px}
.fpd__send:disabled{opacity:.4;cursor:not-allowed;transform:none}
.fpd__clear{display:block;width:100%;margin-top:8px;padding:8px;border:0;background:transparent;cursor:pointer;font-family:inherit;font-size:12.5px;color:rgba(255,255,255,.5)}
.fpd__clear:hover{color:#fff}

.fpd__btn{display:flex;align-items:center;justify-content:center;gap:8px;width:100%;padding:13px;border-radius:14px;font-size:14px;font-weight:600;text-decoration:none;
  transition:transform .35s cubic-bezier(.3,1.6,.5,1),background .3s,color .3s}
.fpd__btn:hover{text-decoration:none;transform:translateY(-2px)}
.fpd__btn svg{width:18px;height:18px}
.fpd__btn--app{color:#fff;background:linear-gradient(135deg,var(--rose),var(--rose-2))}
.fpd__btn--app:hover{color:#fff}
.fpd__btn--wa{color:var(--wa-2);background:rgba(37,211,102,.1);box-shadow:inset 0 0 0 1px rgba(18,140,74,.25)}
.fpd__btn--wa:hover{color:#fff;background:var(--wa-2)}
.fpd__cats{display:flex;flex-wrap:wrap;gap:8px;list-style:none;margin:12px 0 0;padding:0}
.fpd__cats a{display:inline-block;padding:8px 14px;border-radius:50px;font-size:13px;font-weight:500;color:var(--choco-2);text-decoration:none;background:#fff;box-shadow:inset 0 0 0 1px var(--line);
  transition:background .3s,color .3s,transform .35s cubic-bezier(.3,1.6,.5,1),box-shadow .3s}
.fpd__cats a:hover{color:#fff;background:var(--rose-2);box-shadow:none;transform:translateY(-2px);text-decoration:none}

/* Barra da sacola no celular */
.fpd__mbar{display:none}

/* Revelar */
.fpd--js [data-reveal]{opacity:0;transform:translateY(40px);transition:opacity .9s cubic-bezier(.2,.7,.2,1) var(--d,0s),transform .9s cubic-bezier(.2,.7,.2,1) var(--d,0s)}
.fpd--js [data-reveal].is-in{opacity:1;transform:none}

@media (max-width:1199px){.fpd__grid{grid-template-columns:repeat(2,1fr)}}
@media (max-width:991px){
  .fpd__wrap{grid-template-columns:1fr}
  .fpd__side{position:relative;top:0}
  .fpd__mbar{position:fixed;z-index:60;left:12px;right:12px;bottom:12px;display:flex;align-items:center;gap:12px;padding:10px 10px 10px 18px;border-radius:20px;
    background:var(--choco);color:#fff;box-shadow:0 20px 40px -14px rgba(42,23,16,.7);transform:translateY(140%);transition:transform .5s cubic-bezier(.3,1.4,.5,1)}
  .fpd__mbar.is-on{transform:none}
  .fpd__mbar span{flex:1;font-size:13.5px}
  .fpd__mbar b{color:var(--gold-2)}
  .fpd__mbar a{display:inline-flex;align-items:center;gap:6px;padding:11px 16px;border-radius:14px;font-size:13.5px;font-weight:600;color:var(--choco);background:var(--gold-2);text-decoration:none}
}
@media (max-width:760px){
  .fpd__steps{grid-template-columns:1fr;gap:60px}
  .fpd__steps::before{display:none}
}
@media (max-width:520px){
  .fpd__wrap{padding:0 16px}
  .fpd__grid{grid-template-columns:1fr 1fr;gap:14px}
  .fpd__body{padding:14px}
  .fpd__name{font-size:16px}
  .fpd__price{font-size:19px}
  .fpd__foot{flex-direction:column;align-items:stretch}
  .fpd__add{justify-content:center}
  .fpd__qwa{opacity:1;transform:none;width:34px;height:34px}
}
@media (prefers-reduced-motion:reduce){
  .fpd *,.fpd *::before,.fpd *::after{animation:none!important;transition:none!important}
  .fpd--js [data-reveal]{opacity:1;transform:none}
}
</style>

<!--Sidebar Page Container-->
<div class="fpd" id="fpd" data-whats="{{ $numeroWhats }}">
    <div class="fpd__glow" aria-hidden="true"><i></i><i></i></div>

    <div class="fpd__wrap">
        <!-- Conteúdo -->
        <div class="fpd__main">

            {{-- Como pedir --}}
            <span class="fpd__eyebrow" data-reveal>{{ conteudo('pedidos.como.selo') }}</span>
            <h2 class="fpd__h2" data-reveal style="--d:.1s">{{ conteudo_html('pedidos.como.titulo') }}</h2>

            <div class="fpd__steps">
                <div class="fpd__step" data-reveal style="--d:.1s">
                    <span class="fpd__badge"><b>1</b>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="6" y="2" width="12" height="20" rx="3"/><path d="M11 18h2"/></svg>
                    </span>
                    <h3>{{ conteudo('pedidos.como.passo1_titulo') }}</h3>
                    <p>{{ conteudo('pedidos.como.passo1_texto') }}</p>
                    <a href="{{ $linkApp }}" target="_blank" rel="noopener" class="fpd__link">{{ conteudo('pedidos.como.passo1_botao') }} <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
                </div>
                <div class="fpd__step" data-reveal style="--d:.22s">
                    <span class="fpd__badge"><b>2</b>
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.5 14.4c-.3-.1-1.8-.9-2-1-.3-.1-.5-.1-.7.1-.2.3-.8 1-.9 1.2-.2.2-.3.2-.6.1-.3-.1-1.3-.5-2.4-1.5-.9-.8-1.5-1.8-1.7-2.1-.2-.3 0-.5.1-.6l.4-.5c.2-.2.2-.3.3-.5.1-.2 0-.4 0-.5l-.9-2.2c-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.5s1.1 2.9 1.2 3.1c.1.2 2.1 3.2 5.1 4.5.7.3 1.3.5 1.7.6.7.2 1.4.2 1.9.1.6-.1 1.8-.7 2-1.4.3-.7.3-1.3.2-1.4-.1-.2-.3-.3-.6-.4zM12 21.8c-1.8 0-3.5-.5-5-1.4l-.4-.2-3.7 1 1-3.6-.2-.4c-1-1.6-1.5-3.4-1.5-5.2C2.2 6.6 6.6 2.2 12 2.2c2.6 0 5.1 1 6.9 2.9 1.9 1.9 2.9 4.3 2.9 6.9 0 5.4-4.4 9.8-9.8 9.8zm8.4-18.2C18.2 1.3 15.2 0 12 0 5.4 0 0 5.4 0 12c0 2.1.6 4.2 1.6 6L0 24l6.2-1.6c1.8 1 3.8 1.5 5.8 1.5 6.6 0 12-5.4 12-12 0-3.2-1.2-6.2-3.6-8.3z"/></svg>
                    </span>
                    <h3>{{ conteudo('pedidos.como.passo2_titulo') }}</h3>
                    <p>{{ conteudo('pedidos.como.passo2_texto') }}</p>
                    <a href="{{ $linkWhatsapp(conteudo('pedidos.como.passo2_mensagem')) }}" target="_blank" rel="noopener" class="fpd__link">{{ conteudo('pedidos.como.passo2_botao') }} <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
                </div>
                <div class="fpd__step" data-reveal style="--d:.34s">
                    <span class="fpd__badge"><b>3</b>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 21h16M5 21v-6a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v6"/><path d="M5 17c1.2 0 1.8-1 3-1s1.8 1 3 1 1.8-1 3-1 1.8 1 3 1 1.8-1 2-1"/><path d="M12 13V9M12 6.5c-.8-.8-.8-1.8 0-3 .8 1.2.8 2.2 0 3z"/></svg>
                    </span>
                    <h3>{{ conteudo('pedidos.como.passo3_titulo') }}</h3>
                    <p>{{ conteudo('pedidos.como.passo3_texto') }}</p>
                    <a href="{{ route('contato') }}#fale-conosco" class="fpd__link">{{ conteudo('pedidos.como.passo3_botao') }} <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
                </div>
            </div>

            {{-- Produtos --}}
            <div class="fpd__shop-top">
                <div>
                    <span class="fpd__eyebrow" data-reveal>{{ conteudo('pedidos.produtos.selo') }}</span>
                    <h2 class="fpd__h2" data-reveal style="--d:.1s">{{ conteudo_html('pedidos.produtos.titulo') }}</h2>
                </div>
                <a href="{{ route('cardapio.index') }}" class="fpd__all" data-reveal style="--d:.2s">{{ conteudo('pedidos.produtos.ver_todos') }}
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                </a>
            </div>

            <div class="fpd__grid">
                @forelse ($produtos as $produto)
                    @php
                        $valorProduto = (float) $produto->valor_produto;
                        $linkProduto = route('cardapio.produto', $produto->slug_produto);
                    @endphp
                    <div data-reveal style="--d:{{ ($loop->index % 3) * 0.1 }}s">
                        <article class="fpd__card" data-id="{{ $produto->slug_produto }}" data-name="{{ $produto->nome_produto }}" data-price="{{ $valorProduto }}">
                            <a href="{{ $linkProduto }}" class="fpd__media" aria-label="Ver {{ $produto->nome_produto }}">
                                <img src="{{ asset('donuts/images/' . $produto->foto_produto) }}" alt="{{ $produto->nome_produto }}" loading="lazy">
                                @if ($produto->destaque_produto === 'SIM')
                                    <span class="fpd__tag"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l2.9 6.3 6.9.7-5.2 4.6 1.5 6.8L12 17l-6.1 3.4 1.5-6.8L2.2 9l6.9-.7z"/></svg>Destaque</span>
                                @endif
                            </a>
                            <a href="{{ $linkWhatsapp('Olá! Quero pedir: ' . $produto->nome_produto . ($valorProduto > 0 ? ' (' . $formatarValor($valorProduto) . ')' : '') . '.') }}"
                                target="_blank" rel="noopener" class="fpd__qwa" aria-label="Pedir {{ $produto->nome_produto }} pelo WhatsApp" title="Pedir só este pelo WhatsApp">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.5 14.4c-.3-.1-1.8-.9-2-1-.3-.1-.5-.1-.7.1-.2.3-.8 1-.9 1.2-.2.2-.3.2-.6.1-.3-.1-1.3-.5-2.4-1.5-.9-.8-1.5-1.8-1.7-2.1-.2-.3 0-.5.1-.6l.4-.5c.2-.2.2-.3.3-.5.1-.2 0-.4 0-.5l-.9-2.2c-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.5s1.1 2.9 1.2 3.1c.1.2 2.1 3.2 5.1 4.5.7.3 1.3.5 1.7.6.7.2 1.4.2 1.9.1.6-.1 1.8-.7 2-1.4.3-.7.3-1.3.2-1.4-.1-.2-.3-.3-.6-.4zM12 21.8c-1.8 0-3.5-.5-5-1.4l-.4-.2-3.7 1 1-3.6-.2-.4c-1-1.6-1.5-3.4-1.5-5.2C2.2 6.6 6.6 2.2 12 2.2c2.6 0 5.1 1 6.9 2.9 1.9 1.9 2.9 4.3 2.9 6.9 0 5.4-4.4 9.8-9.8 9.8zm8.4-18.2C18.2 1.3 15.2 0 12 0 5.4 0 0 5.4 0 12c0 2.1.6 4.2 1.6 6L0 24l6.2-1.6c1.8 1 3.8 1.5 5.8 1.5 6.6 0 12-5.4 12-12 0-3.2-1.2-6.2-3.6-8.3z"/></svg>
                            </a>
                            <div class="fpd__body">
                                <span class="fpd__cat">{{ $produto->CategoriaProduto->nome_categoria ?? '' }}</span>
                                <h3 class="fpd__name"><a href="{{ $linkProduto }}">{{ $produto->nome_produto }}</a></h3>
                                <div class="fpd__foot">
                                    @if ($valorProduto > 0)
                                        <span class="fpd__price"><small>R$</small>{{ number_format($valorProduto, 2, ',', '.') }}</span>
                                    @else
                                        <span class="fpd__price--ask">Sob consulta</span>
                                    @endif
                                    <button type="button" class="fpd__add" aria-label="Adicionar {{ $produto->nome_produto }} à sacola">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
                                        Adicionar <span class="q">0</span>
                                    </button>
                                </div>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="fpd__empty">{{ conteudo('pedidos.produtos.vazio') }}</div>
                @endforelse
            </div>
        </div>

        <!-- Lateral -->
        <aside class="fpd__side">
            <!-- Sacola -->
            <div class="fpd__box fpd__bag" id="fpd-sacola" data-reveal>
                <h3>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                    Sua sacola <span class="n">0</span>
                </h3>
                <div class="fpd__bag-empty">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                    Sua sacola está vazia.<br>Toque em <b>Adicionar</b> nos doces.
                </div>
                <div class="fpd__bag-full" hidden>
                    <ul class="fpd__items"></ul>
                    <div class="fpd__total"><span>Total estimado</span><b class="fpd__sum">R$ 0,00</b></div>
                    <small class="fpd__obs">{{ conteudo('pedidos.lateral.sacola_obs') }}</small>
                    <button type="button" class="fpd__send">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.5 14.4c-.3-.1-1.8-.9-2-1-.3-.1-.5-.1-.7.1-.2.3-.8 1-.9 1.2-.2.2-.3.2-.6.1-.3-.1-1.3-.5-2.4-1.5-.9-.8-1.5-1.8-1.7-2.1-.2-.3 0-.5.1-.6l.4-.5c.2-.2.2-.3.3-.5.1-.2 0-.4 0-.5l-.9-2.2c-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.5s1.1 2.9 1.2 3.1c.1.2 2.1 3.2 5.1 4.5.7.3 1.3.5 1.7.6.7.2 1.4.2 1.9.1.6-.1 1.8-.7 2-1.4.3-.7.3-1.3.2-1.4-.1-.2-.3-.3-.6-.4zM12 21.8c-1.8 0-3.5-.5-5-1.4l-.4-.2-3.7 1 1-3.6-.2-.4c-1-1.6-1.5-3.4-1.5-5.2C2.2 6.6 6.6 2.2 12 2.2c2.6 0 5.1 1 6.9 2.9 1.9 1.9 2.9 4.3 2.9 6.9 0 5.4-4.4 9.8-9.8 9.8zm8.4-18.2C18.2 1.3 15.2 0 12 0 5.4 0 0 5.4 0 12c0 2.1.6 4.2 1.6 6L0 24l6.2-1.6c1.8 1 3.8 1.5 5.8 1.5 6.6 0 12-5.4 12-12 0-3.2-1.2-6.2-3.6-8.3z"/></svg>
                        Enviar pedido pelo WhatsApp
                    </button>
                    <button type="button" class="fpd__clear">Esvaziar sacola</button>
                </div>
            </div>

            <!-- App -->
            <div class="fpd__box" data-reveal style="--d:.1s">
                <h3><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="6" y="2" width="12" height="20" rx="3"/><path d="M11 18h2"/></svg>{{ conteudo('pedidos.lateral.app_titulo') }}</h3>
                <p>{{ conteudo('pedidos.lateral.app_texto') }}</p>
                <a href="{{ $linkApp }}" target="_blank" rel="noopener" class="fpd__btn fpd__btn--app">{{ conteudo('pedidos.como.passo1_botao') }}</a>
            </div>

            <!-- WhatsApp -->
            <div class="fpd__box" data-reveal style="--d:.2s">
                <h3><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>{{ conteudo('pedidos.lateral.duvida_titulo') }}</h3>
                <p>{{ conteudo('pedidos.lateral.duvida_texto') }}</p>
                <a href="{{ $linkWhatsapp(conteudo('pedidos.lateral.duvida_mensagem')) }}" target="_blank" rel="noopener" class="fpd__btn fpd__btn--wa">{{ conteudo('pedidos.como.passo2_botao') }}</a>
            </div>

            <!-- Categorias -->
            <div class="fpd__box" data-reveal style="--d:.3s">
                <h3><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20.6 13.4 13.4 20.6a2 2 0 0 1-2.8 0L3 13V3h10l7.6 7.6a2 2 0 0 1 0 2.8z"/><circle cx="7.5" cy="7.5" r="1.5"/></svg>Categorias</h3>
                <ul class="fpd__cats">
                    @foreach ($filtroCategoria->where('status_categoria', 'ATIVO') as $categoria)
                        <li><a href="{{ route('cardapio.categoria', $categoria->id_categoria) }}">{{ $categoria->nome_categoria }}</a></li>
                    @endforeach
                </ul>
            </div>
        </aside>
    </div>

    <!-- Barra da sacola no celular -->
    <div class="fpd__mbar" aria-live="polite">
        <span><b class="fpd__mcount">0 itens</b> · <b class="fpd__mtotal">R$ 0,00</b></span>
        <a href="#fpd-sacola">Ver sacola</a>
    </div>
</div>
<!--End Sidebar Page Container-->

<script>
(function () {
    var root = document.getElementById('fpd');
    if (!root) return;
    root.classList.add('fpd--js');
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('is-in'); io.unobserve(e.target); } });
    }, { threshold: 0.12 });
    root.querySelectorAll('[data-reveal]').forEach(function (el) { io.observe(el); });

    // ---------- Sacola ----------
    var KEY = 'sacola-pedido';
    var fmt = new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' });
    var cards = {};
    root.querySelectorAll('.fpd__card').forEach(function (c) { cards[c.dataset.id] = c; });
    var bag = {};
    try { bag = JSON.parse(localStorage.getItem(KEY) || '{}') || {}; } catch (e) { bag = {}; }
    Object.keys(bag).forEach(function (id) { if (!cards[id] || !(bag[id].q > 0)) delete bag[id]; });

    var list = root.querySelector('.fpd__items'), empty = root.querySelector('.fpd__bag-empty'), full = root.querySelector('.fpd__bag-full');
    var n = root.querySelector('.fpd__bag .n'), sum = root.querySelector('.fpd__sum'), mbar = root.querySelector('.fpd__mbar');

    function save() { try { localStorage.setItem(KEY, JSON.stringify(bag)); } catch (e) {} }
    function esc(s) { var d = document.createElement('div'); d.textContent = s; return d.innerHTML; }

    function render(popId) {
        var ids = Object.keys(bag), qtd = 0, total = 0, askOnly = false;
        list.innerHTML = '';
        ids.forEach(function (id) {
            var it = bag[id]; qtd += it.q;
            if (it.p > 0) total += it.p * it.q; else askOnly = true;
            var li = document.createElement('li');
            li.innerHTML = '<span class="nm">' + esc(it.n) + '<small>' + (it.p > 0 ? fmt.format(it.p * it.q) : 'Sob consulta') + '</small></span>' +
                '<span class="fpd__qty"><button type="button" data-a="-" aria-label="Diminuir">−</button><span>' + it.q + '</span><button type="button" data-a="+" aria-label="Aumentar">+</button></span>';
            li.querySelectorAll('button').forEach(function (b) {
                b.addEventListener('click', function () { change(id, b.dataset.a === '+' ? 1 : -1); });
            });
            list.appendChild(li);
        });
        Object.keys(cards).forEach(function (id) {
            var btn = cards[id].querySelector('.fpd__add'), q = bag[id] ? bag[id].q : 0;
            btn.classList.toggle('has-qty', q > 0);
            btn.querySelector('.q').textContent = q;
        });
        empty.hidden = ids.length > 0;
        full.hidden = ids.length === 0;
        n.textContent = qtd;
        if (popId && !reduce) { n.classList.remove('pop'); void n.offsetWidth; n.classList.add('pop'); }
        sum.textContent = fmt.format(total) + (askOnly ? ' +' : '');
        root.querySelector('.fpd__mcount').textContent = qtd + (qtd === 1 ? ' item' : ' itens');
        root.querySelector('.fpd__mtotal').textContent = fmt.format(total);
        mbar.classList.toggle('is-on', qtd > 0);
        save();
    }

    function change(id, d) {
        var c = cards[id]; if (!c) return;
        if (!bag[id]) bag[id] = { n: c.dataset.name, p: parseFloat(c.dataset.price) || 0, q: 0 };
        bag[id].q += d;
        if (bag[id].q <= 0) delete bag[id];
        if (d > 0 && !reduce) { c.classList.remove('is-added'); void c.offsetWidth; c.classList.add('is-added'); }
        render(id);
    }

    Object.keys(cards).forEach(function (id) {
        cards[id].querySelector('.fpd__add').addEventListener('click', function () { change(id, 1); });
    });

    root.querySelector('.fpd__clear').addEventListener('click', function () { bag = {}; render(); });

    root.querySelector('.fpd__send').addEventListener('click', function () {
        var ids = Object.keys(bag); if (!ids.length) return;
        var total = 0, linhas = ids.map(function (id) {
            var it = bag[id]; if (it.p > 0) total += it.p * it.q;
            return '• ' + it.q + 'x ' + it.n + (it.p > 0 ? ' — ' + fmt.format(it.p * it.q) : ' — sob consulta');
        });
        var msg = 'Olá! Gostaria de fazer este pedido:\n\n' + linhas.join('\n') + '\n\nTotal estimado: ' + fmt.format(total) + '\n\nPode confirmar a disponibilidade?';
        window.open('https://wa.me/' + root.dataset.whats + '?text=' + encodeURIComponent(msg), '_blank', 'noopener');
    });

    render();
})();
</script>