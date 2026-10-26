<div class="modal fade" id="modalNovoUsuario" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar Novo Usuário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('admin.usuarios.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-12">
                            <div class="row align-items-center bg-light p-3 border rounded mb-2">
                                <div class="col-md-2 text-center mb-2 mb-md-0">
                                    <div class="d-flex align-items-center justify-content-center bg-secondary rounded-circle mx-auto"
                                        style="width: 70px; height: 70px;">
                                        <i class="bi bi-person text-white" style="font-size: 2rem;"></i>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <label class="form-label fw-bold">Foto do Usuário</label>
                                    <input type="file" class="form-control" name="foto_usuario" accept="image/*">
                                    <div class="form-text">Formatos: JPG, JPEG, PNG ou WEBP. Máx: 2MB.</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <label class="form-label">Nome <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nome_usuario" required maxlength="255" placeholder="Nome completo">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Perfil <span class="text-danger">*</span></label>
                            <select class="form-select" name="perfil_usuario" required>
                                <option value="">Selecione...</option>
                                @foreach (['ATENDENTE', 'GERENTE', 'CAIXA', 'CONFEITEIRO', 'Administrador'] as $perfil)
                                    <option value="{{ $perfil }}">{{ $perfil }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-8">
                            <label class="form-label">E-mail <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email_usuario" required maxlength="255" placeholder="email@cantinhodonuts.com.br">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select" name="status_usuario" required>
                                <option value="ATIVO" selected>Ativo</option>
                                <option value="INATIVO">Inativo</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Senha <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="senha_usuario" required minlength="6">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Confirmar Senha <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="senha_usuario_confirmation" required minlength="6">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
