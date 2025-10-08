<?php
    require "conexao.php";
    $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : null;
    echo "Tipo Pesquisado = " . $tipo . "<br>";

    if ($tipo == "todos") {
        $stmt = $conexao->prepare("SELECT * FROM tabela_usuarios");
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        foreach($resultado as $linha) {
            echo 'Email = ' . $linha['email'] . ' - ' . $linha['tipo'] . '<br>';
        }
    } else {
        $stmt = $conexao->prepare("SELECT * FROM tabela_usuarios WHERE tipo = :tipo");
        $stmt->bindParam(':tipo', $tipo);
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        foreach($resultado as $linha) {
            echo 'Email = ' . $linha['email'] . ' - ' . $linha['tipo'] . '<br>';
        }
    }
?>