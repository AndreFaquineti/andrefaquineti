<?php
session_start();
require "controllers/connection.php";
/*KICK UNLOGGED*/
if (!isset($_SESSION["id_user"])) {
    header("Location: pages/login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Meadow - Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="home.css">
</head>
<body>
<div id="navbar">
    <div id="navLogo">Meadow</div>
    <div id="navgap" style="width: 100%"></div><!--INLINE STYLE-->
    <div id="navUser" style="padding: 5px; color: white; background-color: #9C7E41; border-radius: 10px;"></div>
    <!--navUser IS SUPPOSED TO BE TEMPORARY-->
    <a href="statistics.php"><img id="statistics" src="images/stats-icon.svg" class="navButton"></a>
    <img id="settings" src="images/settings-icon.svg" class="navButton">
    <a href="controllers/exit.php"><img id="logout" src="images/logout-icon.svg" class="navButton"></a>
</div>
<div id="stopwatch" class="card1">
    <img id="swSymbol" src="images/timer-icon.svg" class="icon1">
    <div id="swDisplay">00:00:00</div>
    <div id="swTag" style="margin: 10px -15px 20px 0px; display: flex; flex-direction: row;"><!--INLINE STYLE-->
        <select id="swTagSelect"><option selected disabled hidden>Tag</option></select>
        <img id="swAddTag" src="images/add-icon.svg" class="navButton">
    </div>
    <div id="swSubtag" style="margin: 0px -15px 0px 0px; display: flex; flex-direction: row;"><!--INLINE STYLE-->
        <select id="swSubtagSelect"><option selected disabled hidden>Subtag</option></select>
        <img id="swAddSubtag" src="images/add-icon.svg" class="navButton">

    </div>
    <div id="swControllers">
        <img id="swStart" src="images/play-icon.svg" class="controlButton">
        <img id="swStop" src="images/stop-icon.svg" class="controlButton">
    </div>
</div>
</body>
</html>

<script>
/*STOPWATCH CONTROLLERS START*/
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

        /*STYLE SELECTORS*/
        swTagSelect.setAttribute("disabled", true);
        swSubtagSelect.setAttribute("disabled", true);

        startTime = new Date();
        swStartPhpController();
        runDisplay();

        swStarted = true;
    }
    swStart.addEventListener("click", startStopwatch);

    function swStartPhpController() {
        let request = "startSw";
        fetch("controllers/swController.php?" +
        "&request=" + encodeURIComponent(request) +
        "&swTagValue=" + encodeURIComponent(swTagValue) +
        "&swSubtagValue=" + encodeURIComponent(swSubtagValue))
        .then(response => response.json())
        .then(response => {
        let result = response["startSw"];
        }
        );
    }
/*STOPWATCH STARTFUNCTION STOP*/

/*RELATIVE TO runDisplay*/
    const swDisplay = document.getElementById("swDisplay"); 
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

        /*STYLE SELECTORS*/
        swTagSelect.removeAttribute("disabled");
        swSubtagSelect.removeAttribute("disabled");

        swStopPhpController();
        clearTimeout(swTimeout);
        
        swDisplay.textContent = "00:00:00";
        swStarted = false;
    }

    function swStopPhpController() {
        let request = "stopSw";
        fetch("controllers/swController.php?" +
        "&request=" + encodeURIComponent(request))
        .then(response => response.json())
        .then(response => {
        let result = response["stopSw"];
        console.log(response);
        }
        );
    }
    swStop.addEventListener("click", stopStopwatch);
/*STOPWATCH CONTROLLERS END*/

/*OPTIONS SELECTOR START*/
const swTagSelect = document.getElementById("swTagSelect");
generateSwTags();
    function generateSwTags() {
        let request = "getTags";
        fetch("controllers/swController.php?" +
        "&request=" + encodeURIComponent(request))
        .then(response => response.json())
        .then(response => {
        let arrayTags = response;
        arrayTags.forEach((element) => {
            const option = document.createElement("option");
            option.innerText = element["tag"];
            swTagSelect.appendChild(option);
            })
        }
        );
    }
const swSubtagSelect = document.getElementById("swSubtagSelect");
generateSwSubtags();
    function generateSwSubtags() {
        let request = "getSubtags";
        fetch("controllers/swController.php?" +
        "&request=" + encodeURIComponent(request))
        .then(response => response.json())
        .then(response => {
        let arraySubtags = response;
        arraySubtags.forEach((element) => {
            const option = document.createElement("option");
            option.innerText = element["subtag"];
            swSubtagSelect.appendChild(option);
            })
        }
        );
    } 
/*OPTIONS SELECTOR END*/

/*Username display TEMPORARY*/
const userNickname = "<?php echo $_SESSION["user_nickname"];?>";
const userEmail = "<?php echo $_SESSION["user_email"];?>";
const navUser = document.getElementById("navUser");
navUser.textContent = userNickname + ", " + userEmail;

/*get tags and subtags*/
var swTagValue;
function getSwTagValue() {
    swTagValue = swTagSelect.value;
}
swTagSelect.addEventListener("input", getSwTagValue);
var swSubtagValue;
function getSwSubtagValue() {
    swSubtagValue = swSubtagSelect.value;
}
swSubtagSelect.addEventListener("input", getSwSubtagValue);

const swAddTag = document.getElementById("swAddTag");
function addSwTag() {
    let swPromptTag = prompt("Enter a Tag:");
    if (swPromptTag != null || swPromptTag != "") {

        const option = document.createElement("option");
        option.innerText = swPromptTag;
        option.setAttribute("selected", true);
        swTagSelect.appendChild(option);

        swTagValue = swPromptTag;
    }
}
swAddTag.addEventListener("click", addSwTag);

const swAddSubtag = document.getElementById("swAddSubtag");
function addSwSubtag() {
    let swPromptSubtag = prompt("Enter a Subtag:");
    if (swPromptSubtag != null || swPromptSubtag != "") {

        const option = document.createElement("option");
        option.innerText = swPromptSubtag;
        option.setAttribute("selected", true);
        swSubtagSelect.appendChild(option);

        swSubtagValue = swPromptSubtag;
    }
}
swAddSubtag.addEventListener("click", addSwSubtag);
</script>