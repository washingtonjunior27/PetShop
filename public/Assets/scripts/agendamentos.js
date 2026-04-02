document.addEventListener('DOMContentLoaded', function(){
    let confirm_modal_agend = document.getElementById('confirmarAgendModal');
    let cancel_modal_agend = document.getElementById('cancelarAgendModal');

    if(confirm_modal_agend){
        confirm_modal_agend.addEventListener('show.bs.modal', (e) => {
            const button = e.relatedTarget;

            const id_agend = button.getAttribute('data-bs-id_agend');

            confirm_modal_agend.querySelector('#id_agend_confirm').value = id_agend;
        })
    }

    if(cancel_modal_agend){
        cancel_modal_agend.addEventListener('show.bs.modal', (e) => {
            const button = e.relatedTarget;

            const id_agend = button.getAttribute('data-bs-id_agend');

            cancel_modal_agend.querySelector('#id_agend_cancel').value = id_agend;
        })
    }

    const clienteSelect = document.getElementById('cliente_id_agend');

    if(clienteSelect){
        clienteSelect.addEventListener('change', function(){
            const clienteId = this.value;
            const petSelect = document.getElementById('pet_id_agend');

            const baseUrl = this.getAttribute('data-url');

            petSelect.innerHTML = '<option value="">Carregando...</option>';
            petSelect.disabled = true;

            if (clienteId) {
                const url = `${baseUrl}/agendamentos/BuscarPets?cliente_id_agendamento=${clienteId}`;

                fetch(url)
                    .then(response => {
                        return response.text();
                    })
                    .then(text => {
                        try {
                            const data = JSON.parse(text);

                            petSelect.innerHTML = '<option value="">Selecionar Pet</option>';
                            if (data.length > 0) {
                            data.forEach(pet => {
                                    const option = document.createElement('option');
                                    option.value = pet.id_pet;
                                    option.textContent = pet.nome_pet;
                                    petSelect.appendChild(option);
                                });
                                petSelect.disabled = false;
                            } else {
                                petSelect.innerHTML = '<option value="">Nenhum pet encontrado</option>';
                            }
                        } catch (e) {
                            petSelect.innerHTML = '<option value="">Erro no servidor</option>';
                        }
                    })
                    .catch(error => {
                        console.error('Erro no Fetch:', error);
                        petSelect.innerHTML = '<option value="">Erro de conexão</option>';
                    });
            } else {
                petSelect.innerHTML = '<option value="">Selecione primeiro o cliente</option>';
                petSelect.disabled = true;
            }
        });
    }

    const checksEstetica = document.querySelectorAll('.check-estet-agend');
    const checksClinico = document.querySelectorAll('.check-vet-agend'); // Vacinas e Consultas
    const selectResponsavel = document.getElementById('responsavel_id_agend');
    const optionsResponsavel = selectResponsavel.querySelectorAll('option');

    selectResponsavel.disabled = true;

    function atualizarInterface() {
        const esteticaAtivo = Array.from(checksEstetica).some(c => c.checked);
        const clinicoAtivo = Array.from(checksClinico).some(c => c.checked);

        // O select só fica habilitado se (esteticaAtivo OU clinicoAtivo) for verdadeiro
        selectResponsavel.disabled = !(esteticaAtivo || clinicoAtivo);

        // Se o select for desabilitado agora, aproveite para resetar o valor dele
        if (selectResponsavel.disabled) {
            selectResponsavel.value = "";
        }

        // 1. Bloqueio de Accordions
        document.getElementById('flush-collapseOne').parentElement.style.opacity = clinicoAtivo ? '0.5' : '1';
        checksEstetica.forEach(c => c.disabled = clinicoAtivo);

        document.getElementById('flush-collapseTwo').parentElement.style.opacity = esteticaAtivo ? '0.5' : '1';
        document.getElementById('flush-CollapseThree').parentElement.style.opacity = esteticaAtivo ? '0.5' : '1';
        checksClinico.forEach(c => c.disabled = esteticaAtivo);

        // 2. Filtro de Responsáveis
        optionsResponsavel.forEach(opt => {
            if (opt.value === "") return; // Pula o "Selecionar"

            const role = opt.getAttribute('data-role').toLowerCase();
            
            if (esteticaAtivo) {
                opt.hidden = (role !== 'esteticista' && role !== 'admin');
            } else if (clinicoAtivo) {
                opt.hidden = (role !== 'veterinario' && role !== 'admin');
            } else {
                opt.hidden = false; // Se nada estiver marcado, mostra todos
            }
        });
        
        // Reseta o select se o responsável atual ficar escondido
        if (selectResponsavel.selectedOptions[0]?.hidden) {
            selectResponsavel.value = "";
        }
    }

    // Adiciona o evento em todos os checkboxes
    [...checksEstetica, ...checksClinico].forEach(input => {
        input.addEventListener('change', atualizarInterface);
    });
})