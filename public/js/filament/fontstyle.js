// import { selectedone } from "./placeDataInCanvas.js";
// document.addEventListener("DOMContentLoaded", function () {
    
//     // Function to dynamically load Google Fonts
//     function loadGoogleFonts(fonts) {
//         const link = document.createElement("link");
//         link.rel = "stylesheet";
//         link.href = `https://fonts.googleapis.com/css2?family=${fonts.map(f => f.replace(/ /g, "+")).join("&family=")}&display=swap`;
//         document.head.appendChild(link);
//     }

//     // List of fonts including Google Fonts
//     const fonts = [
//         'Arial', 'Courier New', 'Georgia', 'Times New Roman', 'Verdana', 
//         'Trebuchet MS', 'Lucida Console', 'Comic Sans MS', 'Tahoma',
//         'Garamond', 'Impact', 'Century Gothic', 'Brush Script MT',
//         'Roboto', 'Lobster', 'Open Sans', 'Pacifico', 'Poppins', 'Montserrat'
//     ];

//     // Load only the Google Fonts
//     const googleFonts = fonts.slice(10); // Extract only the Google Fonts
//     loadGoogleFonts(googleFonts);

//     // Ensure the font selector exists before running script
//     const fontSelector = document.getElementById('fontSelector');
    
//     if (!fontSelector) {
//         console.error("Font selector element not found!");
//         return;
//     }

//     // Populate font selector
//     fonts.forEach((font) => {
//         const option = document.createElement('option');
//         option.value = font;
//         option.textContent = font;
//         option.style.fontFamily = font;
//         fontSelector.appendChild(option);
//     });
// const selectedText=selectedone();
//     // Change font style of selected text only
//     fontSelector.addEventListener('change', () => {
//         if (selectedText) {
//             selectedText.fontFamily(fontSelector.value);
//             selectedText.getLayer().batchDraw(); // Redraw to reflect changes
//         } else {
//             console.warn("No text selected!");
//         }
//     });
// });