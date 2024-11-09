document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const action = urlParams.get('action');
    if (!action || action === 'read') {
        const link = document.querySelector('a[href="index.php"]');
        if (link) {
            link.classList.add('link--active');
        }
    } else {
        const link = document.querySelector(`a[href="index.php?action=${action}"]`);
        if (link) {
            link.classList.add('link--active');
        }
    }

    // si la action no coincide con la de la url se le elimina la clase active

    
    
});
document.querySelectorAll('.menu__item').forEach((link) => {
        link.addEventListener('click', () => {
            document.querySelectorAll('.menu__item').forEach((link) => {
                link.classList.remove('link--active');
            });
            link.classList.add('link--active');
        });
});