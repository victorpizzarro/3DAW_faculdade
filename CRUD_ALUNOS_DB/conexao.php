<?php
$servidor = "localhost";
$usuario = "root"; // ou o usuário que você usa no XAMPP/MAMP
$senha = "";
$banco = "alunos_db";

$conn = new mysqli($servidor, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>
