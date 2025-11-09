<?php
include "conexao.php";

$nome = $_GET["nome"];

$sql = "SELECT * FROM alunos WHERE nome LIKE '%$nome%'";
$result = mysqli_query($conn, $sql);

$dados = [];
while ($row = mysqli_fetch_assoc($result)) {
    $dados[] = $row;
}

echo json_encode($dados);
?>
