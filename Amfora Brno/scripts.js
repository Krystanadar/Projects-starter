document
  .getElementById("reservationForm")
  .addEventListener("submit", function (e) {
    /*e.preventDefault();
    const status = document.getElementById("status");
    status.textContent = "Odesílám …";
    setTimeout(() => {
      status.textContent = "Děkujeme! Rezervace byla přijata.";
      this.reset();
    }, 1000);*/
  });

const track = document.querySelector(".carousel-track");
const slides = Array.from(track.children);
const prevButton = document.querySelector(".carousel-btn.prev");
const nextButton = document.querySelector(".carousel-btn.next");
const carousel = document.querySelector(".carousel");

let currentSlide = 0;

function updateSlidePosition() {
  const slideWidth = slides[0].getBoundingClientRect().width;
  track.style.transform = `translateX(-${currentSlide * slideWidth}px)`;
}

// Autoplay stop on hover
carousel.addEventListener("mouseenter", () => clearInterval(autoplayInterval));
carousel.addEventListener("mouseleave", () => resetAutoplay());

function goToNextSlide() {
  currentSlide = (currentSlide + 1) % slides.length;
  updateSlidePosition();
}

function goToPrevSlide() {
  currentSlide = (currentSlide - 1 + slides.length) % slides.length;
  updateSlidePosition();
}

window.addEventListener("resize", updateSlidePosition);
nextButton.addEventListener("click", () => {
  goToNextSlide();
  resetAutoplay();
});
prevButton.addEventListener("click", () => {
  goToPrevSlide();
  resetAutoplay();
});

// Autoplay every 4 seconds
let autoplayInterval = setInterval(goToNextSlide, 4000);

function resetAutoplay() {
  clearInterval(autoplayInterval);
  autoplayInterval = setInterval(goToNextSlide, 4000);
}

// Initialize
updateSlidePosition();

const backToTopBtn = document.getElementById("backToTop");
window.addEventListener("scroll", function () {
  if (window.scrollY > 300) {
    backToTopBtn.style.display = "block";
  } else {
    backToTopBtn.style.display = "none";
  }
});
backToTopBtn.addEventListener("click", function () {
  window.scrollTo({ top: 0, behavior: "smooth" });
});

const navToggle = document.getElementById("navToggle");
const mainNav = document.getElementById("mainNav");

navToggle.addEventListener("click", () => {
  mainNav.classList.toggle("open");
});

// Autoclose hamburger menu on link click
document.querySelectorAll("#mainNav a").forEach((link) => {
  link.addEventListener("click", () => {
    mainNav.classList.remove("open");
    navToggle.classList.remove("open");
  });
});
