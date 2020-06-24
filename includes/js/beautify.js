var owner = document.getElementById("owner").value;
var user = document.getElementById("user").value;

var jsonObj;
var pathToBeautifier = "./users/" + owner + "/beautifiers/" + getTableName() + ".json";

function toggleBoldStyle() {
    toggleStyle("boldStyle");
}

function toggleItalicStyle() {
    toggleStyle("italicStyle");
}

function toggleUnderlineStyle() {
    toggleStyle("underlineStyle");
}

function toggleStyle(style) {
    var row = document.getElementById("rowToFormat").value;
    var col = document.getElementById("colToFormat").value;

    if (!isNaN(row) && !isNaN(col)) {
        var nameOfCell = row + "|" + col;
        var cell = document.getElementsByName(nameOfCell)[0];
        if(cell.getAttribute("readonly") === "") {
			return;
		} 
		cell.classList.toggle(style);
    }
}

function getJsonBeautifier() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.status == 200 && xmlhttp.readyState == 4) {
            jsonObj = JSON.parse(xmlhttp.responseText);
            applyAllStyles();
        }
    };
    xmlhttp.open("GET", pathToBeautifier + "?nocache=" + (new Date()).getTime(), true);
    xmlhttp.send();
}

function getTableName() {
    var exportFilename = document.getElementsByName("exportFilename")[0].value;
    return exportFilename.split('.')[0];
}

function applyAllStyles() {

    var boldCells = jsonObj["bold"];
    var italicCells = jsonObj["italic"];
    var underlineCells = jsonObj["underline"];

    if (typeof boldCells !== "undefined") {
        applyStyle(boldCells, "boldStyle");
    }
    if (typeof italicCells !== "undefined") {
        applyStyle(jsonObj["italic"], "italicStyle");
    }
    if (typeof underlineCells !== "undefined") {
        applyStyle(jsonObj["underline"], "underlineStyle");
    }
}

function applyStyle(cells, style) {
    cells.forEach(cell => {
        var row = cell["row"];
        var col = cell["col"];
        var nameOfCell = row + "|" + col;
        var cell = document.getElementsByName(nameOfCell)[0];
        cell.classList.add(style);
    });
}

function updateBeautifier() {
    var obj = {
        "jsonFilePath": pathToBeautifier,
        "content": {
            "bold": getUpdatedCells("boldStyle"),
            "italic": getUpdatedCells("italicStyle"),
            "underline": getUpdatedCells("underlineStyle"),
        }
    };

    var json = JSON.stringify(obj);

    sendAjaxPostRequest(json);
}

function getUpdatedCells(style) {
    var cells = document.getElementsByClassName(style);
    var cellsJson = new Array();

    if (cells.length > 0) {
        Array.from(cells).forEach(cell => {
            var dimensions = cell["name"].split("|");
            var dimensionsJson = {
                "row": dimensions[0],
                "col": dimensions[1]
            };
            cellsJson.push(dimensionsJson);
        });
    }

    return cellsJson;
}
