document.addEventListener('DOMContentLoaded', () => {
    fetchUsers();
});

async function fetchUsers() {
    let submitUrl = 'controllers/admin_pagination.php';
    try {
        const response = await fetch(submitUrl, {
            method: 'GET',
            
        });

        const result = await response.text();
        responseContainer.innerHTML = result;

    } catch (error) {
        responseContainer.innerHTML = '<div class="form-info form-info--error">Ha ocurrido un error inesperado</div>';
    }
}