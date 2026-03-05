<!DOCTYPE html>
<html>
<head>
    <title>Meadow - Home</title>
    <meta charset="UT-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="home.css">
</head>
<body>
<div id="stopwatch" class="card1">
    <img id="swSymbol" src="/andrefaquineti/src/meadow/images/timer-icon.svg" class="icon1">
    <div id="swDisplay">00:00:00</div>
    <div id="swTag" style="margin: 10px 0px 20px;">
        <select id="swTagSelect"><option selected disabled hidden>Tag</option></select>
    </div>
    <div id="swSubtag">
        <select id="swSubtagSelect"><option selected disabled hidden>Subtag</option></select>
    </div>
    <div id="swControllers">
        <img id="swStart" src="/andrefaquineti/src/meadow/images/play-icon.svg" class="controlButton">
        <img id="swStop" src="/andrefaquineti/src/meadow/images/stop-icon.svg" class="controlButton">
    </div>
</div>
</body>
</html>

<script>
/*STOPWATCH CONTROLLERS START*/
const swDisplay = document.getElementById("swDisplay");
const swStart = document.getElementById("swStart");
const swStop = document.getElementById("swStop");

var startTime;

/*Initial Styles*/
swStart.style.filter = "brightness(1000%)";
swStart.style.cursor = "pointer";
swStop.style.filter = "brightness(90%)";
swStop.style.cursor = "default";

/*STOPWATCH STARTFUNCTION START*/
var swStarted = false;
var startTime;
function startStopwatch() {
    if (swStarted == true) {
        return;
    }
    /*STYLE BUTTON*/
    swStart.style.filter = "brightness(90%)";
    swStart.style.cursor = "default";
    swStop.style.filter = "brightness(1000%)";
    swStop.style.cursor = "pointer";

    startTime = new Date();
    runDisplay();

    swStarted = true;
}
swStart.addEventListener("click", startStopwatch);
/*STOPWATCH STARTFUNCTION STOP*/

var swTimeout;
var swDisplayElapsedTime = 0;
var currentTime;
var swDisplaySeconds;
var swDisplayMinutes;
var swDisplayHours;
var swDisplayFormattedTime;

function runDisplay() {
    currentTime = new Date();
    swDisplayElapsedTime = currentTime - startTime;

    swDisplaySeconds = Math.floor(swDisplayElapsedTime / 1000);
    swDisplayMinutes = Math.floor(swDisplaySeconds / 60);
    swDisplayHours = Math.floor(swDisplayMinutes / 60);

    swDisplayFormattedTime = String(swDisplayHours % 60 + ":").padStart(3, "0");
    swDisplayFormattedTime += String(swDisplayMinutes % 60 + ":").padStart(3, "0");
    swDisplayFormattedTime += String(swDisplaySeconds % 60).padStart(2, "0");

    swDisplay.textContent = swDisplayFormattedTime;

    swTimeout = setTimeout(runDisplay, 1000);
}
    
function stopStopwatch() {
    if (swStarted == false) {
        return;
    }
    /*STYLE BUTTON*/
    swStart.style.filter = "brightness(1000%)";
    swStart.style.cursor = "pointer";
    swStop.style.filter = "brightness(90%)";
    swStop.style.cursor = "default";

    clearTimeout(swTimeout);
    
    swDisplay.textContent = "00:00:00";
    swStarted = false;
}
swStop.addEventListener("click", stopStopwatch);
/*STOPWATCH CONTROLLERS END*/
</script>