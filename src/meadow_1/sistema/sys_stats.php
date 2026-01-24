<?php
session_start();
include "conexao.php";

$buscarSessions = $conexao->prepare(
"SELECT * FROM sessions
WHERE id_user=:id_user
ORDER BY id_session DESC
LIMIT 10");
$buscarSessions->bindParam(":id_user", $_SESSION["user_id"]);
$buscarSessions->execute();
$resultadoSessions = $buscarSessions->fetchAll(PDO::FETCH_ASSOC);

$controlArray = [
    "arraySessions" => $resultadoSessions
];

echo json_encode($controlArray);
?>