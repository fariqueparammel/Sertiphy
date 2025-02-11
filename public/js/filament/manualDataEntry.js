import { TabulatorFull as Tabulator } from "tabulator-tables";
// import * as XLSX from "xlsx";

// document.addEventListener("DOMContentLoaded", function () {
//     console.log("test");
// let table = new Tabulator("#table", {
//     // dependencies: {
//     //     Tabulator: MyDependency,
//     // },
//     // layout: "fitColumns",
//     // columns: [{ title: "Column 1", field: "col1", editor: "input" }],
//     // data: [{ col1: "" }, { col1: "" }],
//     // height: "100%",

// });

//define data
var tabledata = [
    {
        id: 1,
        name: "Billy Bob",
        age: "12",
        gender: "male",
        height: 1,
        col: "red",
        dob: "",
        cheese: 1,
    },
    {
        id: 2,
        name: "Mary May",
        age: "1",
        gender: "female",
        height: 2,
        col: "blue",
        dob: "14/05/1982",
        cheese: true,
    },
];

//define table
var table = new Tabulator("#example-table", {
    data: tabledata,
    // autoColumns: true,
    columns: [
        { title: "Name", field: "name" },
        { title: "Age", field: "age" },
        { title: "Gender", field: "gender" },
        { title: "Height", field: "height" },
        { title: "Favourite Color", field: "col" },
        { title: "Date Of Birth", field: "dob" },
        { title: "Cheese Preference", field: "cheese" },
    ],
});
// });
