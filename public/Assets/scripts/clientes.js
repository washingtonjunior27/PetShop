let edit_modal_cliente = document.getElementById('editarClienteModal');
let delete_modal_cliente = document.getElementById('excluirClienteModal');

edit_modal_cliente.addEventListener("show.bs.modal", (e) => {
    const button = e.relatedTarget;

    const id_cliente = button.getAttribute('data-bs-id');
    const nome = button.getAttribute('data-bs-nome');
    const email = button.getAttribute('data-bs-email');
    const telefone = button.getAttribute('data-bs-telefone');
    const role = button.getAttribute('data-bs-role');

    edit_modal_cliente.querySelector('#modal_id_cliente').value = id_cliente;
    edit_modal_cliente.querySelector('#modal_nome_cliente').value = nome;
    edit_modal_cliente.querySelector('#modal_email_cliente').value = email;
    edit_modal_cliente.querySelector('#modal_telefone_cliente').value = telefone;
    edit_modal_cliente.querySelector('#modal_role_cliente').value = role;
})

delete_modal_cliente.addEventListener('show.bs.modal', (e) => {
    const button = e.relatedTarget;

    const id = button.getAttribute('data-bs-id_cliente');
    const nome = button.getAttribute('data-bs-nome_cliente');

    document.getElementById('nome_cliente_delete').innerHTML = nome;
    delete_modal_cliente.querySelector('#id_cliente_delete').value = id;
})