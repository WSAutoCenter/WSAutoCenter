<?php
include "conexao.php";
header('Content-Type: application/json');

$response = [
    'status' => 'error',
    'message' => ''
];

try {
    $email = $_POST['email_contato'];
    $nome = $_POST['nome_contato'];

    // Usar prepared statements para evitar SQL Injection
    $conn = new mysqli($server, $user, $pass, $name);

    if ($conn->connect_error) {
        throw new Exception("Falha na conexão: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM contatos WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 0) {
        $stmt = $conn->prepare("INSERT INTO contatos (nome, email) VALUES (?, ?)");
        $stmt->bind_param("ss", $nome, $email);
        if ($stmt->execute()) {
            $response['status'] = 'success';
            $response['message'] = 'Usuário cadastrado com sucesso';
        } else {
            $response['message'] = 'Erro ao cadastrar usuário';
        }
    } else {
        $response['message'] = 'Este email já foi cadastrado';
    }

    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    $response['message'] = 'Erro: ' . $e->getMessage();
}

echo json_encode($response);