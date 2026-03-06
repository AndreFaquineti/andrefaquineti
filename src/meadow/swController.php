<?php
require "db/connection.php";
if (isset($_GET['request'])) {
    $request = $_GET['request'];
}

if (isset($request) && $request == "startSw") {

    $startTime = date('Y-m-d H:i:s', strtotime('-4 hours'));

    $startSession = $connection->prepare(query:
        "INSERT INTO meadowdb.sessions (id_user, start_time)
        VALUES (6, :startTime)"
        );
        /*$startSession->bindParam(':id_user', $_SESSION['user_id']);*/
        /*$startSession->bindParam(':tag', $tag);*/
        /*$startSession->bindParam(':subtag', $subtag);*/
        $startSession->bindParam(':startTime', $startTime);
    $startSession->execute();

    $response = [
    "startSw" => "session started!",
    "currentSession" => "unknown"
    ];
}
if (isset($request) && $request == "stopSw") {

    $endTime = date('Y-m-d H:i:s', strtotime('-4 hours'));

    $stopSession = $connection->prepare(query:
        "UPDATE sessions SET end_time = :endTime, finished=1
        WHERE id_user=6 AND finished=0"
        );
        /*$startSession->bindParam(':id_user', $_SESSION['user_id']);*/
        $stopSession->bindParam(':endTime', $endTime);
    $stopSession->execute();

    $response = [
    "stopSw" => "session stopped!",
    "currentSession" => "unknown"
    ];
}


echo json_encode($response);



?>