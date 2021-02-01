let chaptersContainer = document.querySelector('.chapters-container');
let container = document.querySelector('.container-fluid');
let toTopButton = document.querySelector('.to-top-button');
let isScreenOnChaptersContainer = true;

document.querySelector('.container-fluid').scrollTop = 0;

function scrollToAnchor() {
    let regex = /^#([a-zA-Z0-9-_]*)#*/gi;
    let hash = location.hash;
    let results = hash.matchAll(regex);
    let elementToScroll;
    let scrollOffset = -10;

    for(let result of results) {
        elementToScroll = document.getElementById(String(result[1]));
    }

    if (elementToScroll === undefined ||
        elementToScroll === null) {
        window.scrollTo(0, 0)
    } else {
        let coordinatesToScroll = elementToScroll.getBoundingClientRect();
        window.scrollTo(0, Math.abs(coordinatesToScroll.y) + scrollOffset)
    }
}

//TODO: fix this stuff to work properly when everything in dom is loaded
setTimeout(function() {
    scrollToAnchor();
},50)

let hrefTags = document.querySelectorAll('.content-table-href');

hrefTags.forEach((href) => {
    href.onclick = function () {
        setTimeout(function (){
            scrollToAnchor();
        }, 50)
    }
})

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
}


