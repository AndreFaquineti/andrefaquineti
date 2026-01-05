<?php
    session_start();
    require("conexao.php");
    require("lib.php");

    /*ISSO PRECISA SER TEMPORÁRIO*/
    $_SESSION["user_id"] = "umdoistres";
    $_SESSION["user_email"] = "ESTOULOGADO";
    $_SESSION["user_nickname"] = "namasto";
    /*ISSO PRECISA SER TEMPORÁRIO*/
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