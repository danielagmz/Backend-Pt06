function initDialog({ dialogSelector, buttonClass, formId, submitUrl, responseContainerId, redirect }) {
    const dialog = document.querySelector(dialogSelector);
    const dialogClose = dialog.querySelector('.dialog__close');
    const form = document.getElementById(formId);
    const responseContainer = document.getElementById(responseContainerId);
    if (!dialog || !dialogClose || !form || !responseContainer) {
        console.error('Elementos necesarios no encontrados. Verifica los selectores proporcionados.');
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

    function openDialog(buttonClass) {
        const button = document.querySelector(`.${buttonClass}`);
        if (button) {
            button.addEventListener('click', () => {
                dialog.showModal();
            });
        }
    }

    openDialog(buttonClass);

    form.addEventListener('submit', async function (e) {
        e.preventDefault();
        const formData = new FormData(this);

        try {
            const response = await fetch(submitUrl, {
                method: 'POST',
                body: formData,
            });

            const result = await response.text();
            responseContainer.innerHTML = result;

            if (response.ok) {
                form.reset();
                if (redirect) {
                    window.location.href = redirect;
                }
            }
            

        } catch (error) {
            responseContainer.innerHTML = '<div class="form-info form-info--error">Ha ocurrido un error inesperado</div>';
        }
    });
}

initDialog({
    dialogSelector: '.dialog--change-pass', 
    buttonClass: 'change-password__button', 
    formId: 'changePasswordForm', 
    submitUrl: 'index.php?action=change_password', 
    responseContainerId: 'responseContainer'
});

initDialog({
    dialogSelector: '.dialog--delete-account', 
    buttonClass: 'delete-account__button', 
    formId: 'deleteAccountForm', 
    submitUrl: 'index.php?action=delete__account', 
    responseContainerId: 'responseDelete', 
    redirect: 'index.php?action=read'
});