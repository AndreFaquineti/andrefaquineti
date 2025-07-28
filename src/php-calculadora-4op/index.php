<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Calculadora básica</title>
    <link rel="stylesheet" href="../darkmode_geral.css">
</head>
<body>
    <p><h2><a href="../">Pagina Inicial</a></h2></p>
    <p><h1>Calculadora 4 Operações PHP</h1></p>
    <form method="post" action="">
        <label>Número 1
        <input type="number" name="numero_1">
        </label><br>
        <label> Operação
        <select name="operacao">
            <option value=""></option>
            <option value="a">Adição</option>
            <option value="s">Subtração</option>
            <option value="m">Multiplicação</option>
            <option value="d">Divisão</option>
        </select>
        </label><br>
        <label>Número 2
            <input type="number" name="numero_2">
        </label><br>
        <label>Calculadora
            <input type="submit">
        </label><br>
    </form><br>
    <?php
    //Zerando variaveis
    if(!isset($n1) OR !isset($n2) OR !isset($operacao)) {
        $n1 = 0;
        $n2 = 0;
        $operacao = "vazio";
    }
    //Request do post
    if (($_SERVER['REQUEST_METHOD'] == "POST")) {
        if(isset($_POST['numero_1']) && isset($_POST['operacao']) && isset($_POST['numero_2'])) {
            $n1 = floatval($_POST['numero_1']);
            $operacao = strval($_POST['operacao']);
            $n2 = floatval($_POST['numero_2']);
        }
    }
    //Operações
    if (isset($n1) && isset($n2) && isset($operacao)) {
        if ($operacao == "a") {
            $resultado = $n1 + $n2;
        }
        if ($operacao == "s") {
            $resultado = $n1 - $n2;
        }
        if ($operacao == "m") {
            $resultado = $n1 * $n2;
        }
        if ($operacao == "d") {
            $resultado = $n1 / $n2;
        }
    }
    if (isset($resultado)) {
        echo 'Resultado: ' . $resultado;
    }
    ?>
</body>