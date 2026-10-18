{{-- MODAL EDITAR CLIENTE --}}
<div class="modal fade" id="modalEditarCliente{{ $linha->id_cliente }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Cliente: {{ $linha->nome_cliente }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{-- 🛠️ AJUSTADO: Adicionado enctype para permitir upload de arquivo na edição --}}
            <form method="POST" action="{{ route('admin.cliente.update', $linha->id_cliente) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">

                        {{-- 📸 NOVO: Campo de Foto com Preview da foto atual --}}
                        <div class="col-12">
                            <div class="row align-items-center bg-light p-3 border rounded mb-2">
                                <div class="col-md-2 text-center mb-2 mb-md-0">
                                    <div class="avatar-preview d-flex align-items-center justify-content-center border rounded bg-white"
                                        style="width: 70px; height: 70px; margin: 0 auto; overflow: hidden;">
                                        @if ($linha->foto_cliente)
                                     <img src="{{ asset('davilla/images/cliente/' . $linha->foto_cliente) }}"
                                        @else
                                            <i class="bi bi-person text-secondary" style="font-size: 2rem;"></i>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <label class="form-label fw-bold">Alterar Foto
                                        do Cliente</label>
                                    <input type="file" class="form-control" name="foto_cliente" accept="image/*">
                                    <div class="form-text">Deixe em branco para
                                        manter a foto atual. Formatos: JPG, PNG,
                                        WEBP.</div>
                                </div>
                            </div>
                        </div>

                        {{-- Nome do Cliente (Máx 50) --}}
                        <div class="col-md-8">
                            <label class="form-label">Nome do Cliente <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nome_cliente" required maxlength="50"
                                value="{{ $linha->nome_cliente }}">
                        </div>

                        {{-- Tipo --}}
                        <div class="col-md-4">
                            <label class="form-label">Tipo <span class="text-danger">*</span></label>
                            <select class="form-select" name="tipo_cliente" required>
                                <option value="PF" {{ $linha->tipo_cliente == 'PF' ? 'selected' : '' }}>
                                    Pessoa Física (PF)</option>
                                <option value="PJ" {{ $linha->tipo_cliente == 'PJ' ? 'selected' : '' }}>
                                    Pessoa Jurídica (PJ)</option>
                            </select>
                        </div>

                        {{-- CPF / CNPJ (Máx 18) --}}
                        <div class="col-md-6">
                            <label class="form-label">CPF / CNPJ <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="cpf_cnpj_cliente" required maxlength="18"
                                value="{{ $linha->cpf_cnpj_cliente }}">
                        </div>

                        {{-- Data de Nascimento --}}
                        <div class="col-md-6">
                            <label class="form-label">Data de Nascimento</label>
                            <input type="date" class="form-control" name="data_nasc_cliente"
                                value="{{ $linha->data_nasc_cliente?->format('Y-m-d') }}">
                        </div>

                        {{-- E-mail (Máx 80) --}}
                        <div class="col-md-6">
                            <label class="form-label">E-mail</label>
                            <input type="email" class="form-control" name="email_cliente" maxlength="80"
                                value="{{ $linha->email_cliente }}">
                        </div>

                        {{-- ☎️ NOVO: Campo de Telefone (Obrigatório conforme a regra do seu banco) --}}
                        <div class="col-md-6">
                            <label class="form-label">Telefone / Celular <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="telefone_cliente" required maxlength="14"
                                value="{{ $linha->telefone_cliente }}" placeholder="(00) 00000-0000">
                        </div>


                        {{-- Senha --}}
                        <div class="col-6 mb-3">
                            <label class="form-label">Senha</label>
                            <input type="password" class="form-control" name="senha_cliente" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Confirmar Senha</label>
                            <input type="password" class="form-control" name="senha_cliente_confirmation" required>
                        </div>

                        <hr class="text-muted my-2">
                        <h6>Endereço</h6>

                        {{-- CEP (Máx 9) --}}
                        <div class="col-md-4">
                            <label class="form-label">CEP</label>
                            <input type="text" class="form-control" name="cep_cliente" maxlength="9"
                                value="{{ $linha->cep_cliente }}">
                        </div>

                        {{-- Endereço (Máx 40) --}}
                        <div class="col-md-8">
                            <label class="form-label">Endereço</label>
                            <input type="text" class="form-control" name="endereco_cliente" maxlength="40"
                                value="{{ $linha->endereco_cliente }}">
                        </div>

                        {{-- Número (Máx 6) --}}
                        <div class="col-md-4">
                            <label class="form-label">Número</label>
                            <input type="text" class="form-control" name="numero_cliente" maxlength="6"
                                value="{{ $linha->numero_cliente }}">
                        </div>

                        {{-- Complemento (Máx 50) --}}
                        <div class="col-md-8">
                            <label class="form-label">Complemento</label>
                            <input type="text" class="form-control" name="complemento_cliente" maxlength="50"
                                value="{{ $linha->complemento_cliente }}">
                        </div>

                        {{-- Bairro (Máx 40) --}}
                        <div class="col-md-6">
                            <label class="form-label">Bairro</label>
                            <input type="text" class="form-control" name="bairro_cliente" maxlength="40"
                                value="{{ $linha->bairro_cliente }}">
                        </div>

                        {{-- Cidade (Máx 40) --}}
                        <div class="col-md-4">
                            <label class="form-label">Cidade</label>
                            <input type="text" class="form-control" name="cidade_cliente" maxlength="40"
                                value="{{ $linha->cidade_cliente }}">
                        </div>

                        {{-- UF (Máx 2) --}}
                        <div class="col-md-2">
                            <label class="form-label">UF</label>
                            <input type="text" class="form-control" name="uf_cliente" maxlength="2"
                                value="{{ $linha->uf_cliente }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar
                        Alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>
