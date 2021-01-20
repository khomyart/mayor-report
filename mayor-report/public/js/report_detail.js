/******/ (() => { // webpackBootstrap
/*!***************************************!*\
  !*** ./resources/js/report_detail.js ***!
  \***************************************/
var chaptersContainer = document.querySelector('.chapters-container');
var toTopButton = document.querySelector('.to-top-button');
var isScreenOnChaptersContainer = true;

if (window.scrollY > chaptersContainer.offsetHeight) {
  toTopButton.style.opacity = '1';
} else {
  toTopButton.style.opacity = '0';
}

window.onscroll = function () {
  if (window.scrollY > chaptersContainer.offsetHeight) {
    toTopButton.style.opacity = '1';
  } else {
    toTopButton.style.opacity = '0';
  }
};
/******/ })()
;