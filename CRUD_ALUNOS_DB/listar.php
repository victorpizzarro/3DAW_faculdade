<?php
include "conexao.php";

$sql = "SELECT * FROM alunos ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

$dados = [];
while ($row = mysqli_fetch_assoc($result)) {
    $dados[] = $row;
}

echo json_encode($dados);
?>
