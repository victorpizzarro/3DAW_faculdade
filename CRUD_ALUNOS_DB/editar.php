<?php
include "conexao.php";

$id = $_POST["id"];
$nome = $_POST["nome"];
$matricula = $_POST["matricula"];
$email = $_POST["email"];

if ($id && $nome && $matricula && $email) {
    $sql = "UPDATE alunos SET nome='$nome', matricula='$matricula', email='$email' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "Aluno atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar.";
    }
} else {
    echo "Preencha todos os campos.";
}
?>
