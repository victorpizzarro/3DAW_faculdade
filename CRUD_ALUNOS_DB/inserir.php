<?php
include "conexao.php";

$nome = $_POST["nome"];
$matricula = $_POST["matricula"];
$email = $_POST["email"];

if ($nome && $matricula && $email) {
    $sql = "INSERT INTO alunos (nome, matricula, email) VALUES ('$nome', '$matricula', '$email')";
    if (mysqli_query($conn, $sql)) {
        echo "Aluno inserido com sucesso!";
    } else {
        echo "Erro ao inserir.";
    }
} else {
    echo "Preencha todos os campos.";
}
?>
