// Permitir que al presionar el botón de filtrado se haga el filtrado/busqueda
document.querySelector('.form__button--search').addEventListener('click', function () {
    const filtro = document.querySelector('.busqueda__input').value;
    const url = new URL(window.location.href); // Crear un objeto URL de la URL actual

    // Verificar si el parámetro ya existe
    if (url.searchParams.has('filter')) {
        if (filtro === '') { // Si el filtro es vacío, lo eliminamos
            url.searchParams.delete('filter');
        } else {
            // Si existe,actualizamos
            url.searchParams.set('filter', filtro);
        }
    } else {
        // Si no existe, se añade
        url.searchParams.append('filter', filtro);
    }

    // Redirigir 
    window.location.href = url.toString();
});

// Permitir que al presionar "Enter" también se haga la búsqueda
document.querySelector('.busqueda__input').addEventListener('keypress', function (event) {
    if (event.key === 'Enter') {
        event.preventDefault();  // Evitar el submit por defecto
        const filtro = document.querySelector('.busqueda__input').value;
        const url = new URL(window.location.href); // Crear un objeto URL de la URL actual

        // Verificar si el parámetro existe
        if (url.searchParams.has('filter')) {
            if (filtro === '') { // Si el filtro es vacío, lo eliminamos
                url.searchParams.delete('filter');
            } else {
                // Si existe,actualizamos
                url.searchParams.set('filter', filtro);
            }

        } else {
            // Si no existe, lo agregamos
            url.searchParams.append('filter', filtro);
        }

        // Redirigir 
        window.location.href = url.toString();
    }
});

// Función para obtener el valor de una cookie por su nombre
function cookieValor(name) {
    const match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    return match ? match[2] : null; // Devuelve el valor de la cookie o null si no existe
}

// Obtener el parámetro 'order' de la URL
const urlParams = new URLSearchParams(window.location.search);
const orderParam = urlParams.get('order');

// Si no hay parámetro, intentamos obtenerlo de la cookie
let ordenFinal;

if (orderParam) {
        ordenFinal = orderParam;
} 

// Seleccionar el radio button correcto basado en el parámetro o la cookie
if (ordenFinal) {
    document.querySelector(`input[name="orden"][value="${ordenFinal}"]`).checked = true;
}

// Añadir el listener para redirigir cuando se cambie el radio button
document.querySelectorAll('input[name="orden"]').forEach((radio) => {
    radio.addEventListener('change', function () {
        const orden = this.value;
        const url = new URL(window.location.href);

        // Verificar si el parámetro ya existe
        if (url.searchParams.has('order')) {
            url.searchParams.set('order', orden);
        } else {
            url.searchParams.append('order', orden);
        }

        // Redirigir a la nueva URL
        window.location.href = url.toString();
    });
});


