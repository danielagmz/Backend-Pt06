// Permitir que al presionar el botón de filtrado se haga el filtrado/busqueda
document.querySelector('.form__button--search').addEventListener('click', function() {
    const filtro = document.querySelector('.busqueda__input').value;
    const url = new URL(window.location.href); // Crear un objeto URL de la URL actual
    
    // Verificar si el parámetro ya existe
    if (url.searchParams.has('filter')) {
        // Si existe, actualizamos el valor
        url.searchParams.set('filter', filtro);
    } else {
        // Si no existe, se añade
        url.searchParams.append('filter', filtro);
    }
    
    // Redirigir 
    window.location.href = url.toString();
});

// Permitir que al presionar "Enter" también se haga la búsqueda
document.querySelector('.busqueda__input').addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault();  // Evitar el submit por defecto
        const filtro = document.querySelector('.busqueda__input').value;
        const url = new URL(window.location.href); // Crear un objeto URL de la URL actual
        
        // Verificar si el parámetro existe
        if (url.searchParams.has('filter')) {
            // Si existe,actualizamos
            url.searchParams.set('filter', filtro);
        } else {
            // Si no existe, lo agregamos
            url.searchParams.append('filter', filtro);
        }
        
        // Redirigir 
        window.location.href = url.toString();
    }
});
