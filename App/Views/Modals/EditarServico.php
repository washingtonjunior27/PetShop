<!-- Modal -->
<div class="modal fade" id="editarServicoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Serviço</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= BASE_URL ?>/servicos/EditarServico">
                    <input type="hidden" name="id_servico" id="modal_id_servico">
                    <div class="mb-3">
                        <label for="nome_servico" class="form-label">Nome</label>
                        <input type="text" name="nome_servico" class="form-control" id="modal_nome_servico" placeholder="Informe o nome do serviço">
                    </div>
                    <div class="mb-3">
                        <label for="preco_servico" class="form-label">Preço</label>
                        <input min="1" step="0.01" type="number" name="preco_servico" class="form-control" id="modal_preco_servico" placeholder="Informe o preço do serviço">
                    </div>
                    <div class="d-flex gap-2 flex-column">
                        <label for="categoria_servico">Categoria</label>
                        <div class="d-flex gap-4">
                            <div class="form-check">
                                <input id="estetica" value="Estetica" class="form-check-input" type="radio" name="categoria_servico">
                                <label class="form-check-label" for="categoria_servico">
                                    Estetica
                                </label>
                            </div>
                            <div class="form-check mb-4">
                                <input id="consulta" value="Consulta" class="form-check-input" type="radio" name="categoria_servico">
                                <label class="form-check-label" for="categoria_servico">
                                    Consulta
                                </label>
                            </div>
                            <div class="form-check mb-4">
                                <input id="vacina" value="Vacina" class="form-check-input" type="radio" name="categoria_servico">
                                <label class="form-check-label" for="categoria_servico">
                                    Vacina
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="duracao_minutos" class="form-label">Duração (Minutos) (Min - 30)</label>
                        <input min="30" step="30" type="number" name="duracao_minutos" class="form-control" id="modal_duracao_minutos" placeholder="Informe a duração do serviço em minutos">
                    </div>
                    <div class="mb-3">
                        <label for="descricao_servico" class="form-label">Descrição</label>
                        <textarea class="form-control" name="descricao_servico" placeholder="Descreva o serviço caso desejar" id="modal_descricao_servico" rows="5"></textarea>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-warning">Editar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>