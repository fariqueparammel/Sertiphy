import Konva from "konva";
import konvaObject from "./konvaScript.js";
// import { track_position } from "./btnfunctions.js";


let selectedText = null;
const fontSizeInput = document.getElementById('fontSizeInput');
fontSizeInput.addEventListener('input', () => {
    if (selectedText) {
        const selectedFontSize = parseInt(fontSizeInput.value, 10);
        if (selectedFontSize > 0) {
            selectedText.fontSize(selectedFontSize);
            konvaObject.layer.batchDraw();
        }
    }
});
document.addEventListener("DOMContentLoaded", function () {

    // Function to dynamically load Google Fonts
    function loadGoogleFonts(fonts) {
        const link = document.createElement("link");
        link.rel = "stylesheet";
        link.href = `https://fonts.googleapis.com/css2?family=${fonts.map(f => f.replace(/ /g, "+")).join("&family=")}&display=swap`;
        document.head.appendChild(link);
    }

    // List of fonts including Google Fonts
    const fonts = [
        'Arial', 'Courier New', 'Georgia', 'Times New Roman', 'Verdana',
        'Trebuchet MS', 'Lucida Console', 'Comic Sans MS', 'Tahoma',
        'Garamond', 'Impact', 'Century Gothic', 'Brush Script MT',
        'Roboto', 'Lobster', 'Open Sans', 'Pacifico', 'Poppins', 'Montserrat'
    ];

    // Load only the Google Fonts
    const googleFonts = fonts.slice(10); // Extract only the Google Fonts
    loadGoogleFonts(googleFonts);

    // Ensure the font selector exists before running script
    const fontSelector = document.getElementById('fontSelector');

    if (!fontSelector) {
        console.error("Font selector element not found!");
        return;
    }

    // Populate font selector
    fonts.forEach((font) => {
        const option = document.createElement('option');
        option.value = font;
        option.textContent = font;
        option.style.fontFamily = font;
        fontSelector.appendChild(option);
    });

    // Change font style of selected text only
    fontSelector.addEventListener('change', () => {
        if (selectedText) {
            selectedText.fontFamily(fontSelector.value);
            selectedText.getLayer().batchDraw(); // Redraw to reflect changes
        } else {
            console.warn("No text selected!");
        }
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const colorPicker = document.getElementById("colorPicker");

    if (!colorPicker) {
        console.error("Color picker element not found!");
        return;
    }

    colorPicker.addEventListener("input", function () {
        if (selectedText) {
            selectedText.fill(colorPicker.value);  // Change text color
            konvaObject.layer.batchDraw();  // Redraw to reflect changes
        } else {
            console.warn("No text selected!");
        }
    });
});


document.addEventListener("DOMContentLoaded", function () {

    const textTransformers = {}; // Store text-transformer pairs


    document.querySelectorAll(".listData").forEach((item) => {
        item.addEventListener("click", function (event) {

            // If the click target is the "X" button, stop the event from propagating
            if (event.target.classList.contains("remove-btn")) {
                return; // Skip processing the creation logic when the X button is clicked
            }

            if (!konvaObject.isImageLoaded()) {
                alert("Please load an image first.");
                return;
            }

            const data = event.target;
            const key = data.closest('li').querySelector(".remove-btn").getAttribute("data-key");
            const value = data.closest('li').querySelector(".remove-btn").getAttribute("data-value");

            const initialPosX = konvaObject.stage.width() / 2 - 50;
            const initialPosY = konvaObject.stage.height() / 2 - 25;

            const complexText = new Konva.Text({

                x: initialPosX,
                y: initialPosY,
                text: value,
                fontSize: 18,
                fontFamily: "Calibri",
                fill: "#555",
                width: 300,
                padding: 20,
                fontSize: parseInt(fontSizeInput.value, 10),
                align: "center",
                draggable: false, // Disable dragging initially
                name: key,
            });

            // Add the text node to the layer
            konvaObject.layer.add(complexText);
            konvaObject.layer.batchDraw(); // Force the layer to redraw immediately

            // Add click event to select the text and assign transformer
            complexText.on("click", function () {
                console.log("Text clicked: ", complexText.name());
                removeAllTransformers(); // Remove all transformers before selecting the new one
                selectTextObject(complexText, key);
            });

            // Ensure the layer redraws after adding the text node
            konvaObject.layer.batchDraw();
        });
    });

    function removeAllTransformers() {
        // Remove all transformers from all text nodes
        Object.values(textTransformers).forEach(transformer => transformer.destroy());
        // Clear the transformer store after removal
        for (const key in textTransformers) {
            delete textTransformers[key];
        }
        konvaObject.layer.batchDraw(); // Redraw the layer after removing all transformers
    }

    function removeCurrentTransformer() {
        if (selectedText) {
            const transformer = textTransformers[selectedText.name()];
            if (transformer) {
                transformer.destroy();
                delete textTransformers[selectedText.name()];
            }
            selectedText = null;
            konvaObject.layer.batchDraw(); // Ensure the layer redraw happens
        }
    }

    function selectTextObject(textNode, key) {
        selectedText = textNode;

        // Ensure previous transform box is removed before adding a new one
        removeAllTransformers(); // Remove any existing transformers

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

        // Enable dragging only after transformer is added
        textNode.draggable(true);
        track_position(textNode, key);

        konvaObject.layer.batchDraw(); // Redraw the layer after transformer is added
    }

    // Add event listener for removing a text node and its transformer
    document.querySelectorAll(".remove-btn").forEach((button) => {
        button.addEventListener("click", function (event) {
            event.stopPropagation(); // Prevent event propagation so it doesn't trigger the "click" event on .listData

            const key = button.getAttribute("data-key");
            const konvaText = konvaObject.layer.findOne(`.${key}`);
            const transformer = textTransformers[key];

            if (konvaText) {
                // Destroy the text node and its transformer
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
                // Redraw the layer after removing the node
                konvaObject.layer.batchDraw();
            }

            // Clear selected text after deletion
            selectedText = null;
        });
    });
});
var x = [], y = [], fontSize = [], fontColor = [], fontStyle = [];

export function track_position(text_element, key) {
    text_element.on('dragmove', function () {
        x[key] = text_element.x();
        y[key] = text_element.y();
    });

    text_element.on('transform', function () {
        fontSize[key] = text_element.fontSize();
    });

    text_element.on('click', function () {
        fontColor[key] = text_element.fill();
        fontSize[key] = text_element.fontSize();
        fontStyle[key] = text_element.fontFamily();
    });
}
fontSizeInput.addEventListener('input', () => {
    if (selectedText) {
        const selectedFontSize = parseInt(fontSizeInput.value, 10);
        if (selectedFontSize > 0) {
            selectedText.fontSize(selectedFontSize);
            fontSize[selectedText.name()] = selectedFontSize; // Update tracking data
            konvaObject.layer.batchDraw();
        }
    }
});
colorPicker.addEventListener("input", function () {
    if (selectedText) {
        selectedText.fill(colorPicker.value);
        fontColor[selectedText.name()] = colorPicker.value; // Update tracking data
        konvaObject.layer.batchDraw();
    }
});
fontSelector.addEventListener('change', () => {
    if (selectedText) {
        selectedText.fontFamily(fontSelector.value);
        fontStyle[selectedText.name()] = fontSelector.value; // Update tracking data
        konvaObject.layer.batchDraw();
    }
});
// Event listener for Generate button
document.querySelector(".generate").addEventListener("click", function () {
    for (let key in x) {
        console.log(`Key: ${key}, X: ${x[key]}, Y: ${y[key]}, Font Size: ${fontSize[key]}, Color: ${fontColor[key]}, Font Style: ${fontStyle[key]}`);
    }
});
document.querySelector(".clear").addEventListener("click", function () {
    konvaObject.layer.destroyChildren(); // Remove all objects from the layer
    konvaObject.layer.batchDraw(); // Redraw the canvas to reflect changes

    // Clear stored text properties
    selectedText = null;
    Object.keys(x).forEach(key => delete x[key]);
    Object.keys(y).forEach(key => delete y[key]);
    Object.keys(fontSize).forEach(key => delete fontSize[key]);
    Object.keys(fontColor).forEach(key => delete fontColor[key]);
    Object.keys(fontStyle).forEach(key => delete fontStyle[key]);
});
