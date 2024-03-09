document.addEventListener('DOMContentLoaded', () => {
    const shopItemButton = document.querySelector('.shop-item-1-button');
    if (shopItemButton) {
        shopItemButton.addEventListener('click', () => {
            window.location.href = 'checkout/001.html';
        });
    } else {
        console.error('Element with class .shop-item-button not found');
    }
});
