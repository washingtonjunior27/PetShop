let edit_modal_vacina = document.getElementById('editarVacinaModal');
let delete_modal_vacina = document.getElementById('excluirVacinaModal');

edit_modal_vacina.addEventListener("show.bs.modal", (e) => {
    const button = e.relatedTarget;

    const id_vacina = button.getAttribute('data-bs-id_vacina');
    const nome_vacina = button.getAttribute('data-bs-nome_vacina');
    const preco_vacina = button.getAttribute('data-bs-preco_vacina');
    const duracao_retorno = button.getAttribute('data-bs-duracao_retorno');
    const descricao_vacina = button.getAttribute('data-bs-descricao_vacina');

    edit_modal_vacina.querySelector('#modal_id_vacina').value = id_vacina;
    edit_modal_vacina.querySelector('#modal_nome_vacina').value = nome_vacina;
    edit_modal_vacina.querySelector('#modal_preco_vacina').value = preco_vacina;
    edit_modal_vacina.querySelector('#modal_duracao_retorno').value = duracao_retorno;
    edit_modal_vacina.querySelector('#modal_descricao_vacina').value = descricao_vacina;
})

delete_modal_vacina.addEventListener('show.bs.modal', (e) => {
    const button = e.relatedTarget;

    const id = button.getAttribute('data-bs-id_vacina');
    const nome = button.getAttribute('data-bs-nome_vacina');

    document.getElementById('nome_vacina_delete').innerHTML = nome;
    delete_modal_vacina.querySelector('#id_vacina_delete').value = id;
})