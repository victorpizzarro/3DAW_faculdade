<!DOCTYPE html>
<html>
<head>
    <title>Inserir Disciplina</title>
</head>
<body>
    <h1>Inserir Disciplina</h1>
    
    <?php
    if ($_POST) {
        $nome = $_POST['nome'];
        $sigla = $_POST['sigla'];
        $carga = $_POST['carga'];
        
        $arquivo = "disciplinas.txt";
        $dados = $nome . ";" . $sigla . ";" . $carga . "\n";
        
        file_put_contents($arquivo, $dados, FILE_APPEND);
        echo "Disciplina inserida!";
    }
    ?>
    
    <form method="POST">
        Nome: <input type="text" name="nome">
        <br><br>
        Sigla: <input type="text" name="sigla">
        <br><br>
        Carga: <input type="text" name="carga">
        <br><br>
        <input type="submit" value="Inserir">
    </form>
    
    <a href="menu.php">Voltar</a>
</body>
</html>
