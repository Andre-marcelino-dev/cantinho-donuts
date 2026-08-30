

<script>
    setTimeout(function() {
        const sucesso = document.getElementById('alerta-sucesso');
        const erro = document.getElementById('alerta-erro');
        if (sucesso) sucesso.style.display = 'none';
        if (erro) erro.style.display = 'none';
    }, 3000);
</script>

<!-- Modal Novo Evento -->
<div class="modal fade" id="modalNovoEvento" tabindex="-1" aria-labelledby="novoEventoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="novoEventoLabel">Cadastro de Evento (Feira Livre)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('admin.evento.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">

                        <div class="row">
                            <div class="col-4 mb-3">
                                <label for="titulo_evento" class="form-label">Selo (ex: FEIRA LIVRE)</label>
                                <input type="text" class="form-control" id="titulo_evento" name="titulo_evento"
                                    maxlength="30" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="nome_evento" class="form-label">Nome do evento</label>
                                <input type="text" class="form-control" id="nome_evento" name="nome_evento"
                                    maxlength="120" required placeholder="Ex: Feira do Jardim Helena">
                            </div>
                            <div class="col-2 mb-3">
                                <label for="ordem_evento" class="form-label">Ordem</label>
                                <input type="number" class="form-control" id="ordem_evento" name="ordem_evento"
                                    value="0" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="descricao_evento" class="form-label">Descrição curta</label>
                            <input type="text" class="form-control" id="descricao_evento" name="descricao_evento"
                                maxlength="160" placeholder="Ex: Doce Ponto Confeitaria vai estar por lá">
                        </div>

                        <div class="row">
                            <div class="col-4 mb-3">
                                <label for="data_evento" class="form-label">Data</label>
                                <input type="date" class="form-control" id="data_evento" name="data_evento" required>
                            </div>
                            <div class="col-4 mb-3">
                                <label for="horario_evento" class="form-label">Horário</label>
                                <input type="text" class="form-control" id="horario_evento" name="horario_evento"
                                    maxlength="30" required placeholder="Ex: 9h às 14h">
                            </div>
                            <div class="col-4 mb-3">
                                <label for="status_evento" class="form-label">Status</label>
                                <select class="form-select" id="status_evento" name="status_evento" required>
                                    <option value="ATIVO">ATIVO</option>
                                    <option value="INATIVO">INATIVO</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="endereco_evento" class="form-label">Endereço</label>
                            <input type="text" class="form-control" id="endereco_evento" name="endereco_evento"
                                maxlength="160" required
                                placeholder="Ex: Rua Silva Pinto, em frente à praça — Jardim Helena">
                        </div>

                        <div class="mb-3">
                            <label for="link_local_evento" class="form-label">Link do local (Google Maps,
                                opcional)</label>
                            <input type="url" class="form-control" id="link_local_evento" name="link_local_evento"
                                maxlength="255" placeholder="https://maps.google.com/...">
                        </div>

                        <div class="mb-3">
                            <label for="tags_evento" class="form-label">Produtos do dia (separados por vírgula)</label>
                            <input type="text" class="form-control" id="tags_evento" name="tags_evento"
                                maxlength="255" placeholder="Ex: Bolos no pote, Brigadeiros, Tortinhas, Cookies">
                            <div class="form-text">Aparece como etiquetas em "Hoje na barraca"</div>
                        </div>

                        <div class="mb-3">
                            <label for="foto_evento" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="foto_evento" name="foto_evento"
                                accept="image/*">
                            <div class="form-text">Imagem exibida no card do evento</div>
                        </div>

                        <div class="modal-footer mb-3 btn-modal">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Salvar Evento</button>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
