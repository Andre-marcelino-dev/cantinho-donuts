{{-- Campos do formulário de kit (usado no "Novo" e no "Editar") --}}
@php
    $marcados = $kit
        ? $kit->ProdutosKit->pluck('id_produto')->all()
        : array_map('intval', (array) old('produtos', []));
    $idForm = $kit ? 'editar' . $kit->id_kit : 'novo';
@endphp

<div class="row">
    <div class="col-md-8 mb-3">
        <label class="form-label">Nome do kit</label>
        <input type="text" class="form-control" name="nome_kit" maxlength="30" required
            value="{{ $kit->nome_kit ?? old('nome_kit') }}">
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Etiqueta</label>
        <select class="form-select" name="destaque_kit" required>
            @foreach ($destaques as $valor => $rotulo)
                <option value="{{ $valor }}" {{ ($kit->destaque_kit ?? old('destaque_kit', 'NENHUM')) === $valor ? 'selected' : '' }}>{{ $rotulo }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Descrição</label>
    <textarea class="form-control" name="descricao_kit" rows="2" maxlength="1000" required>{{ $kit->descricao_kit ?? old('descricao_kit') }}</textarea>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label">Preço (R$)</label>
        <input type="text" inputmode="decimal" class="form-control" name="preco_kit" required placeholder="49,90"
            value="{{ $kit ? number_format((float) $kit->preco_kit, 2, ',', '') : old('preco_kit') }}">
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Preço promocional (opcional)</label>
        <input type="text" inputmode="decimal" class="form-control" name="preco_promocional_kit" placeholder="39,90"
            value="{{ $kit && $kit->preco_promocional_kit ? number_format((float) $kit->preco_promocional_kit, 2, ',', '') : old('preco_promocional_kit') }}">
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">WhatsApp do botão</label>
        <input type="text" inputmode="tel" class="form-control" name="whatsapp_kit" maxlength="20"
            value="{{ $kit->whatsapp_kit ?? old('whatsapp_kit', $whatsappLoja) }}">
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Produtos do kit</label>
    <div class="border rounded p-2" style="max-height: 180px; overflow-y: auto;">
        @foreach ($produtos as $produto)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="produtos[]" value="{{ $produto->id_produto }}"
                    id="produto-{{ $idForm }}-{{ $produto->id_produto }}"
                    {{ in_array($produto->id_produto, $marcados) ? 'checked' : '' }}>
                <label class="form-check-label" for="produto-{{ $idForm }}-{{ $produto->id_produto }}">
                    {{ $produto->nome_produto }}
                    <span class="text-secondary">— R$ {{ number_format((float) $produto->valor_produto, 2, ',', '.') }}</span>
                </label>
            </div>
        @endforeach
    </div>
</div>

<div class="mb-3">
    <label class="form-label">{{ $kit ? 'Trocar foto (opcional)' : 'Foto (opcional)' }}</label>
    <input type="file" class="form-control" name="foto_kit" accept="image/jpeg,image/png,image/webp">
    <div class="form-text">
        JPG, PNG ou WEBP, até 2 MB.
        {{ $kit ? 'Deixe vazio para manter a foto atual.' : 'Sem foto, o kit usa a foto do primeiro produto.' }}
    </div>
</div>
