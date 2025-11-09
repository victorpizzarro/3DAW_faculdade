<?php
include "conexao.php";

$id = $_POST["id"];

if ($id) {
    $sql = "DELETE FROM alunos WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        echo "Aluno excluído com sucesso!";
    } else {
        echo "Erro ao excluir.";
    }
} else {
    echo "ID inválido!";
}
?>
