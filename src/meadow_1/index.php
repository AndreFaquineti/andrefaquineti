<?php
    session_start();
    require("sistema/conexao.php");
    require("sistema/lib.php");

    not_logged();
    logged();

    echo $_SESSION["user_id"];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>

</body>
</html>