// Função para carregar as raças em qualquer select
function carregarRacas(especieId, selectRaca, racaSelecionada = null, baseUrl) {
    if (!especieId) {
        selectRaca.innerHTML = '<option value="">Selecione primeiro a espécie</option>';
        selectRaca.disabled = true;
        return;
    }

    selectRaca.innerHTML = '<option value="">Carregando...</option>';
    selectRaca.disabled = true;

    const url = `${baseUrl}?especie_id=${especieId}`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            selectRaca.innerHTML = '<option value="">Selecionar Raça</option>';
            
            data.forEach(raca => {
                const option = document.createElement('option');
                option.value = raca.id_raca;
                option.textContent = raca.nome_raca;
                
                // Se o ID da raça for igual ao que o pet já tem, ele seleciona automaticamente
                if (racaSelecionada && raca.id_raca == racaSelecionada) {
                    option.selected = true;
                }
                
                selectRaca.appendChild(option);
            });
            selectRaca.disabled = false;
        })
        .catch(() => {
            selectRaca.innerHTML = '<option value="">Erro ao carregar</option>';
        });
}

let edit_modal_pet = document.getElementById('editarPetModal');
let delete_modal_pet = document.getElementById('excluirPetModal');

edit_modal_pet.addEventListener("show.bs.modal", (e) => {
    edit_modal_pet.querySelectorAll('input[name="modal_sexo_pet"]').forEach(radio => radio.checked = false);

    const button = e.relatedTarget;

    const id_pet = button.getAttribute('data-bs-id_pet');
    const nome_pet = button.getAttribute('data-bs-nome_pet');
    const cliente_id_fk = button.getAttribute('data-bs-id_cliente');
    const especie_id_fk = button.getAttribute('data-bs-id_especie');
    const raca_id_fk = button.getAttribute('data-bs-id_raca');
    const sexo_pet = button.getAttribute('data-bs-sexo_pet');
    const cor_pet = button.getAttribute('data-bs-cor_pet');
    const peso_pet = button.getAttribute('data-bs-peso_pet');

    edit_modal_pet.querySelector('#modal_id_pet').value = id_pet;
    edit_modal_pet.querySelector('#modal_nome_pet').value = nome_pet;

    // SELECT DE CLIENTE
    const selectCliente = edit_modal_pet.querySelector('#modal_cliente_id_fk');
    selectCliente.value = cliente_id_fk;
    edit_modal_pet.querySelector('#modal_cliente_id_fk').value = cliente_id_fk;

    // SELECT DE ESPECIE
    const selectEspecie = edit_modal_pet.querySelector('#modal_especie_id_fk');
    selectEspecie.value = especie_id_fk;
    edit_modal_pet.querySelector('#modal_especie_id_fk').value = especie_id_fk;
    const baseUrl = selectEspecie.getAttribute('data-url');

    // SELECT DE RAÇA
    const selectRaca = edit_modal_pet.querySelector('#modal_raca_id_fk');
    selectRaca.value = raca_id_fk;
    edit_modal_pet.querySelector('#modal_raca_id_fk').value = raca_id_fk;

    carregarRacas(especie_id_fk, selectRaca, raca_id_fk, baseUrl);

    // SEXO
    const radioStatus = edit_modal_pet.querySelector(`input[name="modal_sexo_pet"][value="${sexo_pet}"]`);
    if (radioStatus) {
        radioStatus.checked = true;
    }

    // COR E PESO
    edit_modal_pet.querySelector('#modal_cor_pet').value = cor_pet;
    edit_modal_pet.querySelector('#modal_peso_pet').value = peso_pet;
})

delete_modal_pet.addEventListener('show.bs.modal', (e) => {
    const button = e.relatedTarget;

    const id_pet = button.getAttribute('data-bs-id_pet');
    const nome_pet = button.getAttribute('data-bs-nome_pet');

    document.getElementById('nome_pet_delete').innerHTML = nome_pet;
    delete_modal_pet.querySelector('#id_pet_delete').value = id_pet;
})

// Listener para o select de espécie do CADASTRO
document.getElementById('especie_id_fk').addEventListener('change', function() {
    const racaSelect = document.getElementById('raca_id_fk');
    carregarRacas(this.value, racaSelect, null, this.getAttribute('data-url'));
});

// Listener para o select de espécie do MODAL
document.getElementById('modal_especie_id_fk').addEventListener('change', function() {
    const racaSelect = document.getElementById('modal_raca_id_fk');
    carregarRacas(this.value, racaSelect, null, this.getAttribute('data-url'));
});