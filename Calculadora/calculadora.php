<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
</head>

<body>



    <h1>Escolha novamente!</h1>
    <form action="calculadora.php" method="GET" name="Soma">
        <label for="Fnum">Informe o primeiro numero:</label>
        <br>
        <input type="text" id="Fnum" name="num1">
        <br>
        <label for="Snum">Informe o segundo numero:</label>
        <br>
        <input type="text" id="Snum" name="num2">
        <br>
        <label for="Snum">Informe a operação que deseja: ( * / + - ):</label>
        <br>
        <input type="text" id="Operador" name="op">
        <br>
        <input type="submit" value="Enviar">
    </form>

    <main>

        <?php
        $v1 = $_GET["num1"];
        $v2 = $_GET["num2"];
        $operador = $_GET["op"];
        $resultado;

        if ($operador == "+") {
            $resultado = $v1 + $v2;
        } else if ($operador == "-") {
            $resultado = $v1 - $v2;
        } else if ($operador == "*") {
            $resultado = $v1 * $v2;
        } else if ($operador == "/") {
            if ($v2 != 0) {
                $resultado = $v1 / $v2;
            } else {
                $resultado = "Erro: divisão por zero";
            }
        } else {
            $resultado = "Operador inválido";
        }

        echo "<h1>Resultado: $resultado</h1>";

        ?>
    </main>


</body>

</html>