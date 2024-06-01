// humburger ---------------------------------------------------------------------
const body = document.querySelector("body");
const menu = document.querySelector(".drop-menu");
const hamburger = document.querySelector(".header__menu-btn");

function toggleMenu() {
  if (hamburger.classList.contains("header__menu-btn--active")) {
    hamburger.classList.remove("header__menu-btn--active");
    body.classList.remove("no-scrolled");
    menu.classList.remove("active");
  } else {
    hamburger.classList.add("header__menu-btn--active");
    body.classList.add("no-scrolled");
    menu.classList.add("active");
  }
}

hamburger.addEventListener("click", toggleMenu);

const slides =
  window.innerWidth > 768 ? 3 : window.innerWidth > 490 ? 2 : "auto";
// BOUTIQUES SWIPER SLIDES  --------------------------------------------------------------------
let swiperBonus = new Swiper(".boutiques__swiper", {
  slidesPerView: slides,
  spaceBetween: 30,
  loop: true,
  pagination: {
    el: ".boutiques__pagination",
    clickable: true,
    dynamicBullets: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});
