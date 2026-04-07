const clienteSelect = document.getElementById('cliente_id_fk_vacinacao');

    if(clienteSelect){
        clienteSelect.addEventListener('change', function(){
            const clienteId = this.value;
            const petSelect = document.getElementById('pet_id_fk_vacinacao');

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