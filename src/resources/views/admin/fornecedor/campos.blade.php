{{-- Campos do formulário de fornecedor (usado no "Novo" e no "Editar") --}}
@php $status = $fornecedor->status_fornecedor ?? old('status_fornecedor', 'ATIVO'); @endphp

<div class="mb-3">
    <label class="form-label">Nome do fornecedor</label>
    <input type="text" class="form-control" name="nome_fornecedor" maxlength="50" required
        value="{{ $fornecedor->nome_fornecedor ?? old('nome_fornecedor') }}">
</div>

<div class="mb-3">
    <label class="form-label">Representante</label>
    <input type="text" class="form-control" name="representante_fornecedor" maxlength="50" required
        value="{{ $fornecedor->representante_fornecedor ?? old('representante_fornecedor') }}">
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">E-mail</label>
        <input type="email" class="form-control" name="email_fornecedor" maxlength="80" required
            value="{{ $fornecedor->email_fornecedor ?? old('email_fornecedor') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Telefone</label>
        <input type="text" inputmode="tel" class="form-control" name="telefone_fornecedor" maxlength="20" required
            placeholder="(11) 98765-4321"
            value="{{ $fornecedor ? $telefone($fornecedor->telefone_fornecedor) : old('telefone_fornecedor') }}">
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Status</label>
    <select class="form-select" name="status_fornecedor" required>
        @foreach (['ATIVO', 'INATIVO'] as $opcao)
            <option value="{{ $opcao }}" {{ $status === $opcao ? 'selected' : '' }}>{{ $opcao }}</option>
        @endforeach
    </select>
</div>
