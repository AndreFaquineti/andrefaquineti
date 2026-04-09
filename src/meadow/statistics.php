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
    margin-top: 0;
}
#statsTable {/*No, I'm not proud of this. Should make it cleaner one day*/
    border: none;
    border-spacing: 0px;
    padding-bottom: 10px;
    margin-top: 0;
}
#statsSubtagsTable {
    border: none;
    border-spacing: 0px;
    padding-bottom: 10px;
    margin-top: 0;
}
th {
    border: solid white 1px;
}
td {
    border: solid white 1px;
    padding: 5px;
}
</style>
<div id="tables" style="display:flex; flex-direction: row;">
    
    <table id="sessionsTable" class="card1">
        <tr><th colspan="4"><h1 style="margin: 0px;">All your sessions</h1></tr></tr>
        <tr>
            <th>Tag</th>
            <th>Subtag</th>
            <th>Start</th>
            <th>Duration</th>
        </tr>
    </table>
    <div style="margin-right: auto;">
        <table id="statsTable" class="card1" style="margin-bottom: 50px;">
            <tr><th colspan="4"><h1 style="margin: 0px;">Statistics</h1></tr></tr>
            <tr>
                <th>Tag</th>
                <th>Total Time</th>
                <th>Sessions</th>
                <th>Average session</th>
            </tr>
        </table>
        
        <table id="statsSubtagsTable" class="card1">
            <tr><th colspan="5"><h1 style="margin: 0px;">Statistics for Subtags</h1></tr></tr>
            <tr>
                <th>Tag</th>
                <th>Subtag</th>
                <th>Total Time</th>
                <th>Sessions</th>
                <th>Average session</th>
            </tr>
        </table>
    </div>
</div>
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
/*GET SESSIONS STATS*/
const statsTable = document.getElementById("statsTable");
generateStatsTable();
    function generateStatsTable() {
        let request = "getStats";
        fetch("controllers/statsController.php?" +
        "&request=" + encodeURIComponent(request))
        .then(response => response.json())
        .then(response => {
        let arrayStats = response;
        arrayStats.forEach((element) => {
            const tr = document.createElement("tr");
            const tdTag = document.createElement("td");
            const tdTotalTime = document.createElement("td");
            const tdSessions = document.createElement("td");
            const tdAverage = document.createElement("td");

            let durationSeconds = element["duration_seconds"];
            tdTag.innerText = element["tag"];
            tdTotalTime.innerText = parseFloat(element["total_hours"]).toFixed(2);
            tdSessions.innerText = parseFloat(element["session_count"]).toFixed(2);
            tdAverage.innerText = parseFloat(element["avg_hours"]).toFixed(2);
            
            tr.appendChild(tdTag);
            tr.appendChild(tdTotalTime);
            tr.appendChild(tdSessions);
            tr.appendChild(tdAverage);

            statsTable.appendChild(tr);
            })
        }
        );
    }
/*GET SESSIONS STATS WITH SUBTAGS*/
const statsSubtagsTable = document.getElementById("statsSubtagsTable");
generateStatsSubtagsTable();
    function generateStatsSubtagsTable() {
        let request = "getStatsSubtags";
        fetch("controllers/statsController.php?" +
        "&request=" + encodeURIComponent(request))
        .then(response => response.json())
        .then(response => {
        let arrayStatsSubtags = response;
        arrayStatsSubtags.forEach((element) => {
            const tr = document.createElement("tr");
            const tdTag = document.createElement("td");
            const tdSubtag = document.createElement("td");
            const tdTotalTime = document.createElement("td");
            const tdSessions = document.createElement("td");
            const tdAverage = document.createElement("td");

            let durationSeconds = element["duration_seconds"];
            tdTag.innerText = element["tag"];
            tdSubtag.innerText = element["subtag"];
            tdTotalTime.innerText = parseFloat(element["total_hours"]).toFixed(2);
            tdSessions.innerText = parseFloat(element["session_count"]).toFixed(2);
            tdAverage.innerText = parseFloat(element["avg_hours"]).toFixed(2);
            
            tr.appendChild(tdTag);
            tr.appendChild(tdSubtag);
            tr.appendChild(tdTotalTime);
            tr.appendChild(tdSessions);
            tr.appendChild(tdAverage);

            statsSubtagsTable.appendChild(tr);
            })
        }
        );
    }
</script>