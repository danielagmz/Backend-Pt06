function initDialog({ dialogSelector, buttonIdentifier, formId, submitUrl, responseContainerId, redirect }) {
    const dialog = document.querySelector(dialogSelector);
    const dialogClose = dialog.querySelector('.dialog__close');
    const form = document.getElementById(formId);
    const responseContainer = document.getElementById(responseContainerId);

    if (!dialog || !dialogClose || !form || !responseContainer) {
        console.error(`Elementos necesarios no encontrados. Verifica los selectores proporcionados: 
        dialog: ${dialog}, 
        dialogClose: ${dialogClose}, 
        form: ${form}, 
        responseContainer: ${responseContainer}`);
        return;
    }

    dialogClose.addEventListener('click', () => {
        dialog.close();
        resetForm(form, responseContainer);
    });

    window.addEventListener('click', (event) => {
        if (event.target === dialog) {
            dialog.close();
            resetForm(form, responseContainer);
        }
    });

    function resetForm(form, responseContainer) {
        form.reset();
        responseContainer.innerHTML = '';
    }

    function openDialog(buttonIdentifier) {
        const button = document.querySelector(`${buttonIdentifier}`);
        if (button) {
            button.addEventListener('click', async () => {
                dialog.showModal();
                await uploadImage(); // Enviar al abrir el modal
            });
        }
    }

    openDialog(buttonIdentifier);

    async function uploadImage(e) {
        const titleCheckbox = form.querySelector('input[name="title"]');
        const contentCheckbox = form.querySelector('input[name="content"]');

        const title = document.querySelector('#articleTitle').textContent;
        const content = document.querySelector('#articleContent').textContent;
        

        if (e) e.preventDefault(); // Prevenir comportamiento por defecto
        let data = { 'article': {} };

        if (titleCheckbox.checked) {
            data.article.title = title;
        }
        if (contentCheckbox.checked) {
            data.article.content = content;
        }
        if (!Object.keys(data.article).length) {
            responseContainer.innerHTML = '<div class="form-info form-info--warning">Selecciona al menos un campo</div>';
            return;
        }

        try {
            const response = await fetch(submitUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data), // Asegúrate de enviar solo tu objeto manualmente
            });

            const result = await response.text();
            responseContainer.innerHTML = result;

            if (response.ok) {
                if (redirect) {
                    window.location.href = redirect;
                }
            }
        } catch (error) {
            responseContainer.innerHTML = '<div class="form-info form-info--error">Ha ocurrido un error inesperado</div>';
        }
    }

    form.addEventListener('change', (e) => {
        if (e.target.type === 'checkbox') {
            e.preventDefault();
            uploadImage();
        }
    });
}

if (document.querySelector('.dialog--qr')) {
    initDialog({
        dialogSelector: '.dialog--qr',
        buttonIdentifier: '#qrDialogButton',
        formId: 'uploadqrForm',
        submitUrl: 'index.php?action=create__qr',
        responseContainerId: 'qrImageContainer'
    });
}
