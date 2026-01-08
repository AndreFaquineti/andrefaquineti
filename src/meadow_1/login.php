<?php
session_start();
require "sistema/lib.php";
logged();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login - Meadow</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Login Page</h1>
<form>
    <label for="form_email">Email: </label><br>
    <input type="email" name="form_email" id="form_email" required><br><br>
    <label for="form_pass">Password: </label><br>
    <input type="password" name="form_pass" id="form_pass" required><br><br>
    <img
          src="images/login-icon.svg"
          class="control-button"
          id="submitInput">
</form><br><br>
Doesn't have an account yet? <a href="register.php">Register here.</a><br><br>
<div id="resultado"></div>
</html>
<script>
let email_field = document.getElementById("form_email");
let pass_field = document.getElementById("form_pass");

/*CONTROLE DOS CAMPOS*/
if (pass_field == "") {

}
/*SISTEMA DE LOGIN*/
function loginFunc() {
    let inputEmail = email_field.value;
    let inputPass = pass_field.value;
    let pedido = "login";
    let statusAccess;

    fetch("sistema/sys_users.php?" + "&email=" + encodeURIComponent(inputEmail)
            + "&password=" + encodeURIComponent(inputPass)
            + "&pedido=" + encodeURIComponent(pedido)
    )
    .then(response => response.text())
    .then(statusAccess => {
        document.getElementById('resultado').innerHTML = statusAccess;
        if (statusAccess == "Access Allowed.") {
            window.location.href = 'home.php';
        }
    });
}
const submitButton = document.getElementById("submitInput");
submitButton.addEventListener("click", loginFunc);
</script>