/******/ (() => { // webpackBootstrap
/*!*********************************************!*\
  !*** ./resources/js/report_presentation.js ***!
  \*********************************************/
var slides = document.querySelectorAll('.slide-container');
var slideRation = 1.4; //a4 ration (1.4 - default)

var slidesContainer = document.querySelector('.presentation-container');
var elementsWithResizableFont = document.querySelectorAll('[fontSizeMultiplier]');
var elementsWithResizableBorder = document.querySelectorAll('[borderWidthMultiplier]');
var elementsWithResizableWidth = document.querySelectorAll('[widthMultiplier]');
var elementsWithResizableHeight = document.querySelectorAll('[heightMultiplier]');
var elementWithCustomTopPosition = document.querySelectorAll('[cX]');
var elementWithCustomLeftPosition = document.querySelectorAll('[cX]');
var elementWithTransformTransition = document.querySelectorAll('[cAnchor]');

window.onload = function () {
  slides.forEach(function (e) {
    e.style.height = "".concat(e.offsetWidth / slideRation, "px");
  });
  slidesContainer.scrollTop = 1;
  elementsWithResizableFont.forEach(function (e) {
    var fontSizeUnit = slides[0].offsetWidth / 100;
    var fontSizeMultiplier = e.getAttribute('fontSizeMultiplier');
    e.style.fontSize = "".concat(fontSizeUnit * fontSizeMultiplier, "px");
  });
  elementsWithResizableBorder.forEach(function (e) {
    var borderWidthUnit = slides[0].offsetWidth / 100;
    var borderWidthMultiplier = e.getAttribute('borderWidthMultiplier');
    e.style.borderWidth = "".concat((borderWidthUnit * borderWidthMultiplier).toFixed(), "px");
  });
  elementsWithResizableWidth.forEach(function (e) {
    var widthUnit = slides[0].offsetWidth / 100;
    var widthMultiplier = e.getAttribute('widthMultiplier');
    e.style.width = "".concat((widthUnit * widthMultiplier).toFixed(), "px");
  });
  elementsWithResizableHeight.forEach(function (e) {
    var heightUnit = slides[0].offsetHeight / 100;
    var heightMultiplier = e.getAttribute('heightMultiplier');
    e.style.height = "".concat((heightUnit * heightMultiplier).toFixed(), "px");
  });
  elementWithCustomTopPosition.forEach(function (e) {
    var cYparam = e.getAttribute('cY');
    e.style.position = 'absolute';
    e.style.top = cYparam;
  });
  elementWithCustomLeftPosition.forEach(function (e) {
    var cXparam = e.getAttribute('cX');
    e.style.position = 'absolute';
    e.style.left = cXparam;
  });
  elementWithTransformTransition.forEach(function (e) {
    var regex = /\s+/gi;
    var cAnchorParam = e.getAttribute('cAnchor').replace(regex, '').split(',');
    e.style.position = 'absolute';
    e.style.transform = "translate(".concat(cAnchorParam[0], ", ").concat(cAnchorParam[1], ")");
  });
};

window.onresize = function () {
  slides.forEach(function (e) {
    e.style.height = "".concat(e.offsetWidth / slideRation, "px");
  });
  elementsWithResizableFont.forEach(function (e) {
    var fontSizeUnit = slides[0].offsetWidth / 100;
    var fontSizeMultiplier = e.getAttribute('fontSizeMultiplier');
    e.style.fontSize = "".concat(fontSizeUnit * fontSizeMultiplier, "px");
  });
  elementsWithResizableBorder.forEach(function (e) {
    var borderWidthUnit = slides[0].offsetWidth / 100;
    var borderWidthMultiplier = e.getAttribute('borderWidthMultiplier');
    e.style.borderWidth = "".concat((borderWidthUnit * borderWidthMultiplier).toFixed(), "px");
  });
  elementsWithResizableWidth.forEach(function (e) {
    var widthUnit = slides[0].offsetWidth / 100;
    var widthMultiplier = e.getAttribute('widthMultiplier');
    e.style.width = "".concat((widthUnit * widthMultiplier).toFixed(), "px");
  });
  elementsWithResizableHeight.forEach(function (e) {
    var heightUnit = slides[0].offsetHeight / 100;
    var heightMultiplier = e.getAttribute('heightMultiplier');
    e.style.height = "".concat((heightUnit * heightMultiplier).toFixed(), "px");
  });
  elementWithCustomTopPosition.forEach(function (e) {
    var cYparam = e.getAttribute('cY');
    e.style.position = 'absolute';
    e.style.top = cYparam;
  });
  elementWithCustomLeftPosition.forEach(function (e) {
    var cXparam = e.getAttribute('cX');
    e.style.position = 'absolute';
    e.style.left = cXparam;
  });
  elementWithTransformTransition.forEach(function (e) {
    var regex = /\s+/gi;
    var cAnchorParam = e.getAttribute('cAnchor').replace(regex, '').split(',');
    e.style.position = 'absolute';
    e.style.transform = "translate(".concat(cAnchorParam[0], ", ").concat(cAnchorParam[1], ")");
  });
};
/* show and hide menu with button */


var menuButtons = document.querySelectorAll('.menu-button');
var menuContainer = document.querySelector('.menu-container');
var navLinks = document.querySelectorAll('.nav-link');
var isMenuExtended = false;
var menuAppearingIntervalId;
var menuAppearingLeftStyleValue = -100;
menuButtons.forEach(function (menuButton) {
  menuButton.onclick = function () {
    if (isMenuExtended) {
      isMenuExtended = false;
      clearInterval(menuAppearingIntervalId);
      menuAppearingIntervalId = setInterval(function () {
        menuAppearingLeftStyleValue === -100 ? clearInterval(menuAppearingIntervalId) : menuAppearingLeftStyleValue -= 10;
        menuContainer.style.left = "".concat(menuAppearingLeftStyleValue, "%");
      }, 25);
    } else {
      isMenuExtended = true;
      clearInterval(menuAppearingIntervalId);
      menuAppearingIntervalId = setInterval(function () {
        menuAppearingLeftStyleValue === 0 ? clearInterval(menuAppearingIntervalId) : menuAppearingLeftStyleValue += 10;
        menuContainer.style.left = "".concat(menuAppearingLeftStyleValue, "%");
      }, 25);
    }
  };
});
/* every time when navlink is pressed - hide side menu*/

navLinks.forEach(function (navLink) {
  navLink.onclick = function () {
    if (window.innerWidth < 768) {
      isMenuExtended = false;
      clearInterval(menuAppearingIntervalId);
      menuAppearingIntervalId = setInterval(function () {
        menuAppearingLeftStyleValue === -100 ? clearInterval(menuAppearingIntervalId) : menuAppearingLeftStyleValue -= 10;
        menuContainer.style.left = "".concat(menuAppearingLeftStyleValue, "%");
        console.log('-');
      }, 25);
    }
  };
});
/******/ })()
;