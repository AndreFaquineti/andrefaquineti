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
    <div id="navLogo"><a href="home.php">Meadow</a></div>
    <div id="navgap" style="width: 100%"></div><!--INLINE STYLE-->
    <div id="navUser" style="padding: 5px; color: white; background-color: #9C7E41; border-radius: 10px;"></div>
    <!--navUser IS SUPPOSED TO BE TEMPORARY-->
    <a href="home.php"><img id="navHome" src="images/home-icon.svg" class="navButton"></a>
    <img id="settings" src="images/settings-icon.svg" class="navButton">
    <a href="controllers/exit.php"><img id="logout" src="images/logout-icon.svg" class="navButton"></a>
</div>
<style>
#sessionsTable {
    border: none;
    border-spacing: 0px;
    padding-bottom: 10px;
}
th {
    border: solid white 1px;
}
td {
    border: solid white 1px;
    padding: 5px;
}
</style>
<table id="sessionsTable" class="card1">
    <tr>
        <th>Tag</th>
        <th>Subtag</th>
        <th>Start</th>
        <th>Duration</th>
    </tr>
</table>

</body>
</html>

<script>
/*Username display TEMPORARY*/
const userNickname = "<?php echo $_SESSION["user_nickname"];?>";
const userEmail = "<?php echo $_SESSION["user_email"];?>";
const navUser = document.getElementById("navUser");
navUser.textContent = userNickname + ", " + userEmail;

/*GET SESSIONS*/
const sessionsTable = document.getElementById("sessionsTable");
generateSessionsTable();
    function generateSessionsTable() {
        let request = "getSessions";
        fetch("controllers/statsController.php?" +
        "&request=" + encodeURIComponent(request))
        .then(response => response.json())
        .then(response => {
        let arraySessions = response;
        arraySessions.forEach((element) => {
            const tr = document.createElement("tr");
            const tdTag = document.createElement("td");
            const tdSubtag = document.createElement("td");
            const tdStart = document.createElement("td");
            const tdDuration = document.createElement("td");

            let durationSeconds = element["duration_seconds"];
            tdTag.innerText = element["tag"];
            tdSubtag.innerText = element["subtag"];
            tdStart.innerText = element["start_time"];
            tdDuration.innerText = Math.floor(durationSeconds / 60);
            
            tr.appendChild(tdTag);
            tr.appendChild(tdSubtag);
            tr.appendChild(tdStart);
            tr.appendChild(tdDuration);

            sessionsTable.appendChild(tr);
            })
        }
        );
    }
</script>