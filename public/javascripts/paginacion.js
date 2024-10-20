document.addEventListener('DOMContentLoaded', () => {

    // Cada vez que se cambia el valor del limit, actualiza la URL
    const pages = document.querySelector(".busqueda__input--page").value;
    const params = new URLSearchParams(window.location.search);
    params.set('limit', parseInt(pages));

    // Actualiza la URL con el nuevo límite
    const newUrl = window.location.pathname + '?' + params.toString();
    window.history.pushState({}, '', newUrl);
});

// Cada vez que se cambia el valor del limit, actualiza la URL
document.querySelector(".busqueda__input--page").addEventListener('change', (event) => {
    const params = new URLSearchParams(window.location.search);
    let value = parseInt(event.target.value);
    params.set('limit', parseInt(event.target.value));

    // Actualiza la URL con el nuevo límite
    const newUrl = window.location.pathname + '?' + params.toString();
    window.history.pushState({}, '', newUrl);

    // Redirigir
    window.location.href = newUrl; 
});