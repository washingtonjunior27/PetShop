let resolvido_lembrete_modal = document.getElementById('resolvidoLembreteModal');

resolvido_lembrete_modal.addEventListener("show.bs.modal", (e) => {
    const button = e.relatedTarget;

    const id_vacinacao = button.getAttribute('data-bs-id_vacinacao');

    resolvido_lembrete_modal.querySelector('#id_vacinacao_resolvido').value = id_vacinacao;
})