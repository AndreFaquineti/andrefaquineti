<?php
$db = "mysql:host=" . getenv("aiven_mysqlportifolio_host");
$db .= ";port=" . getenv("aiven_mysqlportifolio_port");
$db .= ";dbname=" . getenv("aiven_meadowdb_name");

try {
    $conexao = new PDO($db,
    getenv("aiven_default_user"),
    getenv("aiven_default_pass"));
    /*
    echo "Conexão bem sucedida!";
    */
} catch (Exception $error) {
    echo "Estamos tendo problemas. Por favor, tente novamente mais tarde.";
    /*
    echo "Erro: " . $error->getMessage();
    */
    exit();    
}
?>