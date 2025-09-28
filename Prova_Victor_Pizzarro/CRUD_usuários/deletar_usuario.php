<?php

ob_start();

$arquivo = __DIR__ . '/usuarios.txt';


function limpar($valor) {
    return preg_replace('/\s+/', '', $valor);
}


function lerLinhas($arquivo) {
    $conteudo = file_get_contents($arquivo);
    if ($conteudo === false) return [];
    // normaliza quebras de linha e quebra em linhas
    $linhas = preg_split('/\r\n|\r|\n/', $conteudo);
    return $linhas ?: [];
}

if (isset($_GET['cpf'])) {
    $cpf = limpar($_GET['cpf']);

    if (!file_exists($arquivo)) {
        
        ob_end_clean();
        echo "Arquivo de usuários não encontrado! Verifique se 'usuarios.txt' está na mesma pasta deste script.";
        exit;
    }

    $linhas = lerLinhas($arquivo);
    $novo = [];
    $encontrado = false;

    foreach ($linhas as $linha) {
        $linhaTrim = trim($linha);
        if ($linhaTrim === '') continue; 

        $colunaDados = array_map('trim', explode(';', $linhaTrim));
        $cpf_linha = isset($colunaDados[2]) ? limpar($colunaDados[2]) : '';

        if ($cpf_linha === $cpf) {
            $encontrado = true;
            
            continue;
        }

        $novo[] = $linhaTrim;
    }

    if ($encontrado) {
        
        $conteudoNovo = implode(PHP_EOL, $novo) . (count($novo) > 0 ? PHP_EOL : '');
        $res = file_put_contents($arquivo, $conteudoNovo, LOCK_EX);
        if ($res === false) {
            ob_end_clean();
            echo "Falha ao gravar em 'usuarios.txt'. Verifique permissões (escrita) do arquivo para o usuário do servidor web.";
            exit;
        }
    }
   
    ob_end_clean();
    header('Location: ./menu_usuarios.php');
    exit;
} else {
    ob_end_clean();
    echo "Nenhum CPF informado para exclusão. <a href='menu_usuarios.php'>Voltar</a>";
    exit;
}
?>
