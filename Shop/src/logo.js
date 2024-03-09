function logoClick() {
    document.querySelector('#logo').addEventListener('click', () => {
        window.location.href = '../public/index.html';
    })
}

document.addEventListener('DOMContentLoaded', () => {
    logoClick();
})