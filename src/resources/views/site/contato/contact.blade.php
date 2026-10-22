<!-- Contact Section (redesign animado) -->
@php
    /*
     | HORÁRIOS DE FUNCIONAMENTO — editados no painel (Conteúdo do Site → Páginas → Contato).
     | dia: 0 = domingo, 1 = segunda ... 6 = sábado. Horário vazio = fechado.
     */
    $diasSemana = [1 => 'Segunda-feira', 2 => 'Terça-feira', 3 => 'Quarta-feira', 4 => 'Quinta-feira', 5 => 'Sexta-feira', 6 => 'Sábado', 0 => 'Domingo'];
    $horarios = [];
    foreach ($diasSemana as $dia => $nomeDia) {
        $temHorario = preg_match('/(\d{1,2}):?(\d{2})?\D+(\d{1,2}):?(\d{2})?/', conteudo("contato.horarios.dia{$dia}"), $h);
        $horarios[] = [
            'dia'   => $dia,
            'nome'  => $nomeDia,
            'abre'  => $temHorario ? sprintf('%02d:%02d', $h[1], $h[2] ?: 0) : null,
            'fecha' => $temHorario ? sprintf('%02d:%02d', $h[3], $h[4] ?? 0) : null,
        ];
    }

    $enderecoCompleto = trim(($loja['endereco'] ?? '') . ', ' . ($loja['bairro'] ?? '') . ', ' . ($loja['cidade'] ?? '') . ' ' . ($loja['cep'] ?? ''), ', ');
    $mapaEmbed = 'https://maps.google.com/maps?q=' . rawurlencode($enderecoCompleto) . '&z=16&output=embed';
    $mapaLink  = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode($enderecoCompleto);
    $assuntoAntigo = old('origem') === 'contato' ? old('assunto_contato') : null;
@endphp

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,500;1,600&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
.fct{--cream:#fdf6ee;--paper:#fffaf4;--choco:#2a1710;--choco-2:#4a2a1d;--rose:#e07a85;--rose-2:#b94e5c;--gold:#d9b06c;--gold-2:#f3d9a4;--text:#6e5a50;--muted:#a08d7d;--line:#ecdccb;
  --wa:#25d366;--wa-2:#128c4a;--ok:#3f8f5a;
  position:relative;padding:120px 0 130px;font-family:'Poppins',sans-serif;color:var(--choco);overflow:hidden;isolation:isolate;
  background:linear-gradient(180deg,var(--cream),#f8ece2)}
.fct *{box-sizing:border-box}
.fct__blob{position:absolute;border-radius:50%;filter:blur(90px);z-index:-1;animation:fctBlob 20s ease-in-out infinite}
.fct__blob--1{width:460px;height:460px;background:rgba(224,122,133,.2);top:-120px;left:-140px}
.fct__blob--2{width:420px;height:420px;background:rgba(217,176,108,.22);bottom:-140px;right:-120px;animation-delay:-9s}
@keyframes fctBlob{50%{transform:translate(60px,40px) scale(1.12)}}

/* Cabeçalho */
.fct__head{text-align:center;max-width:700px;margin:0 auto 64px;padding:0 16px}
.fct__eyebrow{display:inline-flex;align-items:center;gap:10px;padding:8px 18px;border-radius:50px;background:#fff;box-shadow:0 10px 30px -15px rgba(185,78,92,.45);
  font-size:12px;font-weight:600;letter-spacing:.24em;text-transform:uppercase;color:var(--rose-2)}
.fct__eyebrow svg{width:16px;height:16px;animation:fctWave 2.4s ease-in-out infinite;transform-origin:70% 70%}
@keyframes fctWave{0%,60%,100%{transform:rotate(0)}10%,30%{transform:rotate(16deg)}20%,40%{transform:rotate(-10deg)}}
.fct__title{font-family:'Playfair Display',serif;font-weight:800;font-size:clamp(38px,5.4vw,62px);line-height:1.06;letter-spacing:-.02em;margin:22px 0 16px}
.fct__title em{font-style:italic;font-weight:600;background:linear-gradient(90deg,var(--rose-2),var(--rose),var(--gold),var(--rose-2));background-size:300% 100%;
  -webkit-background-clip:text;background-clip:text;color:transparent;animation:fctShine 6s linear infinite}
@keyframes fctShine{to{background-position:300% 0}}
.fct__sub{font-size:17px;line-height:1.7;color:var(--text);margin:0;font-weight:300}

.fct__wrap{max-width:1240px;margin:0 auto;padding:0 20px;display:grid;grid-template-columns:.9fr 1.1fr;gap:34px;align-items:start}
.fct__side{display:grid;gap:24px}
.fct__card{background:var(--paper);border-radius:28px;padding:30px;box-shadow:0 30px 60px -36px rgba(74,42,29,.5);border:1px solid rgba(255,255,255,.9)}
.fct__h{display:flex;align-items:center;gap:12px;font-family:'Playfair Display',serif;font-weight:700;font-size:22px;margin:0 0 20px}
.fct__h .ico{width:42px;height:42px;border-radius:14px;display:grid;place-items:center;color:#fff;background:linear-gradient(135deg,var(--rose),var(--rose-2));flex:none}
.fct__h .ico svg{width:20px;height:20px}

/* Status aberto/fechado */
.fct__status{display:flex;align-items:center;gap:12px;padding:14px 16px;border-radius:18px;margin-bottom:18px;background:rgba(160,141,125,.1);transition:background .4s}
.fct__status i{position:relative;flex:none;width:12px;height:12px;border-radius:50%;background:var(--muted)}
.fct__status.is-open{background:rgba(63,143,90,.12)}
.fct__status.is-open i{background:var(--ok)}
.fct__status.is-open i::after{content:"";position:absolute;inset:0;border-radius:50%;background:var(--ok);animation:fctPing 1.6s ease-out infinite}
.fct__status.is-closed{background:rgba(185,78,92,.1)}
.fct__status.is-closed i{background:var(--rose-2)}
@keyframes fctPing{to{transform:scale(2.8);opacity:0}}
.fct__status strong{display:block;font-size:15px;font-weight:600}
.fct__status.is-open strong{color:var(--ok)}
.fct__status.is-closed strong{color:var(--rose-2)}
.fct__status small{display:block;font-size:12.5px;color:var(--text)}

.fct__hours{list-style:none;margin:0;padding:0}
.fct__hours li{display:flex;justify-content:space-between;gap:12px;padding:10px 12px;border-radius:12px;font-size:14px;color:var(--text);transition:background .4s}
.fct__hours li+li{border-top:1px dashed var(--line)}
.fct__hours li b{font-weight:500;color:var(--choco-2)}
.fct__hours li .off{color:var(--muted);font-style:italic}
.fct__hours li.is-today{background:rgba(224,122,133,.1);border-color:transparent}
.fct__hours li.is-today b{font-weight:600;color:var(--rose-2)}
.fct__hours li.is-today b::after{content:"hoje";margin-left:8px;padding:2px 8px;border-radius:20px;font-size:10px;font-weight:600;letter-spacing:.1em;text-transform:uppercase;
  color:#fff;background:var(--rose-2);vertical-align:2px}
.fct__hours li.is-today+li{border-color:transparent}

/* Contatos */
.fct__list{list-style:none;margin:0;padding:0;display:grid;gap:12px}
.fct__list a{display:flex;gap:14px;align-items:center;padding:12px 14px;border-radius:18px;text-decoration:none;color:inherit;background:#fff;box-shadow:inset 0 0 0 1px var(--line);
  transition:transform .4s cubic-bezier(.3,1.5,.5,1),box-shadow .4s}
.fct__list a:hover{transform:translateX(6px);box-shadow:inset 0 0 0 1px rgba(224,122,133,.4),0 14px 30px -18px rgba(74,42,29,.45);text-decoration:none;color:inherit}
.fct__list .ico{flex:none;width:44px;height:44px;border-radius:14px;display:grid;place-items:center;color:var(--rose-2);background:rgba(224,122,133,.12);
  transition:background .35s,color .35s,transform .5s cubic-bezier(.3,1.6,.5,1)}
.fct__list a:hover .ico{background:var(--rose-2);color:#fff;transform:rotate(-10deg)}
.fct__list a.wa .ico{color:var(--wa-2);background:rgba(37,211,102,.12)}
.fct__list a.wa:hover .ico{background:var(--wa-2);color:#fff}
.fct__list .ico svg{width:20px;height:20px}
.fct__list small{display:block;font-size:10.5px;letter-spacing:.16em;text-transform:uppercase;color:var(--muted)}
.fct__list span.v{display:block;font-size:14.5px;font-weight:500;line-height:1.45;color:var(--choco);word-break:break-word}
.fct__list .go{margin-left:auto;flex:none;width:18px;height:18px;color:var(--muted);transition:transform .4s,color .3s}
.fct__list a:hover .go{transform:translateX(4px);color:var(--rose-2)}

/* Mapa */
.fct__map{position:relative;height:220px;border-radius:22px;overflow:hidden;margin-top:18px;background:#f3d9a4}
.fct__map iframe{position:absolute;inset:0;width:100%;height:100%;border:0;filter:grayscale(.5) sepia(.2);transition:filter .6s}
.fct__map:hover iframe{filter:none}
.fct__map a{position:absolute;left:12px;bottom:12px;display:inline-flex;align-items:center;gap:8px;padding:9px 16px;border-radius:50px;font-size:12.5px;font-weight:600;
  color:#fff;text-decoration:none;background:var(--choco);box-shadow:0 10px 20px -8px rgba(42,23,16,.6);transition:transform .35s cubic-bezier(.3,1.6,.5,1)}
.fct__map a:hover{color:#fff;text-decoration:none;transform:translateY(-2px)}
.fct__map a svg{width:15px;height:15px}

/* Formulário */
.fct__formcard{position:sticky;top:100px;padding:38px;overflow:hidden}
.fct__formcard::before{content:"";position:absolute;right:-90px;top:-90px;width:240px;height:240px;border-radius:50%;border:2px dashed rgba(217,176,108,.4);animation:fctSpin 40s linear infinite}
@keyframes fctSpin{to{transform:rotate(360deg)}}
.fct__form{position:relative;display:grid;gap:18px}
.fct__row{display:grid;grid-template-columns:1fr 1fr;gap:18px}
.fct__field{position:relative}
.fct__field input,.fct__field textarea{width:100%;font-family:inherit;font-size:15px;color:var(--choco);background:#fff;border:1px solid var(--line);border-radius:16px;
  padding:24px 18px 10px;outline:none;transition:border-color .3s,box-shadow .3s;resize:vertical}
.fct__field textarea{min-height:150px}
.fct__field label{position:absolute;left:19px;top:18px;font-size:15px;color:var(--muted);pointer-events:none;transform-origin:0 0;transition:transform .25s cubic-bezier(.2,.7,.2,1),color .25s}
.fct__field input:focus,.fct__field textarea:focus{border-color:var(--rose);box-shadow:0 0 0 4px rgba(224,122,133,.15)}
.fct__field input:focus+label,.fct__field input:not(:placeholder-shown)+label,
.fct__field textarea:focus+label,.fct__field textarea:not(:placeholder-shown)+label{transform:translateY(-11px) scale(.75);color:var(--rose-2)}
.fct__field input:not(:placeholder-shown):valid{border-color:rgba(63,143,90,.4)}
.fct__count{position:absolute;right:14px;bottom:10px;font-size:11.5px;color:var(--muted);pointer-events:none}

.fct__topics legend{font-size:13px;font-weight:600;color:var(--choco-2);margin:0 0 10px;padding:0}
.fct__topics{border:0;margin:0;padding:0}
.fct__chips{display:flex;flex-wrap:wrap;gap:8px}
.fct__chip{position:relative;cursor:pointer}
.fct__chip input{position:absolute;opacity:0;width:1px;height:1px}
.fct__chip span{display:inline-flex;align-items:center;gap:6px;padding:9px 16px;border-radius:50px;font-size:13.5px;font-weight:500;color:var(--choco-2);background:#fff;
  box-shadow:inset 0 0 0 1px var(--line);transition:background .3s,color .3s,box-shadow .3s,transform .35s cubic-bezier(.3,1.6,.5,1)}
.fct__chip span::before{content:"";width:0;height:14px;border-radius:50%;
  background:#fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23b94e5c' stroke-width='4' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M5 12l5 5L20 7'/%3E%3C/svg%3E") center/9px no-repeat;
  transition:width .3s cubic-bezier(.3,1.6,.5,1)}
.fct__chip:hover span{transform:translateY(-2px)}
.fct__chip input:checked+span{color:#fff;background:linear-gradient(135deg,var(--rose),var(--rose-2));box-shadow:0 10px 20px -10px rgba(185,78,92,.8)}
.fct__chip input:checked+span::before{width:14px}
.fct__chip input:focus-visible+span{outline:2px solid var(--rose-2);outline-offset:2px}

.fct__actions{display:flex;align-items:center;gap:16px;flex-wrap:wrap}
.fct__send{position:relative;display:inline-flex;align-items:center;justify-content:center;gap:10px;flex:1 1 220px;padding:17px 26px;border:0;border-radius:16px;cursor:pointer;overflow:hidden;
  font-family:inherit;font-size:15px;font-weight:600;color:#fff;background:linear-gradient(135deg,var(--rose),var(--rose-2));box-shadow:0 18px 36px -16px rgba(185,78,92,.8);
  transition:transform .35s cubic-bezier(.3,1.6,.5,1),box-shadow .35s,opacity .3s}
.fct__send:hover{transform:translateY(-3px);box-shadow:0 24px 44px -16px rgba(185,78,92,.95)}
.fct__send svg{width:18px;height:18px;transition:transform .5s cubic-bezier(.3,1.6,.5,1)}
.fct__send:hover svg{transform:translate(4px,-4px) rotate(10deg)}
.fct__send .spin{display:none;width:18px;height:18px;border-radius:50%;border:2px solid rgba(255,255,255,.35);border-top-color:#fff;animation:fctSpin .8s linear infinite}
.fct__send.is-loading{pointer-events:none;opacity:.85}
.fct__send.is-loading .spin{display:block}
.fct__send.is-loading svg{display:none}
.fct__or{font-size:13px;color:var(--muted)}
.fct__wa{display:inline-flex;align-items:center;gap:8px;padding:15px 20px;border-radius:16px;font-size:14px;font-weight:600;text-decoration:none;color:var(--wa-2);
  background:rgba(37,211,102,.1);box-shadow:inset 0 0 0 1px rgba(18,140,74,.25);transition:background .3s,color .3s,transform .35s cubic-bezier(.3,1.6,.5,1)}
.fct__wa:hover{color:#fff;background:var(--wa-2);text-decoration:none;transform:translateY(-3px)}
.fct__wa svg{width:20px;height:20px}
.fct__note{margin:0;font-size:12.5px;color:var(--muted)}

.fct__alert{display:flex;gap:12px;align-items:flex-start;padding:14px 16px;border-radius:14px;font-size:14px;line-height:1.5;animation:fctIn .6s cubic-bezier(.3,1.5,.5,1)}
.fct__alert svg{flex:none;width:20px;height:20px;margin-top:1px}
.fct__alert--ok{background:rgba(63,143,90,.12);color:#2f6e45;border:1px solid rgba(63,143,90,.35)}
.fct__alert--err{background:rgba(217,98,58,.1);color:#a8431f;border:1px solid rgba(217,98,58,.35)}
@keyframes fctIn{from{opacity:0;transform:translateY(-10px) scale(.96)}}

/* Revelar */
.fct--js [data-reveal]{opacity:0;transform:translateY(50px);transition:opacity 1s cubic-bezier(.2,.7,.2,1) var(--d,0s),transform 1s cubic-bezier(.2,.7,.2,1) var(--d,0s)}
.fct--js [data-reveal].is-in{opacity:1;transform:none}

@media (max-width:991px){.fct__wrap{grid-template-columns:1fr}.fct__formcard{order:-1;position:relative;top:0}}
@media (max-width:560px){
  .fct{padding:90px 0 100px}
  .fct__card{padding:22px}
  .fct__formcard{padding:26px 20px}
  .fct__row{grid-template-columns:1fr}
  .fct__or{display:none}
  .fct__wa{flex:1 1 100%;justify-content:center}
}
@media (prefers-reduced-motion:reduce){
  .fct *,.fct *::before,.fct *::after{animation:none!important;transition:none!important}
  .fct--js [data-reveal]{opacity:1;transform:none}
}
</style>

<section class="fct" id="fale-conosco">
    <div class="fct__blob fct__blob--1"></div>
    <div class="fct__blob fct__blob--2"></div>

    <div class="fct__head">
        <span class="fct__eyebrow" data-reveal>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 11V6a2 2 0 0 0-4 0v5"/><path d="M14 10V4a2 2 0 0 0-4 0v6"/><path d="M10 10.5V6a2 2 0 0 0-4 0v8"/><path d="M18 8a2 2 0 1 1 4 0v6a8 8 0 0 1-8 8h-2c-2.8 0-4.5-.9-6-2.4l-3.6-3.6a2 2 0 0 1 2.8-2.8L7 15"/></svg>
            {{ conteudo('contato.topo.selo') }}
        </span>
        <h2 class="fct__title" data-reveal style="--d:.1s">{{ conteudo_html('contato.topo.titulo') }}</h2>
        <p class="fct__sub" data-reveal style="--d:.2s">{{ conteudo_html('contato.topo.texto') }}</p>
    </div>

    <div class="fct__wrap">
        <!-- Lateral: horários + contatos -->
        <div class="fct__side">
            <div class="fct__card" data-reveal style="--d:.1s">
                <h3 class="fct__h">
                    <span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></span>
                    {{ conteudo('contato.horarios.titulo') }}
                </h3>
                <div class="fct__status" aria-live="polite">
                    <i></i>
                    <span><strong class="fct__status-t">Confira nossos horários</strong><small class="fct__status-s">Horário de Brasília</small></span>
                </div>
                <ul class="fct__hours" data-horarios='@json($horarios)'>
                    @foreach ($horarios as $h)
                        <li data-dia="{{ $h['dia'] }}">
                            <b>{{ $h['nome'] }}</b>
                            @if ($h['abre'])
                                <span>{{ $h['abre'] }} – {{ $h['fecha'] }}</span>
                            @else
                                <span class="off">Fechado</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="fct__card" data-reveal style="--d:.2s">
                <h3 class="fct__h">
                    <span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1.9.4 1.8.7 2.7a2 2 0 0 1-.5 2.1L8 9.8a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.7.7a2 2 0 0 1 1.7 2z"/></svg></span>
                    {{ conteudo('contato.topo.contatos_titulo') }}
                </h3>
                {{-- Dados da loja: config/services.php ('loja') --}}
                <ul class="fct__list">
                    <li>
                        <a href="https://wa.me/{{ $loja['whatsapp'] }}?text={{ rawurlencode(conteudo('contato.formulario.mensagem_whatsapp')) }}" target="_blank" rel="noopener" class="wa">
                            <span class="ico"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.5 14.4c-.3-.1-1.8-.9-2-1-.3-.1-.5-.1-.7.1-.2.3-.8 1-.9 1.2-.2.2-.3.2-.6.1-.3-.1-1.3-.5-2.4-1.5-.9-.8-1.5-1.8-1.7-2.1-.2-.3 0-.5.1-.6l.4-.5c.2-.2.2-.3.3-.5.1-.2 0-.4 0-.5l-.9-2.2c-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.5s1.1 2.9 1.2 3.1c.1.2 2.1 3.2 5.1 4.5.7.3 1.3.5 1.7.6.7.2 1.4.2 1.9.1.6-.1 1.8-.7 2-1.4.3-.7.3-1.3.2-1.4-.1-.2-.3-.3-.6-.4zM12 21.8c-1.8 0-3.5-.5-5-1.4l-.4-.2-3.7 1 1-3.6-.2-.4c-1-1.6-1.5-3.4-1.5-5.2C2.2 6.6 6.6 2.2 12 2.2c2.6 0 5.1 1 6.9 2.9 1.9 1.9 2.9 4.3 2.9 6.9 0 5.4-4.4 9.8-9.8 9.8zm8.4-18.2C18.2 1.3 15.2 0 12 0 5.4 0 0 5.4 0 12c0 2.1.6 4.2 1.6 6L0 24l6.2-1.6c1.8 1 3.8 1.5 5.8 1.5 6.6 0 12-5.4 12-12 0-3.2-1.2-6.2-3.6-8.3z"/></svg></span>
                            <span><small>WhatsApp</small><span class="v">{{ $loja['telefone'] }}</span></span>
                            <svg class="go" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                        </a>
                    </li>
                    <li>
                        <a href="mailto:{{ $loja['email'] }}">
                            <span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="3"/><path d="M22 7l-10 6L2 7"/></svg></span>
                            <span><small>E-mail</small><span class="v">{{ $loja['email'] }}</span></span>
                            <svg class="go" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                        </a>
                    </li>
                    <li>
                        <a href="{{ $mapaLink }}" target="_blank" rel="noopener">
                            <span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s7-7.8 7-13a7 7 0 0 0-14 0c0 5.2 7 13 7 13z"/><circle cx="12" cy="9" r="2.5"/></svg></span>
                            <span><small>Endereço</small><span class="v">{{ $loja['endereco'] }}, {{ $loja['bairro'] }}<br>{{ $loja['cidade'] }} - CEP {{ $loja['cep'] }}</span></span>
                            <svg class="go" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                        </a>
                    </li>
                </ul>
                <div class="fct__map">
                    <iframe src="{{ $mapaEmbed }}" title="Mapa: como chegar" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <a href="{{ $mapaLink }}" target="_blank" rel="noopener">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 11l19-9-9 19-2-8z"/></svg>
                        Como chegar
                    </a>
                </div>
            </div>
        </div>

        <!-- Formulário -->
        <div class="fct__card fct__formcard" data-reveal style="--d:.15s">
            <h3 class="fct__h">
                <span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></span>
                {{ conteudo('contato.formulario.titulo') }}
            </h3>

            {{-- id diferente de "email-form" para o script.js do modelo não interceptar o envio --}}
            <form action="{{ route('contato.enviar') }}#fale-conosco" method="post" id="form-contato" class="fct__form">
                @csrf
                <input type="hidden" name="origem" value="contato">

                @if (session('sucesso_contato'))
                    <div class="fct__alert fct__alert--ok" role="status">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M8 12l3 3 5-6"/></svg>
                        <span>{{ session('sucesso_contato') }}</span>
                    </div>
                @endif
                @if ($errors->contato->any())
                    <div class="fct__alert fct__alert--err" role="alert">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 8v5M12 16.5v.5"/></svg>
                        <span>{{ $errors->contato->first() }}</span>
                    </div>
                @endif

                <div class="fct__field">
                    <input type="text" id="fct-nome" name="nome_contato" placeholder=" " maxlength="50" required autocomplete="name"
                        value="{{ old('origem') === 'contato' ? old('nome_contato') : '' }}">
                    <label for="fct-nome">Seu nome *</label>
                </div>

                <div class="fct__row">
                    <div class="fct__field">
                        <input type="email" id="fct-email" name="email_contato" placeholder=" " maxlength="80" required autocomplete="email"
                            value="{{ old('origem') === 'contato' ? old('email_contato') : '' }}">
                        <label for="fct-email">Seu e-mail *</label>
                    </div>
                    <div class="fct__field">
                        <input type="text" inputmode="tel" id="fct-tel" name="telefone_contato" placeholder=" " maxlength="14" required autocomplete="tel"
                            value="{{ old('origem') === 'contato' ? old('telefone_contato') : '' }}">
                        <label for="fct-tel">Telefone / WhatsApp *</label>
                    </div>
                </div>

                <fieldset class="fct__topics">
                    <legend>Assunto *</legend>
                    <div class="fct__chips">
                        @foreach ($assuntos as $assunto)
                            <label class="fct__chip">
                                <input type="radio" name="assunto_contato" value="{{ $assunto }}" required {{ $assuntoAntigo === $assunto ? 'checked' : '' }}>
                                <span>{{ $assunto }}</span>
                            </label>
                        @endforeach
                    </div>
                </fieldset>

                <div class="fct__field">
                    <textarea id="fct-msg" name="mensagem_contato" placeholder=" " maxlength="2000" required>{{ old('origem') === 'contato' ? old('mensagem_contato') : '' }}</textarea>
                    <label for="fct-msg">Sua mensagem *</label>
                    <span class="fct__count"><b>0</b>/2000</span>
                </div>

                <div class="fct__actions">
                    <button class="fct__send" type="submit">
                        <span class="spin" aria-hidden="true"></span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 2L11 13"/><path d="M22 2l-7 20-4-9-9-4z"/></svg>
                        {{ conteudo('contato.formulario.botao') }}
                    </button>
                    <span class="fct__or">ou</span>
                    <a href="https://wa.me/{{ $loja['whatsapp'] }}?text={{ rawurlencode(conteudo('contato.formulario.mensagem_whatsapp')) }}" target="_blank" rel="noopener" class="fct__wa">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.5 14.4c-.3-.1-1.8-.9-2-1-.3-.1-.5-.1-.7.1-.2.3-.8 1-.9 1.2-.2.2-.3.2-.6.1-.3-.1-1.3-.5-2.4-1.5-.9-.8-1.5-1.8-1.7-2.1-.2-.3 0-.5.1-.6l.4-.5c.2-.2.2-.3.3-.5.1-.2 0-.4 0-.5l-.9-2.2c-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.5s1.1 2.9 1.2 3.1c.1.2 2.1 3.2 5.1 4.5.7.3 1.3.5 1.7.6.7.2 1.4.2 1.9.1.6-.1 1.8-.7 2-1.4.3-.7.3-1.3.2-1.4-.1-.2-.3-.3-.6-.4zM12 21.8c-1.8 0-3.5-.5-5-1.4l-.4-.2-3.7 1 1-3.6-.2-.4c-1-1.6-1.5-3.4-1.5-5.2C2.2 6.6 6.6 2.2 12 2.2c2.6 0 5.1 1 6.9 2.9 1.9 1.9 2.9 4.3 2.9 6.9 0 5.4-4.4 9.8-9.8 9.8zm8.4-18.2C18.2 1.3 15.2 0 12 0 5.4 0 0 5.4 0 12c0 2.1.6 4.2 1.6 6L0 24l6.2-1.6c1.8 1 3.8 1.5 5.8 1.5 6.6 0 12-5.4 12-12 0-3.2-1.2-6.2-3.6-8.3z"/></svg>
                        Chamar no WhatsApp
                    </a>
                </div>
                <p class="fct__note">{{ conteudo('contato.formulario.nota') }}</p>
            </form>
        </div>
    </div>
</section>

<script>
(function () {
    var root = document.getElementById('fale-conosco');
    if (!root) return;
    root.classList.add('fct--js');

    var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('is-in'); io.unobserve(e.target); } });
    }, { threshold: 0.15 });
    root.querySelectorAll('[data-reveal]').forEach(function (el) { io.observe(el); });
    if (location.hash === '#fale-conosco') root.querySelectorAll('[data-reveal]').forEach(function (el) { el.classList.add('is-in'); });

    // Aberto agora / Fechado (horário de Brasília)
    var list = root.querySelector('.fct__hours');
    var horarios = [];
    try { horarios = JSON.parse(list.dataset.horarios || '[]'); } catch (e) {}
    var box = root.querySelector('.fct__status'), t = root.querySelector('.fct__status-t'), s = root.querySelector('.fct__status-s');
    var nomes = ['domingo', 'segunda', 'terça', 'quarta', 'quinta', 'sexta', 'sábado'];
    function toMin(h) { var p = h.split(':'); return +p[0] * 60 + +p[1]; }
    function agoraBR() {
        var parts = new Intl.DateTimeFormat('en-US', { timeZone: 'America/Sao_Paulo', weekday: 'short', hour: '2-digit', minute: '2-digit', hour12: false }).formatToParts(new Date());
        var o = {}; parts.forEach(function (p) { o[p.type] = p.value; });
        return { dia: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'].indexOf(o.weekday), min: (+o.hour % 24) * 60 + +o.minute };
    }
    function hor(d) { for (var i = 0; i < horarios.length; i++) if (+horarios[i].dia === d) return horarios[i]; return null; }
    function status() {
        if (!horarios.length) return;
        var n = agoraBR();
        list.querySelectorAll('li').forEach(function (li) { li.classList.toggle('is-today', +li.dataset.dia === n.dia); });
        var h = hor(n.dia);
        if (h && h.abre && n.min >= toMin(h.abre) && n.min < toMin(h.fecha)) {
            box.className = 'fct__status is-open';
            t.textContent = 'Aberto agora';
            var falta = toMin(h.fecha) - n.min;
            s.textContent = falta <= 60 ? 'Fecha em ' + falta + ' min, às ' + h.fecha : 'Hoje até as ' + h.fecha;
            return;
        }
        box.className = 'fct__status is-closed';
        t.textContent = 'Fechado no momento';
        if (h && h.abre && n.min < toMin(h.abre)) { s.textContent = 'Abre hoje às ' + h.abre; return; }
        for (var k = 1; k <= 7; k++) {
            var d = (n.dia + k) % 7, p = hor(d);
            if (p && p.abre) { s.textContent = 'Abre ' + (k === 1 ? 'amanhã' : nomes[d]) + ' às ' + p.abre; return; }
        }
        s.textContent = 'Fale com a gente pelo WhatsApp';
    }
    status(); setInterval(status, 60000);

    // Contador de caracteres
    var msg = root.querySelector('#fct-msg'), cnt = root.querySelector('.fct__count b');
    function upd() { cnt.textContent = msg.value.length; }
    msg.addEventListener('input', upd); upd();

    // Botão "Enviar" com carregando
    var form = root.querySelector('#form-contato');
    form.addEventListener('submit', function () { if (form.checkValidity()) form.querySelector('.fct__send').classList.add('is-loading'); });
})();
</script>
<!--End Contact Section -->