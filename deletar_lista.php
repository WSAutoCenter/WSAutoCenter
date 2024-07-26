<?php
include "conexao.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $lista = $data['lista'];

    // Adiciona aspas simples para a string da lista para evitar problemas de SQL
    $lista = addslashes($lista);

    $sql = "DELETE FROM emails WHERE lista = '$lista'";
    $resultado = banco($server, $user, $pass, $name, $sql);

    if ($resultado) {
        echo json_encode(['status' => 'success', 'message' => 'Lista deletada com sucesso']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Erro ao deletar a lista']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método de requisição inválido']);
}
?>
