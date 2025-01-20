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

function fitStageIntoParentContainer() {
    var container = document.querySelector("#konvaCanvas");

    // now we need to fit stage into parent container
    var containerWidth = container.offsetWidth;
    var containerHeight = container.offsetHeight;
    // but we also make the full scene visible
    // so we need to scale all objects on canvas
    var scalew = containerWidth / sceneWidth;
    var scaleh = containerHeight / sceneHeight;
    stage.width(sceneWidth * scalew);
    stage.height(sceneHeight * scaleh);
    stage.scale({ x: scalew, y: scaleh });
}

window.addEventListener("resize", fitStageIntoParentContainer);

fitStageIntoParentContainer();

function getCurrentImageUrl(imageUrl) {
    console.log("file url", imageUrl);
    var imageObj = new Image();
    imageObj.onload = function () {
        var templateImage = new Konva.Image({
            image: imageObj,
            width: sceneWidth,
            height: sceneHeight,
        });

        // add the shape to the layer
        layer.add(templateImage);
    };
    imageObj.src = imageUrl;
}

document.querySelectorAll(".image-button").forEach((button) => {
    button.addEventListener("click", function () {
        const imageUrl = this.getAttribute("data-file-url");
        getCurrentImageUrl(imageUrl);
    });
});

// document.addEventListener('alpine:init', () => {
//     Alpine.data('templateUpload', () => ({

//     }))
// })
document
    .getElementById("templateButton")
    .addEventListener("click", function () {
        document.getElementById("templateImage").click();
    });

document
    .getElementById("templateImage")
    .addEventListener("change", function (event) {
        const file = event.target.files[0];
        if (file) {
            console.log("File selected:", file.name);
            // You can handle the file upload or other actions here
        }
    });
