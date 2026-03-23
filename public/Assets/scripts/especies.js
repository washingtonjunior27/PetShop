let edit_modal_especie = document.getElementById('editarEspecieModal');
let delete_modal_especie = document.getElementById('excluirEspecieModal');

edit_modal_especie.addEventListener("show.bs.modal", (e) => {
    const button = e.relatedTarget;

    const id_especie = button.getAttribute('data-bs-id_especie');
    const nome_especie = button.getAttribute('data-bs-nome_especie');

    edit_modal_especie.querySelector('#modal_id_especie').value = id_especie;
    edit_modal_especie.querySelector('#modal_nome_especie').value = nome_especie;
})

delete_modal_especie.addEventListener('show.bs.modal', (e) => {
    const button = e.relatedTarget;

    const id_especie = button.getAttribute('data-bs-id_especie');
    const nome_especie = button.getAttribute('data-bs-nome_especie');

    document.getElementById('nome_especie_delete').innerHTML = nome_especie;
    delete_modal_especie.querySelector('#id_especie_delete').value = id_especie;
})