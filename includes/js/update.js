function sleep(delay) {
    var start = new Date().getTime();
    while (new Date().getTime() < start + delay);
}

function check() {
    if (document.getElementById('updateButton')) {
        document.getElementById('updateButton').click();
    }
    updateBeautifier();
    updateLocking();
    sleep(500);
    return true;
}

function search() {
    document.getElementById('searchButton').click();
}

function setFileLockTimeoutSec(seconds) {
    setTimeout(search, seconds*1000);//Countdown till forcefully refreshing the user's session
}

//called when the body of visual.php is loaded so that any previous styles could be applied and cells - locked
function getJson() {
    getJsonBeautifier();
    getJsonCellLocking();
}

// sends an ajax request to update the format - styles and locked cells
function sendAjaxPostRequest(json) {
    var path = "./includes/format_update.php";

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", path, true);

    xmlhttp.setRequestHeader("Content-Type", "application/json;");
    xmlhttp.send(json);
}

// update hidden input fields in visual.php every time it's clicked on a new cell
function updateRowAndCol(row, col) {
    document.getElementById("rowToFormat").value = row;
    document.getElementById("colToFormat").value = col;
}