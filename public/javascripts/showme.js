document.querySelectorAll('.showme').forEach((element) => {
    element.addEventListener('click', () => {
        element.classList.toggle('fi-rr-eye', !element.classList.contains('fi-rr-eye'));
        element.classList.toggle('fi-rr-eye-crossed', !element.classList.contains('fi-rr-eye-crossed'));
        element.previousElementSibling.setAttribute('type', element.classList.contains('fi-rr-eye') ? 'password' : 'text');
    });
});
