var owner = document.getElementById("owner").value;
var user = document.getElementById("user").value;

var jsonLockedCells;
var pathToCellLocking = "./users/" + owner + "/cell_locking/" + getTableName() + ".json";

function toggleLockingOfCell() {

    var row = document.getElementById("rowToFormat").value;
    var col = document.getElementById("colToFormat").value;

    if (!isNaN(row) && !isNaN(col)) {
        var nameOfCell = row + "|" + col;
        var cell = document.getElementsByName(nameOfCell)[0];
        cell.classList.toggle("lockCellStyleOwner");
    }
}

function toggleLockingOfRow() {
    var row = document.getElementById("rowToFormat").value;
    var table = document.getElementById("currentTable");
    var tableRow = table.rows[parseInt(row)];
    var cells = tableRow.cells;

    Array.from(cells).forEach(cell => {
        cell.childNodes[0].classList.toggle("lockCellStyleOwner");
    });
}

function toggleLockingOfCol() {
    var col = document.getElementById("colToFormat").value;
    var table = document.getElementById("currentTable");
    var cell;

    Array.from(table.rows).forEach(row => {
        cell = row.cells[parseInt(col)]
        cell.childNodes[0].classList.toggle("lockCellStyleOwner");
    });
}

function getJsonCellLocking() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.status == 200 && xmlhttp.readyState == 4) {
            jsonLockedCells = JSON.parse(xmlhttp.responseText);
            lockCells();
        }
    };
    xmlhttp.open("GET", pathToCellLocking + "?nocache=" + (new Date()).getTime(), true);
    xmlhttp.send();
}


function lockCells() {

    lockedCells = jsonLockedCells["locked"];

    if (typeof lockedCells !== "undefined") {
        lockedCells.forEach(cell => {
            var row = cell["row"];
            var col = cell["col"];
            var nameOfCell = row + "|" + col;
            var cell = document.getElementsByName(nameOfCell)[0];

            if (typeof cell !== 'undefined') {

                if (user === owner) {
                    cell.classList.add("lockCellStyleOwner");
                } else {
                    cell.classList.add("lockCellStyleViewer");
                    cell.setAttribute("readonly", "");
                }
            }
        });
    }
}

function updateLocking() {
    //update only if the user is the owner of the current table
    if (user === owner) {
        var obj = {
            "jsonFilePath": pathToCellLocking,
            "content": {
                "locked": getLockedCells(),
            }
        }

        var json = JSON.stringify(obj);
        sendAjaxPostRequest(json);
    }
}

function getLockedCells() {
    var cells = document.getElementsByClassName("lockCellStyleOwner");
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

function toggleLockFromTo() {

    var fromCell = document.getElementById("fromCell").value;
	fromCell = fromCell.toUpperCase();
    var toCell = document.getElementById("toCell").value;
	toCell = toCell.toUpperCase();

    var fromRow = getRow(fromCell);
    var fromCol = getCol(fromCell);

    var toRow = getRow(toCell);
    var toCol = getCol(toCell);

    if (!isNaN(fromRow) && !isNaN(fromCol) && !isNaN(toRow) && !isNaN(toCol)) {

        for (var i = fromRow; i <= toRow; i++) {
            for (var j = fromCol; j <= toCol; j++) {

                var nameOfCell = i + "|" + j;
                var cell = document.getElementsByName(nameOfCell)[0];
                cell.classList.toggle("lockCellStyleOwner");
            }
        }
    }
}

function getRow(cell) {
    var num = cell.replace(/[A-Z]/g, '');
    return num;
}

function getCol(cell) {
    var alpha = cell.replace(/[0-9]/g, '');
    var column = 0;
    var length = alpha.length;

    for (var i = 0; i < length; i++) {
        column += (alpha.charCodeAt(i) - 64) * Math.pow(26, length - i - 1);
    }

    return column;
}
