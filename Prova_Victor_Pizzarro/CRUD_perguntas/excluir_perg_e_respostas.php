<?php

$file_path_mc = 'perguntas.txt';
$file_path_text = 'perguntasTexto.txt';


if (!file_exists($file_path_mc)) file_put_contents($file_path_mc, '');
if (!file_exists($file_path_text)) file_put_contents($file_path_text, '');

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = trim($_POST['delete_id']);


    $mc_questions = file($file_path_mc, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $updated_mc = [];
    $found_mc = false;

    foreach ($mc_questions as $line) {
        $data = explode(';', $line, 4);
        if (count($data) !== 4) {
            $updated_mc[] = $line;
            continue;
        }
        list($id) = $data;
        if ($id === $delete_id) {
            $found_mc = true;
            continue;
        }
        $updated_mc[] = $line;
    }

    if ($found_mc) {
        file_put_contents($file_path_mc, implode("\n", $updated_mc) . "\n");
        $message .= "Pergunta de múltipla escolha ID $delete_id excluída.<br>";
    }


    $text_questions = file($file_path_text, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $updated_text = [];
    $found_text = false;

    foreach ($text_questions as $line) {
        $data = explode(';', $line, 3);
        if (count($data) !== 3) {
            $updated_text[] = $line;
            continue;
        }
        list($id) = $data;
        if ($id === $delete_id) {
            $found_text = true;
            continue;
        }
        $updated_text[] = $line;
    }

    if ($found_text) {
        file_put_contents($file_path_text, implode("\n", $updated_text) . "\n");
        $message .= "Pergunta de texto ID $delete_id excluída.<br>";
    }

    if (!$found_mc && !$found_text) {
        $message = "Nenhuma pergunta encontrada com o ID $delete_id.";
    }
}
?>

<h1>Excluir Pergunta por ID</h1>
<?php if ($message) echo "<p>$message</p>"; ?>

<form method="post">
    <label for="delete_id">Informe o ID da pergunta para excluir (tanto múltipla escolha quanto texto):</label><br>
    <input type="text" id="delete_id" name="delete_id" required><br><br>
    <button type="submit">Excluir Pergunta</button>



</form>

<a href="menu.php">
    <button>Voltar ao Menu</button>
</a>