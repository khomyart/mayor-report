let intervals = [];
let elementsHolder = [];

listOfViews.forEach((e, i) => {
    elementsHolder[i] = document.getElementById(e['id']);
    let nestedImgElement = elementsHolder[i].childNodes[1].childNodes[1];
    let imageSrcEnter =  `${e['thumbnail_prefix']}/${e['thumbnail'][1]}`
    let imageSrcLeave =  `${e['thumbnail_prefix']}/${e['thumbnail'][0]}`
    elementsHolder[i].addEventListener('mouseenter', e => {
        changeImage(nestedImgElement, imageSrcEnter, 'enter')
    })
    elementsHolder[i].addEventListener('mouseleave', e => {
        changeImage(nestedImgElement, imageSrcLeave, 'leave')
    })
})

function controlledElement(id, rotationValueY, animationStage, intervalID, imageUrl) {
    this.id = id;
    this.rotationValueY = rotationValueY;
    this.animationStage = animationStage;
    this.intervalID = intervalID;
    this.imageUrl = imageUrl;
}

function changeImage(element, imageUrl, animationStage) {
    let elementId = element.getAttribute('id');

    if (intervals[elementId] === undefined) {
        intervals[elementId] = new controlledElement(elementId, 0, animationStage, null, imageUrl);
    }

    if (animationStage === 'enter') {
        if (intervals[elementId].animationStage === 'leave') {
            intervals[elementId].animationStage = 'enter';
            intervals[elementId].imageUrl = imageUrl;
            clearInterval(intervals[elementId].intervalID);
        }

        intervals[elementId].intervalID = setInterval(function () {
            intervals[elementId].rotationValueY += 10;
            document.getElementById(elementId).style.transform = "rotateY(".concat(intervals[elementId].rotationValueY, "deg)");

            if (intervals[elementId].rotationValueY >= 90) {
                document.getElementById(elementId).setAttribute('src', intervals[elementId].imageUrl);
            }

            if (intervals[elementId].rotationValueY >= 180) {
                clearInterval(intervals[elementId].intervalID);
            }
        }, 15);
    }

    if (animationStage === 'leave') {

        if (intervals[elementId].animationStage === 'enter') {
            intervals[elementId].animationStage = 'leave';
            intervals[elementId].imageUrl = imageUrl;
            clearInterval(intervals[elementId].intervalID);
        }

        intervals[elementId].intervalID = setInterval(function () {
            intervals[elementId].rotationValueY -= 10;
            document.getElementById(elementId).style.transform = "rotateY(".concat(intervals[elementId].rotationValueY, "deg)");

            if (intervals[elementId].rotationValueY <= 90) {
                document.getElementById(elementId).setAttribute('src', intervals[elementId].imageUrl);
            }

            if (intervals[elementId].rotationValueY <= 0) {
                clearInterval(intervals[elementId].intervalID);
                delete intervals[elementId];
            }
        }, 15);
    }
}
