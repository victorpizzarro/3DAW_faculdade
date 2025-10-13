<?php
function getNextId() {
    $arquivo = 'perguntas.txt';

    if (!file_exists($arquivo) || filesize($arquivo) === 0) {
        return 1;
    }

    $linhas = file($arquivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $ultimo = end($linhas);
    $partes = explode(';', $ultimo);
    return isset($partes[0]) ? ((int)$partes[0] + 1) : 1;
}
?>
