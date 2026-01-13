<?php
session_start();
include "sistema/lib.php";
logged();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Register - Meadow</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Registration Page</h1>
<form>
    <label for="input_email">Email: </label><br>
    <input type="email" name="input_email" id="input_email" required><br><br>

    <label for="input_pass">Password: </label><br>
    <input type="password" name="input_pass" id="input_pass" required>
    <div id="pass_error"></div>

    <label for="input_name">Name (How we call you): </label><br>
    <input type="text" name="input_name" id="input_name" required><br><br>
    
    <img
          src="images/login-icon.svg"
          class="control-button"
          id="submitInput">
</form>
Already have an account? <a href="login.php">Login.</a><br><br>
<div id="resultado"></div>
</div>
</html>
<script>
const email_field = document.getElementById("input_email");
const pass_field = document.getElementById("input_pass");
const name_field = document.getElementById("input_name");
const pass_error = document.getElementById("pass_error");
const submitButton = document.getElementById("submitInput");

/*SISTEMA DE REGISTRO START*/
function registerFunc() {
    let inputEmail = email_field.value;
    let inputPass = pass_field.value;
    let inputName = name_field.value;
    let pedido = "registro";
    let statusRegister;

    fetch("sistema/sys_users.php?" + "&email=" + encodeURIComponent(inputEmail)
            + "&password=" + encodeURIComponent(inputPass)
            + "&name=" + encodeURIComponent(inputName)
            + "&pedido=" + encodeURIComponent(pedido)
    )
    .then(response => response.text())
    .then(statusRegister => {
        document.getElementById('resultado').innerHTML = statusRegister;
        if (statusRegister == "Registered Successfully.") {
            window.location.href = 'home.php';
        }
        document.getElementById('resultado').innerHTML = statusRegister;
    });
}
submitButton.addEventListener("click", registerFunc);

function keyPress() {
    if (event.key == "Enter") {
        registerFunc();
    }
}
document.addEventListener('keydown', keyPress)
/*SISTEMA DE REGISTRO END*/

/*CONTROLE DE CAMPOS START*/
function emailFieldController() {

}
function passFieldController() {
    let passLenght = pass_field.value.length;
    console.log("passLenght: " + passLenght);
    if (passLenght < 8) {
        var errorShort = "Your password must be at least 8 characters long. ";
    }
    if (passLenght >= 8) {
        var errorShort = "";
    }
    pass_error.innerHTML  = errorShort + "<br>" + "<br>";
}
function nameFieldController() {
    
}
email_field.addEventListener("input", emailFieldController);
pass_field.addEventListener("input", passFieldController);
name_field.addEventListener("input", nameFieldController);
/*CONTROLE DE CAMPOS END*/
</script>