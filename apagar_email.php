<?php
include "conexao.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'];

    $sql = "DELETE FROM emails WHERE id = $id";
    $resultado = banco($server, $user, $pass, $name, $sql);

    if ($resultado) {
        echo json_encode(['status' => 'success', 'message' => 'Email deletado com sucesso']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Erro ao deletar o email']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método de requisição inválido']);
}
?>
