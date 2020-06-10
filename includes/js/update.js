function sleep(delay) {
    var start = new Date().getTime();
    while (new Date().getTime() < start + delay);
}

function check() {
    if (document.getElementById('updateButton')) {
        document.getElementById('updateButton').click();
    }
    updateBeautifier();
    sleep(2000);
    return true;
}

