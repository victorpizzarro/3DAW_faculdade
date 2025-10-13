<?php
$arquivo = 'perguntas.txt';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'create_mc') {
    $pergunta = trim($_GET['pergunta']);
    $escolha = isset($_GET['escolha']) ? array_map('trim', $_GET['escolha']) : [];
    $id_correto = isset($_GET['escolha_certa']) ? (int)$_GET['escolha_certa'] : -1;

    if (!empty($pergunta) && count($escolha) == 5 && $id_correto >= 0 && $id_correto < 5) {

        if (!file_exists($arquivo)) {
            file_put_contents($arquivo, '');
        }

        require 'func.php';
        $id_pergunta = getNextId();

        $data = $id_pergunta . ';' . $pergunta . ';' . implode(',', $escolha) . ';' . $id_correto . "\n";

        file_put_contents($arquivo, $data, FILE_APPEND);

        echo "Pergunta criada com sucesso! ID: $id_pergunta";
    } else {
        echo "Por favor, preencha a pergunta, exatamente 5 alternativas e marque a resposta correta.";
    }
} else {
    echo "Requisição inválida.";
}
?>
