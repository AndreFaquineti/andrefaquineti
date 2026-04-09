<!DOCTYPE html>
<html>
<head>

</html>
<body>
    <p id="texto1"></p>
</body>
</html>
<script>
    const texto1 = document.getElementById("texto1");
    var n = 7.6;
    if (n+0.4 >= n+1) {
        n = n+1;
    }
    var resultado = 7.2 % 1;
    texto1.textContent = resultado;

</script>

entrada 5.2 saida 5
entrada 5.6 saida 6