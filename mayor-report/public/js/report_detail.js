/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************!*\
  !*** ./resources/js/report_detail.js ***!
  \***************************************/
function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
var chaptersContainer = document.querySelector('.chapters-container');
var container = document.querySelector('.container-fluid');
var toTopButton = document.querySelector('.to-top-button');
var isScreenOnChaptersContainer = true;
document.querySelector('.container-fluid').scrollTop = 0;
document.body.style.display = "none";
window.onload = function () {
  document.body.style.display = "block";
  scrollToAnchor();
};
function scrollToAnchor() {
  var regex = /^#([a-zA-Z0-9-_]*)#*/gi;
  var hash = location.hash;
  var results = hash.matchAll(regex);
  var elementToScroll;
  var scrollOffset = 0;
  var _iterator = _createForOfIteratorHelper(results),
    _step;
  try {
    for (_iterator.s(); !(_step = _iterator.n()).done;) {
      var result = _step.value;
      elementToScroll = document.getElementById(String(result[1]));
    }
  } catch (err) {
    _iterator.e(err);
  } finally {
    _iterator.f();
  }
  if (elementToScroll === undefined || elementToScroll === null) {
    window.scrollTo(0, 0);
  } else {
    var coordinatesToScroll = elementToScroll.getBoundingClientRect();
    window.scrollTo(0, Math.abs(coordinatesToScroll.y) + window.scrollY);
  }
}
var hrefTags = document.querySelectorAll('.content-table-href');
hrefTags.forEach(function (href) {
  href.onclick = function () {
    setTimeout(function () {
      scrollToAnchor();
    }, 50);
  };
});
if (window.scrollY > chaptersContainer.offsetHeight) {
  toTopButton.style.opacity = '1';
  toTopButton.style.cursor = 'pointer';
} else {
  toTopButton.style.opacity = '0';
  toTopButton.style.cursor = 'default';
}
window.onscroll = function () {
  if (window.scrollY > chaptersContainer.offsetHeight) {
    toTopButton.style.opacity = '1';
    toTopButton.style.cursor = 'pointer';
  } else {
    toTopButton.style.opacity = '0';
    toTopButton.style.cursor = 'default';
  }
};
/******/ })()
;