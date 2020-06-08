var jsonObj;

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

function getPathToBeautifier() {
    return "./users/" + getUsername() + "/beautifiers/" + getTableName() + ".json";
}

function getJson() {

    var path = getPathToBeautifier();

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.status == 200 && xmlhttp.readyState == 4) {
            jsonObj = JSON.parse(xmlhttp.responseText);
        }
    };
    xmlhttp.open("GET", path, true);
    xmlhttp.send();
}