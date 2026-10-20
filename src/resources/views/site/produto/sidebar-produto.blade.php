<!-- Página do produto (redesign animado) -->
@php
    $valorProduto   = (float) $produto->valor_produto;
    $fotoProduto    = asset('davilla/images/' . $produto->foto_produto);
    $categoriaNome  = $produto->CategoriaProduto->nome_categoria ?? null;
    $numeroWhats    = preg_replace('/\D/', '', $whatsapp ?? ($loja['whatsapp'] ?? ''));
    $depoimentosLoja = isset($depoimentosSite) ? $depoimentosSite->take(3) : collect();
@endphp

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,500;1,600&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
.fps{--cream:#fdf6ee;--paper:#fffaf4;--choco:#2a1710;--choco-2:#4a2a1d;--rose:#e07a85;--rose-2:#b94e5c;--gold:#d9b06c;--gold-2:#f3d9a4;--text:#6e5a50;--muted:#a08d7d;--line:#ecdccb;
  --wa:#25d366;--wa-2:#128c4a;--star:#f5b942;
  position:relative;padding:50px 0 120px;background:var(--cream);font-family:'Poppins',sans-serif;color:var(--choco);isolation:isolate}
.fps *{box-sizing:border-box}
.fps [hidden]{display:none!important}
.fps__glow{position:absolute;inset:0;z-index:-1;overflow:hidden;pointer-events:none}
.fps__glow i{position:absolute;border-radius:50%;filter:blur(90px);animation:fpsBlob 22s ease-in-out infinite}
.fps__glow i:nth-child(1){width:480px;height:480px;background:rgba(224,122,133,.2);top:0;left:-160px}
.fps__glow i:nth-child(2){width:420px;height:420px;background:rgba(217,176,108,.2);top:40%;right:-160px;animation-delay:-10s}
@keyframes fpsBlob{50%{transform:translate(50px,40px) scale(1.12)}}

.fps__wrap{max-width:1320px;margin:0 auto;padding:0 20px;display:grid;grid-template-columns:minmax(0,1fr) 320px;gap:40px;align-items:start}
.fps__h2{font-family:'Playfair Display',serif;font-weight:800;font-size:clamp(28px,3.6vw,40px);line-height:1.1;margin:0 0 26px}
.fps__h2 em{font-style:italic;font-weight:600;color:var(--rose-2)}

/* Produto */
.fps__hero{display:grid;grid-template-columns:1fr 1fr;gap:44px;align-items:center;margin-bottom:70px}
.fps__photo{position:relative;aspect-ratio:1;border-radius:34px;overflow:hidden;cursor:zoom-in;background:linear-gradient(135deg,#f3c6c9,#f3d9a4);
  box-shadow:0 50px 90px -42px rgba(74,42,29,.65)}
.fps__photo img{width:100%;height:100%;object-fit:cover;display:block;color:transparent;transition:transform .5s cubic-bezier(.2,.7,.2,1);transform-origin:var(--ox,50%) var(--oy,50%)}
.fps__photo:hover img{transform:scale(1.6)}
.fps__photo::after{content:"";position:absolute;inset:14px;border-radius:24px;border:1.5px dashed rgba(255,255,255,.65);pointer-events:none;transition:opacity .4s}
.fps__photo:hover::after{opacity:0}
.fps__zoom{position:absolute;right:16px;bottom:16px;display:inline-flex;align-items:center;gap:8px;padding:9px 14px;border-radius:50px;font-size:12px;font-weight:600;
  color:var(--choco);background:rgba(255,255,255,.9);-webkit-backdrop-filter:blur(8px);backdrop-filter:blur(8px);pointer-events:none;transition:opacity .4s}
.fps__photo:hover .fps__zoom{opacity:0}
.fps__zoom svg{width:15px;height:15px}
.fps--js .fps__photo{clip-path:inset(0 0 100% 0 round 34px);transition:clip-path 1.3s cubic-bezier(.7,0,.2,1)}
.fps--js .fps__hero.is-in .fps__photo{clip-path:inset(0 0 0 0 round 34px)}

.fps__cat{display:inline-flex;align-items:center;gap:8px;padding:7px 14px;border-radius:50px;font-size:11.5px;font-weight:600;letter-spacing:.18em;text-transform:uppercase;
  color:var(--rose-2);background:rgba(224,122,133,.12);text-decoration:none;transition:background .3s,color .3s}
.fps__cat:hover{color:#fff;background:var(--rose-2);text-decoration:none}
.fps__cat svg{width:13px;height:13px}
.fps__name{font-family:'Playfair Display',serif;font-weight:800;font-size:clamp(34px,4.4vw,52px);line-height:1.05;letter-spacing:-.015em;margin:16px 0 14px}
.fps__price{display:flex;align-items:flex-start;gap:4px;font-family:'Playfair Display',serif;font-weight:800;line-height:1;color:var(--rose-2);margin-bottom:20px}
.fps__price small{font-family:'Poppins',sans-serif;font-size:16px;font-weight:600;margin-top:7px}
.fps__price b{font-size:46px}
.fps__price--ask{display:inline-block;margin-bottom:20px;padding:8px 16px;border-radius:50px;font-size:14px;font-weight:600;color:var(--choco-2);background:rgba(217,176,108,.2)}
.fps__desc{font-size:15.5px;line-height:1.8;color:var(--text);margin:0 0 26px;font-weight:300}

.fps__buy{display:flex;flex-wrap:wrap;align-items:stretch;gap:12px;margin-bottom:14px}
.fps__qty{display:flex;align-items:center;border-radius:16px;background:#fff;box-shadow:inset 0 0 0 1px var(--line)}
.fps__qty button{width:46px;height:54px;border:0;background:transparent;cursor:pointer;font-size:20px;color:var(--choco-2);transition:color .2s,transform .2s}
.fps__qty button:hover{color:var(--rose-2)}
.fps__qty button:active{transform:scale(.85)}
.fps__qty input{width:44px;height:54px;border:0;background:transparent;text-align:center;font-family:'Playfair Display',serif;font-size:20px;font-weight:700;color:var(--choco);-moz-appearance:textfield}
.fps__qty input::-webkit-outer-spin-button,.fps__qty input::-webkit-inner-spin-button{-webkit-appearance:none;margin:0}
.fps__wa{flex:1 1 220px;display:inline-flex;align-items:center;justify-content:center;gap:10px;padding:0 22px;min-height:54px;border-radius:16px;font-size:15px;font-weight:600;
  color:#fff;text-decoration:none;background:linear-gradient(135deg,var(--wa),var(--wa-2));box-shadow:0 16px 30px -14px rgba(18,140,74,.8);
  position:relative;overflow:hidden;transition:transform .35s cubic-bezier(.3,1.6,.5,1),box-shadow .35s}
.fps__wa:hover{color:#fff;text-decoration:none;transform:translateY(-3px);box-shadow:0 22px 38px -14px rgba(18,140,74,.9)}
.fps__wa::after{content:"";position:absolute;top:0;left:-70%;width:45%;height:100%;background:linear-gradient(115deg,transparent,rgba(255,255,255,.4),transparent);transform:skewX(-20deg);animation:fpsSweep 3.5s ease-in-out infinite}
@keyframes fpsSweep{0%,60%{left:-70%}100%{left:130%}}
.fps__wa svg{width:20px;height:20px}
.fps__add{display:inline-flex;align-items:center;justify-content:center;gap:8px;width:100%;min-height:52px;border:0;border-radius:16px;cursor:pointer;font-family:inherit;font-size:14.5px;font-weight:600;
  color:var(--choco);background:#fff;box-shadow:inset 0 0 0 1.5px var(--choco);transition:background .3s,color .3s,transform .35s cubic-bezier(.3,1.6,.5,1)}
.fps__add:hover{color:#fff;background:var(--choco);transform:translateY(-2px)}
.fps__add svg{width:18px;height:18px}
.fps__add.is-done{color:#fff;background:#3f8f5a;box-shadow:none}
.fps__total{margin:12px 0 0;font-size:13px;color:var(--muted)}
.fps__total b{color:var(--choco-2)}

.fps__perks{display:grid;grid-template-columns:repeat(3,1fr);gap:10px;margin-top:26px;padding-top:22px;border-top:1.5px dashed var(--line)}
.fps__perk{display:flex;flex-direction:column;align-items:center;gap:6px;text-align:center;font-size:12px;line-height:1.35;color:var(--text)}
.fps__perk span{width:42px;height:42px;border-radius:14px;display:grid;place-items:center;color:var(--rose-2);background:rgba(224,122,133,.12);transition:transform .5s cubic-bezier(.3,1.6,.5,1)}
.fps__perk:hover span{transform:rotate(-10deg) scale(1.08)}
.fps__perk svg{width:20px;height:20px}

/* Abas */
.fps__tabs{margin-bottom:80px;border-radius:28px;background:var(--paper);box-shadow:0 26px 50px -34px rgba(74,42,29,.5);overflow:hidden}
.fps__tablist{position:relative;display:flex;gap:4px;padding:10px;background:rgba(236,220,203,.35)}
.fps__tab{position:relative;z-index:1;flex:1;padding:13px 16px;border:0;border-radius:16px;background:transparent;cursor:pointer;font-family:inherit;font-size:14.5px;font-weight:600;color:var(--text);transition:color .3s}
.fps__tab.is-active{color:var(--choco)}
.fps__tab-ink{position:absolute;z-index:0;top:10px;bottom:10px;left:10px;border-radius:16px;background:#fff;box-shadow:0 10px 20px -12px rgba(74,42,29,.4);transition:transform .5s cubic-bezier(.3,1.3,.5,1),width .5s}
.fps__panel{padding:30px 34px 34px;font-size:15px;line-height:1.85;color:var(--text);animation:fpsFade .5s ease}
@keyframes fpsFade{from{opacity:0;transform:translateY(10px)}}
.fps__panel p{margin:0;white-space:pre-line}
.fps__how{list-style:none;margin:0;padding:0;display:grid;gap:14px;counter-reset:s}
.fps__how li{counter-increment:s;position:relative;padding-left:48px}
.fps__how li::before{content:counter(s);position:absolute;left:0;top:0;width:32px;height:32px;border-radius:50%;display:grid;place-items:center;font-family:'Playfair Display',serif;font-weight:700;
  color:#fff;background:linear-gradient(135deg,var(--rose),var(--rose-2))}
.fps__how b{display:block;color:var(--choco);font-weight:600}

/* Avaliações da loja */
.fps__reviews{display:grid;grid-template-columns:repeat(3,1fr);gap:16px}
.fps__review{padding:20px;border-radius:20px;background:#fff;box-shadow:inset 0 0 0 1px var(--line)}
.fps__stars{display:flex;gap:2px;margin-bottom:10px}
.fps__stars svg{width:16px;height:16px;fill:#e8dccf}
.fps__stars svg.on{fill:var(--star)}
.fps__review p{margin:0 0 12px;font-family:'Playfair Display',serif;font-style:italic;font-size:15px;line-height:1.6;color:var(--choco-2)}
.fps__review strong{font-size:13px;color:var(--choco)}
.fps__review small{display:block;font-size:11.5px;color:var(--muted)}
.fps__panel-note{margin:16px 0 0!important;font-size:12.5px;color:var(--muted)}

/* Relacionados */
.fps__related{display:grid;grid-template-columns:repeat(3,1fr);gap:22px}
.fps__card{display:flex;flex-direction:column;height:100%;border-radius:24px;overflow:hidden;background:var(--paper);text-decoration:none;color:inherit;
  box-shadow:0 26px 50px -34px rgba(74,42,29,.5);transition:transform .55s cubic-bezier(.3,1.4,.5,1),box-shadow .5s}
.fps__card:hover{transform:translateY(-8px);box-shadow:0 40px 70px -34px rgba(74,42,29,.62);text-decoration:none;color:inherit}
.fps__card .img{aspect-ratio:4/3;overflow:hidden;background:linear-gradient(135deg,#f3c6c9,#f3d9a4)}
.fps__card img{width:100%;height:100%;object-fit:cover;display:block;color:transparent;transition:transform 1s cubic-bezier(.2,.7,.2,1)}
.fps__card:hover img{transform:scale(1.1)}
.fps__card .bd{display:flex;flex-direction:column;flex:1;padding:16px 18px 18px}
.fps__card h3{font-family:'Playfair Display',serif;font-weight:700;font-size:19px;line-height:1.25;margin:0 0 6px;color:var(--choco)}
.fps__card p{font-size:13px;line-height:1.6;color:var(--text);margin:0 0 12px}
.fps__card .pr{margin-top:auto;display:flex;align-items:center;justify-content:space-between;font-family:'Playfair Display',serif;font-weight:800;font-size:20px;color:var(--rose-2)}
.fps__card .pr svg{width:18px;height:18px;color:var(--choco);transition:transform .4s}
.fps__card:hover .pr svg{transform:translateX(5px)}

/* Lateral */
.fps__side{position:sticky;top:100px;display:grid;gap:20px}
.fps__box{border-radius:24px;padding:22px;background:var(--paper);box-shadow:0 26px 50px -34px rgba(74,42,29,.5)}
.fps__box h3{display:flex;align-items:center;gap:10px;font-family:'Playfair Display',serif;font-weight:700;font-size:19px;margin:0 0 14px}
.fps__box h3 svg{width:20px;height:20px;color:var(--rose-2)}
.fps__search{position:relative}
.fps__search input{width:100%;height:50px;padding:0 52px 0 18px;border-radius:50px;border:1px solid var(--line);background:#fff;font-family:inherit;font-size:14px;color:var(--choco);outline:none;transition:border-color .3s,box-shadow .3s}
.fps__search input:focus{border-color:var(--rose);box-shadow:0 0 0 4px rgba(224,122,133,.15)}
.fps__search button{position:absolute;right:5px;top:5px;width:40px;height:40px;border:0;border-radius:50%;cursor:pointer;display:grid;place-items:center;color:#fff;background:var(--rose-2)}
.fps__search button svg{width:17px;height:17px}

.fps__bag{background:linear-gradient(170deg,var(--choco-2),var(--choco));color:#fff}
.fps__bag h3{color:#fff}
.fps__bag h3 svg{color:var(--gold-2)}
.fps__bag h3 .n{margin-left:auto;min-width:26px;height:26px;padding:0 8px;border-radius:20px;display:grid;place-items:center;font-family:'Poppins',sans-serif;font-size:12px;font-weight:600;color:var(--choco);background:var(--gold-2)}
.fps__bag h3 .n.pop{animation:fpsPop .5s cubic-bezier(.3,1.8,.5,1)}
@keyframes fpsPop{50%{transform:scale(1.4)}}
.fps__bag-empty{margin:0;font-size:13px;line-height:1.6;color:rgba(255,255,255,.6)}
.fps__items{list-style:none;margin:0;padding:0;max-height:240px;overflow-y:auto;scrollbar-width:thin;scrollbar-color:rgba(255,255,255,.2) transparent}
.fps__items li{display:flex;align-items:center;gap:8px;padding:9px 0;border-bottom:1px solid rgba(255,255,255,.08);font-size:13px}
.fps__items .nm{flex:1;min-width:0;line-height:1.35}
.fps__items .nm small{display:block;font-size:11.5px;color:var(--gold-2)}
.fps__items .q{display:flex;align-items:center;border-radius:20px;background:rgba(255,255,255,.08)}
.fps__items .q button{width:26px;height:26px;border:0;border-radius:50%;background:transparent;color:#fff;cursor:pointer;font-size:15px}
.fps__items .q button:hover{background:rgba(255,255,255,.15)}
.fps__items .q span{min-width:18px;text-align:center;font-weight:600}
.fps__bag-total{display:flex;justify-content:space-between;align-items:baseline;margin:14px 0 12px;font-size:13px;color:rgba(255,255,255,.7)}
.fps__bag-total b{font-family:'Playfair Display',serif;font-size:22px;color:var(--gold-2)}
.fps__send{display:flex;align-items:center;justify-content:center;gap:8px;width:100%;padding:13px;border:0;border-radius:14px;cursor:pointer;font-family:inherit;font-size:14px;font-weight:600;
  color:#fff;background:linear-gradient(135deg,var(--wa),var(--wa-2));transition:transform .35s cubic-bezier(.3,1.6,.5,1)}
.fps__send:hover{transform:translateY(-2px)}
.fps__send svg{width:18px;height:18px}
.fps__clear{display:block;width:100%;margin-top:6px;padding:6px;border:0;background:transparent;cursor:pointer;font-family:inherit;font-size:12px;color:rgba(255,255,255,.5)}
.fps__clear:hover{color:#fff}

.fps__cats{display:flex;flex-wrap:wrap;gap:8px;list-style:none;margin:0;padding:0}
.fps__cats a{display:inline-block;padding:8px 14px;border-radius:50px;font-size:13px;font-weight:500;color:var(--choco-2);text-decoration:none;background:#fff;box-shadow:inset 0 0 0 1px var(--line);
  transition:background .3s,color .3s,transform .35s cubic-bezier(.3,1.6,.5,1),box-shadow .3s}
.fps__cats a:hover,.fps__cats a.is-cur{color:#fff;background:var(--rose-2);box-shadow:none;text-decoration:none}
.fps__cats a:hover{transform:translateY(-2px)}

/* Lightbox */
.fps__lb{position:fixed;inset:0;z-index:9999;display:grid;place-items:center;padding:30px;background:rgba(42,23,16,.9);-webkit-backdrop-filter:blur(6px);backdrop-filter:blur(6px);
  opacity:0;visibility:hidden;transition:opacity .4s,visibility 0s .4s;cursor:zoom-out}
.fps__lb.is-open{opacity:1;visibility:visible;transition:opacity .4s}
.fps__lb img{max-width:min(92vw,1000px);max-height:86vh;border-radius:20px;box-shadow:0 40px 80px rgba(0,0,0,.5);transform:scale(.9);transition:transform .5s cubic-bezier(.3,1.4,.5,1)}
.fps__lb.is-open img{transform:none}
.fps__lb button{position:absolute;top:20px;right:20px;width:48px;height:48px;border:0;border-radius:50%;cursor:pointer;color:#fff;background:rgba(255,255,255,.12);font-size:22px}

/* Barra fixa no celular */
.fps__mbar{display:none}

/* Revelar */
.fps--js [data-reveal]{opacity:0;transform:translateY(40px);transition:opacity .9s cubic-bezier(.2,.7,.2,1) var(--d,0s),transform .9s cubic-bezier(.2,.7,.2,1) var(--d,0s)}
.fps--js [data-reveal].is-in{opacity:1;transform:none}

@media (max-width:1199px){.fps__hero{gap:30px}.fps__reviews{grid-template-columns:1fr 1fr}}
@media (max-width:991px){
  .fps__wrap{grid-template-columns:minmax(0,1fr)}
  .fps__tab{padding:12px 8px;font-size:13px}
  .fps__side{position:relative;top:0}
  .fps__mbar{position:fixed;z-index:60;left:12px;right:12px;bottom:12px;display:flex;align-items:center;gap:12px;padding:10px 10px 10px 18px;border-radius:20px;background:var(--choco);color:#fff;
    box-shadow:0 20px 40px -14px rgba(42,23,16,.7);transform:translateY(140%);transition:transform .5s cubic-bezier(.3,1.4,.5,1)}
  .fps__mbar.is-on{transform:none}
  .fps__mbar .t{flex:1;min-width:0;font-size:13px;line-height:1.3;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
  .fps__mbar .t b{display:block;font-family:'Playfair Display',serif;font-size:18px;color:var(--gold-2)}
  .fps__mbar a{display:inline-flex;align-items:center;gap:6px;padding:12px 16px;border-radius:14px;font-size:13.5px;font-weight:600;color:#fff;background:var(--wa-2);text-decoration:none}
  .fps__mbar a svg{width:18px;height:18px}
}
@media (max-width:760px){
  .fps__hero{grid-template-columns:1fr}
  .fps__related{grid-template-columns:1fr 1fr}
  .fps__reviews{grid-template-columns:1fr}
  .fps__panel{padding:24px 20px}
}
@media (max-width:480px){
  .fps__wrap{padding:0 16px}
  .fps__related{gap:14px}
  .fps__card h3{font-size:16px}
  .fps__card p{display:none}
  .fps__perk{font-size:11px}
}
@media (hover:none){.fps__photo:hover img{transform:none}.fps__zoom{display:none}}
@media (prefers-reduced-motion:reduce){
  .fps *,.fps *::before,.fps *::after{animation:none!important;transition:none!important}
  .fps--js [data-reveal]{opacity:1;transform:none}
  .fps--js .fps__photo{clip-path:none}
}
</style>

<!--Sidebar Page Container-->
<div class="fps" id="fps" data-whats="{{ $numeroWhats }}" data-id="{{ $produto->slug_produto }}" data-name="{{ $produto->nome_produto }}" data-price="{{ $valorProduto }}">
    <div class="fps__glow" aria-hidden="true"><i></i><i></i></div>

    <div class="fps__wrap">
        <div class="fps__main">

            {{-- Produto --}}
            <div class="fps__hero" data-watch>
                <div class="fps__photo" role="button" tabindex="0" aria-label="Ampliar foto de {{ $produto->nome_produto }}">
                    <img src="{{ $fotoProduto }}" alt="{{ $produto->nome_produto }}">
                    <span class="fps__zoom"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="M20 20l-3.5-3.5M11 8v6M8 11h6"/></svg>Passe o mouse para ampliar</span>
                </div>

                <div class="fps__info">
                    @if ($categoriaNome)
                        <a href="{{ route('cardapio.categoria', $produto->id_categoria) }}" class="fps__cat" data-reveal>
                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l2.4 7.6L22 12l-7.6 2.4L12 22l-2.4-7.6L2 12l7.6-2.4z"/></svg>{{ $categoriaNome }}
                        </a>
                    @endif
                    <h1 class="fps__name" data-reveal style="--d:.08s">{{ $produto->nome_produto }}</h1>

                    @if ($valorProduto > 0)
                        <div class="fps__price" data-reveal style="--d:.14s"><small>R$</small><b>{{ number_format($valorProduto, 2, ',', '.') }}</b></div>
                    @else
                        <span class="fps__price--ask" data-reveal style="--d:.14s">Preço sob consulta</span>
                    @endif

                    @if ($produto->descricao_produto)
                        <p class="fps__desc" data-reveal style="--d:.2s">{{ \Illuminate\Support\Str::limit($produto->descricao_produto, 220) }}</p>
                    @endif

                    <div data-reveal style="--d:.26s">
                        <div class="fps__buy">
                            <div class="fps__qty">
                                <button type="button" data-q="-1" aria-label="Diminuir quantidade">−</button>
                                <input type="number" min="1" max="99" value="1" aria-label="Quantidade" class="fps__qtyin">
                                <button type="button" data-q="1" aria-label="Aumentar quantidade">+</button>
                            </div>
                            @if ($numeroWhats)
                                <a href="#" target="_blank" rel="noopener" class="fps__wa">
                                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.5 14.4c-.3-.1-1.8-.9-2-1-.3-.1-.5-.1-.7.1-.2.3-.8 1-.9 1.2-.2.2-.3.2-.6.1-.3-.1-1.3-.5-2.4-1.5-.9-.8-1.5-1.8-1.7-2.1-.2-.3 0-.5.1-.6l.4-.5c.2-.2.2-.3.3-.5.1-.2 0-.4 0-.5l-.9-2.2c-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.5s1.1 2.9 1.2 3.1c.1.2 2.1 3.2 5.1 4.5.7.3 1.3.5 1.7.6.7.2 1.4.2 1.9.1.6-.1 1.8-.7 2-1.4.3-.7.3-1.3.2-1.4-.1-.2-.3-.3-.6-.4zM12 21.8c-1.8 0-3.5-.5-5-1.4l-.4-.2-3.7 1 1-3.6-.2-.4c-1-1.6-1.5-3.4-1.5-5.2C2.2 6.6 6.6 2.2 12 2.2c2.6 0 5.1 1 6.9 2.9 1.9 1.9 2.9 4.3 2.9 6.9 0 5.4-4.4 9.8-9.8 9.8zm8.4-18.2C18.2 1.3 15.2 0 12 0 5.4 0 0 5.4 0 12c0 2.1.6 4.2 1.6 6L0 24l6.2-1.6c1.8 1 3.8 1.5 5.8 1.5 6.6 0 12-5.4 12-12 0-3.2-1.2-6.2-3.6-8.3z"/></svg>
                                    Pedir pelo WhatsApp
                                </a>
                            @endif
                        </div>
                        <button type="button" class="fps__add">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                            <span>Adicionar à sacola</span>
                        </button>
                        @if ($valorProduto > 0)
                            <p class="fps__total">Total para <b class="fps__qn">1 unidade</b>: <b class="fps__qt">R$ {{ number_format($valorProduto, 2, ',', '.') }}</b></p>
                        @endif
                    </div>

                    <div class="fps__perks" data-reveal style="--d:.32s">
                        <div class="fps__perk"><span><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 21s-8-5-8-11a4.5 4.5 0 0 1 8-2.8A4.5 4.5 0 0 1 20 10c0 6-8 11-8 11z"/></svg></span>Feito à mão</div>
                        <div class="fps__perk"><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.5 19 2c1 2 2 4.2 2 8 0 5.5-4.8 10-10 10Z"/><path d="M2 21c0-3 1.9-5.4 5.1-6"/></svg></span>Ingredientes selecionados</div>
                        <div class="fps__perk"><span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/><path d="M8 10l2.5 2.5L16 7"/></svg></span>Confirmação pelo WhatsApp</div>
                    </div>
                </div>
            </div>

            {{-- Abas --}}
            <div class="fps__tabs" data-reveal>
                <div class="fps__tablist" role="tablist">
                    <span class="fps__tab-ink" aria-hidden="true"></span>
                    <button type="button" class="fps__tab is-active" role="tab" aria-selected="true" data-tab="desc">Descrição</button>
                    <button type="button" class="fps__tab" role="tab" aria-selected="false" data-tab="como">Como encomendar</button>
                    @if ($depoimentosLoja->count())
                        <button type="button" class="fps__tab" role="tab" aria-selected="false" data-tab="aval">Avaliações</button>
                    @endif
                </div>

                <div class="fps__panel" data-panel="desc" role="tabpanel">
                    <p>{{ $produto->descricao_produto ?: 'Em breve mais detalhes sobre este produto. Fale com a gente pelo WhatsApp para saber mais!' }}</p>
                </div>

                <div class="fps__panel" data-panel="como" role="tabpanel" hidden>
                    <ol class="fps__how">
                        <li><b>Escolha a quantidade</b>Use os botões + e − ao lado do preço.</li>
                        <li><b>Envie pelo WhatsApp</b>Toque em “Pedir pelo WhatsApp” ou adicione à sacola para pedir vários doces de uma vez.</li>
                        <li><b>Confirmamos com você</b>Respondemos com a disponibilidade, a forma de pagamento e as opções de retirada ou entrega.</li>
                    </ol>
                </div>

                @if ($depoimentosLoja->count())
                    <div class="fps__panel" data-panel="aval" role="tabpanel" hidden>
                        <div class="fps__reviews">
                            @foreach ($depoimentosLoja as $depoimento)
                                @php
                                    $partesNome = preg_split('/\s+/', trim($depoimento->cliente->nome_cliente ?? 'Cliente'));
                                    $nomeCurto = $partesNome[0] . (count($partesNome) > 1 ? ' ' . mb_substr(end($partesNome), 0, 1) . '.' : '');
                                    $nota = max(1, min(5, (int) $depoimento->nota_depoimento));
                                @endphp
                                <div class="fps__review">
                                    <div class="fps__stars" aria-label="{{ $nota }} de 5 estrelas">
                                        @for ($s = 1; $s <= 5; $s++)
                                            <svg viewBox="0 0 24 24" class="{{ $s <= $nota ? 'on' : '' }}"><path d="M12 2l2.9 6.3 6.9.7-5.2 4.6 1.5 6.8L12 17l-6.1 3.4 1.5-6.8L2.2 9l6.9-.7z"/></svg>
                                        @endfor
                                    </div>
                                    <p>“{{ \Illuminate\Support\Str::limit($depoimento->texto_depoimento, 160) }}”</p>
                                    <strong>{{ $nomeCurto }}</strong>
                                    <small>Cliente · App The Gusta</small>
                                </div>
                            @endforeach
                        </div>
                        <p class="fps__panel-note">Avaliações da nossa confeitaria enviadas pelos clientes no app.</p>
                    </div>
                @endif
            </div>

            {{-- Relacionados --}}
            @if (isset($produtosRelacionados) && $produtosRelacionados->count())
                <h2 class="fps__h2" data-reveal>Você também vai <em>amar</em></h2>
                <div class="fps__related">
                    @foreach ($produtosRelacionados as $relacionado)
                        <div data-reveal style="--d:{{ ($loop->index % 3) * 0.1 }}s">
                            <a href="{{ route('cardapio.produto', $relacionado->slug_produto) }}" class="fps__card">
                                <div class="img"><img src="{{ asset('davilla/images/' . $relacionado->foto_produto) }}" alt="{{ $relacionado->nome_produto }}" loading="lazy"></div>
                                <div class="bd">
                                    <h3>{{ $relacionado->nome_produto }}</h3>
                                    @if ($relacionado->descricao_produto)
                                        <p>{{ \Illuminate\Support\Str::limit($relacionado->descricao_produto, 80) }}</p>
                                    @endif
                                    <span class="pr">
                                        {{ (float) $relacionado->valor_produto > 0 ? 'R$ ' . number_format($relacionado->valor_produto, 2, ',', '.') : 'Sob consulta' }}
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                                    </span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Lateral --}}
        <aside class="fps__side">
            <div class="fps__box" data-reveal>
                <h3><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="M20 20l-3.5-3.5"/></svg>Buscar doces</h3>
                <form method="get" action="{{ route('cardapio.index') }}" class="fps__search" role="search">
                    <input type="search" name="busca" placeholder="Ex.: brigadeiro, torta..." required aria-label="Buscar no cardápio">
                    <button type="submit" aria-label="Buscar"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="M20 20l-3.5-3.5"/></svg></button>
                </form>
            </div>

            <div class="fps__box fps__bag" data-reveal style="--d:.1s">
                <h3><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>Sua sacola <span class="n">0</span></h3>
                <p class="fps__bag-empty">Sua sacola está vazia. Adicione este doce e outros do cardápio para pedir tudo de uma vez.</p>
                <div class="fps__bag-full" hidden>
                    <ul class="fps__items"></ul>
                    <div class="fps__bag-total"><span>Total estimado</span><b class="fps__sum">R$ 0,00</b></div>
                    <button type="button" class="fps__send">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.5 14.4c-.3-.1-1.8-.9-2-1-.3-.1-.5-.1-.7.1-.2.3-.8 1-.9 1.2-.2.2-.3.2-.6.1-.3-.1-1.3-.5-2.4-1.5-.9-.8-1.5-1.8-1.7-2.1-.2-.3 0-.5.1-.6l.4-.5c.2-.2.2-.3.3-.5.1-.2 0-.4 0-.5l-.9-2.2c-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.5s1.1 2.9 1.2 3.1c.1.2 2.1 3.2 5.1 4.5.7.3 1.3.5 1.7.6.7.2 1.4.2 1.9.1.6-.1 1.8-.7 2-1.4.3-.7.3-1.3.2-1.4-.1-.2-.3-.3-.6-.4zM12 21.8c-1.8 0-3.5-.5-5-1.4l-.4-.2-3.7 1 1-3.6-.2-.4c-1-1.6-1.5-3.4-1.5-5.2C2.2 6.6 6.6 2.2 12 2.2c2.6 0 5.1 1 6.9 2.9 1.9 1.9 2.9 4.3 2.9 6.9 0 5.4-4.4 9.8-9.8 9.8zm8.4-18.2C18.2 1.3 15.2 0 12 0 5.4 0 0 5.4 0 12c0 2.1.6 4.2 1.6 6L0 24l6.2-1.6c1.8 1 3.8 1.5 5.8 1.5 6.6 0 12-5.4 12-12 0-3.2-1.2-6.2-3.6-8.3z"/></svg>
                        Enviar sacola pelo WhatsApp
                    </button>
                    <button type="button" class="fps__clear">Esvaziar sacola</button>
                </div>
            </div>

            <div class="fps__box" data-reveal style="--d:.2s">
                <h3><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20.6 13.4 13.4 20.6a2 2 0 0 1-2.8 0L3 13V3h10l7.6 7.6a2 2 0 0 1 0 2.8z"/><circle cx="7.5" cy="7.5" r="1.5"/></svg>Categorias</h3>
                <ul class="fps__cats">
                    @foreach ($filtroCategoria as $categoria)
                        <li><a href="{{ route('cardapio.categoria', $categoria->id_categoria) }}" class="{{ $categoria->id_categoria == $produto->id_categoria ? 'is-cur' : '' }}">{{ $categoria->nome_categoria }}</a></li>
                    @endforeach
                </ul>
            </div>
        </aside>
    </div>

    {{-- Barra fixa no celular --}}
    @if ($numeroWhats)
        <div class="fps__mbar">
            <span class="t">{{ $produto->nome_produto }}<b>{{ $valorProduto > 0 ? 'R$ ' . number_format($valorProduto, 2, ',', '.') : 'Sob consulta' }}</b></span>
            <a href="#" target="_blank" rel="noopener" class="fps__mwa">
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.5 14.4c-.3-.1-1.8-.9-2-1-.3-.1-.5-.1-.7.1-.2.3-.8 1-.9 1.2-.2.2-.3.2-.6.1-.3-.1-1.3-.5-2.4-1.5-.9-.8-1.5-1.8-1.7-2.1-.2-.3 0-.5.1-.6l.4-.5c.2-.2.2-.3.3-.5.1-.2 0-.4 0-.5l-.9-2.2c-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.5s1.1 2.9 1.2 3.1c.1.2 2.1 3.2 5.1 4.5.7.3 1.3.5 1.7.6.7.2 1.4.2 1.9.1.6-.1 1.8-.7 2-1.4.3-.7.3-1.3.2-1.4-.1-.2-.3-.3-.6-.4zM12 21.8c-1.8 0-3.5-.5-5-1.4l-.4-.2-3.7 1 1-3.6-.2-.4c-1-1.6-1.5-3.4-1.5-5.2C2.2 6.6 6.6 2.2 12 2.2c2.6 0 5.1 1 6.9 2.9 1.9 1.9 2.9 4.3 2.9 6.9 0 5.4-4.4 9.8-9.8 9.8zm8.4-18.2C18.2 1.3 15.2 0 12 0 5.4 0 0 5.4 0 12c0 2.1.6 4.2 1.6 6L0 24l6.2-1.6c1.8 1 3.8 1.5 5.8 1.5 6.6 0 12-5.4 12-12 0-3.2-1.2-6.2-3.6-8.3z"/></svg>
                Pedir
            </a>
        </div>
    @endif

    {{-- Foto ampliada --}}
    <div class="fps__lb" aria-hidden="true">
        <img src="{{ $fotoProduto }}" alt="{{ $produto->nome_produto }}">
        <button type="button" aria-label="Fechar">×</button>
    </div>
</div>
<!--End Sidebar Page Container-->

<script>
(function () {
    var root = document.getElementById('fps');
    if (!root) return;
    root.classList.add('fps--js');
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var fmt = new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' });
    var P = { id: root.dataset.id, n: root.dataset.name, p: parseFloat(root.dataset.price) || 0 };
    var whats = root.dataset.whats;

    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('is-in'); io.unobserve(e.target); } });
    }, { threshold: 0.12 });
    root.querySelectorAll('[data-reveal], [data-watch]').forEach(function (el) { io.observe(el); });

    // Zoom seguindo o mouse + foto ampliada
    var photo = root.querySelector('.fps__photo'), img = photo.querySelector('img'), lb = root.querySelector('.fps__lb');
    photo.addEventListener('mousemove', function (e) {
        var r = photo.getBoundingClientRect();
        img.style.setProperty('--ox', ((e.clientX - r.left) / r.width * 100) + '%');
        img.style.setProperty('--oy', ((e.clientY - r.top) / r.height * 100) + '%');
    });
    function openLb() { lb.classList.add('is-open'); lb.setAttribute('aria-hidden', 'false'); document.documentElement.style.overflow = 'hidden'; }
    function closeLb() { lb.classList.remove('is-open'); lb.setAttribute('aria-hidden', 'true'); document.documentElement.style.overflow = ''; }
    photo.addEventListener('click', openLb);
    photo.addEventListener('keydown', function (e) { if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); openLb(); } });
    lb.addEventListener('click', closeLb);
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeLb(); });

    // Quantidade e link do WhatsApp
    var qin = root.querySelector('.fps__qtyin'), wa = root.querySelector('.fps__wa'), mwa = root.querySelector('.fps__mwa');
    var qn = root.querySelector('.fps__qn'), qt = root.querySelector('.fps__qt');
    function qty() { var v = parseInt(qin.value, 10); v = isNaN(v) ? 1 : Math.max(1, Math.min(99, v)); return v; }
    function linkUnico() {
        var q = qty();
        var msg = 'Olá! Quero pedir: ' + q + 'x ' + P.n + (P.p > 0 ? ' (' + fmt.format(P.p * q) + ')' : '') + '.';
        return 'https://wa.me/' + whats + '?text=' + encodeURIComponent(msg);
    }
    function updQty() {
        var q = qty();
        if (qn) qn.textContent = q + (q === 1 ? ' unidade' : ' unidades');
        if (qt) qt.textContent = fmt.format(P.p * q);
        if (wa) wa.href = linkUnico();
        if (mwa) mwa.href = linkUnico();
    }
    root.querySelectorAll('[data-q]').forEach(function (b) {
        b.addEventListener('click', function () { qin.value = Math.max(1, Math.min(99, qty() + (+b.dataset.q))); updQty(); });
    });
    qin.addEventListener('input', updQty);
    qin.addEventListener('blur', function () { qin.value = qty(); updQty(); });
    updQty();

    // Barra fixa no celular aparece quando o botão principal sai da tela
    var mbar = root.querySelector('.fps__mbar');
    if (mbar && wa) new IntersectionObserver(function (es) { mbar.classList.toggle('is-on', !es[0].isIntersecting && es[0].boundingClientRect.top < 0); }).observe(wa);

    // Abas
    var tabs = root.querySelectorAll('.fps__tab'), ink = root.querySelector('.fps__tab-ink');
    function moveInk(t) { ink.style.width = t.offsetWidth + 'px'; ink.style.transform = 'translateX(' + (t.offsetLeft - 10) + 'px)'; }
    tabs.forEach(function (t) {
        t.addEventListener('click', function () {
            tabs.forEach(function (x) { x.classList.toggle('is-active', x === t); x.setAttribute('aria-selected', x === t ? 'true' : 'false'); });
            root.querySelectorAll('.fps__panel').forEach(function (p) { p.hidden = p.dataset.panel !== t.dataset.tab; });
            moveInk(t);
        });
    });
    if (tabs.length) { moveInk(tabs[0]); window.addEventListener('resize', function () { moveInk(root.querySelector('.fps__tab.is-active')); }); }

    // Sacola (a mesma da página de pedidos)
    var KEY = 'sacola-pedido', bag = {};
    try { bag = JSON.parse(localStorage.getItem(KEY) || '{}') || {}; } catch (e) { bag = {}; }
    var list = root.querySelector('.fps__items'), empty = root.querySelector('.fps__bag-empty'), full = root.querySelector('.fps__bag-full');
    var n = root.querySelector('.fps__bag .n'), sum = root.querySelector('.fps__sum'), addBtn = root.querySelector('.fps__add');
    function save() { try { localStorage.setItem(KEY, JSON.stringify(bag)); } catch (e) {} }
    function esc(s) { var d = document.createElement('div'); d.textContent = s; return d.innerHTML; }
    function render(pop) {
        var ids = Object.keys(bag), total = 0, q = 0, ask = false;
        list.innerHTML = '';
        ids.forEach(function (id) {
            var it = bag[id]; q += it.q; if (it.p > 0) total += it.p * it.q; else ask = true;
            var li = document.createElement('li');
            li.innerHTML = '<span class="nm">' + esc(it.n) + '<small>' + (it.p > 0 ? fmt.format(it.p * it.q) : 'Sob consulta') + '</small></span>' +
                '<span class="q"><button type="button" data-a="-1" aria-label="Diminuir">−</button><span>' + it.q + '</span><button type="button" data-a="1" aria-label="Aumentar">+</button></span>';
            li.querySelectorAll('button').forEach(function (b) {
                b.addEventListener('click', function () { bag[id].q += +b.dataset.a; if (bag[id].q <= 0) delete bag[id]; render(true); });
            });
            list.appendChild(li);
        });
        empty.hidden = ids.length > 0; full.hidden = ids.length === 0;
        n.textContent = q;
        if (pop && !reduce) { n.classList.remove('pop'); void n.offsetWidth; n.classList.add('pop'); }
        sum.textContent = fmt.format(total) + (ask ? ' +' : '');
        save();
    }
    addBtn.addEventListener('click', function () {
        var q = qty();
        if (!bag[P.id]) bag[P.id] = { n: P.n, p: P.p, q: 0 };
        bag[P.id].q += q;
        render(true);
        var label = addBtn.querySelector('span');
        addBtn.classList.add('is-done'); label.textContent = 'Adicionado à sacola!';
        setTimeout(function () { addBtn.classList.remove('is-done'); label.textContent = 'Adicionar à sacola'; }, 1800);
    });
    root.querySelector('.fps__clear').addEventListener('click', function () { bag = {}; render(); });
    root.querySelector('.fps__send').addEventListener('click', function () {
        var ids = Object.keys(bag); if (!ids.length) return;
        var total = 0, linhas = ids.map(function (id) {
            var it = bag[id]; if (it.p > 0) total += it.p * it.q;
            return '• ' + it.q + 'x ' + it.n + (it.p > 0 ? ' — ' + fmt.format(it.p * it.q) : ' — sob consulta');
        });
        var msg = 'Olá! Gostaria de fazer este pedido:\n\n' + linhas.join('\n') + '\n\nTotal estimado: ' + fmt.format(total) + '\n\nPode confirmar a disponibilidade?';
        window.open('https://wa.me/' + whats + '?text=' + encodeURIComponent(msg), '_blank', 'noopener');
    });
    render();
})();
</script>