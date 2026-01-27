<?php
session_start();
include "conexao.php";

$pedido = $_GET['pedido'];

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

echo json_encode($controlArray);
?>