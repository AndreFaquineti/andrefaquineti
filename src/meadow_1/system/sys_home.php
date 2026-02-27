<?php
session_start();
include "conexao.php";

if (isset($_GET['pedido'])) {
    $pedido = $_GET['pedido'];
}

if (isset($pedido) && $pedido == "debug") {
    $buscarUltimaSessions = $conexao->prepare("SELECT * FROM sessions
    WHERE id_user=:id_user
    /*AND finished = false*/
    ORDER BY id_session DESC
    LIMIT 1");

    $buscarUltimaSessions->bindParam(":id_user", $_SESSION["user_id"]);
    $buscarUltimaSessions->execute();

    $ultimaSession = $buscarUltimaSessions->fetchAll(PDO::FETCH_ASSOC);

    $controlArray = [
        "ultimaSession" => $ultimaSession
    ];
}

if (isset($pedido) && $pedido == "currentSession") {
    $searchCurrentSession = $conexao->prepare("SELECT * FROM sessions
    WHERE id_user=:id_user
    AND finished = false
    ORDER BY id_session DESC
    LIMIT 1");

    $searchCurrentSession->bindParam(":id_user", $_SESSION["user_id"]);
    $searchCurrentSession->execute();

    $currentSession = $searchCurrentSession->fetchAll(PDO::FETCH_ASSOC);

    $controlArray = [
        "currentSession" => $currentSession
    ];
}

if(isset($pedido) && $pedido == "startSession") {
    $tag = "DESCARTE";
    $subtag = "ISSO MESMO";
    $start_time = $_GET['start_time'];

    if(isset($tag) && isset($subtag) && isset($start_time)) {
        $startSession = $conexao->prepare(query:
            "INSERT INTO meadowdb.sessions (id_user, tag, subtag, start_time)
            VALUES (:id_user, :tag, :subtag, :start_time)"
        );

        $startSession->bindParam(':id_user', $_SESSION['user_id']);
        $startSession->bindParam(':tag', $tag);
        $startSession->bindParam(':subtag', $subtag);
        $startSession->bindParam(':start_time', $start_time);
        $startSession->execute();
        
        $controlArray = [
            "sessionStarted" => "Session Startada"
        ];
    }
}
if(isset($controlArray)) {
    echo json_encode($controlArray);
}
?>