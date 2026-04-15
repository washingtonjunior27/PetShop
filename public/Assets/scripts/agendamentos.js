document.addEventListener('DOMContentLoaded', function(){
    let confirm_modal_agend = document.getElementById('confirmarAgendModal');
    let pago_modal_agend = document.getElementById('pagoAgendModal');
    let cancel_modal_agend = document.getElementById('cancelarAgendModal');

    if(confirm_modal_agend){
        confirm_modal_agend.addEventListener('show.bs.modal', (e) => {
            const button = e.relatedTarget;

            const id_agend = button.getAttribute('data-bs-id_agend');

            confirm_modal_agend.querySelector('#id_agend_confirm').value = id_agend;
        })
    }

    if(pago_modal_agend){
        pago_modal_agend.addEventListener('show.bs.modal', (e) => {
            const button = e.relatedTarget;

            const id_agend = button.getAttribute('data-bs-id_agend');

            pago_modal_agend.querySelector('#id_agend_pago').value = id_agend;
        })
    }

    if(cancel_modal_agend){
        cancel_modal_agend.addEventListener('show.bs.modal', (e) => {
            const button = e.relatedTarget;

            const id_agend = button.getAttribute('data-bs-id_agend');

            cancel_modal_agend.querySelector('#id_agend_cancel').value = id_agend;
        })
    }

    const checkboxes = document.querySelectorAll('.service-checkbox');
    const displayTotal = document.getElementById('total-exibido');

    function calcularTotal() {
        let total = 0;
        
        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                total += parseFloat(checkbox.getAttribute('data-valor'));
            }
        });

        displayTotal.innerText = total.toLocaleString('pt-br', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    const vacinaCheckboxes = document.querySelectorAll('#flush-CollapseThree .service-checkbox');

    vacinaCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                vacinaCheckboxes.forEach(other => {
                    if (other !== this) {
                        other.checked = false;
                    }
                });
            }
        });
    });

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', calcularTotal);
    });

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

        selectResponsavel.disabled = !(esteticaAtivo || clinicoAtivo);

        if (selectResponsavel.disabled) {
            selectResponsavel.value = "";
        }

        document.getElementById('flush-collapseOne').parentElement.style.opacity = clinicoAtivo ? '0.5' : '1';
        checksEstetica.forEach(c => c.disabled = clinicoAtivo);

        document.getElementById('flush-collapseTwo').parentElement.style.opacity = esteticaAtivo ? '0.5' : '1';
        document.getElementById('flush-CollapseThree').parentElement.style.opacity = esteticaAtivo ? '0.5' : '1';
        checksClinico.forEach(c => c.disabled = esteticaAtivo);

        optionsResponsavel.forEach(opt => {
            if (opt.value === "") return;

            const role = opt.getAttribute('data-role').toLowerCase();
            
            if (esteticaAtivo) {
                opt.hidden = (role !== 'esteticista' && role !== 'admin');
            } else if (clinicoAtivo) {
                opt.hidden = (role !== 'veterinario' && role !== 'admin');
            } else {
                opt.hidden = false;
            }
        });
        
        if (selectResponsavel.selectedOptions[0]?.hidden) {
            selectResponsavel.value = "";
        }
    }

    [...checksEstetica, ...checksClinico].forEach(input => {
        input.addEventListener('change', atualizarInterface);
    });

    const inputData = document.getElementById('data_agend');
    const selectResp = document.getElementById('responsavel_id_agend');
    // Melhor usar ID para não haver erro de seleção
    
    const containerHorarios = document.querySelector('#container-horarios-dinamicos');

    function atualizarHorarios() {
        const data = inputData.value;
        const resp = selectResp.value;
        // Pega a URL base do atributo que colocamos no HTML
        const baseUrl = inputData.getAttribute('data-url');

        if (!data || !resp) {
            containerHorarios.innerHTML = `
                <div class="col-12 mt-4">
                    <p class="text-muted italic">
                        <i class="fa-solid fa-calendar-check me-2"></i>
                        Selecione a <strong>data</strong> e o <strong>responsável</strong> para visualizar os horários.
                    </p>
                </div>`;
            return;
        }

        if (!baseUrl) return;

        if (!data || !resp || !baseUrl) return;

        // Agora a URL será montada corretamente pelo navegador
        const url = `${baseUrl}/agendamentos/buscarHorariosLivres?data=${data}&responsavel=${resp}`;

        containerHorarios.innerHTML = '<p class="text-center mt-3">Buscando horários...</p>';

        fetch(url)
            .then(response => {
                // Se der erro 404 ou 500, a gente consegue ver aqui
                if (!response.ok) throw new Error('Erro na rede');
                return response.json();
            })
            .then(horariosLivres => {
                containerHorarios.innerHTML = ''; 

                if (horariosLivres.length === 0) {
                    containerHorarios.innerHTML = '<p class="text-danger mt-3 text-center">Nenhum horário disponível para este profissional nesta data.</p>';
                    return;
                }

                horariosLivres.forEach(hora => {
                    const html = `
                        <div class="col-3">
                            <div class="text-light main-bg py-3 rounded mt-3">
                                <div class="d-flex text-light gap-1 justify-content-center">
                                    <input type="radio" value="${hora}" name="hora_agend_inicio" required id="hora_${hora.replace(':', '')}">
                                    <label for="hora_${hora.replace(':', '')}">${hora}</label>
                                </div>
                            </div>
                        </div>`;
                    containerHorarios.insertAdjacentHTML('beforeend', html);
                });
            })
            .catch(error => {
                console.error('Erro no Fetch de horários:', error);
                containerHorarios.innerHTML = '<p class="text-danger mt-3 text-center">Erro ao carregar horários. Verifique se a rota existe.</p>';
            });
    }

    inputData.addEventListener('change', atualizarHorarios);
    selectResp.addEventListener('change', atualizarHorarios);
})