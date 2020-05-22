function sleep(delay) {
    var start = new Date().getTime();
    while (new Date().getTime() < start + delay);
}

function check() {
    if (document.getElementById('update-button')) {
        document.getElementById('update-button').click();
        sleep(2000);
    }
    return true;
}