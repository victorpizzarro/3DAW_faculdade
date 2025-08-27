<!DOCTYPE html>
<html>
<head>
    <title>Listar Disciplinas</title>
</head>
<body>
    <h1>Listar Disciplinas</h1>

    <table border="1">
        <tr>
            <th>Nome</th>
            <th>Sigla</th>
            <th>Carga</th>
            <th>Ações</th>
        </tr>
        <?php
            $arqDisc = fopen("disciplinas.txt", "r");

            while (!feof($arqDisc)) {
                $linha = fgets($arqDisc);
                $colunaDados = explode(";", $linha);

                if (count($colunaDados) >= 3) {
                    echo "<tr><td>" . $colunaDados[0] . "</td>" .
                         "<td>" . $colunaDados[1] . "</td>" .
                         "<td>" . trim($colunaDados[2]) . "</td>" .
                         "<td><a href='alterar.php?sigla=" . $colunaDados[1] . "'>Editar</a> | " .
                         "<a href='deletar.php?sigla=" . $colunaDados[1] . "' onclick='return confirm(\"Deletar?\")'>Deletar</a></td></tr>";
                }
            }

            fclose($arqDisc);
        ?>
    </table>
    
    <a href="menu.php">Voltar</a>
</body>
</html>
