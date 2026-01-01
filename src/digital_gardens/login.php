<!DOCTYPE html>
<html>
<head>
    <title>Entrar</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <?php include 'assets/simple_header.html';?>
</header>
<main style="padding: 10px;">
    <form>
        <label for="username">Nome de usuário:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">Senha:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Entrar">
    </form>
</main>
</body>
</html>