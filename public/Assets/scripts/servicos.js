let edit_modal_servico = document.getElementById('editarServicoModal');
let delete_modal_servico = document.getElementById('excluirServicoModal');

edit_modal_servico.addEventListener("show.bs.modal", (e) => {
    const button = e.relatedTarget;

    const id_servico = button.getAttribute('data-bs-id_servico');
    const nome_servico = button.getAttribute('data-bs-nome_servico');
    const preco_servico = button.getAttribute('data-bs-preco_servico');
    const duracao_minutos = button.getAttribute('data-bs-duracao_minutos');
    const descricao_servico = button.getAttribute('data-bs-descricao_servico');

    edit_modal_servico.querySelector('#modal_id_servico').value = id_servico;
    edit_modal_servico.querySelector('#modal_nome_servico').value = nome_servico;
    edit_modal_servico.querySelector('#modal_preco_servico').value = preco_servico;
    edit_modal_servico.querySelector('#modal_duracao_minutos').value = duracao_minutos;
    edit_modal_servico.querySelector('#modal_descricao_servico').value = descricao_servico;
})

delete_modal_servico.addEventListener('show.bs.modal', (e) => {
    const button = e.relatedTarget;

    const id = button.getAttribute('data-bs-id_servico');
    const nome = button.getAttribute('data-bs-nome_servico');

    document.getElementById('nome_servico_delete').innerHTML = nome;
    delete_modal_servico.querySelector('#id_servico_delete').value = id;
})