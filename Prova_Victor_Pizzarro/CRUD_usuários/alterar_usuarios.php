<?php
if (isset($_GET['cpf'])) {
    $cpf = $_GET['cpf'];
    $arqUsuarios = fopen("usuarios.txt", "r");
    $encontrado = false;

    while (!feof($arqUsuarios)) {
        $linha = fgets($arqUsuarios);
        if (trim($linha) == "") continue;

        $colunaDados = array_map('trim', explode(";", $linha));

        
        if (count($colunaDados) >= 5 && $colunaDados[2] == $cpf) {
            $encontrado = true;
            echo "<form method='POST'>";
            echo "Nome: <input type='text' name='nome' value='" . htmlspecialchars($colunaDados[0]) . "'><br>";
            echo "Email: <input type='text' name='email' value='" . htmlspecialchars($colunaDados[1]) . "' ><br>";
            echo "CPF: <input type='text' name='cpf' value='" . htmlspecialchars($colunaDados[2]) . "' readonly><br>";
            echo "Telefone: <input type='text' name='telefone' value='" . htmlspecialchars($colunaDados[3]) . "'><br>";
            echo "Gênero: <input type='text' name='genero' value='" . htmlspecialchars($colunaDados[4]) . "'><br>";
            echo "<input type='hidden' name='CPF_original' value='" . htmlspecialchars($colunaDados[2]) . "'>";
            echo "<input type='submit' name='alterar' value='Alterar'>";
            echo "</form>";
            break;
        }
    }
    fclose($arqUsuarios);

    if (!$encontrado) echo "Não encontrado!";
}

if (isset($_POST['alterar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $genero = $_POST['genero'];
    $CPF_original = $_POST['CPF_original'];

    $linhas = file("usuarios.txt");
    $novo = "";

    foreach ($linhas as $linha) {
        if (trim($linha) == "") continue;
        $colunaDados = array_map('trim', explode(";", $linha));

        if (count($colunaDados) >= 5 && $colunaDados[2] == $CPF_original) {
            $novo .= $nome . ";" . $email . ";" . $CPF_original . ";" . $telefone . ";" . $genero . "\n";
        } else {
            $novo .= $linha;
        }
    }

    file_put_contents("usuarios.txt", $novo);
    echo "Alterado! <a href='listar_usuarios.php'><br>Ver lista</a>";
}
?>
