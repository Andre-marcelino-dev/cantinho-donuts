{{-- Campos do formulário de zona de entrega (usado no "Nova" e no "Editar") --}}
@php
    $num = fn ($v) => $v === null ? '' : rtrim(rtrim(number_format((float) $v, 2, ',', ''), '0'), ',');
    $bairrosTexto = $zona
        ? $zona->bairros->map(fn ($b) => $b->nome_bairro_entrega . ($b->faixaCep() ? ' | ' . $b->faixaCep() : ''))->implode("\n")
        : old('bairros');
@endphp

<div class="row">
    <div class="col-md-5 mb-3">
        <label class="form-label">Nome</label>
        <input type="text" class="form-control" name="nome_zona_entrega" maxlength="30" required placeholder="Ex.: Zona 1"
            value="{{ $zona->nome_zona_entrega ?? old('nome_zona_entrega') }}">
    </div>
    <div class="col-md-7 mb-3">
        <label class="form-label">Apelido <small class="text-secondary">(aparece no card do site)</small></label>
        <input type="text" class="form-control" name="apelido_zona_entrega" maxlength="40" placeholder="Ex.: Pertinho da gente"
            value="{{ $zona->apelido_zona_entrega ?? old('apelido_zona_entrega') }}">
    </div>
</div>

<div class="row">
    <div class="col-6 col-md-3 mb-3">
        <label class="form-label">De (km)</label>
        <input type="text" inputmode="decimal" class="form-control" name="km_min_zona_entrega" required placeholder="0"
            value="{{ $zona ? $num($zona->km_min_zona_entrega) : old('km_min_zona_entrega', '0') }}">
    </div>
    <div class="col-6 col-md-3 mb-3">
        <label class="form-label">Até (km)</label>
        <input type="text" inputmode="decimal" class="form-control" name="km_max_zona_entrega" required placeholder="3"
            value="{{ $zona ? $num($zona->km_max_zona_entrega) : old('km_max_zona_entrega') }}">
    </div>
    <div class="col-6 col-md-3 mb-3">
        <label class="form-label">Taxa (R$)</label>
        <input type="text" inputmode="decimal" class="form-control" name="taxa_zona_entrega" required placeholder="0 = grátis"
            value="{{ $zona ? number_format($zona->taxa_zona_entrega, 2, ',', '') : old('taxa_zona_entrega') }}">
    </div>
    <div class="col-6 col-md-3 mb-3">
        <label class="form-label">Prazo</label>
        <input type="text" class="form-control" name="prazo_zona_entrega" maxlength="30" required placeholder="40 a 60 min"
            value="{{ $zona->prazo_zona_entrega ?? old('prazo_zona_entrega') }}">
    </div>
</div>
<div class="form-text mb-3 mt-n2">
    Distância em <strong>linha reta</strong> da loja até o endereço. Pela rua costuma dar uns 30% a mais,
    então deixe uma folga (ex.: zona de "até 5 km de carro" ≈ até 4 km aqui).
</div>

<div class="row">
    <div class="col-6 mb-3">
        <label class="form-label">Cor do card</label>
        <select class="form-select" name="cor_zona_entrega" required>
            @foreach (\App\Models\ZonaEntrega::CORES as $chave => [$rotulo, $hex])
                <option value="{{ $chave }}" {{ ($zona->cor_zona_entrega ?? old('cor_zona_entrega', 'rose')) === $chave ? 'selected' : '' }}>{{ $rotulo }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-6 mb-3">
        <label class="form-label">Status</label>
        <select class="form-select" name="status_zona_entrega" required>
            @foreach (['ATIVO', 'INATIVO'] as $status)
                <option value="{{ $status }}" {{ ($zona->status_zona_entrega ?? old('status_zona_entrega', 'ATIVO')) === $status ? 'selected' : '' }}>{{ $status }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="mb-1">
    <label class="form-label">Bairros <small class="text-secondary">(um por linha)</small></label>
    <textarea class="form-control font-monospace" name="bairros" rows="7"
        placeholder="Parque Santa Rita&#10;Itaim Paulista | 08110-000 a 08159-999&#10;Vila Curuçá | 08030-000">{{ $bairrosTexto }}</textarea>
</div>
<div class="form-text mb-3">
    Aparecem como etiquetas no card da zona. Escreva o nome como os Correios usam: se o CEP do cliente for desse bairro, ele cai nesta zona.
    Opcional: depois de uma <code>|</code>, uma faixa de CEP (<code>08160-000 a 08169-999</code>) ou um CEP só. A faixa vale antes de tudo, inclusive da distância.
</div>
