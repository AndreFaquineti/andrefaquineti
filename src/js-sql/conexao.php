<?php
$db = "mysql:host=" . getenv("DB_Vittaclinic_Host");
$db .= ";dbname=" . getenv("DB_Vittaclinic_Name");

try {
    $conexao = new PDO($db,
    getenv("DB_Vittaclinic_User"),
    getenv("DB_Vittaclinic_Pass"));
} catch (Exception $error) {
    echo "Erro: " . $error->getMessage();
}
echo $db;
?>