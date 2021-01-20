let chaptersContainer = document.querySelector('.chapters-container');
let toTopButton = document.querySelector('.to-top-button');
let isScreenOnChaptersContainer = true;

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
}
