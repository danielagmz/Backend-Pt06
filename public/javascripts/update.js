/* redirigir el elemento clickado a la url correspondiente */
document.querySelectorAll('.busqueda__resultados .article').forEach((link) => {
    link.addEventListener('click', (event) => {
        event.preventDefault();
        const id = link.getAttribute('data-id')
        window.location.href = `index.php?action=updating&id=${id}`
    })
})
