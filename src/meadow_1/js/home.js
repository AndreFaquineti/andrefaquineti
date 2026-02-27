/*DEBUGGING START*/
var pedido = "";

const debuggerElement = document.getElementById("debugger");

function debug() {
    pedido = "debug"

    fetch("system/sys_home.php?" + "&pedido=" + encodeURIComponent(pedido))
    .then(promise => promise.json())
    .then(resultado => {
        var arraySession = resultado["ultimaSession"];
        var ultimaSession = arraySession[0];

        debuggerElement.textContent = JSON.stringify(ultimaSession);
    });
}
debuggerElement.addEventListener("click", debug);
/*DEBUGGING END*/

const modalContainer = document.getElementById("modalContainer");
const modalContent = document.getElementById("modalContent");
const modalText = document.getElementById("modalText");

/*
window.onload = function unfinishedSession() {
    modalText.textContent += "The last text was too creepy so i'll change it."
    modalContainer.style.display = "flex";
}
*/

/*STOPWATCH START*/
const SWstartButton = document.getElementById("SWstartButton");
const SWstopButton = document.getElementById("SWstopButton");

var timerStarted = false;

function startSW() {
    if (timerStarted == false) {
        timerStarted = true;
        console.log("timerStarted = " + timerStarted);

        /*Style Control*/
        SWstartButton.style.filter = "brightness(100%)";
        SWstartButton.style.cursor = "default";
        SWstopButton.style.filter = "";
        SWstopButton.style.cursor = "pointer";

        pedido = "startSession";
        var start_time = Date.now();
        fetch("system/sys_home.php?" + "&pedido=" + encodeURIComponent(pedido)
            + "&start_time" + encodeURIComponent(start_time))
        .then(promise => promise.json())
        .then(result =>{
            let startSession = result["sessionStarted"];
            console.log("startSession = " + startSession);
        })

        /*PHP start signal*/
        pedido = "currentSession";
        fetch("system/sys_home.php?" + "&pedido=" + encodeURIComponent(pedido))
        .then(promise => promise.json())
        .then(result =>{
            let arraySession = result["currentSession"];
            let currentSession = arraySession[0];
            var id_session = currentSession["id_session"];
            start_time = currentSession["start_time"];

            console.log("id_session = " + id_session);
            console.log("start_time = " + start_time);
            console.log("Date.now() = " + Date.now());

            let t = start_time.split(/[- :]/);
            var start_timeMS = new Date(Date.UTC(t[0], t[1]-1, t[2], t[3], t[4], t[5]));
            console.log("start_timeMS = " + start_timeMS);

            var elapsedSeconds = Date.now() - start_timeMS;
            console.log("elapsedSeconds = " + elapsedSeconds);
        })
    }
}
SWstartButton.addEventListener("click", startSW);

function stopSW() {
    if (timerStarted == true) {
        timerStarted = false;
        console.log("timerStarted = " + timerStarted);

        SWstartButton.style.filter = "";
        SWstartButton.style.cursor = "pointer";
        SWstopButton.style.filter = "brightness(100%)";
        SWstopButton.style.cursor = "default";
    }
}
SWstopButton.addEventListener("click", stopSW);
/*STOPWATCH END*/