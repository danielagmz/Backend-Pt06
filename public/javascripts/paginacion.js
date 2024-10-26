document.addEventListener('DOMContentLoaded', () => {
    // Cada vez que se cambia el valor del limit, actualiza la URL
    const pageInput = document.querySelector(".busqueda__input--page");
    if (pageInput && pageInput.value) {
        let pages = parseInt(pageInput.value);

        // Validación: si no es un número entero positivo, establecer valor predeterminado
        if (isNaN(pages) || !Number.isInteger(pages) || pages < 1) {
            pages = 5;
        }

        const params = new URLSearchParams(window.location.search);
        params.set('limit', pages); 

        // Actualiza la URL con el nuevo límite
        const newUrl = window.location.pathname + '?' + params.toString();
        window.history.pushState({}, '', newUrl);
    }

    // Cada vez que se cambia el valor del limit en el input, actualiza la URL
    if (pageInput) {
        pageInput.addEventListener('change', (event) => {
            const params = new URLSearchParams(window.location.search);
            let value = parseInt(event.target.value);

            // Validación: si no es un número entero positivo, establecer valor predeterminado
            if (isNaN(value) || !Number.isInteger(value) || value < 1) {
                value = 5;
            }

            params.set('limit', value);

            // Actualiza la URL con el nuevo límite
            const newUrl = window.location.pathname + '?' + params.toString();
            window.history.pushState({}, '', newUrl);

            // Redirigir
            window.location.href = newUrl; 
        });
    }
});
