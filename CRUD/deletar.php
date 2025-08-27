<!DOCTYPE html>
<html>
<head>
    <title>Deletar Disciplina</title>
</head>
<body>
    <h1>Deletar Disciplina</h1>

    <?php
    if (isset($_GET['sigla'])) {
        $sigla = $_GET['sigla'];
        $arqDisc = fopen("disciplinas.txt", "r");
        $encontrado = false;
        $nome_disciplina = "";
        
        while (!feof($arqDisc)) {
            $linha = fgets($arqDisc);
            $colunaDados = explode(";", $linha);
            if (count($colunaDados) >= 3 && $colunaDados[1] == $sigla) {
                $encontrado = true;
                $nome_disciplina = $colunaDados[0];
                break;
            }
        }
        fclose($arqDisc);
        
        if ($encontrado) {
            echo "Tem certeza que deseja deletar a disciplina <strong>" . $nome_disciplina . "</strong> (Sigla: " . $sigla . ")?<br>";
            echo "<a href='deletar.php?confirmar=" . $sigla . "'>Sim, deletar</a> | ";
            echo "<a href='listar.php'>Cancelar</a>";
        } else {
            echo "Disciplina não encontrada! <a href='listar.php'>Voltar</a>";
        }
    }
    
    if (isset($_GET['confirmar'])) {
        $sigla = $_GET['confirmar'];
        
        $linhas = file("disciplinas.txt");
        $novo = "";
        foreach ($linhas as $linha) {
            $colunaDados = explode(";", $linha);
            if (count($colunaDados) >= 3 && $colunaDados[1] != $sigla) {
                $novo .= $linha;
            }
        }
        file_put_contents("disciplinas.txt", $novo);
        echo "Deletado com sucesso! <a href='listar.php'>Ver lista</a>";
    }
    ?>

    
</body>
</html>
