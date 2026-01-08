<?php
function not_logged() {
    if (isset($_SESSION["user_email"]) == false || $_SESSION["user_email"] == "") {
        header("Location: login.php");
        exit();
    }
}
function logged() {
    if (isset($_SESSION["user_email"]) == true && $_SESSION["user_email"] != "") {
        echo "Logged() hs been called";
        header("Location: home.php");
        exit();
    }
}
function forbidden() {
    header("Location: index.php");
    exit();
}
?>