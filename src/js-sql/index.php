<!DOCTYPE html>
<html>
<head>
    <title>Sql PDO e JS</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
</head>
<body>
    <p>
    <button id="botaoLimpar">
    LIMPAR TUDO</button>
    </p>

    <p>
    <select id="dropdownTipo">
        <option value="paciente">Paciente</option>
        <option value="medico">Medico</option>
        <option value="administrador">Adm</option>
        <option value="todos">Todos</option>
    </select>
    <button id="botao2" value="medico">
    Pesquisar</button>
    </p>
    <p id="resultado">

    </p>

<script>
    function limparTexto() {
        document.getElementById("resultado").innerHTML = "";
    }
    const botaoLimpar = document.getElementById("botaoLimpar");
    botaoLimpar.addEventListener("click", limparTexto);

    function teste2() {
        let formTipo = document.getElementById("dropdownTipo").value;
        fetch('consulta.php?tipo=' + encodeURIComponent(formTipo))
        .then(response => response.text())
        .then(resultadoDaConsulta2 => {
            document.getElementById('resultado').innerHTML = resultadoDaConsulta2;
        });
    }
    const botao2 = document.getElementById("botao2");
    botao2.addEventListener("click", teste2);
</script>
</body>
</html>