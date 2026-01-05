<?php
function not_logged() {
    if ($_SESSION["user_email"] == "") {
        header("Location: login.html");
        exit();
    }
}
function logged() {
    if ($_SESSION["user_email"] != "") {
        header("Location: index.html");
        exit();
    }
}
function forbidden() {
    header("Location: index.html");
    exit();
}


?>