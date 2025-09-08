<?php
$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST')  {
    $nome = $_POST["nome"];
    $matricula = $_POST["matricula"];
    $nascimento = $_POST["nascimento"];
    $cpf = $_POST["cpf"];
    
    if (!file_exists("alunos.txt")) {
        $arqDisc = fopen("alunos.txt","w") or die("erro ao criar arquivo");
        $linha = "nome;matricula;nascimento;carga\n";
        fwrite($arqDisc,$linha);
        fclose($arqDisc);
    }
    
    $arqDisc = fopen("alunos.txt","a") or die("erro ao abrir arquivo");
    
    $linha = $nome . ";" . $matricula . ";" . $nascimento . ";" . $cpf . "\n";
    fwrite($arqDisc,$linha);
    fclose($arqDisc);
    
    $msg = "Aluno Registrado!";
}
?>
<!DOCTYPE html>
<html>
<head>
<?php include 'MenuAlunos.html'; ?>
</head>
<body>
<h1>Criar Nova Disciplina</h1>
<form action="registrarAluno.php" method="POST">
    Nome: <br> <input type="text" name="nome">
    <br><br>
    Matricula: <br> <input type="text" name="matricula">
    <br><br>
    Data de Nascimento: <br><input type="date" name="nascimento">
    <br><br>
    CPF: <br> <input type="text" name="cpf" placeholder="000.000.000-00">
    <br><br>
    <input type="submit" value="Registrar Aluno!">
</form>
<p><?php echo $msg ?></p>
<br>
</body>
</html>