
/**
 * Inicializa un dialogo modal con un formulario y un contenedor para mostrar
 * respuestas.
 *
 * @param {Object} options - Opciones para inicializar el dialogo.
 * @param {string} options.dialogSelector - Selector para el dialogo.
 * @param {string} options.buttonIdentifier - Selector para el boton que abrir  el dialogo.
 * @param {string} options.formId - ID del formulario.
 * @param {string} options.submitUrl - URL a la que se enviar  el formulario.
 * @param {string} options.responseContainerId - ID del contenedor para mostrar respuestas.
 * @param {string} [options.redirect] - URL a la que se redirigir  si el formulario se envia correctamente.
 */
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
            button.addEventListener('click', () => {
                dialog.showModal();
            });
        }
    }

    openDialog(buttonIdentifier);

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
if (document.querySelector('.dialog--change-pass')) {
    initDialog({
        dialogSelector: '.dialog--change-pass',
        buttonIdentifier: '.change-password__button',
        formId: 'changePasswordForm',
        submitUrl: 'index.php?action=change_password',
        responseContainerId: 'responseContainer'
    });
}
if (document.querySelector('.dialog--delete-account')) {
    initDialog({
        dialogSelector: '.dialog--delete-account',
        buttonIdentifier: '.delete-account__button',
        formId: 'deleteAccountForm',
        submitUrl: 'index.php?action=delete__account',
        responseContainerId: 'responseDelete',
        redirect: 'index.php?action=read'
    });
}
if (document.querySelector('.dialog__delete-user')) {
    const dialogSelector = '.dialog__delete-user';
    const formId = 'deleteUserForm';
    const responseContainerId = 'deleteUserResponse';

    // Agregar eventos a cada botón de usuario
    document.querySelectorAll('button[id^="user-"]').forEach((button) => {
        button.addEventListener('click', () => {
            const id = button.id.split('-')[1]; // Obtener el ID del usuario

            // Configurar la URL dinámica para la solicitud
            const submitUrl = `index.php?action=delete__user`;

            // Configurar dinámicamente el campo oculto del formulario
            const hiddenInput = document.querySelector(`#user-id`);
            if (hiddenInput) {
                hiddenInput.value = id;
            }

            // Inicializar el diálogo con los datos dinámicos
            initDialog({
                dialogSelector,
                buttonIdentifier: `#${button.id}`, // Identificar el botón que activa el diálogo
                formId,
                submitUrl,
                responseContainerId,
                redirect: 'index.php?action=admin'
            });

            // Mostrar el diálogo
            const dialog = document.querySelector(dialogSelector);
            if (dialog) dialog.showModal();
        });
    });
}






