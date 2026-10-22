<!-- Região: onde entregamos (redesign animado) -->
@php
    /*
     | ÁREAS DE ENTREGA
     | As zonas e os bairros vêm do banco: painel → Sistema → Zonas de entrega.
     | A consulta de CEP é feita no servidor (rota regiao.consultar / App\Services\AreaEntrega).
     */
    $zonas = collect($zonas ?? \App\Models\ZonaEntrega::ativas())->values()->map(fn ($z) => [
        'id'      => $z->id_zona_entrega,
        'nome'    => $z->nome_zona_entrega,
        'apelido' => $z->apelido_zona_entrega,
        'cor'     => $z->cor_zona_entrega,
        'taxa'    => $z->taxa_zona_entrega,
        'prazo'   => $z->prazo_zona_entrega,
        'raio'    => $z->faixaKm(),
        'bairros' => $z->bairros->pluck('nome_bairro_entrega')->all(),
    ])->all();

    // Regras gerais (aparecem no topo e nas perguntas frequentes)
    // Editadas no painel (Conteúdo do Site → Páginas → Região)
    $pedidoMinimo   = (float) str_replace(',', '.', conteudo('regiao.consulta.pedido_minimo')); // 0 = sem mínimo
    $horarioEntrega = conteudo('regiao.consulta.horario');

    $numeroWhats = preg_replace('/\D/', '', $loja['whatsapp'] ?? '');
    $enderecoLoja = trim(($loja['endereco'] ?? '') . ', ' . ($loja['bairro'] ?? '') . ', ' . ($loja['cidade'] ?? ''), ', ');
    $linkRota = 'https://www.google.com/maps/dir/?api=1&destination=' . rawurlencode($loja['mapa'] ?? $enderecoLoja);
    $formatar = fn ($v) => $v > 0 ? 'R$ ' . number_format($v, 2, ',', '.') : 'Grátis';
    $coresZona = array_map(fn ($c) => $c[1], \App\Models\ZonaEntrega::CORES);
    // Mensagens do resultado da consulta de CEP (usadas no script do fim da página)
    $mensagensCep = [];
    foreach (array_keys(config('conteudo.regiao.secoes.mensagens.campos', [])) as $chave) {
        $mensagensCep[\Illuminate\Support\Str::afterLast($chave, '.')] = conteudo($chave);
    }
    $zonasJs = array_map(fn ($z) => [
        'id' => $z['id'], 'nome' => $z['nome'], 'taxa' => $formatar($z['taxa']), 'prazo' => $z['prazo'],
    ], $zonas);
@endphp

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,500;1,600&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
.frg{--cream:#fdf6ee;--paper:#fffaf4;--choco:#2a1710;--choco-2:#4a2a1d;--rose:#e07a85;--rose-2:#b94e5c;--gold:#d9b06c;--gold-2:#f3d9a4;--text:#6e5a50;--muted:#a08d7d;--line:#ecdccb;
  --wa:#25d366;--wa-2:#128c4a;--ok:#3f8f5a;
  position:relative;padding:50px 0 120px;background:var(--cream);font-family:'Poppins',sans-serif;color:var(--choco);overflow:hidden;isolation:isolate}
.frg *{box-sizing:border-box}
.frg [hidden]{display:none!important}
.frg__glow{position:absolute;inset:0;z-index:-1;pointer-events:none}
.frg__glow i{position:absolute;border-radius:50%;filter:blur(90px);animation:frgBlob 22s ease-in-out infinite}
.frg__glow i:nth-child(1){width:480px;height:480px;background:rgba(224,122,133,.2);top:0;right:-140px}
.frg__glow i:nth-child(2){width:420px;height:420px;background:rgba(217,176,108,.2);top:45%;left:-160px;animation-delay:-10s}
@keyframes frgBlob{50%{transform:translate(-50px,40px) scale(1.12)}}
.frg__wrap{max-width:1240px;margin:0 auto;padding:0 20px}
#frg,#frg-zonas,#frg-retirada,#frg-faq{scroll-margin-top:120px}

.frg__eyebrow{display:inline-flex;align-items:center;gap:12px;font-size:12.5px;font-weight:600;letter-spacing:.3em;text-transform:uppercase;color:var(--rose-2)}
.frg__eyebrow::before{content:"";height:1px;width:0;background:var(--rose);transition:width 1.2s cubic-bezier(.2,.7,.2,1) .2s}
.frg__eyebrow.is-in::before{width:40px}
.frg__h2{font-family:'Playfair Display',serif;font-weight:800;font-size:clamp(32px,4.6vw,52px);line-height:1.07;letter-spacing:-.015em;margin:14px 0 16px}
.frg__h2 em{font-style:italic;font-weight:600;background:linear-gradient(90deg,var(--rose-2),var(--rose),var(--gold),var(--rose-2));background-size:300% 100%;
  -webkit-background-clip:text;background-clip:text;color:transparent;animation:frgShine 6s linear infinite}
@keyframes frgShine{to{background-position:300% 0}}
.frg__lead{font-size:16.5px;line-height:1.75;color:var(--text);margin:0 0 28px;font-weight:300;max-width:520px}

/* Verificador */
.frg__hero{display:grid;grid-template-columns:1.05fr .95fr;gap:50px;align-items:center;margin-bottom:100px}
.frg__check{padding:26px;border-radius:28px;background:var(--paper);box-shadow:0 30px 60px -34px rgba(74,42,29,.55);border:1px solid rgba(255,255,255,.9)}
.frg__check label{display:block;font-size:13px;font-weight:600;color:var(--choco-2);margin-bottom:10px}
.frg__field{display:flex;gap:10px}
.frg__input{position:relative;flex:1}
.frg__input svg{position:absolute;left:18px;top:50%;width:20px;height:20px;margin-top:-10px;color:var(--rose-2);pointer-events:none}
.frg__input input{width:100%;height:58px;padding:0 18px 0 52px;border-radius:18px;border:1.5px solid var(--line);background:#fff;font-family:'Poppins',sans-serif;font-size:20px;font-weight:600;
  letter-spacing:.06em;color:var(--choco);outline:none;transition:border-color .3s,box-shadow .3s}
.frg__input input::placeholder{color:#cdbcab;font-weight:500}
.frg__input input:focus{border-color:var(--rose);box-shadow:0 0 0 5px rgba(224,122,133,.15)}
.frg__go{flex:none;display:inline-flex;align-items:center;gap:8px;padding:0 24px;border:0;border-radius:18px;cursor:pointer;font-family:inherit;font-size:15px;font-weight:600;color:#fff;
  background:linear-gradient(135deg,var(--rose),var(--rose-2));box-shadow:0 16px 30px -14px rgba(185,78,92,.8);transition:transform .35s cubic-bezier(.3,1.6,.5,1),opacity .3s}
.frg__go:hover{transform:translateY(-2px)}
.frg__go svg{width:18px;height:18px}
.frg__go .spin{display:none;width:18px;height:18px;border-radius:50%;border:2px solid rgba(255,255,255,.35);border-top-color:#fff;animation:frgSpin .8s linear infinite}
.frg__go.is-loading{pointer-events:none;opacity:.85}
.frg__go.is-loading .spin{display:block}
.frg__go.is-loading svg{display:none}
@keyframes frgSpin{to{transform:rotate(360deg)}}
.frg__or{display:flex;align-items:center;gap:12px;margin:16px 0 12px;font-size:12px;color:var(--muted)}
.frg__or::before,.frg__or::after{content:"";flex:1;height:1px;background:var(--line)}
.frg__select{position:relative}
.frg__select select{width:100%;height:50px;padding:0 44px 0 18px;border-radius:14px;border:1px solid var(--line);background:#fff;font-family:inherit;font-size:14px;color:var(--choco-2);cursor:pointer;
  outline:none;-webkit-appearance:none;appearance:none}
.frg__select select:focus{border-color:var(--rose)}
.frg__select svg{position:absolute;right:16px;top:50%;width:16px;height:16px;margin-top:-8px;color:var(--muted);pointer-events:none}
.frg__nocep{display:inline-block;margin-top:10px;font-size:12.5px;color:var(--rose-2);text-decoration:underline;text-underline-offset:3px}
.frg__nocep:hover{color:var(--rose-2)}

/* Resultado */
.frg__result{margin-top:18px;border-radius:20px;overflow:hidden;animation:frgPop .6s cubic-bezier(.3,1.5,.5,1)}
@keyframes frgPop{from{opacity:0;transform:translateY(-10px) scale(.97)}}
.frg__res{display:flex;gap:14px;align-items:flex-start;padding:18px}
.frg__res .ic{flex:none;width:46px;height:46px;border-radius:14px;display:grid;place-items:center;color:#fff}
.frg__res .ic svg{width:24px;height:24px}
.frg__res h4{margin:0 0 4px;font-family:'Playfair Display',serif;font-weight:700;font-size:20px;line-height:1.25}
.frg__res p{margin:0;font-size:13.5px;line-height:1.6;color:var(--text)}
.frg__res--ok{background:rgba(63,143,90,.1);box-shadow:inset 0 0 0 1px rgba(63,143,90,.3)}
.frg__res--ok .ic{background:var(--ok)}
.frg__res--ok h4{color:#2f6e45}
.frg__res--no{background:rgba(185,78,92,.08);box-shadow:inset 0 0 0 1px rgba(185,78,92,.25)}
.frg__res--no .ic{background:var(--rose-2)}
.frg__res--no h4{color:var(--rose-2)}
.frg__res--err{background:rgba(217,176,108,.15);box-shadow:inset 0 0 0 1px rgba(217,176,108,.4)}
.frg__res--err .ic{background:#b8893f}
.frg__res--err h4{color:#8a6424}
.frg__stats{display:grid;grid-template-columns:repeat(3,1fr);gap:8px;margin-top:12px}
.frg__stats span{display:block;padding:10px;border-radius:12px;background:#fff;text-align:center}
.frg__stats small{display:block;font-size:10px;letter-spacing:.14em;text-transform:uppercase;color:var(--muted)}
.frg__stats b{display:block;font-size:14px;font-weight:600;color:var(--choco)}
.frg__res-act{display:flex;flex-wrap:wrap;gap:8px;margin-top:12px}
.frg__btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:12px 18px;border:0;border-radius:14px;cursor:pointer;font-family:inherit;font-size:13.5px;font-weight:600;
  text-decoration:none;transition:transform .35s cubic-bezier(.3,1.6,.5,1),background .3s,color .3s}
.frg__btn:hover{transform:translateY(-2px);text-decoration:none}
.frg__btn svg{width:17px;height:17px}
.frg__btn--wa{color:#fff;background:linear-gradient(135deg,var(--wa),var(--wa-2));box-shadow:0 12px 24px -12px rgba(18,140,74,.8)}
.frg__btn--wa:hover{color:#fff}
.frg__btn--alt{color:var(--choco);background:#fff;box-shadow:inset 0 0 0 1px var(--line)}
.frg__btn--alt:hover{color:var(--choco)}

.frg__rules{display:flex;flex-wrap:wrap;gap:10px;margin-top:18px}
.frg__rule{display:inline-flex;align-items:center;gap:8px;padding:9px 14px;border-radius:50px;font-size:12.5px;color:var(--choco-2);background:rgba(255,255,255,.7);box-shadow:inset 0 0 0 1px var(--line)}
.frg__rule svg{width:15px;height:15px;color:var(--rose-2)}

/* Radar */
.frg__radar{position:relative;width:100%;max-width:500px;aspect-ratio:1;margin:0 auto}
.frg__ring{position:absolute;left:50%;top:50%;border-radius:50%;transform:translate(-50%,-50%);transition:box-shadow .5s,background .5s,transform .6s cubic-bezier(.3,1.5,.5,1)}
.frg__ring--3{width:100%;height:100%;background:radial-gradient(circle,rgba(74,42,29,.08),rgba(74,42,29,.14));box-shadow:inset 0 0 0 2px rgba(74,42,29,.25)}
.frg__ring--2{width:68%;height:68%;background:radial-gradient(circle,rgba(217,176,108,.14),rgba(217,176,108,.26));box-shadow:inset 0 0 0 2px rgba(184,137,63,.4)}
.frg__ring--1{width:38%;height:38%;background:radial-gradient(circle,rgba(224,122,133,.2),rgba(224,122,133,.36));box-shadow:inset 0 0 0 2px rgba(185,78,92,.45)}
.frg__ring.is-hit{transform:translate(-50%,-50%) scale(1.04);box-shadow:inset 0 0 0 3px var(--hc),0 0 0 8px rgba(255,255,255,.6),0 20px 50px -10px var(--hc)}
.frg__sweep{position:absolute;inset:0;border-radius:50%;background:conic-gradient(from 0deg,rgba(224,122,133,.35),transparent 18%);animation:frgSweep 5s linear infinite;
  -webkit-mask:radial-gradient(circle,#000 70%,transparent 71%);mask:radial-gradient(circle,#000 70%,transparent 71%)}
@keyframes frgSweep{to{transform:rotate(360deg)}}
.frg__ripple{position:absolute;left:50%;top:50%;width:38%;height:38%;border-radius:50%;border:2px solid rgba(224,122,133,.5);transform:translate(-50%,-50%);animation:frgRipple 3.6s ease-out infinite;pointer-events:none}
.frg__ripple:nth-of-type(2){animation-delay:-1.8s}
@keyframes frgRipple{from{width:20%;height:20%;opacity:.9}to{width:110%;height:110%;opacity:0}}
.frg__store{position:absolute;left:50%;top:50%;width:76px;height:76px;margin:-38px 0 0 -38px;border-radius:50%;display:grid;place-items:center;color:#fff;
  background:linear-gradient(135deg,var(--rose),var(--rose-2));box-shadow:0 0 0 8px rgba(255,255,255,.8),0 20px 40px -10px rgba(185,78,92,.7);animation:frgBob 3s ease-in-out infinite}
.frg__store svg{width:34px;height:34px}
@keyframes frgBob{50%{transform:translateY(-6px)}}
.frg__tag{position:absolute;display:flex;align-items:center;gap:8px;padding:8px 14px 8px 10px;border-radius:50px;background:#fff;box-shadow:0 12px 26px -12px rgba(74,42,29,.5);
  font-size:12px;font-weight:600;color:var(--choco);white-space:nowrap;transition:transform .5s cubic-bezier(.3,1.6,.5,1),box-shadow .4s}
.frg__tag i{width:10px;height:10px;border-radius:50%;background:var(--zc)}
.frg__tag small{font-weight:500;color:var(--muted)}
.frg__tag--1{left:50%;top:27%;transform:translate(-50%,-50%)}
.frg__tag--2{left:84%;top:42%;transform:translate(-50%,-50%)}
.frg__tag--3{left:22%;top:92%;transform:translate(-50%,-50%)}
.frg__tag.is-hit{transform:translate(-50%,-50%) scale(1.12);box-shadow:0 0 0 3px var(--zc),0 16px 30px -12px rgba(74,42,29,.5)}
.frg__home{position:absolute;opacity:0;width:40px;height:40px;margin:-40px 0 0 -20px;color:var(--choco);transition:opacity .4s,left .9s cubic-bezier(.3,1.3,.5,1),top .9s cubic-bezier(.3,1.3,.5,1)}
.frg__home.is-on{opacity:1;animation:frgDrop .8s cubic-bezier(.3,1.6,.5,1)}
@keyframes frgDrop{from{transform:translateY(-30px)}}
.frg__home svg{width:100%;height:100%;filter:drop-shadow(0 8px 8px rgba(42,23,16,.3))}
.frg--js .frg__radar .frg__ring{transform:translate(-50%,-50%) scale(0)}
.frg--js .frg__radar.is-in .frg__ring{transform:translate(-50%,-50%) scale(1);transition:transform 1s cubic-bezier(.3,1.4,.5,1)}
.frg--js .frg__radar.is-in .frg__ring--2{transition-delay:.12s}
.frg--js .frg__radar.is-in .frg__ring--3{transition-delay:.24s}
.frg--js .frg__radar.is-in .frg__ring.is-hit{transform:translate(-50%,-50%) scale(1.04);transition-delay:0s}

/* Zonas */
.frg__zones-head{display:flex;align-items:flex-end;justify-content:space-between;gap:20px;flex-wrap:wrap;margin-bottom:30px}
.frg__zones-head .frg__h2{margin-bottom:0}
.frg__filter{position:relative;flex:0 1 320px}
.frg__filter svg{position:absolute;left:16px;top:50%;width:17px;height:17px;margin-top:-8.5px;color:var(--muted);pointer-events:none}
.frg__filter input{width:100%;height:48px;padding:0 16px 0 44px;border-radius:50px;border:1px solid var(--line);background:#fff;font-family:inherit;font-size:14px;color:var(--choco);outline:none}
.frg__filter input:focus{border-color:var(--rose);box-shadow:0 0 0 4px rgba(224,122,133,.15)}
.frg__zones{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin-bottom:100px}
.frg__zone{position:relative;display:flex;flex-direction:column;border-radius:28px;background:var(--paper);box-shadow:0 30px 60px -36px rgba(74,42,29,.55);overflow:hidden;
  transition:transform .55s cubic-bezier(.3,1.4,.5,1),box-shadow .5s}
.frg__zone:hover{transform:translateY(-8px)}
.frg__zone.is-hit{box-shadow:0 0 0 3px var(--zc),0 40px 70px -30px rgba(74,42,29,.6);animation:frgHit 1s cubic-bezier(.3,1.5,.5,1)}
@keyframes frgHit{30%{transform:translateY(-12px) scale(1.02)}}
.frg__zone-top{position:relative;padding:24px 24px 20px;color:#fff;background:var(--zc);overflow:hidden}
.frg__zone-top::after{content:"";position:absolute;right:-50px;top:-50px;width:150px;height:150px;border-radius:50%;border:2px dashed rgba(255,255,255,.3);animation:frgSpin 30s linear infinite}
.frg__zone-top small{display:block;font-size:11px;font-weight:600;letter-spacing:.2em;text-transform:uppercase;opacity:.8}
.frg__zone-top h3{font-family:'Playfair Display',serif;font-weight:700;font-size:26px;margin:4px 0 0;color:#fff}
.frg__zone-top .km{position:absolute;right:20px;top:22px;padding:5px 11px;border-radius:30px;font-size:11.5px;font-weight:600;background:rgba(255,255,255,.2)}
.frg__zone-info{display:grid;grid-template-columns:1fr 1fr;border-bottom:1.5px dashed var(--line)}
.frg__zone-info div{padding:16px 20px}
.frg__zone-info div+div{border-left:1px solid var(--line)}
.frg__zone-info small{display:block;font-size:10.5px;letter-spacing:.14em;text-transform:uppercase;color:var(--muted)}
.frg__zone-info b{display:block;font-family:'Playfair Display',serif;font-size:22px;font-weight:800;color:var(--zc)}
.frg__zone-info b.free{color:var(--ok)}
.frg__chips{display:flex;flex-wrap:wrap;gap:7px;padding:18px 20px 22px}
.frg__chip{padding:7px 12px;border-radius:50px;font-size:12.5px;color:var(--choco-2);background:#fff;box-shadow:inset 0 0 0 1px var(--line);transition:background .3s,color .3s,box-shadow .3s,transform .3s}
.frg__chip.is-match{color:#fff;background:var(--zc);box-shadow:none;transform:scale(1.06)}
.frg__chip.is-dim{opacity:.35}

/* Alternativas */
.frg__alt{display:grid;grid-template-columns:1fr 1fr;gap:24px;margin-bottom:100px}
.frg__card{position:relative;padding:30px;border-radius:28px;overflow:hidden;box-shadow:0 30px 60px -36px rgba(74,42,29,.55)}
.frg__card--store{background:var(--paper)}
.frg__card--far{color:#fff;background:linear-gradient(150deg,var(--choco-2),var(--choco))}
.frg__card .ic{width:56px;height:56px;border-radius:18px;display:grid;place-items:center;margin-bottom:18px;color:#fff;background:linear-gradient(135deg,var(--rose),var(--rose-2))}
.frg__card--far .ic{color:var(--choco);background:linear-gradient(135deg,var(--gold-2),var(--gold))}
.frg__card .ic svg{width:28px;height:28px}
.frg__card h3{font-family:'Playfair Display',serif;font-weight:700;font-size:26px;margin:0 0 10px}
.frg__card--far h3{color:#fff}
.frg__card p{font-size:14.5px;line-height:1.7;margin:0 0 20px;color:var(--text)}
.frg__card--far p{color:rgba(255,255,255,.75)}
.frg__card .addr{display:flex;gap:10px;padding:14px;border-radius:16px;background:#fff;box-shadow:inset 0 0 0 1px var(--line);margin-bottom:18px;font-size:14px;color:var(--choco-2)}
.frg__card .addr svg{flex:none;width:20px;height:20px;color:var(--rose-2)}

/* Perguntas */
.frg__faq{max-width:860px;margin:0 auto}
.frg__faq .frg__h2{text-align:center;margin-bottom:30px}
.frg__q{border-radius:20px;background:var(--paper);box-shadow:0 20px 40px -32px rgba(74,42,29,.5);margin-bottom:12px;overflow:hidden}
.frg__q button{display:flex;align-items:center;gap:14px;width:100%;padding:20px 22px;border:0;background:transparent;cursor:pointer;font-family:inherit;font-size:15.5px;font-weight:600;color:var(--choco);text-align:left}
.frg__q button i{margin-left:auto;flex:none;position:relative;width:30px;height:30px;border-radius:50%;background:rgba(224,122,133,.12);transition:background .3s,transform .5s cubic-bezier(.3,1.5,.5,1)}
.frg__q button i::before,.frg__q button i::after{content:"";position:absolute;left:50%;top:50%;width:12px;height:2px;margin:-1px 0 0 -6px;border-radius:2px;background:var(--rose-2);transition:transform .4s}
.frg__q button i::after{transform:rotate(90deg)}
.frg__q.is-open button i{background:var(--rose-2);transform:rotate(180deg)}
.frg__q.is-open button i::before,.frg__q.is-open button i::after{background:#fff}
.frg__q.is-open button i::after{transform:rotate(0)}
.frg__a{display:grid;grid-template-rows:0fr;transition:grid-template-rows .5s cubic-bezier(.2,.7,.2,1)}
.frg__q.is-open .frg__a{grid-template-rows:1fr}
.frg__a div{overflow:hidden}
.frg__a p{margin:0;padding:0 22px 22px;font-size:14.5px;line-height:1.75;color:var(--text)}

/* Revelar */
.frg--js [data-reveal]{opacity:0;transform:translateY(40px);transition:opacity .9s cubic-bezier(.2,.7,.2,1) var(--d,0s),transform .9s cubic-bezier(.2,.7,.2,1) var(--d,0s)}
.frg--js [data-reveal].is-in{opacity:1;transform:none}

@media (max-width:991px){
  .frg__hero{grid-template-columns:1fr;gap:60px}
  .frg__radar{max-width:420px;order:-1}
  .frg__zones{grid-template-columns:1fr 1fr}
  .frg__alt{grid-template-columns:1fr}
}
@media (max-width:640px){
  .frg__wrap{padding:0 16px}
  .frg__field{flex-direction:column}
  .frg__go{justify-content:center;height:52px}
  .frg__zones{grid-template-columns:1fr}
  .frg__radar{max-width:320px}
  .frg__tag{font-size:11px;padding:6px 10px 6px 8px}
  .frg__tag small{display:none}
  .frg__card{padding:24px}
  .frg__stats{grid-template-columns:1fr 1fr 1fr}
}
@media (prefers-reduced-motion:reduce){
  .frg *,.frg *::before,.frg *::after{animation:none!important;transition:none!important}
  .frg--js [data-reveal]{opacity:1;transform:none}
  .frg--js .frg__radar .frg__ring{transform:translate(-50%,-50%)}
}
</style>

<section class="frg" id="frg" data-whats="{{ $numeroWhats }}" data-consultar="{{ route('regiao.consultar') }}">
    <div class="frg__glow" aria-hidden="true"><i></i><i></i></div>

    <div class="frg__wrap">

        {{-- Verificador de CEP --}}
        <div class="frg__hero">
            <div>
                <span class="frg__eyebrow" data-reveal>{{ conteudo('regiao.consulta.selo') }}</span>
                <h2 class="frg__h2" data-reveal style="--d:.08s">{{ conteudo_html('regiao.consulta.titulo') }}</h2>
                <p class="frg__lead" data-reveal style="--d:.16s">{{ conteudo_html('regiao.consulta.texto') }}</p>

                <div class="frg__check" data-reveal style="--d:.24s">
                    <form class="frg__form" novalidate>
                        <label for="frg-cep">{{ conteudo('regiao.consulta.pergunta_cep') }}</label>
                        <div class="frg__field">
                            <div class="frg__input">
                                <input type="text" id="frg-cep" inputmode="numeric" autocomplete="postal-code" placeholder="00000-000" maxlength="9">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s7-7.8 7-13a7 7 0 0 0-14 0c0 5.2 7 13 7 13z"/><circle cx="12" cy="9" r="2.5"/></svg>
                            </div>
                            <button type="submit" class="frg__go">
                                <span class="spin" aria-hidden="true"></span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="M20 20l-3.5-3.5"/></svg>
                                Consultar
                            </button>
                        </div>
                    </form>
                    <a href="https://buscacepinter.correios.com.br/app/endereco/index.php" target="_blank" rel="noopener" class="frg__nocep">Não sei meu CEP</a>

                    <div class="frg__or">ou escolha seu bairro</div>
                    <div class="frg__select">
                        <select class="frg__bairro" aria-label="Escolha seu bairro">
                            <option value="">Selecione o bairro...</option>
                            @foreach ($zonas as $zi => $z)
                                <optgroup label="{{ $z['nome'] }} · {{ $formatar($z['taxa']) }}">
                                    @foreach ($z['bairros'] as $b)
                                        <option value="{{ $zi }}|{{ $b }}">{{ $b }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                    </div>

                    <div class="frg__result" aria-live="polite" hidden></div>
                </div>

                <div class="frg__rules" data-reveal style="--d:.3s">
                    <span class="frg__rule"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>{{ $horarioEntrega }}</span>
                    @if ($pedidoMinimo > 0)
                        <span class="frg__rule"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><path d="M3 6h18"/></svg>Pedido mínimo {{ $formatar($pedidoMinimo) }}</span>
                    @endif
                </div>
            </div>

            {{-- Radar das zonas --}}
            <div class="frg__radar" data-reveal aria-hidden="true">
                @foreach (array_reverse(array_slice($zonas, 0, 3, true), true) as $zi => $z)
                    <span class="frg__ring frg__ring--{{ $zi + 1 }}" data-ring="{{ $zi }}" style="--hc:{{ $coresZona[$z['cor']] ?? '#b94e5c' }}"></span>
                @endforeach
                <span class="frg__sweep"></span>
                <span class="frg__ripple"></span><span class="frg__ripple"></span>
                <span class="frg__store">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 21h16M5 21v-6a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v6"/><path d="M5 17c1.2 0 1.8-1 3-1s1.8 1 3 1 1.8-1 3-1 1.8 1 3 1 1.8-1 2-1"/><path d="M12 13V9M12 6.5c-.8-.8-.8-1.8 0-3 .8 1.2.8 2.2 0 3z"/></svg>
                </span>
                @foreach ($zonas as $zi => $z)
                    @if ($zi < 3)
                        <span class="frg__tag frg__tag--{{ $zi + 1 }}" data-tag="{{ $zi }}" style="--zc:{{ $coresZona[$z['cor']] ?? '#b94e5c' }}"><i></i>{{ $z['nome'] }} <small>{{ $formatar($z['taxa']) }}</small></span>
                    @endif
                @endforeach
                <span class="frg__home">
                    <svg viewBox="0 0 24 24"><path fill="#2a1710" d="M12 1.5a7.5 7.5 0 0 0-7.5 7.5c0 5.6 7.5 13.5 7.5 13.5s7.5-7.9 7.5-13.5A7.5 7.5 0 0 0 12 1.5z"/><path fill="#f3d9a4" d="M8 10.5 12 7l4 3.5V14h-2.5v-2.5h-3V14H8z"/></svg>
                </span>
            </div>
        </div>

        {{-- Zonas --}}
        <div class="frg__zones-head" id="frg-zonas">
            <div>
                <span class="frg__eyebrow" data-reveal>{{ conteudo('regiao.zonas.selo') }}</span>
                <h2 class="frg__h2" data-reveal style="--d:.08s">{{ conteudo_html('regiao.zonas.titulo') }}</h2>
            </div>
            <label class="frg__filter" data-reveal style="--d:.16s">
                <input type="search" placeholder="{{ conteudo('regiao.zonas.busca') }}" aria-label="Procurar bairro">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="M20 20l-3.5-3.5"/></svg>
            </label>
        </div>

        <div class="frg__zones">
            @foreach ($zonas as $zi => $z)
                <article class="frg__zone" data-zone="{{ $zi }}" data-reveal style="--d:{{ $zi * 0.12 }}s;--zc:{{ $coresZona[$z['cor']] ?? '#b94e5c' }}">
                    <div class="frg__zone-top">
                        <small>{{ $z['apelido'] }}</small>
                        <h3>{{ $z['nome'] }}</h3>
                        @if (!empty($z['raio']))<span class="km">{{ $z['raio'] }}</span>@endif
                    </div>
                    <div class="frg__zone-info">
                        <div><small>Taxa</small><b class="{{ $z['taxa'] > 0 ? '' : 'free' }}">{{ $formatar($z['taxa']) }}</b></div>
                        <div><small>Prazo</small><b>{{ $z['prazo'] }}</b></div>
                    </div>
                    <div class="frg__chips">
                        @foreach ($z['bairros'] as $b)
                            <span class="frg__chip" data-b="{{ \Illuminate\Support\Str::lower(\Illuminate\Support\Str::ascii($b)) }}">{{ $b }}</span>
                        @endforeach
                    </div>
                </article>
            @endforeach
        </div>

        {{-- Alternativas --}}
        <div class="frg__alt">
            <div class="frg__card frg__card--store" id="frg-retirada" data-reveal>
                <span class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l1.5-5h15L21 9"/><path d="M3 9h18v2a3 3 0 0 1-6 0 3 3 0 0 1-6 0 3 3 0 0 1-6 0z"/><path d="M5 13v8h14v-8"/><path d="M10 21v-4h4v4"/></svg></span>
                <h3>{{ conteudo('regiao.alternativas.retirar_titulo') }}</h3>
                <p>{{ conteudo('regiao.alternativas.retirar_texto') }}</p>
                <div class="addr">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s7-7.8 7-13a7 7 0 0 0-14 0c0 5.2 7 13 7 13z"/><circle cx="12" cy="9" r="2.5"/></svg>
                    <span>{{ $enderecoLoja }}</span>
                </div>
                <a href="{{ $linkRota }}" target="_blank" rel="noopener" class="frg__btn frg__btn--alt">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 11l19-9-9 19-2-8z"/></svg>
                    {{ conteudo('regiao.alternativas.retirar_botao') }}
                </a>
            </div>
            <div class="frg__card frg__card--far" data-reveal style="--d:.12s">
                <span class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="7" width="13" height="10" rx="1"/><path d="M14 10h4l3 3v4h-7z"/><circle cx="5.5" cy="18" r="1.8"/><circle cx="17.5" cy="18" r="1.8"/></svg></span>
                <h3>{{ conteudo('regiao.alternativas.longe_titulo') }}</h3>
                <p>{{ conteudo('regiao.alternativas.longe_texto') }}</p>
                @if ($numeroWhats)
                    <a href="https://wa.me/{{ $numeroWhats }}?text={{ rawurlencode(conteudo('regiao.alternativas.longe_mensagem')) }}" target="_blank" rel="noopener" class="frg__btn frg__btn--wa">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.5 14.4c-.3-.1-1.8-.9-2-1-.3-.1-.5-.1-.7.1-.2.3-.8 1-.9 1.2-.2.2-.3.2-.6.1-.3-.1-1.3-.5-2.4-1.5-.9-.8-1.5-1.8-1.7-2.1-.2-.3 0-.5.1-.6l.4-.5c.2-.2.2-.3.3-.5.1-.2 0-.4 0-.5l-.9-2.2c-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.5s1.1 2.9 1.2 3.1c.1.2 2.1 3.2 5.1 4.5.7.3 1.3.5 1.7.6.7.2 1.4.2 1.9.1.6-.1 1.8-.7 2-1.4.3-.7.3-1.3.2-1.4-.1-.2-.3-.3-.6-.4zM12 21.8c-1.8 0-3.5-.5-5-1.4l-.4-.2-3.7 1 1-3.6-.2-.4c-1-1.6-1.5-3.4-1.5-5.2C2.2 6.6 6.6 2.2 12 2.2c2.6 0 5.1 1 6.9 2.9 1.9 1.9 2.9 4.3 2.9 6.9 0 5.4-4.4 9.8-9.8 9.8zm8.4-18.2C18.2 1.3 15.2 0 12 0 5.4 0 0 5.4 0 12c0 2.1.6 4.2 1.6 6L0 24l6.2-1.6c1.8 1 3.8 1.5 5.8 1.5 6.6 0 12-5.4 12-12 0-3.2-1.2-6.2-3.6-8.3z"/></svg>
                        {{ conteudo('regiao.alternativas.longe_botao') }}
                    </a>
                @endif
            </div>
        </div>

        {{-- Perguntas frequentes --}}
        <div class="frg__faq" id="frg-faq">
            <span class="frg__eyebrow" data-reveal style="display:flex;justify-content:center">{{ conteudo('regiao.faq.selo') }}</span>
            <h2 class="frg__h2" data-reveal style="--d:.08s">{{ conteudo_html('regiao.faq.titulo') }}</h2>
            @php
                // {horario} e {pedido_minimo} são trocados pelos valores da seção "Consulta de CEP"
                $trocas = ['{horario}' => mb_strtolower($horarioEntrega), '{pedido_minimo}' => $formatar($pedidoMinimo)];
                $perguntas = [];
                foreach ([1, 2, 3, 4, 5] as $n) {
                    if (conteudo("regiao.faq.pergunta{$n}") === '') continue;
                    $perguntas[] = [conteudo("regiao.faq.pergunta{$n}"), strtr(conteudo("regiao.faq.resposta{$n}"), $trocas)];
                }
            @endphp
            @foreach ($perguntas as $pq)
                <div class="frg__q" data-reveal style="--d:{{ $loop->index * 0.06 }}s">
                    <button type="button" aria-expanded="false">{{ $pq[0] }}<i aria-hidden="true"></i></button>
                    <div class="frg__a"><div><p>{{ $pq[1] }}</p></div></div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Dados das zonas para a consulta de CEP --}}
    <script type="application/json" class="frg__data">@json($zonasJs)</script>
</section>

<script>
(function () {
    var root = document.getElementById('frg');
    if (!root) return;
    root.classList.add('frg--js');
    var whats = root.dataset.whats;
    var zonas = [];
    try { zonas = JSON.parse(root.querySelector('.frg__data').textContent); } catch (e) {}

    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('is-in'); io.unobserve(e.target); } });
    }, { threshold: 0.15 });
    root.querySelectorAll('[data-reveal]').forEach(function (el) { io.observe(el); });

    function norm(s) { return (s || '').toLowerCase().normalize('NFD').replace(/[̀-ͯ]/g, '').replace(/\s+/g, ' ').trim(); }
    function esc(s) { var d = document.createElement('div'); d.textContent = s; return d.innerHTML; }

    var input = root.querySelector('#frg-cep'), form = root.querySelector('.frg__form'), go = root.querySelector('.frg__go');
    var result = root.querySelector('.frg__result'), select = root.querySelector('.frg__bairro'), home = root.querySelector('.frg__home');

    // Máscara 00000-000
    input.addEventListener('input', function () {
        var d = input.value.replace(/\D/g, '').slice(0, 8);
        input.value = d.length > 5 ? d.slice(0, 5) + '-' + d.slice(5) : d;
        if (d.length === 8) consultar();
    });

    // Posição da zona na página (cards e radar) a partir do id que o servidor devolve
    function zoneIndex(id) {
        for (var i = 0; i < zonas.length; i++) if (zonas[i].id === id) return i;
        return -1;
    }

    function highlight(zi) {
        root.querySelectorAll('[data-ring],[data-tag],.frg__zone').forEach(function (el) { el.classList.remove('is-hit'); });
        root.querySelectorAll('.frg__chip').forEach(function (c) { c.classList.remove('is-match'); });
        home.classList.remove('is-on');
        if (zi < 0) return;
        var ring = root.querySelector('[data-ring="' + zi + '"]'), tag = root.querySelector('[data-tag="' + zi + '"]');
        var card = root.querySelector('.frg__zone[data-zone="' + zi + '"]');
        if (ring) ring.classList.add('is-hit');
        if (tag) tag.classList.add('is-hit');
        if (card) { void card.offsetWidth; card.classList.add('is-hit'); }
        // Posiciona a casinha dentro do anel da zona
        var radius = [12, 27, 42][Math.min(zi, 2)], ang = 315 * Math.PI / 180;
        home.style.left = (50 + radius * Math.cos(ang)) + '%';
        home.style.top = (50 + radius * Math.sin(ang)) + '%';
        void home.offsetWidth; home.classList.add('is-on');
    }

    function show(type, html) {
        result.hidden = false;
        result.innerHTML = '<div class="frg__res frg__res--' + type + '">' + html + '</div>';
        result.style.animation = 'none'; void result.offsetWidth; result.style.animation = '';
    }
    var icOk = '<span class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5L20 7"/></svg></span>';
    var icNo = '<span class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s7-7.8 7-13a7 7 0 0 0-14 0c0 5.2 7 13 7 13z"/><path d="M9.5 6.5l5 5M14.5 6.5l-5 5"/></svg></span>';
    var icErr = '<span class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 8v5M12 16.5v.5"/></svg></span>';
    var icWa = '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.5 14.4c-.3-.1-1.8-.9-2-1-.3-.1-.5-.1-.7.1-.2.3-.8 1-.9 1.2-.2.2-.3.2-.6.1-.3-.1-1.3-.5-2.4-1.5-.9-.8-1.5-1.8-1.7-2.1-.2-.3 0-.5.1-.6l.4-.5c.2-.2.2-.3.3-.5.1-.2 0-.4 0-.5l-.9-2.2c-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.5s1.1 2.9 1.2 3.1c.1.2 2.1 3.2 5.1 4.5.7.3 1.3.5 1.7.6.7.2 1.4.2 1.9.1.6-.1 1.8-.7 2-1.4.3-.7.3-1.3.2-1.4-.1-.2-.3-.3-.6-.4zM12 21.8c-1.8 0-3.5-.5-5-1.4l-.4-.2-3.7 1 1-3.6-.2-.4c-1-1.6-1.5-3.4-1.5-5.2C2.2 6.6 6.6 2.2 12 2.2c2.6 0 5.1 1 6.9 2.9 1.9 1.9 2.9 4.3 2.9 6.9 0 5.4-4.4 9.8-9.8 9.8zm8.4-18.2C18.2 1.3 15.2 0 12 0 5.4 0 0 5.4 0 12c0 2.1.6 4.2 1.6 6L0 24l6.2-1.6c1.8 1 3.8 1.5 5.8 1.5 6.6 0 12-5.4 12-12 0-3.2-1.2-6.2-3.6-8.3z"/></svg>';
    function waLink(msg) { return 'https://wa.me/' + whats + '?text=' + encodeURIComponent(msg); }

    // Mensagens editadas no painel (Conteúdo do Site → Páginas → Região → Mensagens da consulta)
    var T = @json($mensagensCep);
    // Texto do painel com {endereco} trocado (sem HTML: escapa tudo)
    function t(chave, endereco) { return esc((T[chave] || '').split('{endereco}').join(endereco || '')); }
    function erroMsg(titulo, texto) { return icErr + '<div><h4>' + t(titulo) + '</h4><p>' + t(texto) + '</p></div>'; }

    // z: zona encontrada ({nome, taxa, prazo}) ou null; zi: posição dela na página; km: distância até a loja
    function resultado(z, zi, bairro, cidade, cep, km) {
        var onde = (bairro ? esc(bairro) + (cidade ? ' · ' + esc(cidade) : '') : 'seu endereço') +
            (km != null ? ' · cerca de ' + String(km).replace('.', ',') + ' km da loja' : '');
        var endereco = (bairro || '') + (cep ? ' (CEP ' + cep + ')' : '');
        highlight(z ? zi : -1);
        if (z) {
            show('ok', icOk + '<div style="flex:1"><h4>' + t('ok_titulo', bairro || 'seu endereço') + '</h4><p>' + onde + '</p>' +
                '<div class="frg__stats"><span><small>Zona</small><b>' + esc(z.nome) + '</b></span><span><small>Taxa</small><b>' + esc(z.taxa) + '</b></span><span><small>Prazo</small><b>' + esc(z.prazo) + '</b></span></div>' +
                (whats ? '<div class="frg__res-act"><a class="frg__btn frg__btn--wa" target="_blank" rel="noopener" href="' + waLink((T.ok_whatsapp || '').split('{endereco}').join(endereco)) + '">' + icWa + t('ok_botao') + '</a></div>' : '') + '</div>');
        } else {
            show('no', icNo + '<div style="flex:1"><h4>' + t('nao_titulo') + '</h4><p>' + onde + '. ' + t('nao_texto') + '</p>' +
                '<div class="frg__res-act">' + (whats ? '<a class="frg__btn frg__btn--wa" target="_blank" rel="noopener" href="' + waLink((T.nao_whatsapp || '').split('{endereco}').join(endereco)) + '">' + icWa + t('nao_botao') + '</a>' : '') +
                '<a class="frg__btn frg__btn--alt" href="#frg-retirada">' + t('nao_retirar') + '</a></div></div>');
        }
    }

    var busy = false, lastCep = '';
    function consultar() {
        var cep = input.value.replace(/\D/g, '');
        if (cep.length !== 8) { show('err', erroMsg('incompleto_titulo', 'incompleto_texto')); highlight(-1); return; }
        if (busy || cep === lastCep) return;
        busy = true; lastCep = cep; go.classList.add('is-loading');
        var ctrl = 'AbortController' in window ? new AbortController() : null;
        var timer = setTimeout(function () { if (ctrl) ctrl.abort(); }, 15000);
        var opcoes = { headers: { Accept: 'application/json' } };
        if (ctrl) opcoes.signal = ctrl.signal;
        // O servidor confere faixa de CEP, bairro e distância até a loja
        fetch(root.dataset.consultar + '?cep=' + cep, opcoes)
            .then(function (r) { if (!r.ok) throw r.status; return r.json(); })
            .then(function (d) {
                if (d.status === 'cep_invalido') {
                    show('err', erroMsg('invalido_titulo', 'invalido_texto'));
                    highlight(-1); lastCep = ''; return;
                }
                if (d.status === 'indefinido') {
                    show('err', erroMsg('indefinido_titulo', 'indefinido_texto'));
                    highlight(-1); lastCep = ''; return;
                }
                resultado(d.zona, d.zona ? zoneIndex(d.zona.id) : -1, d.bairro || '', d.cidade || '', d.cep, d.distancia_km);
            })
            .catch(function (erro) {
                show('err', erroMsg('falha_titulo', erro === 429 ? 'falha_limite' : 'falha_texto'));
                highlight(-1); lastCep = '';
            })
            .then(function () { clearTimeout(timer); busy = false; go.classList.remove('is-loading'); });
    }
    form.addEventListener('submit', function (e) { e.preventDefault(); lastCep = ''; consultar(); });

    select.addEventListener('change', function () {
        if (!select.value) return;
        var p = select.value.split('|'), zi = Number(p[0]);
        input.value = ''; lastCep = '';
        resultado(zonas[zi], zi, p.slice(1).join('|'), '', '', null);
    });

    // Procurar bairro nas zonas
    var filtro = root.querySelector('.frg__filter input');
    filtro.addEventListener('input', function () {
        var q = norm(filtro.value);
        root.querySelectorAll('.frg__chip').forEach(function (c) {
            var m = q && c.dataset.b.indexOf(q) !== -1;
            c.classList.toggle('is-match', !!m);
            c.classList.toggle('is-dim', !!q && !m);
        });
    });

    // Perguntas frequentes
    root.querySelectorAll('.frg__q button').forEach(function (b) {
        b.addEventListener('click', function () {
            var q = b.parentNode, open = !q.classList.contains('is-open');
            root.querySelectorAll('.frg__q').forEach(function (x) { x.classList.remove('is-open'); x.querySelector('button').setAttribute('aria-expanded', 'false'); });
            if (open) { q.classList.add('is-open'); b.setAttribute('aria-expanded', 'true'); }
        });
    });
    var first = root.querySelector('.frg__q'); if (first) { first.classList.add('is-open'); first.querySelector('button').setAttribute('aria-expanded', 'true'); }
})();
</script>
<!-- End Região -->
