<?php
session_start();
include "system/lib.php";
not_logged();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Meadow</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/style_buttons.css">
</head>
<body>
<?php include 'assets/header1.php';?>

<div
class="flex-container-direction-row"
style="text-align: center; justify-content: center; flex-wrap: wrap;"
>
  <!--STOPWATCH START-->
  <div id="stopWatchCard"
  class="card_1 flex-container-direction-column"
  style="padding: 5px;">
      <h1>Welcome to Meadow</h1>
      <br>
      <div
      class="display"
      id="displayWatch">00:00:00</div>
      <div
      class="flex-container-direction-row"
      style="justify-content: center;">
          <img
          src="images/play-icon.svg"
          class="control-button"
          id="startButton">
          <img
          src="images/stop-icon.svg"
          class="control-button"
          id="stopButton"
          style="filter: brightness(100%); cursor: default">
      </div>
  </div>
  <!--STOPWATCH END-->
  <div class="gap-1"></div>
  <!--BULLETLIST START-->
  <div id="statsCard"
  class="card_1 flex-container-direction-column"
  style="padding: 5px; justify-content: flex-end;">
    <a href="stats.php">See all your statistics here</a>
  </div>
  <!--BULLETLIST END-->
  <div class="gap-1"></div>
  <!--BULLETLIST START-->
  <div id="listCard"
  class="card_1 flex-container-direction-column"
  style="padding: 5px; max-width: 200px;">
      <h1>This will be worked soon...</h1>
      <br>
      
  </div>
  <!--BULLETLIST END-->

</div>
<div id="footer"></div>
<div id="popup1" class="popup1">
  <div class="popupContent1">
    <p>Some text in the Modal..</p>
  </div>
</div>

</body>
</html>
<script>
/*
let pedido = "buscarUltima";
fetch("sistema/sys_timer.php?" + "&pedido=" + encodeURIComponent(pedido))
  .then(promise => promise.json())
  .then(resultado =>{
    var arraySession = resultado["ultimaSession"];
    var ultimaSession = arraySession[0];


    document.getElementById("footer").textContent = JSON.stringify();
    if(ultimaSession["start_time"] != "") {
      var text =
      "It seens you have a session of " + ultimaSession["tag"]
      + " started at " + ultimaSession["start_time"]
      + " that hasn't been finished properly. Do you wish to continue it now?";

      const startMessage = confirm(text);
      if (startMessage == true) {
        console.log("ok");
      }  else {
        console.log("nope")
      }
    }

      
  });
*/
let startTime;
let stopTime;
let elapsedTime;
let elapsedSeconds;
let myTimer;
let timerStarted;
const startButton = document.getElementById("startButton");
const stopButton = document.getElementById("stopButton");

startButton.addEventListener("click", startWatch);
function startWatch() {
  if (timerStarted != Boolean(true)) {
    timerStarted = Boolean(true);
    startTime = new Date();
    myTimer = setInterval(updateDisplay, 1000);
    
    startButton.style.filter = "brightness(100%)";
    startButton.style.cursor = "default";
    stopButton.style.filter = "";
    stopButton.style.cursor = "pointer";
  }
  console.log("startButton Clicked!");
}

function stopWatch() {
  console.log("stopButton Clicked!");
  totalSeconds = -1;
  updateDisplay();
  stopTime = new Date();
  timerStarted = Boolean(false);
  clearInterval(myTimer);

  startButton.style.filter = "";
  startButton.style.cursor = "pointer";
  stopButton.style.filter = "brightness(100%)";
  stopButton.style.cursor = "default";
}
stopButton.addEventListener("click", stopWatch);


/*TIMER FRONTEND START*/
var totalSeconds = 0;
var totalMinutes = 0;
var totalHours = 0;
const displayWatch = document.getElementById("displayWatch");

function formatTime() {
  const s = String(totalSeconds % 60).padStart(2, "0");
  const m = String((Math.floor(totalSeconds / 60) % 60)).padStart(2, "0");
  const h = String(Math.floor(totalSeconds / 3600)).padStart(2, "0");
  return `${h}:${m}:${s}`;
}
function updateDisplay() {
  totalSeconds = totalSeconds + 1;
  displayWatch.textContent = formatTime();
}
/*TIMER FRONTEND END*/

const footer = document.getElementById("footer");

  
    
</script>