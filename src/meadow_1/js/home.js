/*DEBUGGING START*/
var pedido = "debug";

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

/*STOPWATCH START*/
const SWstartButton = document.getElementById("SWstartButton");
const SWstopButton = document.getElementById("SWstopButton");

var timerStarted = false;

function startSW() {
    if (timerStarted == false) {
        timerStarted = true;
        console.log("timerStarted = " + timerStarted);

        SWstartButton.style.filter = "brightness(100%)";
        SWstartButton.style.cursor = "default";
        SWstopButton.style.filter = "";
        SWstopButton.style.cursor = "pointer";
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