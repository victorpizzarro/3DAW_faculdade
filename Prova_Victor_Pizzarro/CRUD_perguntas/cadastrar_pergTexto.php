<?php
$file_path = 'perguntasTexto.txt';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create_text') {
    $text_question = trim($_POST['text_question']);
    $correct_answer = trim($_POST['correct_answer']);

    if (!empty($text_question) && !empty($correct_answer)) {


        if (strpos($text_question, ';') !== false || strpos($correct_answer, '|') !== false) {
            echo "A pergunta e a resposta não podem conter o caractere ';'.";
            exit;
        }


        require 'funções.php';
        $new_id = getNextId();

        $data = $new_id . ';' . $text_question . ';' . $correct_answer . "\n";


        if (file_put_contents($file_path, $data, FILE_APPEND) !== false) {
            echo "Pergunta de múltipla escolha criada com sucesso! ID: $new_id";
        } else {
            echo " Erro ao salvar a pergunta. Verifique permissões no arquivo.";
        }
    } else {
        echo " Por favor, preencha a pergunta e a resposta correta.";
    }
}
?>


<h1>Criar Pergunta de Texto</h1>
<form method="post">
    <input type="hidden" name="action" value="create_text">

    <label>Pergunta:</label><br>
    <input type="text" name="text_question" required><br><br>

    <label>Resposta correta:</label><br>
    <input type="text" name="correct_answer" required><br><br>

    <button type="submit">Criar Pergunta</button>


</form>

<a href="menu.php">
    <button>Voltar ao Menu</button>
</a>