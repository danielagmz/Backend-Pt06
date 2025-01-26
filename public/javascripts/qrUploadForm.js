let qrFormC = document.getElementById('qrForm__container');
let manualFormC = document.getElementById('manualForm__container');
let swapButton = document.getElementById('swapForm');

function swapForm() {
    if (qrFormC.hasAttribute('hidden')) {
        qrFormC.removeAttribute('hidden');
        manualFormC.setAttribute('hidden', true);
    } else {
        qrFormC.setAttribute('hidden', true);
        manualFormC.removeAttribute('hidden');
    }
}

swapButton.addEventListener('click', swapForm);