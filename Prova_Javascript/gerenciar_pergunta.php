<?php
header('Content-Type: application/json');

$arquivo = 'perguntas.txt';

// Função para ler todas as perguntas do arquivo e devolver array
function lerPerguntas($arquivo) {
    if (!file_exists($arquivo)) return [];
    return file($arquivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}

// Função para salvar todas as perguntas no arquivo
function salvarPerguntas($arquivo, $linhas) {
    file_put_contents($arquivo, implode("\n", $linhas) . "\n");
}

// Lê a ação da requisição
$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == 'buscar') {
    if (!isset($_GET['id'])) {
        echo json_encode(['sucesso' => false, 'mensagem' => 'ID da pergunta não fornecido.']);
        exit;
    }

    $id_busca = trim($_GET['id']);
    $linhas = lerPerguntas($arquivo);

    foreach ($linhas as $linha) {
        list($id, $pergunta, $alternativas, $id_correto) = explode(';', $linha);

        if ($id == $id_busca) {
            $alternativas_array = explode(',', $alternativas);

            echo json_encode([
                'sucesso' => true,
                'id' => $id,
                'pergunta' => $pergunta,
                'alternativas' => $alternativas_array,
                'id_correto' => (int)$id_correto
            ]);
            exit;
        }
    }

    echo json_encode(['sucesso' => false, 'mensagem' => 'Pergunta não encontrada.']);
    exit;

} else if ($action == 'salvar') {
    if (!isset($_GET['id'], $_GET['pergunta'], $_GET['escolha'], $_GET['escolha_certa'])) {
        echo json_encode(['sucesso' => false, 'mensagem' => 'Dados incompletos para a alteração.']);
        exit;
    }

    $id_alterar = trim($_GET['id']);
    $nova_pergunta = trim($_GET['pergunta']);
    $novas_escolhas = $_GET['escolha'];
    $id_correto = (int)$_GET['escolha_certa'];

    if ($nova_pergunta === '' || count($novas_escolhas) != 5 || $id_correto < 0 || $id_correto > 4) {
        echo json_encode(['sucesso' => false, 'mensagem' => 'Dados inválidos. Verifique se todos os campos estão preenchidos corretamente.']);
        exit;
    }

    $linhas = lerPerguntas($arquivo);
    $nova_lista = [];
    $encontrado = false;

    foreach ($linhas as $linha) {
        list($id, $pergunta, $alternativas, $correta) = explode(';', $linha);

        if ($id == $id_alterar) {
            $nova_linha = $id . ';' . $nova_pergunta . ';' . implode(',', $novas_escolhas) . ';' . $id_correto;
            $nova_lista[] = $nova_linha;
            $encontrado = true;
        } else {
            $nova_lista[] = $linha;
        }
    }

    if ($encontrado) {
        salvarPerguntas($arquivo, $nova_lista);
        echo json_encode(['sucesso' => true, 'mensagem' => 'Pergunta atualizada com sucesso!']);
    } else {
        echo json_encode(['sucesso' => false, 'mensagem' => 'Pergunta com ID '.$id_alterar.' não encontrada.']);
    }

    exit;
} else {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Ação inválida ou não informada.']);
    exit;
}
