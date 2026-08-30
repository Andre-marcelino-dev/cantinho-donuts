@if ($listaEvento->count() > 0)
<section class="feira-livre-section">
    <style>
        .feira-livre-section {
            padding: 50px 15px;
            background: #f7f1ea;
        }

        .feira-livre-section .feira-livre-wrap {
            max-width: 1300px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 24px;
            align-items: start;
        }

        .feira-livre-card {
            width: 100%;
            background: #fffaf4;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
            font-family: 'Poppins', Arial, sans-serif;
        }

        .feira-livre-card .fl-header {
            background: #4a1f1c;
            color: #fff;
            padding: 22px 24px 18px;
        }

        .feira-livre-card .fl-eyebrow {
            display: block;
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #e8c49a;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .feira-livre-card .fl-titulo {
            font-family: Georgia, 'Times New Roman', serif;
            font-style: italic;
            font-size: 28px;
            margin: 0 0 10px;
            line-height: 1.2;
        }

        .feira-livre-card .fl-subtitulo {
            font-size: 14px;
            margin: 0;
            color: #f3e6d8;
        }

        .feira-livre-card .fl-subtitulo strong {
            color: #fff;
        }

        .feira-livre-card .fl-imagem {
            position: relative;
            background: #f6d9d3;
            min-height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-size: cover;
            background-position: center;
        }

        .feira-livre-card .fl-imagem .fl-local-btn {
            position: absolute;
            bottom: 14px;
            left: 50%;
            transform: translateX(-50%);
            background: #3f6b45;
            color: #fff;
            font-size: 12px;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 30px;
            text-decoration: none;
            white-space: nowrap;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .feira-livre-card .fl-imagem .fl-local-btn:hover {
            opacity: 0.9;
            color: #fff;
        }

        .feira-livre-card .fl-info {
            padding: 22px 24px 6px;
        }

        .feira-livre-card .fl-info-row {
            display: flex;
            gap: 12px;
            margin-bottom: 16px;
        }

        .feira-livre-card .fl-info-row .fl-icon {
            color: #b4482f;
            font-size: 16px;
            width: 20px;
            text-align: center;
            margin-top: 2px;
        }

        .feira-livre-card .fl-info-row .fl-label {
            display: block;
            font-size: 10px;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #a08d7d;
            margin-bottom: 2px;
        }

        .feira-livre-card .fl-info-row .fl-valor {
            font-size: 15px;
            font-weight: 600;
            color: #3a2a22;
        }

        .feira-livre-card .fl-tags-wrap {
            border-top: 2px dotted #e3d4c4;
            padding: 18px 24px 22px;
        }

        .feira-livre-card .fl-tags-title {
            font-family: Georgia, 'Times New Roman', serif;
            font-style: italic;
            font-size: 16px;
            color: #b4482f;
            margin: 0 0 12px;
        }

        .feira-livre-card .fl-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 14px;
        }

        .feira-livre-card .fl-tag {
            border: 1px solid #e3d4c4;
            border-radius: 20px;
            padding: 6px 14px;
            font-size: 12px;
            color: #6b5a4c;
            background: #fff;
        }

        .feira-livre-card .fl-rodape {
            font-size: 13px;
            color: #a08d7d;
        }
    </style>

    <div class="feira-livre-wrap">
        @foreach ($listaEvento as $linha)
        <div class="feira-livre-card">
            <div class="fl-header">
                <span class="fl-eyebrow">— {{ $linha->titulo_evento }}</span>
                <h3 class="fl-titulo">{{ $linha->nome_evento }}</h3>
                @if ($linha->descricao_evento)
                <p class="fl-subtitulo">{{ $linha->descricao_evento }}</p>
                @endif
            </div>
            <!-- 
            <div class="mapa experience-map-card">

            <div class="fl-imagem"
                @if ($linha->foto_evento) style="background-image: url('{{ asset('davilla/images/' . $linha->foto_evento) }}')" @endif>

                @if ($linha->link_local_evento)
                <a href="{{ $linha->link_local_evento }}" target="_blank" rel="noopener" class="fl-local-btn">
                    📍 LOCAL DO EVENTO
                </a>
                @else
                <span class="fl-local-btn">📍 LOCAL DO EVENTO</span>
                @endif
            </div> 
        </div>
        -->
        <div class="fl-imagem">
                <iframe  width="600" height="300" style="border:0;" allowfullscreen="" loading="lazy"  src="{{ $linha->link_local_evento }}" title="Local do evento" allowfullscreen loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                
                <a href="{{ $linha->link_local_evento }}" target="_blank" rel="noopener" class="fl-local-btn">
                    📍 LOCAL DO EVENTO
                </a>
          
            </div>

            <div class="fl-info">
                <div class="fl-info-row">
                    <span class="fl-icon">📅</span>
                    <div>
                        <span class="fl-label">Data</span>
                        <span class="fl-valor">{{ ucfirst(\Carbon\Carbon::parse($linha->data_evento)->locale('pt_BR')->translatedFormat('l, d \d\e F')) }}</span>
                    </div>
                </div>
                <div class="fl-info-row">
                    <span class="fl-icon">🕐</span>
                    <div>
                        <span class="fl-label">Horário</span>
                        <span class="fl-valor">{{ $linha->horario_evento }}</span>
                    </div>
                </div>
                <div class="fl-info-row">
                    <span class="fl-icon">📍</span>
                    <div>
                        <span class="fl-label">Endereço</span>
                        <span class="fl-valor">{{ $linha->endereco_evento }}</span>
                    </div>
                </div>
            </div>

            @if ($linha->tags_array)
            <div class="fl-tags-wrap">
                <p class="fl-tags-title">Hoje na barraca</p>
                <div class="fl-tags">
                    @foreach ($linha->tags_array as $tag)
                    <span class="fl-tag">{{ $tag }}</span>
                    @endforeach
                </div>
                <p class="fl-rodape">Vem provar 🤩</p>
            </div>
            @endif
        </div>
        @endforeach
    </div>
</section>
@endif