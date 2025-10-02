// Lightbox functionality for gallery images

document.addEventListener('DOMContentLoaded', function () {
  const galleryImages = document.querySelectorAll('.gallery-img-large');
  const lightbox = document.getElementById('lightbox');
  const lightboxImg = document.querySelector('.lightbox-img');
  const lightboxClose = document.querySelector('.lightbox-close');

  // Open lightbox on image click
  galleryImages.forEach(img => {
    img.addEventListener('click', function () {
      lightboxImg.src = img.getAttribute('data-full') || img.src;
      lightbox.style.display = 'flex';
      document.body.style.overflow = 'hidden'; // Prevent background scroll
    });
  });

  // Close lightbox on close button click
  lightboxClose.addEventListener('click', function () {
    lightbox.style.display = 'none';
    lightboxImg.src = '';
    document.body.style.overflow = '';
  });

  // Close lightbox on overlay click (not image)
  lightbox.addEventListener('click', function (e) {
    if (e.target === lightbox) {
      lightbox.style.display = 'none';
      lightboxImg.src = '';
      document.body.style.overflow = '';
    }
  });
});
