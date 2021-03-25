function callback(events) {
    return events
}

function getEvents() {

    let xhr = new XMLHttpRequest();
    xhr.addEventListener('readystatechange', function (callback) {
        if (this.readyState == 4 && this.status == 200) {
            let events = JSON.parse(this.responseText);
            // console.log(events);
            return events;
            callback();
        }
    }
    )
    xhr.open("GET", "../../server/tasks/events.php", true);
    xhr.send();
}