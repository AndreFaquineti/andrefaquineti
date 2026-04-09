<?php
session_start();
require "connection.php";
if (isset($_GET['request'])) {
    $request = $_GET['request'];
}
if (isset($request) && $request == "getSessions") {
    $getSessions = $connection->prepare(query:
            "SELECT tag, subtag, start_time, duration_seconds FROM sessions WHERE id_user=:id_user
            ORDER BY id_session DESC;"
        );
        $getSessions->bindParam(':id_user', $_SESSION['id_user']);
    $getSessions->execute();

    $userSessions = $getSessions->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(($userSessions));
}
if (isset($request) && $request == "getStats") {
    $getStats = $connection->prepare(query:
            "SELECT tag, 
            COUNT(*) as session_count, 
            SUM(duration_seconds) / 3600 as total_hours, 
            AVG(duration_seconds) / 3600 as avg_hours
            FROM sessions 
            WHERE id_user=:id_user 
            GROUP BY tag 
            ORDER BY tag;"
        );
        $getStats->bindParam(':id_user', $_SESSION['id_user']);
    $getStats->execute();

    $userStats = $getStats->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(($userStats));
}
if (isset($request) && $request == "getStatsSubtags") {
    $getStatsSubtags = $connection->prepare(query:
            "SELECT tag, subtag, 
            COUNT(*) as session_count, 
            SUM(duration_seconds) / 3600 as total_hours, 
            AVG(duration_seconds) / 3600 as avg_hours 
            FROM sessions WHERE id_user=:id_user 
            GROUP BY tag, subtag 
            ORDER BY tag;"
        );
        $getStatsSubtags->bindParam(':id_user', $_SESSION['id_user']);
    $getStatsSubtags->execute();

    $userStatsSubtags = $getStatsSubtags->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(($userStatsSubtags));
}
?>