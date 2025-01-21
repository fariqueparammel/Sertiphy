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
    stage.x((containerWidth - sceneWidth * scalew) / 2);
    stage.y((containerHeight - sceneHeight * scaleh) / 2);

    // Force the layer to redraw (important for scaling)
    layer.batchDraw();
}

fitStageIntoParentContainer();
window.addEventListener("resize", fitStageIntoParentContainer);

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
            // console.log("File selected:", file);
            uploadedImageDisplay(file);
        }
    });
function uploadedImageDisplay(file) {
    const uploadedImage = document.querySelector(".uploaded-image-button");

    // Clone the button element (including its child elements like <img>)
    const cloneUploadedImageElement = uploadedImage.cloneNode(true);

    // Show the cloned button
    cloneUploadedImageElement.style.display = "block";

    // Find the <img> element inside the cloned button
    const clonedImageElement = cloneUploadedImageElement.querySelector(
        ".uploaded-template-image"
    );
    console.log(clonedImageElement);
    // Set the <img> element's src to the uploaded file's URL
    const imageUrl = URL.createObjectURL(file);
    console.log(imageUrl);
    clonedImageElement.src = imageUrl;

    clonedImageElement.style.display = "block";
    // const newDiv = document.createElement("div");

    // newDiv.classList.add("uploaded-image-container");
    // document.body.appendChild(newDiv);
    // const lastImageContainer = document.querySelector("div.uploaded-image-container:last-of-type");// Correct selector
    // const lastMarkElement = document.querySelector(lastImageContainer);
    // Append the cloned button (with the updated <img>) to the container

    const newDiv = document.createElement("div");

    newDiv.classList.add("uploaded-image-container");
    newDiv.id = "div" + Date.now(); //using timestamp for unique div id
    document.getElementById("upload-template").appendChild(newDiv);
    document
        .getElementById("div" + Date.now())
        .appendChild(cloneUploadedImageElement);

    // Create a URL for the uploaded file
    // const imageUrl = URL.createObjectURL(file);

    // // Set the image source to the uploaded file
    // uploadImageDisplay.src = imageUrl;

    // // Optional: Log the file name
    // console.log("File selected:", file.name);
}
