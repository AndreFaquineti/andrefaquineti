let startTime;
let stopTime;
let elapsedTime;
let elapsedSeconds;
let myTimer;
let timerStarted;

const startButton = document.getElementById("startButton");
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
const stopButton = document.getElementById("stopButton");
stopButton.addEventListener("click", stopWatch);


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