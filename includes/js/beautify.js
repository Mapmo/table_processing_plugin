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