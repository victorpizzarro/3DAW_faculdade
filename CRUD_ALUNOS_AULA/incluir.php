<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $matricula = $_POST["Matricula"];
    $nome = $_POST["Nome"];
    $email = $_POST["Email"];
    $msg = "";

    $padraoMatricula = "/[0-9]/";
    $padraoNome = "/[a-zA-Z\s]/";
    $padraoEmail = "/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/";

    if (empty($nome) || empty($email) || empty($matricula)){
        $msg = "Todos os campos devem ser preenchidos";
        exit($msg);
    }
    
    if (!preg_match($padraoMatricula , $matricula)){
        $msg = "A matricula deve conter apenas Numeros";
        exit($msg);
    }

    if (!preg_match($padraoNome, $nome)){
        $msg = "O nome deve conter apenas letras e espaços";
        exit($msg);
    }

    if (!preg_match($padraoEmail, $email)) {
    $msg = "Email inválido";
    exit($msg);
    }



    if (!file_exists("alunos.txt")){

        $arquivo = fopen("alunos.txt", "w") or die ("Erro ao abrir o arquivo");
        $linha = "matricula;nome;email";
        fwrite($arquivo, $linha);
        fclose($arquivo);

    }

    $arquivo = fopen("alunos.txt", "a") or die ("Erro ao abrir o arquivo");
    $linha = "\n" . $matricula . ";" . $nome . ";" . $email;
    fwrite($arquivo, $linha);
    fclose($arquivo);
    $msg = "Incluido!";

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="incluir.php" method = "POST">
    Matricula: <input type="text" name="Matricula"><br>
    Nome: <input type="text" name="Nome"><br>
    Email: <input type="text" name="Email"><br>
    <input type="submit" value = "Enviar">
</form>
</body>
</html>