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

function search() {
		document.getElementById('searchButton').click();
}

setTimeout(search, 100000) //Countdown till forcefully refreshing the user's session
