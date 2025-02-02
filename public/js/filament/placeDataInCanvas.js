import Konva from "konva";
import konvaObject from "./konvaScript.js";

document.addEventListener("DOMContentLoaded", function () {
    let selectedText = null;
    const textTransformers = {}; // Store text-transformer pairs

    // Handle clicks on the text creation list
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

                // Redraw the layer after removing the node
                konvaObject.layer.batchDraw();
            }

            // Clear selected text after deletion
            selectedText = null;
        });
    });
});
