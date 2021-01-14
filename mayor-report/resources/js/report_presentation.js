let slides = document.querySelectorAll('.slide-container');
let slideRation = 1.4 //a4 ration (1.4 - default)
let slidesContainer = document.querySelector('.presentation-container');
let elementsWithResizableFont = document.querySelectorAll('[fontSizeMultiplier]')
let elementsWithResizableBorder = document.querySelectorAll('[borderWidthMultiplier]')
let elementsWithResizableWidth = document.querySelectorAll('[widthMultiplier]')

window.onload = function () {
    slides.forEach((e)=> {
        e.style.height = `${e.offsetWidth / slideRation}px`;
    })
    slidesContainer.scrollTop = 20;

    elementsWithResizableFont.forEach(e => {
        let fontSizeUnit = slides[0].offsetWidth / 100;
        let fontSizeMultiplier = e.getAttribute('fontSizeMultiplier');
        e.style.fontSize = `${fontSizeUnit * fontSizeMultiplier}px`;
    })

    elementsWithResizableBorder.forEach(e => {
        let borderWidthUnit = slides[0].offsetWidth / 100;
        let borderWidthMultiplier = e.getAttribute('borderWidthMultiplier');
        e.style.borderWidth = `${(borderWidthUnit * borderWidthMultiplier).toFixed()}px`;
    })

    elementsWithResizableWidth.forEach(e => {
        let widthUnit = slides[0].offsetWidth / 100;
        let widthMultiplier = e.getAttribute('widthMultiplier');
        e.style.width = `${(widthUnit * widthMultiplier).toFixed()}px`;
    })
}

window.onresize = function () {
    slides.forEach((e)=> {
        e.style.height = `${e.offsetWidth / slideRation}px`;
    })

    elementsWithResizableFont.forEach(e => {
        let fontSizeUnit = slides[0].offsetWidth / 100;
        let fontSizeMultiplier = e.getAttribute('fontSizeMultiplier');
        e.style.fontSize = `${fontSizeUnit * fontSizeMultiplier}px`;
    })

    elementsWithResizableBorder.forEach(e => {
        let borderWidthUnit = slides[0].offsetWidth / 100;
        let borderWidthMultiplier = e.getAttribute('borderWidthMultiplier');
        e.style.borderWidth = `${(borderWidthUnit * borderWidthMultiplier).toFixed()}px`;
    })

    elementsWithResizableWidth.forEach(e => {
        let widthUnit = slides[0].offsetWidth / 100;
        let widthMultiplier = e.getAttribute('widthMultiplier');
        e.style.width = `${(widthUnit * widthMultiplier).toFixed()}px`;
    })
}

