<?php
session_start();
require "connection.php";
if (isset($_GET['request'])) {
    $request = $_GET['request'];
}
if (isset($_GET['swSubtagValue'])) {
    $swSubtagValue = $_GET['swSubtagValue'];
}
if (isset($_GET['swTagValue'])) {
    $swTagValue = $_GET['swTagValue'];
}

if (isset($request) && $request == "startSw") {

    $startTime = date('Y-m-d H:i:s', strtotime('-3 hours'));

    if (!isset($swTagValue) OR $swTagValue == "undefined") {
        $swTagValue = "Other";
    }
    if (!isset($swSubtagValue ) OR $swSubtagValue == "undefined") {
        $swSubtagValue = "Other";
    }
    $startSession = $connection->prepare(query:
        "INSERT INTO meadowdb.sessions (id_user, tag, subtag, start_time)
        VALUES (:id_user, :tag, :subtag, :startTime)"
        );
        $startSession->bindParam(':id_user', $_SESSION['id_user']);
        $startSession->bindParam(':tag', $swTagValue);
        $startSession->bindParam(':subtag', $swSubtagValue);
        $startSession->bindParam(':startTime', $startTime);
    $startSession->execute();

    $getCurrentSession = $connection->prepare(query:
        "SELECT id_session FROM meadowdb.sessions WHERE id_user=:id_user AND end_time IS NULL;"
        );
        $getCurrentSession->bindParam(':id_user', $_SESSION['id_user']);
    $getCurrentSession->execute();

    $currentSession = $getCurrentSession->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION["currentSession"] = implode($currentSession[0]);

    $response = [
    "startSw" => "session started!",
    "currentSession" => implode($currentSession[0])
    ];
}


if (isset($request) && $request == "stopSw") {

    $endTime = date('Y-m-d H:i:s', strtotime('-3 hours'));

    $stopSession = $connection->prepare(query:
        "UPDATE sessions SET end_time = :endTime, finished=1
        WHERE id_user=:id_user AND finished=0"
        );
        $stopSession->bindParam(':id_user', $_SESSION['id_user']);
        $stopSession->bindParam(':endTime', $endTime);
    $stopSession->execute();

    $response = [
    "stopSw" => "session stopped!",
    "currentSession" => "unknown"
    ];
}


if (isset($request) && $request == "getTags") {
    $getTags = $connection->prepare(query:
            "SELECT DISTINCT tag FROM sessions WHERE id_user=:id_user;"
        );
        $getTags->bindParam(':id_user', $_SESSION['id_user']);
    $getTags->execute();

    $userTags = $getTags->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(($userTags));
}
if (isset($request) && $request == "getSubtags") {
    $getSubtags = $connection->prepare(query:
            "SELECT DISTINCT subtag FROM sessions WHERE id_user=:id_user;"
        );
        $getSubtags->bindParam(':id_user', $_SESSION['id_user']);
    $getSubtags->execute();

    $userSubtags = $getSubtags->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(($userSubtags));
}

if (isset($request) && $request == "swAutosave") {

    $endTime = date('Y-m-d H:i:s', strtotime('-3 hours'));

    $swAutosave = $connection->prepare(query:
            "UPDATE sessions SET end_time=:end_time WHERE id_session=:currentSession;"
        );
        $swAutosave->bindParam(':end_time', $endTime);
        $swAutosave->bindParam(':currentSession', $_SESSION['currentSession']);
    $swAutosave->execute();

    echo "Successful";
}

if (isset($response)) {
    echo json_encode($response);
}


?>