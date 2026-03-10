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
?>