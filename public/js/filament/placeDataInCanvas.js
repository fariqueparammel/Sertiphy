import Konva from "konva";
import konvaObject from "./konvaScript.js";
import { getScalingFactors } from "./konvaScript.js";

let imageFiles = [];
let selectedImageUrl = null;
let selectedText = null;
const fontSizeInput = document.getElementById("fontSizeInput");
var x = [], y = [], fontSize = [], fontColor = [], fontStyle = [];

// Font handling
document.addEventListener("DOMContentLoaded", function () {
    function loadGoogleFonts(fonts) {
        const link = document.createElement("link");
        link.rel = "stylesheet";
        link.href = `https://fonts.googleapis.com/css2?family=${fonts
            .map((f) => f.replace(/ /g, "+"))
            .join("&family=")}&display=swap`;
        document.head.appendChild(link);
    }

    const fonts = [
        "Arial", "Courier New", "Georgia", "Times New Roman", "Verdana",
        "Trebuchet MS", "Lucida Console", "Comic Sans MS", "Tahoma",
        "Garamond", "Impact", "Century Gothic", "Brush Script MT",
        "Roboto", "Lobster", "Open Sans", "Pacifico", "Poppins", "Montserrat"
    ];

    const googleFonts = fonts.slice(10);
    loadGoogleFonts(googleFonts);

    const fontSelector = document.getElementById("fontSelector");
    if (!fontSelector) {
        console.error("Font selector element not found!");
        return;
    }

    fonts.forEach((font) => {
        const option = document.createElement("option");
        option.value = font;
        option.textContent = font;
        option.style.fontFamily = font;
        fontSelector.appendChild(option);
    });

    fontSelector.addEventListener("change", () => {
        if (selectedText) {
            selectedText.fontFamily(fontSelector.value);
            fontStyle[selectedText.name()] = fontSelector.value;
            selectedText.getLayer().batchDraw();
        }
    });
});

// Color picker handling
document.addEventListener("DOMContentLoaded", function () {
    const colorPicker = document.getElementById("colorPicker");
    if (!colorPicker) {
        console.error("Color picker element not found!");
        return;
    }

    colorPicker.addEventListener("input", function () {
        if (selectedText) {
            selectedText.fill(colorPicker.value);
            fontColor[selectedText.name()] = colorPicker.value;
            konvaObject.layer.batchDraw();
        }
    });
});

// Font size handling
fontSizeInput.addEventListener("input", () => {
    if (selectedText) {
        const selectedFontSize = parseInt(fontSizeInput.value, 10);
        if (selectedFontSize > 0) {
            selectedText.fontSize(selectedFontSize);
            fontSize[selectedText.name()] = selectedFontSize;
            konvaObject.layer.batchDraw();
        }
    }
});

const textTransformers = {};

document.querySelectorAll(".listData").forEach((item) => {
    item.addEventListener("click", function (event) {
        if (event.target.classList.contains("remove-btn")) {
            return;
        }

        if (!konvaObject.isImageLoaded()) {
            alert("Please load an image first.");
            return;
        }

        const data = event.target;
        const key = data.closest("li").querySelector(".remove-btn").getAttribute("data-key");
        const value = data.closest("li").querySelector(".remove-btn").getAttribute("data-value");

        const initialPosX = konvaObject.stage.width() / 2;
        const initialPosY = konvaObject.stage.height() / 2;

        const complexText = new Konva.Text({
            x: initialPosX, // Scale initial position
            y: initialPosY,
            text: value,
            fontSize: parseInt(fontSizeInput.value, 10) || 18,
            fontFamily: "Calibri",
            fill: "#555",
            width: 300,
            padding: 20,
            align: "center",
            draggable: false,
            name: key,
        });

        konvaObject.layer.add(complexText);
        konvaObject.layer.batchDraw();

        complexText.on("click", function () {
            removeAllTransformers();
            selectTextObject(complexText, key);
        });
    });
});

function removeAllTransformers() {
    Object.values(textTransformers).forEach((transformer) => transformer.destroy());
    for (const key in textTransformers) {
        delete textTransformers[key];
    }
    konvaObject.layer.batchDraw();
}

function removeCurrentTransformer() {
    if (selectedText) {
        const transformer = textTransformers[selectedText.name()];
        if (transformer) {
            transformer.destroy();
            delete textTransformers[selectedText.name()];
        }
        selectedText = null;
        konvaObject.layer.batchDraw();
    }
}

function selectTextObject(textNode, key) {
    selectedText = textNode;
    removeAllTransformers();

    const tr = new Konva.Transformer({
        anchorStroke: "black",
        anchorFill: "white",
        anchorSize: 8,
        borderStroke: "green",
        borderDash: [3, 3],
        nodes: [textNode],
    });

    konvaObject.layer.add(tr);
    textTransformers[key] = tr;
    textNode.draggable(true);
    track_position(textNode, key);
    konvaObject.layer.batchDraw();
}

document.querySelectorAll(".remove-btn").forEach((button) => {
    button.addEventListener("click", function (event) {
        event.stopPropagation();
        const key = button.getAttribute("data-key");
        const konvaText = konvaObject.layer.findOne(`.${key}`);
        const transformer = textTransformers[key];

        if (konvaText) {
            konvaText.destroy();
            if (transformer) {
                transformer.destroy();
                delete textTransformers[key];
            }
            delete x[key];
            delete y[key];
            delete fontSize[key];
            delete fontColor[key];
            delete fontStyle[key];
            konvaObject.layer.batchDraw();
        }
        selectedText = null;
    });
});

function track_position(text_element, key) {
    console.log("track_position called for key:", key);  // Debugging

    text_element.on("dragmove", function () {
        console.log("Dragging:", key);  // Check if this runs
        const { realscalex, realscaley } = getScalingFactors();
        const uniformScale = (realscalex + realscaley) / 2;
        console.log("Scaling", getScalingFactors());  // Debug log

        const absPos = text_element.getAbsolutePosition();
        console.log("Before Scaling:", absPos.x, absPos.y);  // Debug log

        // Uniform scaling factor: average of realscalex and realscaley


        // Apply the uniform scale factor to position and font size
        x[key] = (absPos.x + 140) * uniformScale;
        y[key] = (absPos.y + 20) * uniformScale;
        fontSize[key] = text_element.fontSize() * uniformScale;

        console.log("After Scaling:", x[key], y[key], fontSize[key]);  // Debug log
    });

    text_element.on("transform", function () {
        fontSize[key] = text_element.fontSize() * uniformScale;  // Apply uniform scaling on transform
    });

    text_element.on("click", function () {
        fontColor[key] = text_element.fill();
        fontSize[key] = text_element.fontSize() * uniformScale;  // Apply uniform scaling on click
        fontStyle[key] = text_element.fontFamily();
    });
}


document.querySelector(".generate").addEventListener("click", function () {
    let dataArray = [];
    for (let key in x) {
        const properties = {
            key: key,
            x: x[key],
            y: y[key],
            fontSize: fontSize[key],
            fontColor: fontColor[key],
            fontStyle: fontStyle[key],
        };
        dataArray.push(properties);
    }

    const jsonObject = JSON.stringify(dataArray);
    selectedImageUrl = localStorage.getItem("selectedImageUrl");

    if (!selectedImageUrl) {
        let storage = {};
        Object.keys(sessionStorage).forEach((key) => {
            storage[key] = sessionStorage.getItem(key);
        });

        function dataUriToFile(dataUri, fileName) {
            const parts = dataUri.split(";base64,");
            const contentType = parts[0].split(":")[1];
            const raw = window.atob(parts[1]);
            const rawLength = raw.length;
            const uInt8Array = new Uint8Array(rawLength);

            for (let i = 0; i < rawLength; ++i) {
                uInt8Array[i] = raw.charCodeAt(i);
            }

            const blob = new Blob([uInt8Array], { type: contentType });
            return new File([blob], fileName, { type: contentType });
        }

        Object.values(storage).forEach((dataUri, index) => {
            const fileName = `image_${index}.${dataUri.split(";")[0].split("/")[1]}`;
            const file = dataUriToFile(dataUri, fileName);
            imageFiles.push(file);
        });
    }

    sessionStorage.clear();
    localStorage.clear();

    async function sendImages() {
        const formData = new FormData();

        if (!selectedImageUrl) {
            imageFiles.forEach((file) => {
                formData.append("images[]", file);
            });
        } else {
            formData.append("selectedImageUrl", selectedImageUrl);
        }

        formData.append("jsonObject", jsonObject);
        formData.append("project_id", currentProjectId);
        formData.append("user_id", user_id);

        console.log("JSON Data Being Sent:", jsonObject);  // Log the JSON data being sent to the server
        console.log("Project ID:", currentProjectId);  // Log the project ID being sent
        console.log("User ID:", user_id);

        try {
            const response = await fetch("/api/uploadDataApi", {
                method: "POST",
                headers: {
                    Accept: "Application/json",
                },
                body: formData,
            });

            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            const status = await response.status;
            if (status == 200) {
                new FilamentNotification()
                    .title("Saved successfully")
                    .success()
                    .seconds(3)
                    .send();

                const apiStatus = new FormData();
                apiStatus.append("status", status);
                apiStatus.append("project_id", currentProjectId);

                setTimeout(function () {
                    document.getElementById("routeToDownload").click();
                }, 3000);

                const pythonRes = await fetch("/api/generation", {
                    method: "POST",
                    headers: {
                        Accept: "Application/json",
                    },
                    body: apiStatus,
                });

                if (!pythonRes.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const pythonResult = await pythonRes.json();
                localStorage.setItem("downloadpath", pythonResult);
            } else {
                new FilamentNotification()
                    .title("Failed to save")
                    .danger()
                    .seconds(5)
                    .send();
            }
        } catch (error) {
            console.error("Error uploading images:", error);
        }
    }

    sendImages();
});

document.querySelector(".clear").addEventListener("click", function () {
    localStorage.clear();
    sessionStorage.clear();
    konvaObject.layer.destroyChildren();
    konvaObject.layer.batchDraw();

    selectedText = null;
    Object.keys(x).forEach((key) => delete x[key]);
    Object.keys(y).forEach((key) => delete y[key]);
    Object.keys(fontSize).forEach((key) => delete fontSize[key]);
    Object.keys(fontColor).forEach((key) => delete fontColor[key]);
    Object.keys(fontStyle).forEach((key) => delete fontStyle[key]);
});
