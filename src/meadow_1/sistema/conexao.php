<?php
$db = "mysql:host=" . getenv("DB_meadow1_Host");
$db .= ";dbname=" . getenv("DB_meadow1_Name");

try {
    $conexao = new PDO($db,
    getenv("DB_meadow1_User"),
    getenv("DB_meadow1_Pass"));
    /*
    echo "Conexão bem sucedida!";
    */
} catch (Exception $error) {
    echo "Estamos tendo problemas. Por favor, tente novamente mais tarde.";
    exit();
    /*
    echo "Erro: " . $error->getMessage();
    */
}
?>