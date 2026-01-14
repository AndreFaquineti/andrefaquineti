<?php
session_start();
include "conexao.php";

$inputEmail = $_GET['email'];
$inputPass = $_GET['password'];
if (isset($_GET['name'])) {
    $inputName = $_GET['name'];
}
$pedido = $_GET['pedido'];

/*LÓGICA DE LOGIN START*/
if ($pedido == "login") {
    $lookup = $conexao->prepare("SELECT * FROM users WHERE email=:email");
    $lookup->bindParam(':email', $inputEmail);
    $lookup->execute();
    $result = $lookup->fetchAll(PDO::FETCH_ASSOC);

    if (isset($result[0])) {
        $arrayDados = $result["0"];
    }

    if (isset($arrayDados["email"]) && $arrayDados["email"] == $inputEmail) {
        if (isset($arrayDados["password"]) && $arrayDados["password"] == $inputPass) {
            $_SESSION["user_id"] = $arrayDados["id_user"];
            $_SESSION["user_email"] = $arrayDados["email"];
            $_SESSION["user_nickname"] = $arrayDados["nickname"];
            echo "Access Allowed.";
        }
        if (isset($arrayDados["password"]) && $arrayDados["password"] != $inputPass) {
            echo "Verify your password.";
        }
    }
    if (isset($arrayDados["email"]) == false) {
        echo "Email not found.";
    }
    if (isset($arrayDados["password"]) == false) {
        echo "Please insert your password.";
    }
}
/*LÓGICA DE LOGIN END*/

/*LÓGICA DE REGISTRO START*/
if ($pedido == "registro") {
    echo "Não tem lógica de registro ainda!";
    if ($inputEmail != "" && $inputName != "" && $inputPass != "") {
        echo $inputEmail . $inputName . $inputPass;
    }
}
/*
Usuario: envia email, senha, nome
PHP: recebe input_email, input_senha, input_nome
PHP: busca o input_email na base de dados
PHP: se (isset(return_email) == true) {
        echo: "this email is already being used";
    }
    se (isset(return_email) == false) {
        enviar input_email, input_senha, input_nome para db;
        echo: "Registered Successfully";
    }
*/
/*LÓGICA DE REGISTRO END*/
?>