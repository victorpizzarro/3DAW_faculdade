<!DOCTYPE html>
<html>
<head>
    <?php include 'MenuAlunos.html'; ?>
    <style>
        .tabela-container {
            margin-top: 20px; 
        }
        .minha-tabela {
            border-collapse: collapse;
            width: 100%;
        }
        .minha-tabela th, .minha-tabela td {
            border: 1px solid black;
            padding: 8px; 
            text-align: left; 
        }
    </style>
</head>
<body>
<h1>Listar Alunos</h1>
<div class="tabela-container">
    <table class="minha-tabela">
        <thead>
            <tr>
                <th>Aluno</th>
                <th>Matrícula</th>
                <th>Data de Nascimento</th>
                <th>CPF</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $arquivo = fopen("alunos.txt", "r") or die ("Erro ao abrir o arquivo!");
                $primeiraLinha = true;
                while (($linha = fgets($arquivo)) !== false) {
                    if ($primeiraLinha) {
                        $primeiraLinha = false; 
                        continue;
                    }

                    $linha = trim($linha); 
                    if ($linha === "") {
                        continue; 
                    }

                    $colunaDados = explode(";", $linha);

                  
                    if (count($colunaDados) < 4) {
                        continue;
                    }

                    echo "<tr>";
                    echo "<td>{$colunaDados[0]}</td>";
                    echo "<td>{$colunaDados[1]}</td>";
                    echo "<td>{$colunaDados[2]}</td>";
                    echo "<td>{$colunaDados[3]}</td>";
                    echo "</tr>"; 
                }
                fclose($arquivo);
            ?>  
        </tbody>
    </table>
</div>
</body>
</html>
