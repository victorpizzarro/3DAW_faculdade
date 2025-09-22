<?php
$file_path = 'perguntasTexto.txt';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'edit_text') {
    $question_id = intval($_POST['question_id']);
    $new_question = trim($_POST['text_question']);
    $new_answer = trim($_POST['correct_answer']);

   
    if ($question_id <= 0 || $new_question === '' || $new_answer === '') {
        echo "Por favor, preencha corretamente o ID, a pergunta e a resposta correta.";
        exit;
    }

    if (!file_exists($file_path)) {
        echo "Arquivo de perguntas de texto não encontrado.";
        exit;
    }

    $text_questions = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $found = false;

    foreach ($text_questions as $key => $line) {
        $data = explode('|', $line, 3);
        if (count($data) !== 3) continue;

        $id = intval($data[0]);
        if ($id === $question_id) {
            
            $text_questions[$key] = $id . '|' . $new_question . '|' . $new_answer;
            $found = true;
            break;
        }
    }

    if (!$found) {
        echo "Pergunta com ID $question_id não encontrada.";
        exit;
    }

   
    file_put_contents($file_path, implode("\n", $text_questions) . "\n");
    echo "Pergunta de texto editada com sucesso!";
}
?>

<h1>Editar Pergunta de Texto</h1>
<form method="post">
    <input type="hidden" name="action" value="edit_text">

    <label>ID da Pergunta para editar:</label><br>
    <input type="number" name="question_id" required min="1"><br><br>

    <label>Pergunta:</label><br>
    <input type="text" name="text_question" required><br><br>

    <label>Resposta correta:</label><br>
    <input type="text" name="correct_answer" required><br><br>

    <button type="submit">Editar Pergunta</button>
</form>
