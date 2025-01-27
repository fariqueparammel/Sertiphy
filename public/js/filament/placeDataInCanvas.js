import Konva from "konva";
import konvaObject from "./konvaScript.js";
// import { stage, layer } from "./konvaScript.js";
document.addEventListener("DOMContentLoaded", function () {
    // Your code

    document.querySelectorAll(".listData").forEach((item) => {
        item.addEventListener("click", function (event) {
            let data = event.target;
            // console.log(data);
            let key = data.querySelector("#data-container").getAttribute("key");
            // console.log(key);
            let value = data
                .querySelector("#data-container")
                .getAttribute("value");
            // console.log(value);
            var initialPosX = konvaObject.stage.width() / 2 - 50;
            var initialPosY = konvaObject.stage.height() / 2 - 25;
            // can make the value toggle between heading or value to be display based ona toggle button with if
            var complexText = new Konva.Text({
                x: initialPosX,
                y: initialPosY,
                text: key,
                fontSize: 18,
                fontFamily: "Calibri",
                fill: "#555",
                width: 300,
                padding: 20,
                align: "center",
                draggable: true,
            });

            var tr = new Konva.Transformer({
                anchorStroke: "black",
                anchorFill: "white",
                anchorSize: 8,
                borderStroke: "green",
                borderDash: [3, 3],
                nodes: [complexText],
            });
            konvaObject.layer.add(tr);

            complexText.on("mouseover", function () {
                document.body.style.cursor = "grab";
            });
            complexText.on("mouseout", function () {
                document.body.style.cursor = "default";
            });
            konvaObject.layer.add(complexText);
        });
    });
});
