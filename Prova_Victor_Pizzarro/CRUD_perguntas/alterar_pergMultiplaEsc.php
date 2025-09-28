<?php
$file_path = 'perguntas.txt';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'edit_mc') {
    $question_id = intval($_POST['question_id']);
    $new_question = trim($_POST['question']);
    $choices = array_map('trim', $_POST['choices']);
    $choices = array_filter($choices);
    $correct_index = isset($_POST['correct_index']) ? intval($_POST['correct_index']) : -1;


    if (empty($new_question) || count($choices) != 5 || $correct_index < 0 || $correct_index > 4) {
        echo "Por favor, preencha corretamente a pergunta, as 5 alternativas e selecione a resposta correta.";
        exit;
    }

    if (!file_exists($file_path)) {
        echo "Arquivo de perguntas não encontrado.";
        exit;
    }

    $mc_questions = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $found = false;

    foreach ($mc_questions as $key => $line) {
        $data = explode(';', $line, 4);
        if (count($data) !== 4) continue;

        $id = intval($data[0]);
        if ($id === $question_id) {

            $mc_questions[$key] = $id . ';' . $new_question . ';' . implode(',', $choices) . ';' . $correct_index;
            $found = true;
            break;
        }
    }

    if (!$found) {
        echo "Pergunta com ID $question_id não encontrada.";
        exit;
    }


    file_put_contents($file_path, implode("\n", $mc_questions) . "\n");
    echo "Pergunta de múltipla escolha editada com sucesso!";
}
?>

<h1>Editar Pergunta de Múltipla Escolha</h1>
<form method="post">
    <input type="hidden" name="action" value="edit_mc">

    <label>ID da Pergunta para editar:</label><br>
    <input type="number" name="question_id" required min="1"><br><br>

    <label>Pergunta:</label><br>
    <input type="text" name="question" required><br><br>

    <label>Alternativa 1:</label><br>
    <input type="text" name="choices[]" required><br><br>

    <label>Alternativa 2:</label><br>
    <input type="text" name="choices[]" required><br><br>

    <label>Alternativa 3:</label><br>
    <input type="text" name="choices[]" required><br><br>

    <label>Alternativa 4:</label><br>
    <input type="text" name="choices[]" required><br><br>

    <label>Alternativa 5:</label><br>
    <input type="text" name="choices[]" required><br><br>

    <label>Resposta correta:</label><br>
    <select name="correct_index" required>
        <option value="">-- Selecione a alternativa correta --</option>
        <option value="0">Alternativa 1</option>
        <option value="1">Alternativa 2</option>
        <option value="2">Alternativa 3</option>
        <option value="3">Alternativa 4</option>
        <option value="4">Alternativa 5</option>
    </select><br><br>

    <button type="submit">Editar Pergunta</button>



</form>

<a href="menu.php">
    <button>Voltar ao Menu</button>
</a>