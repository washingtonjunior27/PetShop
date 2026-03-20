<!-- Modal -->
<div class="modal fade" id="editarFuncionarioModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Funcionário</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= BASE_URL ?>/funcionarios/EditarFuncionario">
                    <input type="hidden" name="id" id="modal_id_usuario">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" name="nome" class="form-control" id="modal_nome_usuario" placeholder="Informe o nome do funcionario">
                    </div>
                    <div class="mb-3">
                        <label for="login" class="form-label">Login</label>
                        <input type="text" name="login" class="form-control" id="modal_login_usuario" placeholder="Informe o login do funcionario">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="modal_email_usuario" placeholder="Informe o email do funcionario">
                    </div>
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="number" name="telefone" class="form-control" id="modal_telefone_usuario" placeholder="Informe o telefone do funcionario">
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select name="role" id="modal_role_usuario" class="form-select">
                            <option value="">Selecionar</option>
                            <option value="Atendente">Atendente</option>
                            <option value="Esteticista">Esteticista</option>
                        </select>
                    </div>
                    <div class="d-flex gap-4">
                        <div class="form-check">
                            <input id="status_ativo" value="Ativo" class="form-check-input" type="radio" name="status">
                            <label class="form-check-label" for="status">
                                Ativo
                            </label>
                        </div>
                        <div class="form-check mb-4">
                            <input id="status_inativo" value="Inativo" class="form-check-input" type="radio" name="status">
                            <label class="form-check-label" for="status">
                                Inativo
                            </label>
                        </div>
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