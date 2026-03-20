<!-- Modal -->
<div class="modal fade" id="editarClienteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Cliente</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= BASE_URL ?>/clientes/EditarCliente">
                    <input type="hidden" name="id" id="modal_id_cliente">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" name="nome" class="form-control" id="modal_nome_cliente" placeholder="Informe o nome do funcionario">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="modal_email_cliente" placeholder="Informe o email do funcionario">
                    </div>
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="number" name="telefone" class="form-control" id="modal_telefone_cliente" placeholder="Informe o telefone do funcionario">
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <input type="text" name="role" class="form-control" id="modal_role_cliente" readonly>
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