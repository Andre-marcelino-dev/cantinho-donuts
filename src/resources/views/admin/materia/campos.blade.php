{{-- Campos do formulário de matéria-prima (usado no "Nova" e no "Editar") --}}
@php
    $fornecedorAtual = $materia->id_fornecedor ?? (int) old('id_fornecedor');
    $unidadeAtual = $materia->unid_med_materia_prima ?? old('unid_med_materia_prima', 'KG');
@endphp

<div class="mb-3">
    <label class="form-label">Nome</label>
    <input type="text" class="form-control" name="nome_materia_prima" maxlength="30" required
        value="{{ $materia->nome_materia_prima ?? old('nome_materia_prima') }}">
</div>

<div class="row">
    <div class="col-md-7 mb-3">
        <label class="form-label">Fornecedor</label>
        <select class="form-select" name="id_fornecedor" required>
            <option value="">Selecione</option>
            @foreach ($fornecedores as $fornecedor)
                <option value="{{ $fornecedor->id_fornecedor }}" {{ $fornecedorAtual === $fornecedor->id_fornecedor ? 'selected' : '' }}>
                    {{ $fornecedor->nome_fornecedor }}
                </option>
            @endforeach
            {{-- Mantém o fornecedor atual na lista mesmo se ele estiver inativo --}}
            @if ($materia && $materia->fornecedor && $materia->fornecedor->status_fornecedor !== 'ATIVO')
                <option value="{{ $materia->id_fornecedor }}" selected>{{ $materia->fornecedor->nome_fornecedor }} (inativo)</option>
            @endif
        </select>
    </div>
    <div class="col-md-5 mb-3">
        <label class="form-label">Unidade</label>
        <select class="form-select" name="unid_med_materia_prima" required>
            @foreach ($unidades as $sigla => $rotulo)
                <option value="{{ $sigla }}" {{ $unidadeAtual === $sigla ? 'selected' : '' }}>{{ $rotulo }}</option>
            @endforeach
        </select>
    </div>
</div>
