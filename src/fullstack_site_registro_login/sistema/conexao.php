<?php
$db = "mysql:host=" . getenv("aiven_defaultdb_host");
$db .= ";port=" . getenv("aiven_defaultdb_port");
$db .= ";dbname=" . getenv("aiven_defaultdb_name");

try {
    $conn = new PDO($db, getenv("aiven_defaultdb_user"), getenv("aiven_defaultdb_pass"));

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . '<br>';
}
?>
