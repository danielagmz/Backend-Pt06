let responseContainer = document.querySelector('.form-info--success');
let actionButton = document.querySelector('#actionButton');


document.addEventListener('DOMContentLoaded', () => {
    if (responseContainer) {
        if(actionButton){
            actionButton.classList.add('link--active');
        }
    }
});