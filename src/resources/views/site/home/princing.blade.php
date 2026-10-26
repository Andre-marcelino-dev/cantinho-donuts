<!-- Pricing Section (redesign animado) -->
@if ($kitis->count() > 0)
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,500;1,600&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
.fsk{--cream:#fdf6ee;--paper:#fffaf4;--choco:#2a1710;--choco-2:#4a2a1d;--rose:#e07a85;--rose-2:#b94e5c;--gold:#d9b06c;--gold-2:#f3d9a4;--text:#6e5a50;--muted:#a08d7d;--line:#ecdccb;--wa:#25d366;--wa-2:#128c4a;
  position:relative;padding:120px 0 130px;background:linear-gradient(180deg,#f7ece1,var(--cream));font-family:'Poppins',sans-serif;color:var(--choco);overflow:hidden;isolation:isolate}
.fsk *{box-sizing:border-box}
.fsk__blob{position:absolute;border-radius:50%;filter:blur(90px);z-index:-1;animation:fskBlob 20s ease-in-out infinite}
.fsk__blob--1{width:460px;height:460px;background:rgba(224,122,133,.22);top:-140px;left:20%}
.fsk__blob--2{width:380px;height:380px;background:rgba(217,176,108,.25);bottom:-120px;right:-100px;animation-delay:-9s}
@keyframes fskBlob{50%{transform:translate(-50px,40px) scale(1.12)}}

/* Cabeçalho */
.fsk__head{text-align:center;max-width:700px;margin:0 auto 70px;padding:0 16px}
.fsk__eyebrow{display:inline-flex;align-items:center;gap:10px;padding:8px 18px;border-radius:50px;background:#fff;box-shadow:0 10px 30px -15px rgba(185,78,92,.45);
  font-size:12px;font-weight:600;letter-spacing:.24em;text-transform:uppercase;color:var(--rose-2)}
.fsk__eyebrow svg{width:16px;height:16px;animation:fskTilt 3s ease-in-out infinite}
@keyframes fskTilt{0%,100%{transform:rotate(-12deg)}50%{transform:rotate(12deg)}}
.fsk__title{font-family:'Playfair Display',serif;font-weight:800;font-size:clamp(38px,5.4vw,62px);line-height:1.06;letter-spacing:-.02em;margin:22px 0 16px}
.fsk__title em{font-style:italic;font-weight:600;background:linear-gradient(90deg,var(--rose-2),var(--rose),var(--gold),var(--rose-2));background-size:300% 100%;
  -webkit-background-clip:text;background-clip:text;color:transparent;animation:fskShine 6s linear infinite}
@keyframes fskShine{to{background-position:300% 0}}
.fsk__sub{font-size:17px;line-height:1.7;color:var(--text);margin:0;font-weight:300}

/* Grade */
.fsk__grid{max-width:1320px;margin:0 auto;padding:0 20px;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(100%,280px),1fr));gap:30px;align-items:start}
.fsk__grid--few{max-width:1000px}

/* Card */
.fsk__card{position:relative;display:flex;flex-direction:column;background:var(--paper);border-radius:30px;padding:16px 16px 26px;
  box-shadow:0 30px 60px -34px rgba(74,42,29,.5);border:1px solid rgba(255,255,255,.8);
  transition:transform .55s cubic-bezier(.3,1.4,.5,1),box-shadow .5s}
.fsk__card:hover{transform:translateY(-12px);box-shadow:0 46px 80px -34px rgba(74,42,29,.62)}
.fsk__card--hot{background:linear-gradient(170deg,var(--choco-2),var(--choco));color:#fff;box-shadow:0 40px 80px -30px rgba(42,23,16,.75)}
.fsk__card--hot::before{content:"";position:absolute;inset:-2px;border-radius:32px;z-index:-1;padding:2px;
  background:conic-gradient(from var(--ang,0deg),var(--rose),var(--gold),var(--rose-2),var(--gold-2),var(--rose));animation:fskAng 5s linear infinite;
  -webkit-mask:linear-gradient(#000 0 0) content-box,linear-gradient(#000 0 0);-webkit-mask-composite:xor;mask-composite:exclude}
@property --ang{syntax:'<angle>';initial-value:0deg;inherits:false}
@keyframes fskAng{to{--ang:360deg}}

/* Foto */
.fsk__media{position:relative;aspect-ratio:5/4;border-radius:22px 22px 120px 120px/22px 22px 40px 40px;overflow:hidden;background:linear-gradient(135deg,#f3c6c9,#f3d9a4)}
.fsk__media img{width:100%;height:100%;object-fit:cover;display:block;color:transparent;transform:scale(1.03);transition:transform 1.1s cubic-bezier(.2,.7,.2,1)}
.fsk__card:hover .fsk__media img{transform:scale(1.14) rotate(1deg)}
.fsk__media::after{content:"";position:absolute;inset:0;background:linear-gradient(180deg,transparent 55%,rgba(42,23,16,.35));pointer-events:none}

/* Selo de destaque */
.fsk__badge{position:absolute;z-index:3;top:14px;left:14px;display:inline-flex;align-items:center;gap:7px;padding:7px 14px 7px 10px;border-radius:50px;
  font-size:11px;font-weight:600;letter-spacing:.12em;text-transform:uppercase;color:#fff;background:var(--bc,var(--rose-2));box-shadow:0 10px 20px -8px var(--bc,var(--rose-2))}
.fsk__badge svg{width:15px;height:15px}
.fsk__badge--mais-vendido{--bc:#c2556a}
.fsk__badge--promocao{--bc:#d9623a}
.fsk__badge--novidade{--bc:#3f8f5a}
.fsk__badge--mais-vendido svg{animation:fskSpin 6s linear infinite}
.fsk__badge--promocao svg{animation:fskFlame 1.2s ease-in-out infinite;transform-origin:50% 100%}
.fsk__badge--novidade svg{animation:fskPop 2s ease-in-out infinite}
@keyframes fskSpin{to{transform:rotate(360deg)}}
@keyframes fskFlame{0%,100%{transform:scale(1) rotate(-6deg)}50%{transform:scale(1.2,1.05) rotate(6deg)}}
@keyframes fskPop{0%,100%{transform:scale(1)}50%{transform:scale(1.3)}}

/* Selo de desconto */
.fsk__off{position:absolute;z-index:3;top:10px;right:10px;width:74px;height:74px;display:grid;place-items:center;text-align:center;color:#fff}
.fsk__off svg{position:absolute;inset:0;width:100%;height:100%;fill:var(--rose-2);animation:fskSpin 14s linear infinite;filter:drop-shadow(0 8px 12px rgba(185,78,92,.45))}
.fsk__off b{position:relative;display:block;font-family:'Playfair Display',serif;font-size:19px;font-weight:800;line-height:1}
.fsk__off small{position:relative;display:block;font-size:9px;letter-spacing:.14em;text-transform:uppercase;font-weight:600;margin-top:2px}
.fsk__card--hot .fsk__off svg{fill:var(--gold)}

/* Corpo */
.fsk__body{display:flex;flex-direction:column;flex:1;padding:22px 12px 0;text-align:center}
.fsk__count{align-self:center;display:inline-flex;align-items:center;gap:6px;font-size:11.5px;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:var(--rose-2);margin-bottom:10px}
.fsk__count svg{width:15px;height:15px}
.fsk__card--hot .fsk__count{color:var(--gold-2)}
.fsk__name{font-family:'Playfair Display',serif;font-weight:700;font-size:26px;line-height:1.2;margin:0 0 10px;color:var(--choco)}
.fsk__card--hot .fsk__name{color:#fff}
.fsk__desc{font-size:14px;line-height:1.65;color:var(--text);margin:0 0 18px}
.fsk__card--hot .fsk__desc{color:rgba(255,255,255,.72)}

/* Itens do kit */
.fsk__items{margin:0 0 20px;text-align:left}
.fsk__toggle{width:100%;display:flex;align-items:center;gap:12px;padding:10px 14px;border-radius:16px;border:1px dashed var(--line);background:transparent;cursor:pointer;font-family:inherit;color:inherit;
  transition:background .3s,border-color .3s}
.fsk__toggle:hover{background:rgba(224,122,133,.06);border-color:rgba(224,122,133,.4)}
.fsk__card--hot .fsk__toggle{border-color:rgba(255,255,255,.2)}
.fsk__card--hot .fsk__toggle:hover{background:rgba(255,255,255,.06)}
.fsk__avatars{display:flex;flex:none}
.fsk__avatars img,.fsk__avatars span{width:34px;height:34px;border-radius:50%;object-fit:cover;border:2px solid var(--paper);margin-left:-10px;background:#f3d9a4;color:transparent;
  transition:transform .4s cubic-bezier(.3,1.6,.5,1)}
.fsk__avatars>*:first-child{margin-left:0}
.fsk__card--hot .fsk__avatars img,.fsk__card--hot .fsk__avatars span{border-color:var(--choco-2)}
.fsk__avatars span{display:grid;place-items:center;font-size:11px;font-weight:600;color:var(--rose-2);background:#fff}
.fsk__toggle:hover .fsk__avatars>*{transform:translateY(-3px)}
.fsk__toggle:hover .fsk__avatars>*:nth-child(2){transition-delay:.05s}
.fsk__toggle:hover .fsk__avatars>*:nth-child(3){transition-delay:.1s}
.fsk__toggle-txt{flex:1;font-size:13px;font-weight:500;text-align:left;white-space:nowrap;min-width:0;overflow:hidden;text-overflow:ellipsis}
.fsk__chev{flex:none;width:18px;height:18px;transition:transform .4s cubic-bezier(.3,1.4,.5,1)}
.fsk__items.is-open .fsk__chev{transform:rotate(180deg)}
.fsk__list-wrap{display:grid;grid-template-rows:0fr;transition:grid-template-rows .5s cubic-bezier(.2,.7,.2,1)}
.fsk__items.is-open .fsk__list-wrap{grid-template-rows:1fr}
.fsk__list{overflow:hidden;list-style:none;margin:0;padding:0}
.fsk__list li{display:flex;align-items:center;gap:12px;padding:10px 4px;border-bottom:1px solid var(--line);opacity:0;transform:translateX(-12px);transition:opacity .35s,transform .4s}
.fsk__card--hot .fsk__list li{border-color:rgba(255,255,255,.1)}
.fsk__list li:first-child{margin-top:8px}
.fsk__items.is-open .fsk__list li{opacity:1;transform:none;transition-delay:calc(var(--i) * 60ms + 120ms)}
.fsk__list img{width:46px;height:46px;flex:none;border-radius:50%;object-fit:cover;background:#f3d9a4;color:transparent;box-shadow:0 6px 12px -6px rgba(74,42,29,.5)}
.fsk__list strong{display:block;font-size:13.5px;font-weight:600;line-height:1.3}
.fsk__list small{display:block;font-size:12px;color:var(--muted);line-height:1.4;margin-top:2px}
.fsk__card--hot .fsk__list small{color:rgba(255,255,255,.55)}

/* Preço */
.fsk__price{margin-top:auto;padding:18px 0 4px}
.fsk__old{display:block;font-size:14px;color:var(--muted);text-decoration:line-through;margin-bottom:2px}
.fsk__card--hot .fsk__old{color:rgba(255,255,255,.5)}
.fsk__now{display:inline-flex;align-items:flex-start;gap:4px;font-family:'Playfair Display',serif;font-weight:800;line-height:1;color:var(--rose-2)}
.fsk__now small{font-family:'Poppins',sans-serif;font-size:15px;font-weight:600;margin-top:6px}
.fsk__now b{font-size:44px;font-weight:800}
.fsk__card--hot .fsk__now{color:var(--gold-2)}
.fsk__save{display:block;margin-top:8px;font-size:12px;font-weight:600;color:#3f8f5a}
.fsk__card--hot .fsk__save{color:#8fd6a5}

/* Botão WhatsApp */
.fsk__cta{position:relative;display:inline-flex;align-items:center;justify-content:center;gap:10px;width:100%;margin-top:18px;padding:15px 22px;border-radius:50px;overflow:hidden;
  font-size:15px;font-weight:600;color:#fff;text-decoration:none;background:linear-gradient(135deg,var(--wa),var(--wa-2));box-shadow:0 16px 30px -14px rgba(18,140,74,.75);
  transition:transform .35s cubic-bezier(.3,1.6,.5,1),box-shadow .35s}
.fsk__cta::after{content:"";position:absolute;top:0;left:-70%;width:45%;height:100%;background:linear-gradient(115deg,transparent,rgba(255,255,255,.45),transparent);transform:skewX(-20deg);animation:fskSweep 3.5s ease-in-out infinite}
@keyframes fskSweep{0%,60%{left:-70%}100%{left:130%}}
.fsk__cta:hover{color:#fff;text-decoration:none;transform:translateY(-3px);box-shadow:0 22px 38px -14px rgba(18,140,74,.85)}
.fsk__cta svg{width:20px;height:20px;transition:transform .4s cubic-bezier(.3,1.6,.5,1)}
.fsk__cta:hover svg{transform:rotate(-12deg) scale(1.15)}

/* Revelar */
.fsk--js [data-reveal]{opacity:0;transform:translateY(60px) scale(.96);transition:opacity 1s cubic-bezier(.2,.7,.2,1) var(--d,0s),transform 1s cubic-bezier(.2,.7,.2,1) var(--d,0s)}
.fsk--js [data-reveal].is-in{opacity:1;transform:none}

@media (max-width:640px){.fsk{padding:90px 0 100px}.fsk__now b{font-size:38px}}
@media (prefers-reduced-motion:reduce){
  .fsk *,.fsk *::before,.fsk *::after{animation:none!important;transition:none!important}
  .fsk--js [data-reveal]{opacity:1;transform:none}
}
</style>

<section class="fsk" id="fsk">
    <div class="fsk__blob fsk__blob--1"></div>
    <div class="fsk__blob fsk__blob--2"></div>

    <div class="fsk__head">
        <span class="fsk__eyebrow" data-reveal>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 12v9H4v-9"/><path d="M2 7h20v5H2z"/><path d="M12 21V7"/><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"/><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"/></svg>
            {{ conteudo('home.kits.selo') }}
        </span>
        <h2 class="fsk__title" data-reveal style="--d:.1s">{{ conteudo_html('home.kits.titulo') }}</h2>
        <p class="fsk__sub" data-reveal style="--d:.2s">{{ conteudo_html('home.kits.texto') }}</p>
    </div>

    <div class="fsk__grid {{ $kitis->count() <= 3 ? 'fsk__grid--few' : '' }}">
        @foreach ($kitis as $linha)
            @php
                // Foto do kit (ou do primeiro produto do kit)
                $fotoKit = $linha->foto_kit ?? ($linha->ProdutosKit->first()?->produto?->foto_produto ?? null);
                if ($fotoKit && !str_contains($fotoKit, '.')) {
                    $fotoKit .= '.png';
                }

                // Destaque
                $destaque = $linha->destaque_kit;
                $badges = [
                    'MAIS VENDIDO' => ['classe' => 'mais-vendido', 'texto' => 'Mais vendido'],
                    'PROMOCAO'     => ['classe' => 'promocao',     'texto' => 'Promoção'],
                    'NOVIDADE'     => ['classe' => 'novidade',     'texto' => 'Novidade'],
                ];
                $badge = $badges[$destaque] ?? null;
                $emAlta = $destaque === 'MAIS VENDIDO';

                // Preços
                $preco = (float) $linha->preco_kit;
                $promo = (float) $linha->preco_promocional_kit;
                $temPromo = $promo > 0 && $preco > 0 && $promo < $preco;
                $precoFinal = $temPromo ? $promo : ($preco > 0 ? $preco : $promo);
                $desconto = $temPromo ? round((1 - $promo / $preco) * 100) : 0;

                // Itens
                $itens = $linha->ProdutosKit->filter(fn ($item) => $item->produto);
                $qtdItens = $itens->count();

                // WhatsApp
                $mensagemWa = 'Olá! Tenho interesse no ' . $linha->nome_kit . '.';
                $linkWa = $linha->whatsapp_kit
                    ? 'https://wa.me/' . preg_replace('/\D/', '', $linha->whatsapp_kit) . '?text=' . rawurlencode($mensagemWa)
                    : null;
            @endphp

            <div data-reveal style="--d:{{ min($loop->index, 4) * 0.12 }}s">
                <article class="fsk__card {{ $emAlta ? 'fsk__card--hot' : '' }}">
                    <div class="fsk__media">
                        @if ($badge)
                            <span class="fsk__badge fsk__badge--{{ $badge['classe'] }}">
                                @if ($badge['classe'] === 'mais-vendido')
                                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l2.9 6.3 6.9.7-5.2 4.6 1.5 6.8L12 17l-6.1 3.4 1.5-6.8L2.2 9l6.9-.7z"/></svg>
                                @elseif ($badge['classe'] === 'promocao')
                                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 22c4.4 0 7-2.9 7-6.6 0-3.7-2.6-5.9-4-8.4-.5 2-1.6 3.2-2.8 3.6.3-3.1-.9-6.4-3.7-8.6.2 3.7-2.2 5.6-3.6 8C3.8 11.8 5 15 5 15.4 5 19.1 7.6 22 12 22z"/></svg>
                                @else
                                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l2.4 7.6L22 12l-7.6 2.4L12 22l-2.4-7.6L2 12l7.6-2.4z"/></svg>
                                @endif
                                {{ $badge['texto'] }}
                            </span>
                        @endif

                        @if ($temPromo && $desconto > 0)
                            <span class="fsk__off">
                                <svg viewBox="0 0 67.3 67.3" aria-hidden="true"><path d="M40.7,2.8c0.4,0,0.7,0,1.1,0.1c1.3,0.4,2.4,1.5,3.6,2.6c0.9,1,1.9,1.8,3,2.5c1.2,0.6,2.5,1.1,3.8,1.4 c1.6,0.4,3.1,0.8,4,1.7s1.3,2.4,1.7,4c0.3,1.3,0.7,2.5,1.3,3.7c0.7,1.1,1.6,2.1,2.6,3c1.2,1.2,2.3,2.2,2.6,3.5 c0.3,1.3-0.1,2.7-0.5,4.3c-0.4,1.3-0.6,2.6-0.7,3.9c0.1,1.2,0.3,2.5,0.6,3.7v0.1v0.1l0,0l0.5,1.9h0.1c0.2,0.9,0.1,1.7-0.1,2.6 c-0.3,1.3-1.4,2.4-2.6,3.6l0,0c-1,0.9-1.8,1.9-2.5,3c-0.6,1.2-1.1,2.5-1.4,3.8c-0.4,1.6-0.8,3.1-1.7,4s-2.5,1.2-4.1,1.7 c-1.3,0.3-2.5,0.7-3.7,1.3c-1.1,0.7-2.1,1.6-3,2.6c-1.2,1.2-2.2,2.3-3.5,2.6c-0.3,0.1-0.7,0.1-1,0.1c-1.1-0.1-2.2-0.3-3.3-0.6 c-1.3-0.4-2.6-0.6-3.9-0.7c-1.3,0.1-2.6,0.3-3.8,0.7c-1.1,0.3-2.2,0.6-3.3,0.6c-0.4,0-0.7,0-1.1-0.1c-1.3-0.4-2.4-1.5-3.6-2.6 c-0.9-1-1.9-1.8-3-2.5c-1.2-0.6-2.5-1.1-3.8-1.4c-1.6-0.4-3-0.8-4-1.7c-0.9-0.9-1.3-2.4-1.8-4c-0.3-1.3-0.7-2.5-1.3-3.7 c-0.7-1.1-1.6-2.1-2.6-3c-1.2-1.2-2.3-2.2-2.6-3.5s0.1-2.7,0.5-4.3c0.4-1.3,0.6-2.6,0.7-4c-0.1-1.3-0.3-2.6-0.7-3.8 c-0.4-1.6-0.8-3.1-0.5-4.4c0.4-1.3,1.5-2.4,2.6-3.6c1-0.9,1.8-1.9,2.5-3c0.6-1.2,1.1-2.5,1.4-3.8c0.4-1.6,0.8-3.1,1.7-4 s2.4-1.2,4-1.7c1.3-0.3,2.5-0.7,3.7-1.3c1.1-0.7,2.1-1.6,3-2.6c1.2-1.2,2.3-2.3,3.5-2.6c0.3-0.1,0.7-0.1,1-0.1 c1.1,0.1,2.2,0.3,3.3,0.6c1.3,0.4,2.6,0.6,4,0.7c1.3-0.1,2.6-0.3,3.8-0.7C38.5,3,39.6,2.8,40.7,2.8L40.7,2.8"/></svg>
                                <span><b>-{{ $desconto }}%</b><small>off</small></span>
                            </span>
                        @endif

                        <img src="{{ asset('donuts/images/' . ($fotoKit ?: 'sem-foto.png')) }}" alt="{{ $linha->nome_kit }}" loading="lazy">
                    </div>

                    <div class="fsk__body">
                        <span class="fsk__count">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                            Kit com {{ $qtdItens }} {{ $qtdItens == 1 ? 'item' : 'itens' }}
                        </span>
                        <h3 class="fsk__name">{{ $linha->nome_kit }}</h3>
                        @if ($linha->descricao_kit)
                            <p class="fsk__desc">{{ $linha->descricao_kit }}</p>
                        @endif

                        @if ($qtdItens > 0)
                            <div class="fsk__items">
                                <button type="button" class="fsk__toggle" aria-expanded="false"
                                    data-abrir="{{ conteudo('home.kits.ver_itens') }}" data-fechar="{{ conteudo('home.kits.ocultar_itens') }}">
                                    <span class="fsk__avatars">
                                        @foreach ($itens->take(3) as $item)
                                            <img src="{{ asset('donuts/images/' . $item->produto->foto_produto) }}" alt="">
                                        @endforeach
                                        @if ($qtdItens > 3)
                                            <span>+{{ $qtdItens - 3 }}</span>
                                        @endif
                                    </span>
                                    <span class="fsk__toggle-txt">{{ conteudo('home.kits.ver_itens') }}</span>
                                    <svg class="fsk__chev" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                                </button>
                                <div class="fsk__list-wrap">
                                    <ul class="fsk__list">
                                        @foreach ($itens as $item)
                                            <li style="--i:{{ $loop->index }}">
                                                <img src="{{ asset('donuts/images/' . $item->produto->foto_produto) }}" alt="{{ $item->produto->nome_produto }}" loading="lazy">
                                                <div>
                                                    <strong>{{ $item->produto->nome_produto }}</strong>
                                                    @if ($item->produto->descricao_produto)
                                                        <small>{{ $item->produto->descricao_produto }}</small>
                                                    @endif
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        @if ($precoFinal > 0)
                            <div class="fsk__price">
                                @if ($temPromo)
                                    <span class="fsk__old">de R$ {{ number_format($preco, 2, ',', '.') }}</span>
                                @endif
                                <span class="fsk__now"><small>R$</small><b data-price="{{ $precoFinal }}">{{ number_format($precoFinal, 2, ',', '.') }}</b></span>
                                @if ($temPromo)
                                    <span class="fsk__save">Você economiza R$ {{ number_format($preco - $promo, 2, ',', '.') }}</span>
                                @endif
                            </div>
                        @endif

                        @if ($linkWa)
                            <a href="{{ $linkWa }}" target="_blank" rel="noopener" class="fsk__cta">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.5 14.4c-.3-.1-1.8-.9-2-1-.3-.1-.5-.1-.7.1-.2.3-.8 1-.9 1.2-.2.2-.3.2-.6.1-.3-.1-1.3-.5-2.4-1.5-.9-.8-1.5-1.8-1.7-2.1-.2-.3 0-.5.1-.6l.4-.5c.2-.2.2-.3.3-.5.1-.2 0-.4 0-.5l-.9-2.2c-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.5s1.1 2.9 1.2 3.1c.1.2 2.1 3.2 5.1 4.5.7.3 1.3.5 1.7.6.7.2 1.4.2 1.9.1.6-.1 1.8-.7 2-1.4.3-.7.3-1.3.2-1.4-.1-.2-.3-.3-.6-.4zM12 21.8c-1.8 0-3.5-.5-5-1.4l-.4-.2-3.7 1 1-3.6-.2-.4c-1-1.6-1.5-3.4-1.5-5.2C2.2 6.6 6.6 2.2 12 2.2c2.6 0 5.1 1 6.9 2.9 1.9 1.9 2.9 4.3 2.9 6.9 0 5.4-4.4 9.8-9.8 9.8zm8.4-18.2C18.2 1.3 15.2 0 12 0 5.4 0 0 5.4 0 12c0 2.1.6 4.2 1.6 6L0 24l6.2-1.6c1.8 1 3.8 1.5 5.8 1.5 6.6 0 12-5.4 12-12 0-3.2-1.2-6.2-3.6-8.3z"/></svg>
                                {{ conteudo('home.kits.botao') }}
                            </a>
                        @endif
                    </div>
                </article>
            </div>
        @endforeach
    </div>
</section>

<script>
(function () {
    var root = document.getElementById('fsk');
    if (!root) return;
    root.classList.add('fsk--js');
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var fmt = new Intl.NumberFormat('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

    function countUp(el) {
        var end = parseFloat(el.dataset.price);
        if (!end || reduce) return;
        var dur = 1400, t0 = performance.now();
        (function step(t) {
            var p = Math.min((t - t0) / dur, 1), e = 1 - Math.pow(1 - p, 3);
            el.textContent = fmt.format(end * e);
            if (p < 1) requestAnimationFrame(step); else el.textContent = fmt.format(end);
        })(t0);
    }

    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) {
            if (!e.isIntersecting) return;
            e.target.classList.add('is-in');
            e.target.querySelectorAll('[data-price]').forEach(function (p) { setTimeout(function () { countUp(p); }, 300); });
            io.unobserve(e.target);
        });
    }, { threshold: 0.2 });
    root.querySelectorAll('[data-reveal]').forEach(function (el) { io.observe(el); });

    root.querySelectorAll('.fsk__toggle').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var box = btn.closest('.fsk__items');
            var open = box.classList.toggle('is-open');
            btn.setAttribute('aria-expanded', open ? 'true' : 'false');
            btn.querySelector('.fsk__toggle-txt').textContent = open ? btn.dataset.fechar : btn.dataset.abrir;
        });
    });
})();
</script>
@endif
<!--End Pricing Section -->