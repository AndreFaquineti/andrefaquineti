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

<div id="modalContainer" class="modalBox">
    <div id="modalContent" class="modalContent">
        <div id="modalText"></div>
        <div class="buttonsContainer" style="display:flex; flex-direction: row;">
            <div class="modalButtonSafe">Continue</div>
            <input type="date"><input type="timer">
            <div class="modalButtonDanger">Delete</div>
        </div>
    </div>
</div>

<div
id="main"
class="flex-container-direction-row"
style="text-align: center; justify-content: center; flex-wrap: wrap;">

    <div
    id="mainCard"
    class="card_1 flex-container-direction-column">
        <div
        id="modeSelector"
        class="flex-container-direction-row"
        style="justify-content: center;">
            <img
                id="SWSelectorButton"
                src="images/timer-icon.svg"
                class="control-button2"
                alt="StopWatch Button"
                title="StopWatch">
            <img
                id="TimerSelectorButton"
                src="images/alarm-icon.svg"
                class="control-button2"
                style="display: none;"
                alt="Timer Button"
                title="Timer">
        </div>
        <?php include 'assets/stopWatch.php';?>
        <div
        id="tagSelector">
            Placeholder TAG
        </div>
        <div
        id="subtagSelector">
            Placeholder SUBTAG
        </div>
    </div>
</div>
<div id="debugger">Update</div>
</body>
</html>
<script>
    var id_user = <?php echo $_SESSION["user_id"];?>;
</script>
<script src="js/assets.js"></script>
<script src="js/home.js"></script>