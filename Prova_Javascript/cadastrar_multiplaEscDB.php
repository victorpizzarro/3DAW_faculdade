<?php
// Conexão com o banco de dados
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "BD_Perguntas";

$conn = new mysqli($host, $usuario, $senha, $banco);

// Define charset para evitar problemas com acentos
$conn->set_charset("utf8mb4");

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Coleta os dados enviados via POST
$action = isset($_POST['action']) ? $_POST['action'] : '';
$pergunta = isset($_POST['pergunta']) ? trim($_POST['pergunta']) : '';
$escolhas = isset($_POST['escolha']) ? (array)$_POST['escolha'] : [];
$escolha_certa = isset($_POST['escolha_certa']) ? (int)$_POST['escolha_certa'] : -1;

// Verifica se é a ação correta
if ($action === 'create_mc') {

    // Validação básica
    if (empty($pergunta) || count($escolhas) != 5 || $escolha_certa < 0 || $escolha_certa > 4) {
<<<<<<< HEAD
        echo "⚠️ Preencha todos os campos corretamente e selecione a resposta correta.";
=======
        echo "Preencha todos os campos corretamente e selecione a resposta correta.";
>>>>>>> 421a771 (Atualização PHP com Banco de Dados)
        exit;
    }

    // Monta comando SQL direto
    $sql = "
        INSERT INTO perguntas 
        (pergunta, alternativa1, alternativa2, alternativa3, alternativa4, alternativa5, correta)
        VALUES (
            '" . $conn->real_escape_string($pergunta) . "',
            '" . $conn->real_escape_string($escolhas[0]) . "',
            '" . $conn->real_escape_string($escolhas[1]) . "',
            '" . $conn->real_escape_string($escolhas[2]) . "',
            '" . $conn->real_escape_string($escolhas[3]) . "',
            '" . $conn->real_escape_string($escolhas[4]) . "',
            $escolha_certa
        )
    ";

    // Executa a query
    if ($conn->query($sql) === TRUE) {
<<<<<<< HEAD
        echo "✅ Pergunta cadastrada com sucesso! ID: " . $conn->insert_id;
    } else {
        echo "❌ Erro ao cadastrar: " . $conn->error;
    }

} else {
    echo "⚠️ Ação inválida ou parâmetros ausentes.";
=======
        echo "Pergunta cadastrada com sucesso! ID: " . $conn->insert_id;
    } else {
        echo "Erro ao cadastrar: " . $conn->error;
    }

} else {
    echo "Ação inválida ou parâmetros ausentes.";
>>>>>>> 421a771 (Atualização PHP com Banco de Dados)
}

$conn->close();
?>
