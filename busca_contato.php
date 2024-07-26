<?php
include "conexao.php";
header('Content-Type: application/json');

$response = [
    'status' => 'error',
    'data' => [],
    'message' => ''
];

$sql = "SELECT * FROM contatos";
$resultado = banco($server, $user, $pass, $name, $sql);

if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $response['data'][] = $row;
    }
    $response['status'] = 'success';
} else {
    $response['message'] = 'Nenhum contato encontrado';
}

echo json_encode($response);
?>
