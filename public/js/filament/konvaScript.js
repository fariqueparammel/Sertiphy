import Konva from "konva";

let sceneWidth = 900;
let sceneHeight = 900;

var stage = new Konva.Stage({
    container: "container", // id of container <div>
    width: sceneWidth,
    height: sceneHeight,
});

var layer = new Konva.Layer();
stage.add(layer);
let imageloaded = false;

function setImageloaded(value) {
    imageloaded = value;
}

function isImageLoaded() {
    return imageloaded;
}

function fitStageIntoParentContainer() {
    var container = document.querySelector("#konvaCanvas");

    var containerWidth = container.offsetWidth;
    var containerHeight = container.offsetHeight;

    var scalew = containerWidth / sceneWidth;
    var scaleh = containerHeight / sceneHeight;
    stage.width(sceneWidth * scalew);
    stage.height(sceneHeight * scaleh);
    stage.scale({ x: scalew, y: scaleh });
    stage.x((containerWidth - sceneWidth * scalew) / 2);
    stage.y((containerHeight - sceneHeight * scaleh) / 2);

    layer.batchDraw();
}

fitStageIntoParentContainer();
window.addEventListener("resize", fitStageIntoParentContainer);

function getCurrentImageUrl(imageUrl, callback) {
    var imageObj = new Image();
    imageObj.onload = function () {
        var templateImage = new Konva.Image({
            image: imageObj,
            width: sceneWidth,
            height: sceneHeight,
        });

        setImageloaded(true); // Ensure this is set when the image loads.

        layer.add(templateImage);
        layer.batchDraw();
        callback(true);
    };
    imageObj.src = imageUrl;
}

document.querySelectorAll(".image-button").forEach((button) => {
    button.addEventListener("click", function () {
        const imageUrl = this.getAttribute("data-file-url");
        getCurrentImageUrl(imageUrl, () => {});
    });
});

document.getElementById("templateButton").addEventListener("click", function () {
    document.getElementById("templateImage").click();
});

document.getElementById("templateImage").addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file) {
        uploadedImageDisplay(file);
    }
});

function uploadedImageDisplay(file) {
    const uploadedImage = document.querySelector(".uploaded-image-button");
    const cloneUploadedImageElement = uploadedImage.cloneNode(true);
    cloneUploadedImageElement.style.display = "block";
    const clonedImageElement = cloneUploadedImageElement.querySelector(".uploaded-template-image");
    const imageUrl = URL.createObjectURL(file);
    clonedImageElement.src = imageUrl;
    clonedImageElement.setAttribute("data-file-url", imageUrl);
    clonedImageElement.style.display = "block";
    const newDiv = document.createElement("div");
    newDiv.classList.add("uploaded-image-container");
    newDiv.id = "div" + Date.now();
    document.getElementById("upload-template").appendChild(newDiv);
    document.getElementById("div" + Date.now()).appendChild(cloneUploadedImageElement);
    displayUploadedTemplate();
    
}

function displayUploadedTemplate() {
    document.querySelectorAll(".uploaded-template-image").forEach((button) => {
        button.addEventListener("click", function () {
            const imageUrl = this.getAttribute("data-file-url");
            getCurrentImageUrl(imageUrl, () => {});
        });
    });
}

export default {
    stage,
    layer,
    isImageLoaded,
    getCurrentImageUrl,
};
