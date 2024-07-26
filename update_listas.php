<?php
include "conexao.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Tratamento dos dados enviados via FormData
    $emails = $_POST['email'];
    $observacoes = $_POST['observacao'];
    $ids = array_keys($emails); // IDs são as chaves dos arrays de emails e observações

    foreach ($ids as $id) {
        $email = $emails[$id];
        $observacao = $observacoes[$id];
        $caminho = null;

        // Verificar se um arquivo foi enviado para o ID atual
        if (isset($_FILES['files']['name'][$id])) {
            $fileTmpPath = $_FILES['files']['tmp_name'][$id];
            $fileName = basename($_FILES['files']['name'][$id]);
            $filePath = 'uploads/' . $fileName;

            if (move_uploaded_file($fileTmpPath, $filePath)) {
                $caminho = $filePath;
            } else {
                echo json_encode(['status' => 'error', 'message' => "Erro ao mover o arquivo: " . $fileName]);
                exit;
            }
        }

        // Preparar a consulta SQL
        $sql = "UPDATE emails SET email='$email', observacao='$observacao'";
        if ($caminho) {
            $sql .= ", caminho='$caminho'";
        }
        $sql .= " WHERE id=$id";

        // Executar a consulta
        $resultado = banco($server, $user, $pass, $name, $sql);

        if (!$resultado) {
            echo json_encode(['status' => 'error', 'message' => "Erro ao atualizar o ID $id"]);
            exit;
        }
    }

    echo json_encode(['status' => 'success', 'message' => 'Dados atualizados com sucesso']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método de requisição inválido']);
}
?>
