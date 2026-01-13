<?php
$db = "mysql:host=" . getenv("aiven_mysqlportifolio_host");
$db .= ";port=" . getenv("aiven_mysqlportifolio_port");
$db .= ";dbname=" . getenv("aiven_defaultdb_name");

try {
    $conn = new PDO($db, getenv("aiven_default_user"), getenv("aiven_default_pass"));

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . '<br>';
}
?>

mysql:host=