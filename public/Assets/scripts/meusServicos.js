let finalizar_modal_servico_estetico = document.getElementById('finalizarServicoEsteticoModal');
let cancelar_modal_servico_estetico = document.getElementById('cancelarServicoEsteticoModal');

finalizar_modal_servico_estetico.addEventListener("show.bs.modal", (e) => {
    const button = e.relatedTarget;

    const id_agend = button.getAttribute('data-bs-id_agend');

    finalizar_modal_servico_estetico.querySelector('#id_servico_estetico_confirm').value = id_agend;
})

cancelar_modal_servico_estetico.addEventListener('show.bs.modal', (e) => {
    const button = e.relatedTarget;

    const id_agend = button.getAttribute('data-bs-id_agend');

    cancelar_modal_servico_estetico.querySelector('#id_servico_estetico_cancel').value = id_agend;
})