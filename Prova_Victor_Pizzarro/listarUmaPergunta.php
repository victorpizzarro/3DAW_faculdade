<?php
$question_id = null;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question_id = isset($_POST['question_id']) ? (int)$_POST['question_id'] : null;
}
?>


<h2>Buscar Pergunta pelo ID</h2>
<form method="post">
    <label for="question_id">Digite o ID da pergunta:</label>
    <input type="number" name="question_id" id="question_id" required>
    <button type="submit">Buscar</button>
</form>

<hr>

<?php
if ($question_id === null) {
    exit; 
}

$found = false;


$mc_file = 'perguntas.txt';
if (file_exists($mc_file)) {
    $mc_questions = file($mc_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($mc_questions as $line) {
        $data = explode('|', $line, 4); 
        if (count($data) !== 4) continue;

        list($id, $question, $choices_str, $correct_index) = $data;

        if ((int)$id === $question_id) {
            $found = true;
            $choices = array_map('trim', explode(',', $choices_str));

            echo "<h3>Pergunta de Múltipla Escolha - ID: $id</h3>";
            echo "<p><strong>" . htmlspecialchars($question) . "</strong></p>";
            echo "<ul>";
            foreach ($choices as $index => $choice) {
                $safe_choice = htmlspecialchars($choice);
                if ($index == $correct_index) {
                    echo "<li><b>$safe_choice (Resposta correta)</b></li>";
                } else {
                    echo "<li>$safe_choice</li>";
                }
            }
            echo "</ul>";
            break;
        }
    }
}


$text_file = 'perguntasTexto.txt';
if (!$found && file_exists($text_file)) {
    $text_questions = file($text_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($text_questions as $line) {
        $data = explode('|', $line, 3); 
        if (count($data) !== 3) continue;

        list($id, $question, $correct_answer) = $data;

        if ((int)$id === $question_id) {
            $found = true;

            echo "<h3>Pergunta de Texto - ID: $id</h3>";
            echo "<p><strong>" . htmlspecialchars($question) . "</strong></p>";
            echo "<p>Resposta correta: <i>" . htmlspecialchars($correct_answer) . "</i></p>";
            break;
        }
    }
}

if (!$found) {
    echo "<p>Pergunta com ID $question_id não encontrada.</p>";
}
?>
