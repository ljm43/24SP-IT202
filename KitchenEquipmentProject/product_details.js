const productImage = document.getElementById('productImage');
const alternateImageSrc = 'alternate_image.jpg';
productImage.addEventListener('mouseover', () => {
    productImage.src = `images/${alternateImageSrc}`;
});
productImage.addEventListener('mouseout', () => {
    const originalImageSrc = productImage.dataset.originalSrc;
    productImage.src = `images/${originalImageSrc}`;
});

productImage.dataset.originalSrc = productImage.src.split('/').pop();