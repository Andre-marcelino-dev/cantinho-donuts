{{-- Campos do formulário de cupom (usado no "Novo" e no "Editar") --}}
@php
    $hoje = now('America/Sao_Paulo')->toDateString();
@endphp

<div class="mb-3">
    <label class="form-label">Código</label>
    <input type="text" class="form-control text-uppercase" name="codigo_cupom" maxlength="20" required
        pattern="[A-Za-z0-9]+" title="Só letras e números, sem espaços"
        placeholder="Ex.: THEGUSTA10"
        value="{{ $cupom->codigo_cupom ?? old('codigo_cupom') }}">
</div>

<div class="row">
    <div class="col-6 mb-3">
        <label class="form-label">Desconto (%)</label>
        <input type="number" class="form-control" name="valor_desconto_cupom" min="1" max="100" step="0.01" required
            placeholder="10"
            value="{{ $cupom->valor_desconto_cupom ?? old('valor_desconto_cupom') }}">
    </div>
    <div class="col-6 mb-3">
        <label class="form-label">Status</label>
        <select class="form-select" name="status_cupom" required>
            @foreach (['ATIVO', 'INATIVO'] as $status)
                <option value="{{ $status }}" {{ ($cupom->status_cupom ?? 'ATIVO') === $status ? 'selected' : '' }}>{{ $status }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row">
    <div class="col-6 mb-3">
        <label class="form-label">Vale a partir de</label>
        <input type="date" class="form-control" name="data_inicio_cupom" required
            value="{{ isset($cupom) ? substr($cupom->data_inicio_cupom, 0, 10) : old('data_inicio_cupom', $hoje) }}">
    </div>
    <div class="col-6 mb-3">
        <label class="form-label">Vale até</label>
        <input type="date" class="form-control" name="data_fim_cupom" required
            value="{{ isset($cupom) ? substr($cupom->data_fim_cupom, 0, 10) : old('data_fim_cupom') }}">
    </div>
</div>
