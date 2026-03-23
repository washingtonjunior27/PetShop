<!-- Modal -->
<div class="modal fade" id="editarVeterinarioModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Veterinario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= BASE_URL ?>/veterinarios/EditarVeterinario">
                    <input type="hidden" name="id" id="id_veterinario">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" name="nome" class="form-control" id="nome_veterinario" placeholder="Informe o nome do veterinario">
                    </div>
                    <div class="mb-3">
                        <label for="login" class="form-label">Login</label>
                        <input type="text" name="login" class="form-control" id="login_veterinario" placeholder="Informe o login do veterinario">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email_veterinario" placeholder="Informe o email do veterinario">
                    </div>
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="number" name="telefone" class="form-control" id="telefone_veterinario" placeholder="Informe o telefone do veterinario">
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <input type="text" class="form-control" name="role" id="role_veterinario" value="Veterinario" readonly>
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
                    <div class="mb-3">
                        <label for="crmv" class="form-label">CRMV</label>
                        <input type="text" name="crmv" class="form-control" id="crmv_veterinario" placeholder="Informe o crmv do veterinario">
                    </div>
                    <div class="mb-3">
                        <label for="especialidade" class="form-label">Especialidade</label>
                        <input type="text" name="especialidade" class="form-control" id="especialidade_veterinario" placeholder="Informe o especialidade do veterinario">
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