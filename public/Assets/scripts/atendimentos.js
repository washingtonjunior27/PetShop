let create_vacina_atendimentos = document.getElementById('cadastrarVacinacaoAtendimentosModal');
let finalizar_atendimentos_modal = document.getElementById('finalizarAtendimentoModal');

create_vacina_atendimentos.addEventListener("show.bs.modal", (e) => {
    const button = e.relatedTarget;

    const id_agend = button.getAttribute('data-bs-id_agend');
    const id_cliente = button.getAttribute('data-bs-id_cliente');
    const nome_cliente = button.getAttribute('data-bs-nome_cliente');
    const id_pet = button.getAttribute('data-bs-id_pet');
    const nome_pet = button.getAttribute('data-bs-nome_pet');
    const responsavel_id = button.getAttribute('data-bs-responsavel_id');
    const responsavel_login = button.getAttribute('data-bs-responsavel_login');
    const vacina_id = button.getAttribute('data-bs-vacina_id');
    const vacina_nome = button.getAttribute('data-bs-vacina_nome');

    create_vacina_atendimentos.querySelector('#id_agend_vac_atend_modal').value = id_agend;
    create_vacina_atendimentos.querySelector('#cliente_id_vac_atend_modal').value = id_cliente;
    create_vacina_atendimentos.querySelector('#cliente_nome_vac_atend_modal').value = nome_cliente;
    create_vacina_atendimentos.querySelector('#pet_id_vac_atend_modal').value = id_pet;
    create_vacina_atendimentos.querySelector('#pet_nome_vac_atend_modal').value = nome_pet;
    create_vacina_atendimentos.querySelector('#vet_id_vac_atend_modal').value = responsavel_id;
    create_vacina_atendimentos.querySelector('#vet_login_vac_atend_modal').value = responsavel_login;
    create_vacina_atendimentos.querySelector('#nome_vac_atend_modal').value = vacina_nome;
    create_vacina_atendimentos.querySelector('#id_vac_atend_modal').value = vacina_id;
})

finalizar_atendimentos_modal.addEventListener("show.bs.modal", (e) => {
    const button = e.relatedTarget;

    const id_agend = button.getAttribute('data-bs-id_agend');

    finalizar_atendimentos_modal.querySelector('#id_finalizar_atendimento_modal').value = id_agend;
})