let slides = document.querySelectorAll('.slide-container');
let slideRation = 1.4 //a4 ration (1.4 - default)
let presentationLoader = document.querySelector('.presentation-loader-holder');
let slidesContainer = document.querySelector('.presentation-container');
let elementsWithResizableFont = document.querySelectorAll('[fontSizeMultiplier]');
let elementsWithResizablePadding = document.querySelectorAll('[paddingMultiplier]');
let elementsWithResizableBorder = document.querySelectorAll('[borderWidthMultiplier]');
let elementsWithResizableWidth = document.querySelectorAll('[widthMultiplier]');
let elementsWithResizableHeight = document.querySelectorAll('[heightMultiplier]');
let elementWithCustomMarginBottom = document.querySelectorAll('[marginBottomMultiplier]');
let elementWithCustomTopPosition = document.querySelectorAll('[cY]');
let elementWithCustomLeftPosition = document.querySelectorAll('[cX]');
let elementWithTransformTransition = document.querySelectorAll('[cAnchor]');

window.onload = function () {
    presentationLoader.remove();

    slides.forEach((e)=> {
        e.style.height = `${e.offsetWidth / slideRation}px`;
    })
    slidesContainer.scrollTop = 1;

    elementsWithResizableFont.forEach(e => {
        let fontSizeUnit = slides[0].offsetWidth / 100;
        let fontSizeMultiplier = e.getAttribute('fontSizeMultiplier');
        e.style.fontSize = `${fontSizeUnit * fontSizeMultiplier}px`;

        e.childNodes.forEach((childNode)=>{
            childNode.style.fontSize = `${fontSizeUnit * fontSizeMultiplier}px`;
        })
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

    elementsWithResizableHeight.forEach(e => {
        let heightUnit = slides[0].offsetHeight / 100;
        let heightMultiplier = e.getAttribute('heightMultiplier');
        e.style.height = `${(heightUnit * heightMultiplier).toFixed()}px`;
    })

    elementWithCustomMarginBottom.forEach(e => {
        marginUnit = slides[0].offsetHeight/100;
        marginBottomMultiplier = e.getAttribute('marginBottomMultiplier');
        e.style.marginBottom = `${(marginUnit * marginBottomMultiplier).toFixed()}px`;
    })

    elementsWithResizablePadding.forEach(e => {
        let paddingUnit = slides[0].offsetWidth / 100;
        let paddingMultiplier = e.getAttribute('paddingMultiplier');
        e.style.padding = `${paddingUnit * paddingMultiplier}`;
    })

    elementWithCustomTopPosition.forEach(e => {
        let cYparam = e.getAttribute('cY');
        e.style.position = 'absolute';
        e.style.top = cYparam;
    })

    elementWithCustomLeftPosition.forEach(e => {
        let cXparam = e.getAttribute('cX');
        e.style.position = 'absolute';
        e.style.left = cXparam;
    })

    elementWithTransformTransition.forEach(e => {
        const regex = /\s+/gi;
        let cAnchorParam = e.getAttribute('cAnchor').replace(regex, '').split(',');
        e.style.position = 'absolute';
        e.style.transform = `translate(${cAnchorParam[0]}, ${cAnchorParam[1]})`;
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

    elementsWithResizableHeight.forEach(e => {
        let heightUnit = slides[0].offsetHeight / 100;
        let heightMultiplier = e.getAttribute('heightMultiplier');
        e.style.height = `${(heightUnit * heightMultiplier).toFixed()}px`;
    })

    elementWithCustomMarginBottom.forEach(e => {
        marginUnit = slides[0].offsetHeight/100;
        marginBottomMultiplier = e.getAttribute('marginBottomMultiplier');
        e.style.marginBottom = `${(marginUnit * marginBottomMultiplier).toFixed()}px`;
    })

    elementsWithResizablePadding.forEach(e => {
        let paddingUnit = slides[0].offsetWidth / 100;
        let paddingMultiplier = e.getAttribute('paddingMultiplier');
        e.style.padding = `${paddingUnit * paddingMultiplier}`;
    })

    elementWithCustomTopPosition.forEach(e => {
        let cYparam = e.getAttribute('cY');
        e.style.position = 'absolute';
        e.style.top = cYparam;
    })

    elementWithCustomLeftPosition.forEach(e => {
        let cXparam = e.getAttribute('cX');
        e.style.position = 'absolute';
        e.style.left = cXparam;
    })

    elementWithTransformTransition.forEach(e => {
        const regex = /\s+/gi;
        let cAnchorParam = e.getAttribute('cAnchor').replace(regex, '').split(',');
        e.style.position = 'absolute';
        e.style.transform = `translate(${cAnchorParam[0]}, ${cAnchorParam[1]})`;
    })
}

/* show and hide menu with button */
let menuButtons = document.querySelectorAll('.menu-button');
let menuContainer = document.querySelector('.menu-container');
let navLinks = document.querySelectorAll('.nav-link');
let isMenuExtended = false;
let menuAppearingIntervalId;
let menuAppearingLeftStyleValue = -100;

menuButtons.forEach((menuButton)=>{
    menuButton.onclick = function() {
        if (isMenuExtended) {
            isMenuExtended = false;
            clearInterval(menuAppearingIntervalId)
            menuAppearingIntervalId = setInterval(function() {
                menuAppearingLeftStyleValue === -100 ? clearInterval(menuAppearingIntervalId) : menuAppearingLeftStyleValue -= 10;
                menuContainer.style.left = `${menuAppearingLeftStyleValue}%`;
            }, 25)
        } else {
            isMenuExtended = true;
            clearInterval(menuAppearingIntervalId)
            menuAppearingIntervalId = setInterval(function() {
                menuAppearingLeftStyleValue === 0 ? clearInterval(menuAppearingIntervalId) : menuAppearingLeftStyleValue += 10;
                menuContainer.style.left = `${menuAppearingLeftStyleValue}%`;
            }, 25)

        }
    }
})

/* every time when navlink is pressed - hide side menu*/
navLinks.forEach((navLink) => {
    navLink.onclick = function () {
        if (window.innerWidth < 768) {
            isMenuExtended = false;
            clearInterval(menuAppearingIntervalId)
            menuAppearingIntervalId = setInterval(function() {
                menuAppearingLeftStyleValue === -100 ? clearInterval(menuAppearingIntervalId) : menuAppearingLeftStyleValue -= 10;
                menuContainer.style.left = `${menuAppearingLeftStyleValue}%`;
                console.log('-')
            }, 25)
        }
    }
})

