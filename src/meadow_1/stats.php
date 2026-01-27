<?php
session_start();
require "system/lib.php";
not_logged();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My Statistics</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/style_buttons.css">
</head>
<style>
th, td {
    border: 1px black solid;
    padding: 2px;
}
table {
    border-collapse: collapse;
    width: 50%;
    border-radius: 5px;
    margin: 5px;
}
</style>
<body>
    
<?php include 'assets/header1.php';?>

    <table id="sessionsTable">
        <th>Tag</th>
        <th>Subtag</th>
        <th>Start</th>
        <th>End</th>
        <th>Created</th>
    </table>
</body>
</html>

<script src="js/assets.js"></script>
<script>
    fetch("system/sys_stats.php")
    .then(promise => promise.json())
    .then(resultado =>{
        var arraySessions = resultado["arraySessions"]

        arraySessions.forEach(session => {
        const newRow = document.createElement('tr');

        const newTag = document.createElement('td');
        newTag.textContent = session["tag"];
        const newSub = document.createElement('td');
        newSub.textContent = session["subtag"];
        const newStart = document.createElement('td');
        newStart.textContent = session["start_time"];
        const newEnd = document.createElement('td');
        newEnd.textContent = session["end_time"];
        const newCreated = document.createElement('td');
        newCreated.textContent = session["created"];

        newRow.appendChild(newTag);
        newRow.appendChild(newSub);
        newRow.appendChild(newStart);
        newRow.appendChild(newEnd);
        newRow.appendChild(newCreated);

        sessionsTable.appendChild(newRow);
        
        });
    });
</script>