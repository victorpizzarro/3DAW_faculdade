<!DOCTYPE html>
<html>

<head>
    <title>Listar Usuários</title>
</head>

<body>
    <h1>Listar Usuários</h1>

    <table border="1">
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>CPF</th>
            <th>Telefone</th>
            <th>Gênero</th>
            <th>Opções</th>
        </tr>
        <?php
        $arquivo = "usuarios.txt";

        if (!file_exists($arquivo)) {
            die("Arquivo de usuários não encontrado!");
        }

        $arqUsuarios = fopen($arquivo, "r");

        while (!feof($arqUsuarios)) {
            $linha = fgets($arqUsuarios);
            if (trim($linha) == "") continue;

            $colunaDados = explode(";", $linha);

            if (count($colunaDados) >= 5) {
                $nome = trim($colunaDados[0]);
                $email = trim($colunaDados[1]);
                $cpf = trim($colunaDados[2]);
                $telefone = trim($colunaDados[3]);
                $genero = trim($colunaDados[4]);

                echo "<tr>
                        <td>{$nome}</td>
                        <td>{$email}</td>
                        <td>{$cpf}</td>
                        <td>{$telefone}</td>
                        <td>{$genero}</td>
                        <td>
                            <a href='alterar_usuarios.php?cpf=" . urlencode($cpf) . "'>Editar</a> | 
                            <a href='deletar_usuario.php?cpf=" . urlencode($cpf) . "' onclick='return confirm(\"Deletar este usuário?\")'>Deletar</a>
                        </td>
                      </tr>";
            }
        }

        fclose($arqUsuarios);
        ?>
    </table>
    
    <a href="menu_usuarios.php">
        <button>Voltar ao Menu</button>
    </a>

</body>

</html>