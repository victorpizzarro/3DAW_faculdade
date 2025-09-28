<!DOCTYPE html>
<html>

<head>
    <title>Cadastrar Usuário</title>
</head>

<body>
    <h1>Cadastrar Usuário</h1>

    <?php
    if ($_POST) {
        $nome = htmlspecialchars($_POST['nome']);
        $email = htmlspecialchars($_POST['email']);
        $genero = $_POST['genero'];
        $cpf = $_POST['cpf'];
        $telefone = $_POST['telefone'];

        $arquivo = "usuarios.txt";
        $dados = $nome . ";" . $email . ";" . $cpf . ";" . $telefone . ";" . $genero . "\n";

        file_put_contents($arquivo, $dados, FILE_APPEND);
        echo "Usuário Cadastrado!";
    }
    ?>

    <form method="POST">
        Nome:
        <br>
        <input type="text" name="nome" required>
        <br><br>
        Email:
        <br>
        <input type="email" name="email">
        <br><br>
        CPF:
        <br>
        <input type="number" name="cpf">
        <br><br>
        Telefone:
        <br>
        <input type="tel" name="telefone" required placeholder="(xx) xxxxx-xxxx">
        <br><br>
        Gênero:
        <br>
        <input type="radio" name="genero" value="feminino">
        <label for="feminino" id="feminino" value="feminino">Feminino</label>
        <br>
        <input type="radio" name="genero" value="masculino">
        <label for="masculino" id="masculino" value="masculino">Masculino</label><br>
        <br><br>
        <input type="submit" value="Inserir">
    </form>

    <a href="menu_usuarios.php">
        <button>Voltar ao Menu</button>
    </a>

</body>

</html>