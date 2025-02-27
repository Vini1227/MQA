let slideIndex = 0;
showSlides();

function showSlides() {
    let slides = document.querySelectorAll('.carousel-slide');
    for (let i = 0; i < slides.length; i++) {
        slides[i].classList.remove('active-slide');
    }
    slideIndex++;
    if (slideIndex > slides.length) { slideIndex = 1 }
    if (slideIndex < 1) { slideIndex = slides.length }
    slides[slideIndex - 1].classList.add('active-slide');
    setTimeout(showSlides, 10000); // Muda a imagem a cada 5 segundos
}

function plusSlides(n) {
    slideIndex += n - 1;
    showSlides();
}
