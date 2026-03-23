let edit_modal_veterinario = document.getElementById('editarVeterinarioModal');
let delete_modal_veterinario = document.getElementById('excluirVeterinarioModal');

edit_modal_veterinario.addEventListener("show.bs.modal", (e) => {
    edit_modal_veterinario.querySelectorAll('input[name="status"]').forEach(radio => radio.checked = false);
    const button = e.relatedTarget;

    const id_vet = button.getAttribute('data-bs-id_veterinario');
    const nome_vet = button.getAttribute('data-bs-nome_veterinario');
    const login_vet = button.getAttribute('data-bs-login_veterinario');
    const email_vet = button.getAttribute('data-bs-email_veterinario');
    const telefone_vet = button.getAttribute('data-bs-telefone_veterinario');
    const status_vet = button.getAttribute('data-bs-status_veterinario');
    const crmv_vet = button.getAttribute('data-bs-crmv');
    const especialidade_vet = button.getAttribute('data-bs-especialidade');
    const radioStatus = edit_modal_veterinario.querySelector(`input[name="status"][value="${status_vet}"]`);


    edit_modal_veterinario.querySelector('#id_veterinario').value = id_vet;
    edit_modal_veterinario.querySelector('#login_veterinario').value = login_vet;
    edit_modal_veterinario.querySelector('#nome_veterinario').value = nome_vet;
    edit_modal_veterinario.querySelector('#email_veterinario').value = email_vet;
    edit_modal_veterinario.querySelector('#telefone_veterinario').value = telefone_vet;
    edit_modal_veterinario.querySelector('#crmv_veterinario').value = crmv_vet;
    edit_modal_veterinario.querySelector('#especialidade_veterinario').value = especialidade_vet;
    if (radioStatus) {
        radioStatus.checked = true;
    }
})

delete_modal_veterinario.addEventListener('show.bs.modal', (e) => {
    const button = e.relatedTarget;

    const id_vet = button.getAttribute('data-bs-id_veterinario');
    const nome_vet = button.getAttribute('data-bs-nome_veterinario');

    document.getElementById('nome_veterinario_delete').innerHTML = nome_vet;
    delete_modal_veterinario.querySelector('#id_veterinario_delete').value = id_vet;
})