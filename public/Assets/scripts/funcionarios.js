let edit_modal = document.getElementById('editarFuncionarioModal');
let delete_modal = document.getElementById('excluirFuncionarioModal')

edit_modal.addEventListener("show.bs.modal", (e) => {
    edit_modal.querySelectorAll('input[name="status"]').forEach(radio => radio.checked = false);
    const button = e.relatedTarget;

    const id_usuario = button.getAttribute('data-bs-id');
    const nome = button.getAttribute('data-bs-nome');
    const login = button.getAttribute('data-bs-login');
    const email = button.getAttribute('data-bs-email');
    const telefone = button.getAttribute('data-bs-telefone');
    const role = button.getAttribute('data-bs-role');
    const status = button.getAttribute('data-bs-status');
    const radioStatus = edit_modal.querySelector(`input[name="status"][value="${status}"]`);

    edit_modal.querySelector('#modal_id_usuario').value = id_usuario;
    edit_modal.querySelector('#modal_nome_usuario').value = nome;
    edit_modal.querySelector('#modal_login_usuario').value = login;
    edit_modal.querySelector('#modal_email_usuario').value = email;
    edit_modal.querySelector('#modal_telefone_usuario').value = telefone;
    const selectRole = edit_modal.querySelector('#modal_role_usuario');
    selectRole.value = role;
    if (radioStatus) {
        radioStatus.checked = true;
    }
})

delete_modal.addEventListener('show.bs.modal', (e) => {
    const button = e.relatedTarget;

    const id = button.getAttribute('data-bs-id');
    const role = button.getAttribute('data-bs-role');
    const login = button.getAttribute('data-bs-login');

    document.getElementById('role_func_delete').innerHTML = role;
    document.getElementById('login_func_delete').innerHTML = login;
    delete_modal.querySelector('#delete_id_usuario').value = id;
})