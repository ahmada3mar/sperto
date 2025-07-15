// resources/js/slider.js

let slideIndex = 0;
const slides = document.querySelectorAll('.slider-item');
const sliderWrapper = document.getElementById('image-slider');
const dotsContainer = document.getElementById('slider-dots');
let slideInterval;
let touchStartX = 0;
let touchEndX = 0;
const swipeThreshold = 50; // Minimum pixels to register a swipe

// Expose functions globally for HTML onclick attributes
window.showSlides = function() {
    if (slideIndex >= slides.length) { slideIndex = 0; }
    if (slideIndex < 0) { slideIndex = slides.length - 1; }

    sliderWrapper.style.transform = `translateX(${-slideIndex * 100}%)`;

    // Update dots
    dotsContainer.innerHTML = ''; // Clear existing dots
    for (let i = 0; i < slides.length; i++) {
        const dot = document.createElement('span');
        dot.classList.add('dot');
        if (i === slideIndex) {
            dot.classList.add('active');
        }
        dot.onclick = () => window.currentSlide(i); // Call global currentSlide
        dotsContainer.appendChild(dot);
    }
}

window.nextSlide = function() {
    slideIndex++;
    window.showSlides(); // Call global showSlides
}

window.prevSlide = function() {
    slideIndex--;
    window.showSlides(); // Call global showSlides
}

window.currentSlide = function(n) {
    slideIndex = n;
    window.showSlides(); // Call global showSlides
}

// Automatic slideshow control (also made global for consistency, though not strictly necessary for HTML)
window.startAutoSlide = function() {
    clearInterval(slideInterval); // Clear any existing interval first
    slideInterval = setInterval(window.nextSlide, 5000); // Call global nextSlide
}

window.stopAutoSlide = function() {
    clearInterval(slideInterval);
}

// Touch event listeners for swipe
if (sliderWrapper) { // Ensure sliderWrapper exists before adding listeners
    sliderWrapper.addEventListener('touchstart', (e) => {
        touchStartX = e.touches[0].clientX;
        window.stopAutoSlide(); // Call global stopAutoSlide
    });

    sliderWrapper.addEventListener('touchmove', (e) => {
        touchEndX = e.touches[0].clientX;
    });

    sliderWrapper.addEventListener('touchend', () => {
        const swipeDistance = touchStartX - touchEndX;

        if (swipeDistance > swipeThreshold) {
            // Swiped left (show next slide)
            window.nextSlide(); // Call global nextSlide
        } else if (swipeDistance < -swipeThreshold) {
            // Swiped right (show previous slide)
            window.prevSlide(); // Call global prevSlide
        }
        window.startAutoSlide(); // Restart auto-slide after touch ends
    });
}


// Mouse hover for desktop (still useful for non-touch devices)
const sliderContainer = document.querySelector('.slider-container');
if (sliderContainer) { // Ensure sliderContainer exists before adding listeners
    sliderContainer.addEventListener('mouseenter', window.stopAutoSlide); // Call global stopAutoSlide
    sliderContainer.addEventListener('mouseleave', window.startAutoSlide); // Call global startAutoSlide
}


// Initialize slider on script load (or DOMContentLoaded)
document.addEventListener('DOMContentLoaded', () => {
    // Check if slider elements exist before trying to initialize
    if (slides.length > 0 && sliderWrapper && dotsContainer) {
        window.showSlides();
        window.startAutoSlide();
    }
});
