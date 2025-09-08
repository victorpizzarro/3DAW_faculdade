<!DOCTYPE html>
<html>

<head>
    <style>
        .tabela-container {
            margin-top: 20px;
        }

        .minha-tabela {
            border-collapse: collapse;
            width: 100%;
        }

        .minha-tabela th,
        .minha-tabela td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <?php include 'MenuAlunos.html'; ?>

    <h1>Listar Aluno</h1>
    <div class="tabela-container">
        <table class="minha-tabela">
            <tr>
                <th>Nome</th>
                <th>Matricula</th>
                <th>Data de Nascimento</th>
                <th>CPF</th>
            </tr>
            <?php
            $arquivo = fopen("alunos.txt", "r") or die("Erro ao abrir arquivo!");
            $matricula = $_POST["matricula"];

            while (($linha = fgets($arquivo)) !== false) {
                $linha = trim($linha);


                if ($linha === "") {
                    continue;
                }

                $colunaDados = explode(";", $linha);


                if (count($colunaDados) < 2) {
                    continue;
                }

                if ($colunaDados[1] == $matricula) {
                    echo "<tr>";
                    echo "<td>{$colunaDados[0]}</td>";
                    echo "<td>{$colunaDados[1]}</td>";
                    echo "<td>" . (isset($colunaDados[2]) ? $colunaDados[2] : '') . "</td>";
                    echo "<td>" . (isset($colunaDados[3]) ? $colunaDados[3] : '') . "</td>";
                    echo "</tr>";
                }
            }

            fclose($arquivo);
            ?>
        </table>
    </div>
</body>

</html>