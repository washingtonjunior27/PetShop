<!-- Modal -->
<div class="modal fade" id="editarVacinaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Vacina</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= BASE_URL ?>/vacinas/EditarVacina">
                    <input type="hidden" name="id_vacina" id="modal_id_vacina">
                    <div class="mb-3">
                        <label for="nome_vacina" class="form-label">Nome</label>
                        <input type="text" name="nome_vacina" class="form-control" id="modal_nome_vacina" placeholder="Informe o nome da vacina">
                    </div>
                    <div class="mb-3">
                        <label for="preco_vacina" class="form-label">Preço</label>
                        <input min="1" step="0.01" type="number" name="preco_vacina" class="form-control" id="modal_preco_vacina" placeholder="Informe o preço da vacina">
                    </div>
                    <div class="mb-3">
                        <label for="duracao_retorno" class="form-label">Duração Retorno(dias)</label>
                        <input min="1" step="1" type="number" name="duracao_retorno" class="form-control" id="modal_duracao_retorno" placeholder="Informe a duração da vacina em minutos">
                    </div>
                    <div class="mb-3">
                        <label for="descricao_vacina" class="form-label">Descrição</label>
                        <textarea class="form-control" name="descricao_vacina" placeholder="Descreva a vacina caso desejar" id="modal_descricao_vacina" rows="5"></textarea>
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