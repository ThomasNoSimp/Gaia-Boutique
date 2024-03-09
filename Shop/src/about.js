(function() {
    const imageOverlayContentButtonContainer = document.querySelector('.image-overlay-content-button-container');
    const imageOverlayContentParagraph = document.querySelector('.image-overlay-content-paragraph');
    
    imageOverlayContentButtonContainer.addEventListener('click', () => {
        imageOverlayContentButtonContainer.style.visibility = 'hidden';
        imageOverlayContentParagraph.style.visibility = 'visible';
    });
})
();