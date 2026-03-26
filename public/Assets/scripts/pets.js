
// SELECT DE RAÇAS
document.getElementById('especie_id_fk').addEventListener('change', function(){
    const especieId = this.value;
    const racaSelect = document.getElementById('raca_id_fk');

    const baseUrl = this.getAttribute('data-url');

    racaSelect.innerHTML = '<option value="">Carregando...</option>';
    racaSelect.disabled = true;

    if (especieId) {
        const url = `${baseUrl}/pets/BuscarRacas?especie_id=${especieId}`;

        fetch(url)
            .then(response => {
                return response.text();
            })
            .then(text => {
                try {
                    const data = JSON.parse(text);
                    racaSelect.innerHTML = '<option value="">Selecionar Raça</option>';

                    if (data.length > 0) {
                        data.forEach(raca => {
                            const option = document.createElement('option');
                            option.value = raca.id_raca;
                            option.textContent = raca.nome_raca;
                            racaSelect.appendChild(option);
                        });
                        racaSelect.disabled = false;
                    } else {
                        racaSelect.innerHTML = '<option value="">Nenhuma raça encontrada</option>';
                    }
                } catch (e) {
                    racaSelect.innerHTML = '<option value="">Erro no servidor</option>';
                }
            })
            .catch(error => {
                console.error('Erro no Fetch:', error);
                racaSelect.innerHTML = '<option value="">Erro de conexão</option>';
            });
    } else {
        racaSelect.innerHTML = '<option value="">Selecione primeiro a espécie</option>';
        racaSelect.disabled = true;
    }
});