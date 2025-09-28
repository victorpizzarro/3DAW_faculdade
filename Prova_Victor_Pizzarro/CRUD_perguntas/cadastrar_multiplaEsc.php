<?php
$file_path = 'perguntas.txt';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'create_mc') {
    $question = trim($_POST['question']);
    $choices = array_map('trim', $_POST['choices']);
    $choices = array_filter($choices);


    $correct_index = isset($_POST['correct_choice']) ? (int)$_POST['correct_choice'] : -1;

    if (!empty($question) && count($choices) == 5 && $correct_index >= 0 && $correct_index < 5) {

        if (!file_exists($file_path)) {
            file_put_contents($file_path, '');
        }


        require 'funções.php';
        $question_id = getNextId();



        $data = $question_id . ';' . $question . ';' . implode(',', $choices) . ';' . $correct_index . "\n";


        file_put_contents($file_path, $data, FILE_APPEND);

        echo "Pergunta de múltipla escolha criada com sucesso! ID: $question_id";
    } else {
        echo "Por favor, preencha a pergunta, exatamente 5 alternativas e marque a resposta correta.";
    }
}
?>

<h1>Criar Pergunta de Múltipla Escolha</h1>
<form method="post">
    <input type="hidden" name="action" value="create_mc">

    <label>Pergunta: </label><br>
    <input type="text" name="question" required><br><br>

    <?php
    for ($i = 0; $i < 5; $i++) {
        $num = $i + 1;
        echo "<label>Alternativa $num: </label><br>";
        echo '<input type="text" name="choices[]" required>';
        echo ' <input type="radio" name="correct_choice" value="' . $i . '" required> Marcar como correta<br><br>';
    }
    ?>

    <button type="submit">Criar Pergunta</button>


</form>

<a href="menu.php">
    <button>Voltar ao Menu</button>
</a>