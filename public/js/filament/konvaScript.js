import Konva from "konva";

let sceneWidth = 900;
let sceneHeight = 900;

// first we need to create a stage

var stage = new Konva.Stage({
    container: "container", // id of container <div>
    width: sceneWidth,
    height: sceneHeight,
});

// then create layer
var layer = new Konva.Layer();
stage.add(layer);
// create our shape
var circle = new Konva.Circle({
    x: stage.width() / 2,
    y: stage.height() / 2,
    radius: 70,
    fill: "red",
    stroke: "black",
    strokeWidth: 4,
});

// add the shape to the layer
layer.add(circle);

// add the layer to the stage

// draw the image
layer.draw();

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

function myFunction(fileUrl) {
    console.log("Button clicked! File URL:", fileUrl);
}

document.querySelectorAll(".image-button").forEach((button) => {
    button.addEventListener("click", function () {
        const fileUrl = this.getAttribute("data-file-url");
        myFunction(fileUrl);
    });
});
