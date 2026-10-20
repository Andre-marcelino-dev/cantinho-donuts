<!-- Map Section (redesign animado) -->
@php
    // Endereço usado no mapa (config/services.php → loja)
    $enderecoMapa = $loja['mapa'] ?? trim(($loja['endereco'] ?? '') . ', ' . ($loja['bairro'] ?? '') . ', ' . ($loja['cidade'] ?? ''), ', ');
    $q = rawurlencode($enderecoMapa);
    $mapaEmbed  = "https://maps.google.com/maps?q={$q}&t=&z=16&ie=UTF8&iwloc=&output=embed";
    $linkRota   = "https://www.google.com/maps/dir/?api=1&destination={$q}";
    $linkWaze   = "https://waze.com/ul?q={$q}&navigate=yes";
@endphp

<style>
.fmp{--cream:#fdf6ee;--choco:#2a1710;--choco-2:#4a2a1d;--rose:#e07a85;--rose-2:#b94e5c;--gold:#d9b06c;--gold-2:#f3d9a4;--text:#6e5a50;--muted:#a08d7d;--line:#ecdccb;
  position:relative;height:540px;font-family:'Poppins',sans-serif;color:var(--choco);overflow:hidden;isolation:isolate;background:#f3e3d3}
.fmp *{box-sizing:border-box}

/* Mapa */
.fmp__map{position:absolute;inset:0;z-index:-2}
.fmp__map iframe{width:100%;height:100%;border:0;display:block;filter:grayscale(.65) sepia(.35) hue-rotate(-15deg) contrast(.95) brightness(1.02);transition:filter .8s ease}
.fmp:hover .fmp__map iframe,.fmp.is-live .fmp__map iframe{filter:none}
.fmp__tint{position:absolute;inset:0;z-index:-1;pointer-events:none;transition:opacity .8s;
  background:linear-gradient(90deg,rgba(253,246,238,.92) 0%,rgba(253,246,238,.55) 32%,rgba(253,246,238,0) 55%)}
.fmp.is-live .fmp__tint{opacity:.35}

/* Ondas */
.fmp__wave{position:absolute;left:0;right:0;height:60px;z-index:2;pointer-events:none;overflow:hidden}
.fmp__wave--top{top:-1px;transform:scaleY(-1)}
.fmp__wave--bot{bottom:-1px}
.fmp__wave svg{position:absolute;bottom:0;left:0;width:200%;height:100%}
.fmp__wave path{fill:var(--cream)}
.fmp__wave--top path{animation:fmpWave 18s linear infinite}
.fmp__wave--bot path{fill:var(--choco);animation:fmpWave 14s linear infinite reverse}
@keyframes fmpWave{to{transform:translateX(-50%)}}

/* Pino animado (decorativo, no centro do mapa) */
.fmp__pin{position:absolute;left:50%;top:50%;z-index:1;pointer-events:none;transform:translate(-50%,-100%)}
.fmp__pin svg{display:block;width:54px;height:54px;filter:drop-shadow(0 10px 12px rgba(42,23,16,.4));animation:fmpBounce 2.2s cubic-bezier(.3,1.5,.5,1) infinite}
.fmp__pin::after{content:"";position:absolute;left:50%;bottom:-6px;width:18px;height:6px;margin-left:-9px;border-radius:50%;background:rgba(42,23,16,.3);animation:fmpShadow 2.2s cubic-bezier(.3,1.5,.5,1) infinite}
.fmp__pin i{position:absolute;left:50%;bottom:-14px;width:22px;height:22px;margin-left:-11px;border-radius:50%;border:2px solid var(--rose-2);opacity:0;animation:fmpRipple 2.2s ease-out infinite}
@keyframes fmpBounce{0%,100%{transform:translateY(0)}30%{transform:translateY(-16px)}}
@keyframes fmpShadow{0%,100%{transform:scale(1);opacity:.6}30%{transform:scale(.6);opacity:.3}}
@keyframes fmpRipple{0%{transform:scale(.4) scaleY(.4);opacity:.8}100%{transform:scale(3.2) scaleY(1.2);opacity:0}}
.fmp.is-live .fmp__pin{opacity:0;transition:opacity .4s}

/* Cartão */
.fmp__inner{position:relative;z-index:3;max-width:1240px;height:100%;margin:0 auto;padding:0 20px;display:flex;align-items:center;pointer-events:none}
.fmp__card{pointer-events:auto;width:100%;max-width:400px;padding:30px;border-radius:28px;background:rgba(255,250,244,.94);
  -webkit-backdrop-filter:blur(14px);backdrop-filter:blur(14px);border:1px solid rgba(255,255,255,.9);box-shadow:0 40px 80px -36px rgba(74,42,29,.6)}
.fmp--js .fmp__card{opacity:0;transform:translateX(-40px) scale(.96);transition:opacity 1s cubic-bezier(.2,.7,.2,1),transform 1s cubic-bezier(.2,.7,.2,1)}
.fmp.is-in .fmp__card{opacity:1;transform:none}
.fmp__eyebrow{display:inline-flex;align-items:center;gap:8px;font-size:11.5px;font-weight:600;letter-spacing:.24em;text-transform:uppercase;color:var(--rose-2)}
.fmp__eyebrow svg{width:15px;height:15px}
.fmp__title{font-family:'Playfair Display',serif;font-weight:800;font-size:32px;line-height:1.1;margin:10px 0 16px}
.fmp__title em{font-style:italic;font-weight:600;color:var(--rose-2)}
.fmp__addr{display:flex;gap:12px;align-items:flex-start;margin:0 0 22px;padding:14px;border-radius:16px;background:#fff;box-shadow:inset 0 0 0 1px var(--line);font-size:14.5px;line-height:1.55;color:var(--choco-2)}
.fmp__addr svg{flex:none;width:20px;height:20px;margin-top:2px;color:var(--rose-2)}
.fmp__copy{margin-left:auto;flex:none;width:34px;height:34px;border:0;border-radius:10px;cursor:pointer;display:grid;place-items:center;color:var(--muted);background:rgba(224,122,133,.08);
  transition:background .3s,color .3s,transform .35s cubic-bezier(.3,1.6,.5,1)}
.fmp__copy:hover{background:var(--rose-2);color:#fff;transform:scale(1.08)}
.fmp__copy svg{width:16px;height:16px;margin:0;color:inherit}
.fmp__copy.is-done{background:#3f8f5a;color:#fff}

.fmp__btns{display:grid;grid-template-columns:1fr 1fr;gap:10px}
.fmp__btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:14px 12px;border-radius:16px;font-size:14px;font-weight:600;text-decoration:none;
  transition:transform .35s cubic-bezier(.3,1.6,.5,1),box-shadow .35s,background .3s,color .3s}
.fmp__btn svg{width:18px;height:18px}
.fmp__btn:hover{text-decoration:none;transform:translateY(-3px)}
.fmp__btn--main{grid-column:1/-1;color:#fff;background:linear-gradient(135deg,var(--rose),var(--rose-2));box-shadow:0 16px 32px -14px rgba(185,78,92,.8)}
.fmp__btn--main:hover{color:#fff;box-shadow:0 22px 40px -14px rgba(185,78,92,.95)}
.fmp__btn--main:hover svg{animation:fmpGo .6s ease}
@keyframes fmpGo{50%{transform:translate(3px,-3px) rotate(12deg)}}
.fmp__btn--alt{color:var(--choco-2);background:#fff;box-shadow:inset 0 0 0 1px var(--line)}
.fmp__btn--alt:hover{color:var(--choco);box-shadow:inset 0 0 0 1px rgba(224,122,133,.45),0 12px 24px -14px rgba(74,42,29,.45)}

.fmp__hint{display:flex;align-items:center;gap:8px;margin:16px 0 0;font-size:12.5px;color:var(--muted)}
.fmp__hint svg{width:15px;height:15px}

/* Ativar o mapa (evita que a rolagem da página fique presa no mapa) */
.fmp__shield{position:absolute;inset:0;z-index:0;cursor:pointer;background:transparent;border:0}
.fmp.is-live .fmp__shield{display:none}

@media (max-width:760px){
  .fmp{height:auto;display:flex;flex-direction:column}
  .fmp__map{position:relative;height:340px;order:-1}
  .fmp__tint{display:none}
  .fmp__pin{top:170px}
  .fmp__inner{height:auto;padding:0 16px;margin-top:-70px;margin-bottom:70px}
  .fmp__shield{bottom:auto;height:340px}
  .fmp__card{max-width:none;padding:24px}
  .fmp__title{font-size:28px}
}
@media (prefers-reduced-motion:reduce){
  .fmp *,.fmp *::before,.fmp *::after{animation:none!important;transition:none!important}
  .fmp--js .fmp__card{opacity:1;transform:none}
}
</style>

<section class="fmp" id="fmp">
    <div class="fmp__wave fmp__wave--top" aria-hidden="true"><svg viewBox="0 0 2880 60" preserveAspectRatio="none"><path d="M0,30 Q240,0 480,30 T960,30 T1440,30 T1920,30 T2400,30 T2880,30 V60 H0Z"/></svg></div>

    <div class="fmp__map">
        {{-- Mapa do endereço da loja (config/services.php → loja) --}}
        <iframe id="gmap_canvas" title="Mapa da confeitaria" loading="lazy" referrerpolicy="no-referrer-when-downgrade" src="{{ $mapaEmbed }}"></iframe>
    </div>
    <div class="fmp__tint" aria-hidden="true"></div>
    <button type="button" class="fmp__shield" aria-label="Clique para interagir com o mapa"></button>

    <span class="fmp__pin" aria-hidden="true">
        <svg viewBox="0 0 24 24"><path fill="#b94e5c" d="M12 1.5a7.5 7.5 0 0 0-7.5 7.5c0 5.6 7.5 13.5 7.5 13.5s7.5-7.9 7.5-13.5A7.5 7.5 0 0 0 12 1.5z"/><circle cx="12" cy="9" r="4.2" fill="#fff"/><path fill="#e07a85" d="M12 12.3s-2.7-1.7-2.7-3.6a1.5 1.5 0 0 1 2.7-.9 1.5 1.5 0 0 1 2.7.9c0 1.9-2.7 3.6-2.7 3.6z"/></svg>
        <i></i>
    </span>

    <div class="fmp__inner">
        <div class="fmp__card">
            <span class="fmp__eyebrow">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s7-7.8 7-13a7 7 0 0 0-14 0c0 5.2 7 13 7 13z"/><circle cx="12" cy="9" r="2.5"/></svg>
                Onde estamos
            </span>
            <h2 class="fmp__title">Venha nos <em>visitar</em></h2>

            <div class="fmp__addr">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 10.5 12 3l9 7.5V20a1 1 0 0 1-1 1h-5v-6h-6v6H4a1 1 0 0 1-1-1z"/></svg>
                <span class="fmp__addr-txt">{{ $enderecoMapa }}</span>
                <button type="button" class="fmp__copy" aria-label="Copiar endereço" title="Copiar endereço">
                    <svg class="i-copy" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="12" height="12" rx="2"/><path d="M5 15V5a2 2 0 0 1 2-2h10"/></svg>
                </button>
            </div>

            <div class="fmp__btns">
                <a href="{{ $linkRota }}" target="_blank" rel="noopener" class="fmp__btn fmp__btn--main">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 11l19-9-9 19-2-8z"/></svg>
                    Traçar rota
                </a>
                <a href="{{ $linkWaze }}" target="_blank" rel="noopener" class="fmp__btn fmp__btn--alt">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 11a8 8 0 0 0-16 0c0 2 .6 3.4 1.6 4.4-.3 1.4-1 2.3-2.1 2.6 1.6.9 3.6.6 5-.6a9 9 0 0 0 3.5.6A8 8 0 0 0 20 11z"/><circle cx="9" cy="10" r=".8" fill="currentColor"/><circle cx="15" cy="10" r=".8" fill="currentColor"/><path d="M9.5 13.5c1.4 1 3.6 1 5 0"/></svg>
                    Waze
                </a>
                <a href="https://www.google.com/maps/search/?api=1&query={{ $q }}" target="_blank" rel="noopener" class="fmp__btn fmp__btn--alt">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 4 3 6v14l6-2 6 2 6-2V4l-6 2z"/><path d="M9 4v14M15 6v14"/></svg>
                    Google Maps
                </a>
            </div>

            <p class="fmp__hint">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11V6a2 2 0 1 1 4 0v5"/><path d="M13 9.5a2 2 0 1 1 4 0V11"/><path d="M17 10.5a2 2 0 1 1 4 0V15a7 7 0 0 1-7 7h-1.6a6 6 0 0 1-4.6-2.2L4.3 16a2 2 0 0 1 3-2.6L9 15"/></svg>
                Clique no mapa para mover e dar zoom
            </p>
        </div>
    </div>

    <div class="fmp__wave fmp__wave--bot" aria-hidden="true"><svg viewBox="0 0 2880 60" preserveAspectRatio="none"><path d="M0,30 Q240,0 480,30 T960,30 T1440,30 T1920,30 T2400,30 T2880,30 V60 H0Z"/></svg></div>
</section>

<script>
(function () {
    var root = document.getElementById('fmp');
    if (!root) return;
    root.classList.add('fmp--js');

    new IntersectionObserver(function (es, obs) {
        if (es[0].isIntersecting) { root.classList.add('is-in'); obs.disconnect(); }
    }, { threshold: 0.25 }).observe(root);

    // Mapa só fica interativo depois do clique (a rolagem da página não "prende" no mapa)
    var shield = root.querySelector('.fmp__shield');
    shield.addEventListener('click', function () { root.classList.add('is-live'); });
    root.addEventListener('mouseleave', function () { root.classList.remove('is-live'); });

    // Copiar endereço
    var copy = root.querySelector('.fmp__copy'), txt = root.querySelector('.fmp__addr-txt').textContent.trim();
    copy.addEventListener('click', function () {
        var done = function () {
            copy.classList.add('is-done'); copy.title = 'Endereço copiado!';
            setTimeout(function () { copy.classList.remove('is-done'); copy.title = 'Copiar endereço'; }, 1800);
        };
        if (navigator.clipboard) navigator.clipboard.writeText(txt).then(done, function () {});
        else { var t = document.createElement('textarea'); t.value = txt; document.body.appendChild(t); t.select(); try { document.execCommand('copy'); done(); } catch (e) {} t.remove(); }
    });
})();
</script>
<!-- End Map Section -->