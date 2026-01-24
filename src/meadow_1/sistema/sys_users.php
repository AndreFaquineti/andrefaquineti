<?php
session_start();
require "conexao.php";

$inputEmail = $_GET['email'];
$inputPass = $_GET['password'];
$hash = password_hash($inputPass, PASSWORD_DEFAULT);
if (isset($_GET['name'])) {
    $inputName = $_GET['name'];
}
$pedido = $_GET['pedido'];
$verify = false;

/*LÓGICA DE LOGIN START*/
if ($pedido == "login") {
    $lookup = $conexao->prepare("SELECT * FROM users WHERE email=:email");
    $lookup->bindParam(':email', $inputEmail);
    $lookup->execute();
    $result = $lookup->fetchAll(PDO::FETCH_ASSOC);
    /*
    $result é um array onde cada item linha contém uma linha da base de dados.
    Assim, $arrayDados é o único item de $result.
    $resulte por sua vez tem seus indices como os nomes das colunas retornadas da db.
    */
    if (isset($result[0])) {
        $arrayDados = $result["0"];
    }

    if (isset($arrayDados["email"])) {
        if (isset($arrayDados["password"])) {
            $verify = password_verify($inputPass, $arrayDados["password"]);
        }
        if ($verify == true) {
            $_SESSION["user_id"] = $arrayDados["id_user"];
            $_SESSION["user_email"] = $arrayDados["email"];
            $_SESSION["user_nickname"] = $arrayDados["nickname"];
            echo "Access Allowed.";
        }
        if ($verify == false) {
            echo "Verify your password.";
        }
    }
    if (isset($arrayDados["email"]) == false) {
        echo "Email not found.";
    }
    if (isset($inputPass) == false) {
        echo "Please insert your password.";
    }
}
/*LÓGICA DE LOGIN END*/

/*LÓGICA DE REGISTRO START*/
if ($pedido == "registro") {
    $lookup = $conexao->prepare("SELECT * FROM users WHERE email=:email");
    $lookup->bindParam(':email', $inputEmail);
    $lookup->execute();
    $result = $lookup->fetchAll(PDO::FETCH_ASSOC);

    if (isset($result[0])) {
        $arrayDados = $result["0"];
    }

    if (isset($arrayDados["email"]) && $arrayDados["email"] == $inputEmail) {
        echo "This email is already in use.";
    } else {
        $sendData = $conexao->prepare("INSERT users (email, password, nickname) VALUES (:email, :password, :nickname)");
        $sendData->bindParam(':email', $inputEmail);
        $sendData->bindParam(':password', $hash);
        $sendData->bindParam(':nickname', $inputName);
        $sendData->execute();

        /*BRING DATA BACK FOR SESSION*/
        $bringData = $conexao->prepare("SELECT * FROM users WHERE email=:email");
        $bringData->bindParam(':email', $inputEmail);
        $bringData->execute();
        $result = $bringData->fetchAll(PDO::FETCH_ASSOC);
        if (isset($result[0])) {
            $arrayDados = $result["0"];
        }

        $_SESSION["user_id"] = $arrayDados["id_user"];
        $_SESSION["user_email"] = $arrayDados["email"];
        $_SESSION["user_nickname"] = $arrayDados["nickname"];
        
        echo "Registered Successfully.";
    }
}
/*LÓGICA DE REGISTRO END*/
?>