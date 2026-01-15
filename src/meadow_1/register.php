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
    <input type="email" name="input_email" id="input_email" required>
    <div id="email_error" class="form-error"></div><br>

    <label for="input_pass">Password: </label><br>
    <input type="password" name="input_pass" id="input_pass" required>
    <div id="pass_error" class="form-error"></div><br>

    <label for="input_pass">Repeat Password: </label><br>
    <input type="password" name="input_pass" id="input_repeat_pass" required>
    <div id="repeat_pass_error" class="form-error"></div><br>

    <label for="input_name">Name (How we call you): </label><br>
    <input type="text" name="input_name" id="input_name" required>
    <div id="name_error" class="form-error"></div><br>
    
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
const repeat_pass_field = document.getElementById("input_repeat_pass");
const repeat_pass_error = document.getElementById("repeat_pass_error");
const email_error = document.getElementById("email_error");
const name_error = document.getElementById("name_error");

var passFieldAllow = new Boolean(false);
var repeatPassFieldAllow = new Boolean(false);
var emailFieldAllow = new Boolean(false);
var nameFieldAllow = new Boolean(false);

/*SISTEMA DE REGISTRO START*/
function registerFunc() {
    if (passFieldAllow == Boolean(true) && repeatPassFieldAllow == Boolean(true) && emailFieldAllow == Boolean(true) && nameFieldAllow == Boolean(true)) {
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
}
function submitButtonClicked() {
    emailFieldController();
    passFieldController();
    repeatPassFieldController();
    nameFieldController();
    registerFunc();
}
submitButton.addEventListener("click", submitButtonClicked);

function keyPress() {
    if (event.key == "Enter") {
        emailFieldController();
        passFieldController();
        repeatPassFieldController();
        nameFieldController();
        registerFunc();
    }
}
document.addEventListener('keydown', keyPress)
/*SISTEMA DE REGISTRO END*/

/*CONTROLE DE CAMPOS START*/
function emailFieldController() {
    if (email_field.value.match("@") == null || email_field.value.match(".") == null) {
        emailFieldAllow = Boolean(false);
        email_error.innerHTML = "Insert avalid email address.";
    }
    if (email_field.value.match("@") != null && email_field.value.match("\\.") != null) {
        emailFieldAllow = Boolean(true);
        email_error.innerHTML = "";
    }
}
function passFieldController() {
    let passLength = pass_field.value.length;
    console.log("passLength: " + passLength);
    var arr_errors = [];
    const specialCharacters = new RegExp(/[!@#$%&*()=-]/);
    const numbers = new RegExp(/[0123456789]/);
    passFieldAllow = new Boolean(false);
    if (passLength < 8) {
        arr_errors.splice(0, 0, "Your password must be at least 8 characters long.");
        var passLengthAllow = new Boolean(false);
    } else {
        passLengthAllow = Boolean(true);
    }
    if (pass_field.value.match(specialCharacters) == null) {
        arr_errors.splice(2, 0, "Your password must be at least one of these: ! @ # $ % & * ( ) - =.");
        var specialCharactersAllow = new Boolean(false);
    } else {
        specialCharactersAllow = Boolean(true);
    }
    if (pass_field.value.match(numbers) == null) {
        arr_errors.splice(2, 0, "Your password must be at least one number from 0 to 9.");
        var numbersAllow = new Boolean(false);
    } else {
        numbersAllow = Boolean(true);
    }
    if (passLengthAllow == Boolean(true) && specialCharactersAllow == Boolean(true) && numbersAllow == Boolean(true)) {
        passFieldAllow = Boolean(true);
    }
    pass_error.innerHTML  = arr_errors.join("<br>");
}
function repeatPassFieldController() {
    if (repeat_pass_field.value != pass_field.value) {
        repeatPassFieldAllow = new Boolean(false);
        repeat_pass_error.innerHTML = "Passwords must coincide.";
    }
    if (repeat_pass_field.value == pass_field.value) {
        repeat_pass_error.innerHTML = "";
        repeatPassFieldAllow = Boolean(true);
    }
}
function nameFieldController() {
    if (name_field.value != "") {
        nameFieldAllow = Boolean(true);
        name_error.innerHTML = "";
    }
    if (name_field.value == "") {
        nameFieldAllow = Boolean(false);
        name_error.innerHTML = "Please insert a name.";
    }
}
email_field.addEventListener("input", emailFieldController);
pass_field.addEventListener("input", passFieldController);
repeat_pass_field.addEventListener("input", repeatPassFieldController);
name_field.addEventListener("input", nameFieldController);
/*CONTROLE DE CAMPOS END*/
</script>