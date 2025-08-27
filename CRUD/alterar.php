<!DOCTYPE html>
<html>

<head>
    <title>Alterar Disciplina</title>
</head>

<body>
    <h1>Alterar Disciplina</h1>

    <?php
    if (isset($_GET['sigla'])) {
        $sigla = $_GET['sigla'];
        $arqDisc = fopen("disciplinas.txt", "r");
        $encontrado = false;

        while (!feof($arqDisc)) {
            $linha = fgets($arqDisc);
            $colunaDados = explode(";", $linha);
            if (count($colunaDados) >= 3 && $colunaDados[1] == $sigla) {
                $encontrado = true;
                echo "<form method='POST'>";
                echo "Nome: <input type='text' name='nome' value='" . $colunaDados[0] . "'><br>";
                echo "Sigla: <input type='text' name='sigla' value='" . $colunaDados[1] . "' readonly><br>";
                echo "Carga: <input type='text' name='carga' value='" . trim($colunaDados[2]) . "'><br>";
                echo "<input type='hidden' name='sigla_original' value='" . $sigla . "'>";
                echo "<input type='submit' name='alterar' value='Alterar'>";
                echo "</form>";
                break;
            }
        }
        fclose($arqDisc);
        if (!$encontrado) echo "Não encontrado!";
    }

    if (isset($_POST['alterar'])) {
        $nome = $_POST['nome'];
        $carga = $_POST['carga'];
        $sigla_original = $_POST['sigla_original'];

        $linhas = file("disciplinas.txt");
        $novo = "";
        foreach ($linhas as $linha) {
            $colunaDados = explode(";", $linha);
            if (count($colunaDados) >= 3 && $colunaDados[1] == $sigla_original) {
                $novo .= $nome . ";" . $sigla_original . ";" . $carga . "\n";
            } else {
                $novo .= $linha;
            }
        }
        file_put_contents("disciplinas.txt", $novo);
        echo "Alterado! <a href='listar.php'><br>Ver lista</a>";
    }
    ?>

    
</body>

</html>