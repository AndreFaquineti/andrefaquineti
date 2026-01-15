<?php
session_start();
include "sistema/lib.php";
not_logged();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Meadow</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<!--HEADER START-->
<div id="header-home" class="flex-container-direction-row" style="display: flex; justify-content: end;">
    <div id="header-nameDisplay">
        <p>
            <?php echo "Logged as: " . $_SESSION["user_nickname"] . "<br>Under " . $_SESSION["user_email"]?>
        </p>
    </div>
    <a href="settings.php">
        <img
          src="images/settings-icon.svg"
          class="control-button2"
          id="submitInput">
    </a>
    <a href="exit.php">
        <img
          src="images/logout-icon.svg"
          class="control-button2"
          id="submitInput">
    </a>
</div>
<!--HEADER END-->
<div
class="flex-container-direction-row"
style="text-align: center; justify-content: center; flex-wrap: wrap;"
>
  <!--STOPWATCH-->
  <div
  class="flex-container-direction-column"
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
          id="stopButton">
      </div>
  </div>
  <!--STOPWATCH-->
  <div class="gap-1"></div>
  <!--BULLETLIST-->
  <div
  class="flex-container-direction-column"
  style="padding: 5px;">
      <h1>This will be worked soon...</h1>
      <br>
      
  </div>
</div>
<div id="dbstate"></div>
</body>
</html>
<script>
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
  if (timerStarted != true) {
    timerStarted = true;
    startTime = new Date();
    console.log("start time = ", startTime);
    myTimer = setInterval(updateDisplay, 1000);
    
    startButton.style.filter = "brightness(100%)";
  }
  console.log("startButton Clicked!");
}

function stopWatch() {
  console.log("stopButton Clicked!");
  totalSeconds = -1;
  updateDisplay();
  stopTime = new Date();
  timerStarted = false;
  clearInterval(myTimer);

  startButton.style.filter = "";
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

    fetch("sistema/sys_timer.php")
    .then(promise => promise.text())
    .then(resultado =>{
        document.getElementById("dbstate").innerHTML = resultado;
    });
</script>