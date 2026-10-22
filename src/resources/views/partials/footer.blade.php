@php
    // Dados da loja: config/services.php ('loja')
    $nomeLoja = $loja['nome'] ?? 'Davilla';
    $redes = array_filter([
        'instagram' => $loja['instagram'] ?? '',
        'facebook'  => $loja['facebook'] ?? '',
        'tiktok'    => $loja['tiktok'] ?? '',
    ]);
    $enderecoMapa = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode(($loja['endereco'] ?? '') . ', ' . ($loja['bairro'] ?? '') . ', ' . ($loja['cidade'] ?? ''));
    $mensagemWa = rawurlencode(conteudo('geral.rodape.mensagem_whatsapp'));
@endphp

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,500;1,600&family=Poppins:wght@300;400;500;600&family=Great+Vibes&display=swap" rel="stylesheet">

<style>
.ffo{--cream:#fdf6ee;--choco:#2a1710;--choco-2:#4a2a1d;--rose:#e07a85;--rose-2:#b94e5c;--gold:#d9b06c;--gold-2:#f3d9a4;--wa:#25d366;--wa-2:#128c4a;
  position:relative;font-family:'Poppins',sans-serif;color:rgba(255,255,255,.78);background:var(--choco);isolation:isolate;overflow:hidden}
.ffo *{box-sizing:border-box}
.ffo a{color:inherit;text-decoration:none}

/* Onda do topo */
.ffo__wave{position:relative;height:90px;margin-bottom:-1px;background:var(--cream);overflow:hidden}
.ffo__wave svg{position:absolute;bottom:0;left:0;width:200%;height:100%}
.ffo__wave .w1{fill:var(--choco);animation:ffoWave 16s linear infinite}
.ffo__wave .w2{fill:var(--rose-2);opacity:.35;animation:ffoWave 10s linear infinite reverse}
@keyframes ffoWave{to{transform:translateX(-50%)}}

.ffo__glow{position:absolute;border-radius:50%;filter:blur(100px);z-index:-1;animation:ffoBlob 22s ease-in-out infinite;pointer-events:none}
.ffo__glow--1{width:460px;height:460px;background:rgba(224,122,133,.22);top:80px;left:-160px}
.ffo__glow--2{width:420px;height:420px;background:rgba(217,176,108,.18);bottom:-140px;right:-120px;animation-delay:-10s}
@keyframes ffoBlob{50%{transform:translate(70px,-40px) scale(1.15)}}

/* Faixa de chamada */
.ffo__cta{max-width:1200px;margin:0 auto;padding:40px 20px 0}
.ffo__cta-box{position:relative;display:flex;align-items:center;justify-content:space-between;gap:30px;padding:38px 44px;border-radius:30px;overflow:hidden;
  background:linear-gradient(120deg,var(--rose),var(--rose-2));box-shadow:0 40px 80px -34px rgba(185,78,92,.75)}
.ffo__cta-box::before{content:"";position:absolute;right:-60px;top:-80px;width:280px;height:280px;border-radius:50%;border:2px dashed rgba(255,255,255,.3);animation:ffoSpin 30s linear infinite}
.ffo__cta-box::after{content:"";position:absolute;left:30%;bottom:-120px;width:240px;height:240px;border-radius:50%;background:rgba(255,255,255,.08)}
@keyframes ffoSpin{to{transform:rotate(360deg)}}
.ffo__cta-txt{position:relative;z-index:1}
.ffo__cta-txt small{display:block;font-family:'Great Vibes',cursive;font-size:30px;line-height:1;color:var(--gold-2);margin-bottom:4px}
.ffo__cta-txt h3{font-family:'Playfair Display',serif;font-weight:800;font-size:clamp(26px,3.2vw,38px);line-height:1.15;color:#fff;margin:0}
.ffo__cta-btn{position:relative;z-index:1;flex:none;display:inline-flex;align-items:center;gap:12px;padding:17px 32px;border-radius:60px;overflow:hidden;
  font-size:15px;font-weight:600;color:var(--choco)!important;background:#fff;box-shadow:0 18px 36px -14px rgba(42,23,16,.55);
  transition:transform .35s cubic-bezier(.3,1.6,.5,1),box-shadow .35s}
.ffo__cta-btn svg{width:22px;height:22px;color:var(--wa-2);transition:transform .4s cubic-bezier(.3,1.6,.5,1)}
.ffo__cta-btn:hover{transform:translateY(-3px) scale(1.02);box-shadow:0 24px 44px -14px rgba(42,23,16,.65)}
.ffo__cta-btn:hover svg{transform:rotate(-14deg) scale(1.15)}
.ffo__cta-btn::after{content:"";position:absolute;top:0;left:-70%;width:45%;height:100%;background:linear-gradient(115deg,transparent,rgba(224,122,133,.25),transparent);transform:skewX(-20deg);animation:ffoSweep 3.5s ease-in-out infinite}
@keyframes ffoSweep{0%,60%{left:-70%}100%{left:130%}}

/* Colunas */
.ffo__main{max-width:1200px;margin:0 auto;padding:80px 20px 60px;display:grid;grid-template-columns:1.05fr .95fr 1.2fr;gap:56px}
.ffo__title{position:relative;font-family:'Playfair Display',serif;font-weight:700;font-size:23px;color:#fff;margin:0 0 30px;padding-bottom:16px}
.ffo__title::after{content:"";position:absolute;left:0;bottom:0;height:2px;width:0;border-radius:2px;background:linear-gradient(90deg,var(--rose),var(--gold));transition:width 1.2s cubic-bezier(.2,.7,.2,1) calc(var(--d,0s) + .3s)}
.is-in .ffo__title::after{width:56px}

.ffo__brand{display:flex;align-items:center;gap:12px;margin-bottom:20px}
.ffo__logo{width:54px;height:54px;border-radius:50%;display:grid;place-items:center;background:linear-gradient(135deg,var(--rose),var(--gold));color:#fff;
  box-shadow:0 12px 26px -10px rgba(224,122,133,.7);animation:ffoBob 4s ease-in-out infinite}
.ffo__logo svg{width:26px;height:26px}
@keyframes ffoBob{50%{transform:translateY(-5px) rotate(-6deg)}}
.ffo__brand b{font-family:'Playfair Display',serif;font-size:28px;font-weight:800;color:#fff;line-height:1}
.ffo__brand small{display:block;font-family:'Great Vibes',cursive;font-size:20px;color:var(--gold-2);line-height:1.1}
.ffo__about{font-size:14.5px;line-height:1.8;margin:0 0 26px}

.ffo__social{display:flex;gap:12px;list-style:none;padding:0;margin:0}
.ffo__social a{width:44px;height:44px;border-radius:50%;display:grid;place-items:center;color:#fff;background:rgba(255,255,255,.07);
  box-shadow:inset 0 0 0 1px rgba(255,255,255,.14);position:relative;overflow:hidden;isolation:isolate;transition:transform .35s cubic-bezier(.3,1.6,.5,1),color .3s}
.ffo__social a::before{content:"";position:absolute;inset:0;z-index:-1;border-radius:50%;background:linear-gradient(135deg,var(--rose),var(--gold));transform:scale(0);transition:transform .4s cubic-bezier(.3,1.3,.5,1)}
.ffo__social a:hover{transform:translateY(-4px) rotate(-8deg)}
.ffo__social a:hover::before{transform:scale(1)}
.ffo__social svg{width:19px;height:19px}

/* Contatos */
.ffo__contacts{list-style:none;padding:0;margin:0;display:grid;gap:20px}
.ffo__contacts a,.ffo__contacts div{display:flex;gap:16px;align-items:flex-start}
.ffo__contacts .ico{flex:none;width:46px;height:46px;border-radius:14px;display:grid;place-items:center;color:var(--gold-2);background:rgba(255,255,255,.06);
  box-shadow:inset 0 0 0 1px rgba(255,255,255,.1);transition:background .35s,color .35s,transform .45s cubic-bezier(.3,1.6,.5,1)}
.ffo__contacts .ico svg{width:20px;height:20px}
.ffo__contacts a:hover .ico{background:var(--rose-2);color:#fff;transform:rotate(-10deg) scale(1.06)}
.ffo__contacts small{display:block;font-size:11px;letter-spacing:.16em;text-transform:uppercase;color:rgba(255,255,255,.45);margin-bottom:3px}
.ffo__contacts span.v{display:block;font-size:14.5px;line-height:1.55;color:#fff;word-break:break-word;transition:color .3s}
.ffo__contacts a:hover span.v{color:var(--gold-2)}

/* Formulário */
.ffo__form{display:grid;gap:16px}
.ffo__field{position:relative}
.ffo__field input,.ffo__field textarea{width:100%;font-family:inherit;font-size:14.5px;color:#fff;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.14);
  border-radius:16px;padding:22px 18px 10px;outline:none;transition:border-color .3s,background .3s,box-shadow .3s;resize:vertical}
.ffo__field textarea{min-height:110px}
.ffo__field label{position:absolute;left:19px;top:17px;font-size:14.5px;color:rgba(255,255,255,.5);pointer-events:none;transform-origin:0 0;
  transition:transform .25s cubic-bezier(.2,.7,.2,1),color .25s}
.ffo__field input:focus,.ffo__field textarea:focus{border-color:var(--rose);background:rgba(255,255,255,.08);box-shadow:0 0 0 4px rgba(224,122,133,.15)}
.ffo__field input:focus+label,.ffo__field input:not(:placeholder-shown)+label,
.ffo__field textarea:focus+label,.ffo__field textarea:not(:placeholder-shown)+label{transform:translateY(-10px) scale(.75);color:var(--gold-2)}
.ffo__field input:-webkit-autofill{-webkit-text-fill-color:#fff;-webkit-box-shadow:0 0 0 40px #3a2219 inset}
.ffo__row{display:grid;grid-template-columns:1fr 1fr;gap:16px}
.ffo__send{position:relative;display:inline-flex;align-items:center;justify-content:center;gap:10px;width:100%;padding:17px 24px;border:0;border-radius:16px;cursor:pointer;
  font-family:inherit;font-size:15px;font-weight:600;color:#fff;background:linear-gradient(135deg,var(--rose),var(--rose-2));overflow:hidden;
  box-shadow:0 18px 36px -16px rgba(185,78,92,.8);transition:transform .35s cubic-bezier(.3,1.6,.5,1),box-shadow .35s,opacity .3s}
.ffo__send:hover{transform:translateY(-3px);box-shadow:0 24px 44px -16px rgba(185,78,92,.95)}
.ffo__send svg{width:18px;height:18px;transition:transform .5s cubic-bezier(.3,1.6,.5,1)}
.ffo__send:hover svg{transform:translate(4px,-4px) rotate(10deg)}
.ffo__send .spin{display:none;width:18px;height:18px;border-radius:50%;border:2px solid rgba(255,255,255,.35);border-top-color:#fff;animation:ffoSpin .8s linear infinite}
.ffo__send.is-loading{pointer-events:none;opacity:.85}
.ffo__send.is-loading .spin{display:block}
.ffo__send.is-loading svg{display:none}

.ffo__alert{display:flex;gap:12px;align-items:flex-start;padding:14px 16px;border-radius:14px;font-size:14px;line-height:1.5;animation:ffoIn .6s cubic-bezier(.3,1.5,.5,1)}
.ffo__alert svg{flex:none;width:20px;height:20px;margin-top:1px}
.ffo__alert--ok{background:rgba(63,143,90,.18);color:#bfe8cb;border:1px solid rgba(63,143,90,.45)}
.ffo__alert--err{background:rgba(217,98,58,.16);color:#ffd2c2;border:1px solid rgba(217,98,58,.45)}
@keyframes ffoIn{from{opacity:0;transform:translateY(-10px) scale(.96)}}

/* Rodapé inferior */
.ffo__bottom{border-top:1px solid rgba(255,255,255,.08)}
.ffo__bottom-in{max-width:1200px;margin:0 auto;padding:24px 20px;display:flex;align-items:center;justify-content:space-between;gap:20px;font-size:13.5px;color:rgba(255,255,255,.5)}
.ffo__bottom-in p{margin:0}
.ffo__bottom-in .heart{display:inline-block;color:var(--rose);animation:ffoBeat 1.4s ease-in-out infinite}
@keyframes ffoBeat{0%,100%{transform:scale(1)}20%{transform:scale(1.3)}40%{transform:scale(.95)}60%{transform:scale(1.2)}}

/* Voltar ao topo */
.ffo__top{position:relative;flex:none;width:52px;height:52px;border-radius:50%;border:0;cursor:pointer;display:grid;place-items:center;color:#fff;background:rgba(255,255,255,.06);
  transition:transform .35s cubic-bezier(.3,1.6,.5,1),background .3s}
.ffo__top:hover{transform:translateY(-4px);background:var(--rose-2)}
.ffo__top svg.arrow{width:20px;height:20px;transition:transform .4s}
.ffo__top:hover svg.arrow{transform:translateY(-3px)}
.ffo__top svg.ring{position:absolute;inset:0;width:100%;height:100%;transform:rotate(-90deg)}
.ffo__top .ring circle{fill:none;stroke-width:2.5}
.ffo__top .ring .bg{stroke:rgba(255,255,255,.12)}
.ffo__top .ring .fg{stroke:var(--gold);stroke-linecap:round;stroke-dasharray:151;stroke-dashoffset:151;transition:stroke-dashoffset .2s}

/* Revelar */
.ffo--js [data-reveal]{opacity:0;transform:translateY(50px);transition:opacity 1s cubic-bezier(.2,.7,.2,1) var(--d,0s),transform 1s cubic-bezier(.2,.7,.2,1) var(--d,0s)}
.ffo--js [data-reveal].is-in{opacity:1;transform:none}

@media (max-width:991px){
  .ffo__main{grid-template-columns:1fr 1fr;gap:50px}
  .ffo__col--form{grid-column:1/-1}
  .ffo__cta-box{flex-direction:column;align-items:flex-start;padding:34px 30px}
}
@media (max-width:640px){
  .ffo__main{grid-template-columns:1fr;padding-top:60px}
  .ffo__row{grid-template-columns:1fr}
  .ffo__cta-btn{width:100%;justify-content:center}
  .ffo__bottom-in{flex-direction:column-reverse;text-align:center}
}
@media (prefers-reduced-motion:reduce){
  .ffo *,.ffo *::before,.ffo *::after{animation:none!important;transition:none!important}
  .ffo--js [data-reveal]{opacity:1;transform:none}
  .ffo__title::after{width:56px}
}
</style>

<!-- Main Footer -->
<footer class="ffo" id="ffo">
    <div class="ffo__wave" aria-hidden="true">
        <svg viewBox="0 0 2880 90" preserveAspectRatio="none"><path class="w2" d="M0,40 Q180,0 360,40 T720,40 T1080,40 T1440,40 T1800,40 T2160,40 T2520,40 T2880,40 V90 H0Z"/></svg>
        <svg viewBox="0 0 2880 90" preserveAspectRatio="none"><path class="w1" d="M0,55 Q240,20 480,55 T960,55 T1440,55 T1920,55 T2400,55 T2880,55 V90 H0Z"/></svg>
    </div>
    <div class="ffo__glow ffo__glow--1"></div>
    <div class="ffo__glow ffo__glow--2"></div>

    <!-- Chamada para encomenda -->
    <div class="ffo__cta" data-reveal>
        <div class="ffo__cta-box">
            <div class="ffo__cta-txt">
                <small>{{ conteudo('geral.rodape.chamada_selo') }}</small>
                <h3>{{ conteudo('geral.rodape.chamada_titulo') }}</h3>
            </div>
            <a href="https://wa.me/{{ $loja['whatsapp'] }}?text={{ $mensagemWa }}" target="_blank" rel="noopener" class="ffo__cta-btn">
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.5 14.4c-.3-.1-1.8-.9-2-1-.3-.1-.5-.1-.7.1-.2.3-.8 1-.9 1.2-.2.2-.3.2-.6.1-.3-.1-1.3-.5-2.4-1.5-.9-.8-1.5-1.8-1.7-2.1-.2-.3 0-.5.1-.6l.4-.5c.2-.2.2-.3.3-.5.1-.2 0-.4 0-.5l-.9-2.2c-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.5s1.1 2.9 1.2 3.1c.1.2 2.1 3.2 5.1 4.5.7.3 1.3.5 1.7.6.7.2 1.4.2 1.9.1.6-.1 1.8-.7 2-1.4.3-.7.3-1.3.2-1.4-.1-.2-.3-.3-.6-.4zM12 21.8c-1.8 0-3.5-.5-5-1.4l-.4-.2-3.7 1 1-3.6-.2-.4c-1-1.6-1.5-3.4-1.5-5.2C2.2 6.6 6.6 2.2 12 2.2c2.6 0 5.1 1 6.9 2.9 1.9 1.9 2.9 4.3 2.9 6.9 0 5.4-4.4 9.8-9.8 9.8zm8.4-18.2C18.2 1.3 15.2 0 12 0 5.4 0 0 5.4 0 12c0 2.1.6 4.2 1.6 6L0 24l6.2-1.6c1.8 1 3.8 1.5 5.8 1.5 6.6 0 12-5.4 12-12 0-3.2-1.2-6.2-3.6-8.3z"/></svg>
                {{ conteudo('geral.rodape.chamada_botao') }}
            </a>
        </div>
    </div>

    <div class="ffo__main">
        <!-- Sobre -->
        <div class="ffo__col" data-reveal style="--d:.05s">
            <div class="ffo__brand">
                <span class="ffo__logo"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 21h16M5 21v-6a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v6"/><path d="M5 17c1.2 0 1.8-1 3-1s1.8 1 3 1 1.8-1 3-1 1.8 1 3 1 1.8-1 2-1"/><path d="M12 13V9M12 6.5c-.8-.8-.8-1.8 0-3 .8 1.2.8 2.2 0 3z"/></svg></span>
                <span><b>{{ $nomeLoja }}</b><small>{{ conteudo('geral.rodape.slogan') }}</small></span>
            </div>
            <p class="ffo__about">{{ conteudo_html('geral.rodape.sobre') }}</p>
            @if (count($redes))
                <ul class="ffo__social">
                    @if (!empty($redes['instagram']))
                        <li><a href="{{ $redes['instagram'] }}" target="_blank" rel="noopener" aria-label="Instagram">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r=".6" fill="currentColor"/></svg>
                        </a></li>
                    @endif
                    @if (!empty($redes['facebook']))
                        <li><a href="{{ $redes['facebook'] }}" target="_blank" rel="noopener" aria-label="Facebook">
                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M14 8.5V6.8c0-.8.2-1.3 1.4-1.3H17V2.3c-.3 0-1.3-.1-2.5-.1-2.5 0-4.2 1.5-4.2 4.3v2H7.5v3.4h2.8V22H14v-10.1h2.8l.4-3.4H14z"/></svg>
                        </a></li>
                    @endif
                    @if (!empty($redes['tiktok']))
                        <li><a href="{{ $redes['tiktok'] }}" target="_blank" rel="noopener" aria-label="TikTok">
                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M16.6 2h-3.3v13.4a2.9 2.9 0 1 1-2.9-2.9c.3 0 .6 0 .9.1V9.2a6.3 6.3 0 1 0 5.3 6.2V8.6a7.7 7.7 0 0 0 4.5 1.4V6.7a4.5 4.5 0 0 1-4.5-4.7z"/></svg>
                        </a></li>
                    @endif
                </ul>
            @endif
        </div>

        <!-- Contatos -->
        <div class="ffo__col" data-reveal style="--d:.15s">
            <h3 class="ffo__title">{{ conteudo('geral.rodape.contatos_titulo') }}</h3>
            <ul class="ffo__contacts">
                <li>
                    <a href="{{ $enderecoMapa }}" target="_blank" rel="noopener">
                        <span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s7-7.8 7-13a7 7 0 0 0-14 0c0 5.2 7 13 7 13z"/><circle cx="12" cy="9" r="2.5"/></svg></span>
                        <span><small>Endereço</small><span class="v">{{ $loja['endereco'] }} - {{ $loja['bairro'] }}<br>{{ $loja['cidade'] }} - CEP {{ $loja['cep'] }}</span></span>
                    </a>
                </li>
                <li>
                    <a href="https://wa.me/{{ $loja['whatsapp'] }}" target="_blank" rel="noopener">
                        <span class="ico"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.5 14.4c-.3-.1-1.8-.9-2-1-.3-.1-.5-.1-.7.1-.2.3-.8 1-.9 1.2-.2.2-.3.2-.6.1-.3-.1-1.3-.5-2.4-1.5-.9-.8-1.5-1.8-1.7-2.1-.2-.3 0-.5.1-.6l.4-.5c.2-.2.2-.3.3-.5.1-.2 0-.4 0-.5l-.9-2.2c-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.5s1.1 2.9 1.2 3.1c.1.2 2.1 3.2 5.1 4.5.7.3 1.3.5 1.7.6.7.2 1.4.2 1.9.1.6-.1 1.8-.7 2-1.4.3-.7.3-1.3.2-1.4-.1-.2-.3-.3-.6-.4zM12 21.8c-1.8 0-3.5-.5-5-1.4l-.4-.2-3.7 1 1-3.6-.2-.4c-1-1.6-1.5-3.4-1.5-5.2C2.2 6.6 6.6 2.2 12 2.2c2.6 0 5.1 1 6.9 2.9 1.9 1.9 2.9 4.3 2.9 6.9 0 5.4-4.4 9.8-9.8 9.8zm8.4-18.2C18.2 1.3 15.2 0 12 0 5.4 0 0 5.4 0 12c0 2.1.6 4.2 1.6 6L0 24l6.2-1.6c1.8 1 3.8 1.5 5.8 1.5 6.6 0 12-5.4 12-12 0-3.2-1.2-6.2-3.6-8.3z"/></svg></span>
                        <span><small>WhatsApp</small><span class="v">{{ $loja['telefone'] }}</span></span>
                    </a>
                </li>
                <li>
                    <a href="mailto:{{ $loja['email'] }}">
                        <span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="3"/><path d="M22 7l-10 6L2 7"/></svg></span>
                        <span><small>E-mail</small><span class="v">{{ $loja['email'] }}</span></span>
                    </a>
                </li>
                @if (!empty($loja['horario']))
                    <li>
                        <div>
                            <span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></span>
                            <span><small>Horário</small><span class="v">{{ $loja['horario'] }}</span></span>
                        </div>
                    </li>
                @endif
            </ul>
        </div>

        <!-- Formulário de encomenda -->
        <div class="ffo__col ffo__col--form" data-reveal style="--d:.25s">
            <h3 class="ffo__title">{{ conteudo('geral.rodape.form_titulo') }}</h3>
            {{-- id diferente de "email-form" para o script.js do modelo não interceptar o envio --}}
            <form action="{{ route('contato.enviar') }}#form-rodape" method="post" id="form-rodape" class="ffo__form">
                @csrf
                <input type="hidden" name="origem" value="rodape">
                <input type="hidden" name="assunto_contato" value="Encomenda">

                @if (session('sucesso_rodape'))
                    <div class="ffo__alert ffo__alert--ok" role="status">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M8 12l3 3 5-6"/></svg>
                        <span>{{ session('sucesso_rodape') }}</span>
                    </div>
                @endif
                @if ($errors->rodape->any())
                    <div class="ffo__alert ffo__alert--err" role="alert">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 8v5M12 16.5v.5"/></svg>
                        <span>{{ $errors->rodape->first() }}</span>
                    </div>
                @endif

                <div class="ffo__field">
                    <input type="text" id="ffo-nome" name="nome_contato" placeholder=" " maxlength="50" required autocomplete="name"
                        value="{{ old('origem') === 'rodape' ? old('nome_contato') : '' }}">
                    <label for="ffo-nome">Seu nome *</label>
                </div>
                <div class="ffo__row">
                    <div class="ffo__field">
                        <input type="email" id="ffo-email" name="email_contato" placeholder=" " maxlength="80" required autocomplete="email"
                            value="{{ old('origem') === 'rodape' ? old('email_contato') : '' }}">
                        <label for="ffo-email">Seu e-mail *</label>
                    </div>
                    <div class="ffo__field">
                        <input type="text" inputmode="tel" id="ffo-tel" name="telefone_contato" placeholder=" " maxlength="14" required autocomplete="tel"
                            value="{{ old('origem') === 'rodape' ? old('telefone_contato') : '' }}">
                        <label for="ffo-tel">Telefone / WhatsApp *</label>
                    </div>
                </div>
                <div class="ffo__field">
                    <textarea id="ffo-msg" name="mensagem_contato" placeholder=" " maxlength="2000" required>{{ old('origem') === 'rodape' ? old('mensagem_contato') : '' }}</textarea>
                    <label for="ffo-msg">{{ conteudo('geral.rodape.form_pergunta') }} *</label>
                </div>
                <button class="ffo__send" type="submit">
                    <span class="spin" aria-hidden="true"></span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 2L11 13"/><path d="M22 2l-7 20-4-9-9-4z"/></svg>
                    {{ conteudo('geral.rodape.form_botao') }}
                </button>
            </form>
        </div>
    </div>

    <div class="ffo__bottom">
        <div class="ffo__bottom-in">
            <p>© {{ date('Y') }} {{ $nomeLoja }}. {!! str_replace('♥', '<span class="heart">♥</span>', e(conteudo('geral.rodape.direitos'))) !!}</p>
            <button type="button" class="ffo__top" aria-label="Voltar ao topo">
                <svg class="ring" viewBox="0 0 52 52" aria-hidden="true"><circle class="bg" cx="26" cy="26" r="24"/><circle class="fg" cx="26" cy="26" r="24"/></svg>
                <svg class="arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 19V5M6 11l6-6 6 6"/></svg>
            </button>
        </div>
    </div>
</footer>
<!-- End Footer -->

<script>
(function () {
    var root = document.getElementById('ffo');
    if (!root) return;
    root.classList.add('ffo--js');
    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) {
            if (e.isIntersecting) { e.target.classList.add('is-in'); io.unobserve(e.target); }
        });
    }, { threshold: 0.15 });
    root.querySelectorAll('[data-reveal]').forEach(function (el) { io.observe(el); });

    // Mostra o formulário já revelado quando a página volta com mensagem
    if (location.hash === '#form-rodape') root.querySelectorAll('[data-reveal]').forEach(function (el) { el.classList.add('is-in'); });

    // Botão "Enviar" com carregando
    var form = document.getElementById('form-rodape');
    if (form) form.addEventListener('submit', function () {
        if (form.checkValidity()) form.querySelector('.ffo__send').classList.add('is-loading');
    });

    // Voltar ao topo com anel de progresso da rolagem
    var top = root.querySelector('.ffo__top'), ring = top.querySelector('.fg'), tick = false;
    function progress() {
        var max = document.documentElement.scrollHeight - innerHeight;
        var p = max > 0 ? scrollY / max : 0;
        ring.style.strokeDashoffset = 151 - 151 * p;
        tick = false;
    }
    window.addEventListener('scroll', function () { if (!tick) { tick = true; requestAnimationFrame(progress); } }, { passive: true });
    progress();
    top.addEventListener('click', function () { window.scrollTo({ top: 0, behavior: reduce ? 'auto' : 'smooth' }); });
})();
</script>