<?php

$mc_file = 'perguntas.txt';

if (file_exists($mc_file)) {
    $mc_questions = file($mc_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    if (!empty($mc_questions)) {
        echo "<h1>Perguntas de Múltipla Escolha</h1><ul>";

        foreach ($mc_questions as $line) {
            $data = explode('|', $line, 4);
            if (count($data) !== 4) {
                echo "<li><i>Pergunta inválida: formato incorreto.</i></li>";
                continue;
            }

            list($id, $question, $choices_str, $correct_index_str) = $data;
            $choices = array_map('trim', explode(',', $choices_str));
            $correct_index = (int)$correct_index_str;

            if (count($choices) !== 5) {
                echo "<li><i>Pergunta ID $id inválida: precisa ter 5 alternativas.</i></li>";
                continue;
            }

            echo "<li><b>ID $id - " . htmlspecialchars($question) . "</b><br>Alternativas:<ul>";
            foreach ($choices as $idx => $choice) {
                $safe_choice = htmlspecialchars($choice);
                if ($idx === $correct_index) {
                    echo "<li><b>$safe_choice (Resposta correta)</b></li>";
                } else {
                    echo "<li>$safe_choice</li>";
                }
            }
            echo "</ul></li>";
        }

        echo "</ul>";
    } else {
        echo "<p> Não há perguntas de múltipla escolha cadastradas!</p>";
    }
} else {
    echo "<p> Arquivo de perguntas de múltipla escolha não encontrado!</p>";
}



$text_file = 'perguntasTexto.txt'; 

if (file_exists($text_file)) {
    $text_questions = file($text_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    if (!empty($text_questions)) {
        echo "<h1>Perguntas de Texto</h1><ul>";

        foreach ($text_questions as $line) {
            $data = explode('|', $line, 3);
            if (count($data) !== 3) {
                echo "<li><i>Pergunta de texto inválida: formato incorreto.</i></li>";
                continue;
            }

            list($id, $question, $correct_answer) = $data;

            echo "<li><b>ID $id - " . htmlspecialchars($question) . "</b><br>";
            echo "Resposta correta: <i>" . htmlspecialchars($correct_answer) . "</i></li>";
        }

        echo "</ul>";
    } else {
        echo "<p> Não há perguntas de texto cadastradas!</p>";
    }
} else {
    echo "<p>Arquivo de perguntas de texto não encontrado!</p>";
}
?>
