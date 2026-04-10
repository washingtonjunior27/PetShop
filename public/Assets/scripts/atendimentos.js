let create_vacina_atendimentos = document.getElementById('cadastrarVacinacaoAtendimentosModal');
let finalizar_atendimentos_modal = document.getElementById('finalizarAtendimentoModal');

create_vacina_atendimentos.addEventListener("show.bs.modal", (e) => {
    const button = e.relatedTarget;
    const containerSelect = create_vacina_atendimentos.querySelector('#container_select_vacina');
    const containerInput = create_vacina_atendimentos.querySelector('#container_input_vacina');
    const inputNome = create_vacina_atendimentos.querySelector('#nome_vac_atend_modal');
    const inputHidden = create_vacina_atendimentos.querySelector('#id_vac_atend_modal');
    const selectVacina = create_vacina_atendimentos.querySelector('#select_vac_atend_modal');

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

    if (vacina_id > 0 && vacina_id !== "null") {
        // CASO 1: Existe vacina agendada
        console.log("Entrou no CASO 1: Com vacina");
        
        containerInput.classList.remove('d-none');
        containerSelect.classList.remove('d-block');
        
        containerInput.style.display = 'block';
        containerSelect.style.display = 'none';
        
        inputNome.value = vacina_nome;
        inputHidden.value = vacina_id;
        
        selectVacina.disabled = true;
        inputHidden.disabled = false;
    } else {
        // CASO 2: Não existe vacina agendada
        console.log("Entrou no CASO 2: Sem vacina (ELSE)");
        
        containerSelect.classList.remove('d-none');
        containerInput.classList.remove('d-block');
        
        containerSelect.style.display = 'block';
        containerInput.style.display = 'none';

        inputNome.value = "";
        inputHidden.value = "";
        
        selectVacina.disabled = false;
        inputHidden.disabled = true;
    }
})

finalizar_atendimentos_modal.addEventListener("show.bs.modal", (e) => {
    const button = e.relatedTarget;

    const id_agend = button.getAttribute('data-bs-id_agend');

    finalizar_atendimentos_modal.querySelector('#id_finalizar_atendimento_modal').value = id_agend;
})