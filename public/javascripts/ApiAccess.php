<script type="module">
    function apiDialog({
        dialogSelector,
        buttonIdentifier,
        submitB,
        submitUrl,
        responseContainerId
    }) {
        const apiKeyContainer = document.getElementById('apiKeyContainer');
        const refreshKeyContainer = document.getElementById('refreshKeyContainer');
        const dialog = document.querySelector(dialogSelector);
        const dialogClose = dialog.querySelector('.dialog__close');
        const submit = document.getElementById(submitB);
        const responseContainer = document.getElementById(responseContainerId);
        if (!dialog || !dialogClose || !submit || !responseContainer) {
            console.error(`Elementos necesarios no encontrados. Verifica los selectores proporcionados: 
        dialog: ${dialog}, 
        dialogClose: ${dialogClose}, 
        submitB: ${submit}, 
        responseContainer: ${responseContainer}`);
            return;
        }

        dialogClose.addEventListener('click', () => {
            dialog.close();
            resetForm(apiKeyContainer, refreshKeyContainer);
        });

        window.addEventListener('click', (event) => {
            if (event.target === dialog) {
                dialog.close();
                resetForm(apiKeyContainer, refreshKeyContainer);
            }
        });

        function resetContainers(apiKeyContainer, refreshKeyContainer) {
            apiKeyContainer.innerHTML = '';
            refreshKeyContainer.innerHTML = '';
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

        submit.addEventListener('click', async function(e) {
            e.preventDefault();

            try {
                const response = await fetch(submitUrl, {
                    method: 'POST',
                    body: JSON.stringify({
                        "user": "<?= $_SESSION['id'] ?>"
                    })
                });

                const result = await response.json();


                if (response.ok) {
                    if (result && result.token) apiKeyContainer.value= result.token;
                    if (result && result.refreshToken) refreshKeyContainer.value = result.refreshToken;
                }


            } catch (error) {
                responseContainer.innerHTML = '<div class="form-info form-info--error">Ha ocurrido un error inesperado</div>';
            }
        });
    }

    apiDialog({
        dialogSelector: '.dialog--apiAccess',
        buttonIdentifier: '.dev__button',
        submitB: 'getApiKeys',
        submitUrl: '<?= ROOT . '/api/login' ?>',
        responseContainerId: 'apiAccessResponse'
    });
</script>