<?php
include "conexao.php";
header('Content-Type: application/json');

$response = [
    'status' => 'error',
    'data' => [],
    'message' => ''
];

// Primeiro, obtenha todas as listas únicas
$sql = "SELECT DISTINCT lista FROM emails";
$resultado = banco($server, $user, $pass, $name, $sql);

if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $lista = $row['lista'];

        // Para cada lista, obtenha os emails, caminhos de arquivos e observações
        $sqlDetails = "SELECT email, caminho, observacao, id, data_envio FROM emails WHERE lista = '$lista'";
        $resultadoDetails = banco($server, $user, $pass, $name, $sqlDetails);

        $details = [];
        if ($resultadoDetails->num_rows > 0) {
            while ($detailRow = $resultadoDetails->fetch_assoc()) {
                $details[] = $detailRow;
            }
        }

        $response['data'][] = [
            'lista' => $lista,
            'details' => $details
        ];
    }
    $response['status'] = 'success';
} else {
    $response['message'] = 'Nenhuma lista encontrada no banco de dados';
}

echo json_encode($response);
