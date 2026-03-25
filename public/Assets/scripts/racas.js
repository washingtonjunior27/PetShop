let edit_modal_raca = document.getElementById('editarRacaModal');
let delete_modal_raca = document.getElementById('excluirRacaModal');

edit_modal_raca.addEventListener("show.bs.modal", (e) => {
    const button = e.relatedTarget;

    const id_raca = button.getAttribute('data-bs-id_raca');
    const nome_raca = button.getAttribute('data-bs-nome_raca');
    const id_especie_fk = button.getAttribute('data-bs-id_especie_fk')
    const selectEspecie = edit_modal_raca.querySelector('#id_especie_fk');
    selectEspecie.value = id_especie_fk;

    edit_modal_raca.querySelector('#modal_id_raca').value = id_raca;
    edit_modal_raca.querySelector('#modal_nome_raca').value = nome_raca;
    edit_modal_raca.querySelector('#modal_id_especie_fk').value = id_especie_fk;
})

delete_modal_raca.addEventListener('show.bs.modal', (e) => {
    const button = e.relatedTarget;

    const id_raca = button.getAttribute('data-bs-id_raca');
    const nome_raca = button.getAttribute('data-bs-nome_raca');

    document.getElementById('nome_raca_delete').innerHTML = nome_raca;
    delete_modal_raca.querySelector('#id_raca_delete').value = id_raca;
})