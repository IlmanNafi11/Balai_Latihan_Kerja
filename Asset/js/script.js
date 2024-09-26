const hamburgerMenu = document.getElementById("hamburger-menu");
const sliderNavigation = document.getElementById("slider-navigation");

hamburgerMenu.addEventListener("click", function () {
  // Toggle class active pada hamburger dan slider
  hamburgerMenu.classList.toggle("active");
  sliderNavigation.classList.toggle("active");
});
