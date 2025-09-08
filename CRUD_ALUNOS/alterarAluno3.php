<?php
include 'MenuAlunos.html'; 

$arquivo  = fopen("alunos.txt", "r") or die("Erro ao abrir arquivo!");
$arquivo2 = fopen("alunos2.txt", "w") or die("Erro ao abrir arquivo!");

$matriculaOriginal = $_POST["matriculaOriginal"];
$nome       = $_POST["nome"];
$matricula  = $_POST["matricula"];
$nascimento = $_POST["nascimento"];
$cpf        = $_POST["cpf"];

$cont = 0;

while (($linha = fgets($arquivo)) !== false) {
    $linha = trim($linha);

    if ($linha === "") {
        continue; 
    }

    $colunaDados = explode(";", $linha);

    
    if (count($colunaDados) < 2) {
        fwrite($arquivo2, $linha . PHP_EOL);
        continue;
    }

    if ($cont == 0 && $matriculaOriginal == $colunaDados[1]) {
        
        $linha = $nome . ";" . $matricula . ";" . $nascimento . ";" . $cpf;
        $cont = 1;
    }

    fwrite($arquivo2, $linha . PHP_EOL);
}

fclose($arquivo);
fclose($arquivo2);

rename("alunos2.txt", "alunos.txt");

echo "Aluno(a) atualizado(a) com sucesso!";
?>
