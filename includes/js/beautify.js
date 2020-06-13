var jsonObj;
var pathToBeautifier = "./users/" + getUsername() + "/beautifiers/" + getTableName() + ".json";

function toggleBoldStyle() {

    var row = document.getElementById("rowToBeautify").value;
    var col = document.getElementById("colToBeautify").value;

    if (!isNaN(row) && !isNaN(col)) {
        var nameOfCell = row + "|" + col;
        var cell = document.getElementsByName(nameOfCell)[0];
        cell.classList.toggle("boldStyle");
    }
}

function toggleItalicStyle() {

    var row = document.getElementById("rowToBeautify").value;
    var col = document.getElementById("colToBeautify").value;

    if (!isNaN(row) && !isNaN(col)) {
        var nameOfCell = row + "|" + col;
        var cell = document.getElementsByName(nameOfCell)[0];
        cell.classList.toggle("italicStyle");
    }
}

function toggleUnderlineStyle() {

    var row = document.getElementById("rowToBeautify").value;
    var col = document.getElementById("colToBeautify").value;

    if (!isNaN(row) && !isNaN(col)) {
        var nameOfCell = row + "|" + col;
        var cell = document.getElementsByName(nameOfCell)[0];
        cell.classList.toggle("underlineStyle");
    }
}

function updateRowAndCol(row, col) {
    document.getElementById("rowToBeautify").value = row;
    document.getElementById("colToBeautify").value = col;
}

function getTableName() {
    var exportFilename = document.getElementsByName("exportFilename")[0].value;
    return exportFilename.split('.')[0];
}

function getUsername() {
    var fileToSave = document.getElementsByName("fileТoSave")[0].value;
    return fileToSave.split('/')[1];
}

function getJson() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.status == 200 && xmlhttp.readyState == 4) {
            jsonObj = JSON.parse(xmlhttp.responseText);
            applyAllStyles();
        }
    };
    xmlhttp.open("GET", pathToBeautifier, true);
    xmlhttp.send();
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

    var path = "./includes/beautifier_update.php";

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", path, true);

    xmlhttp.setRequestHeader("Content-Type", "application/json;");
    xmlhttp.send(json);
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
