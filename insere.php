<?php
include "conexao.php";
header('Content-Type: application/json');

$response = [
    'status' => 'error',
    'message' => ''
];

try {
    $email = $_POST['email_login'];
    $senha = $_POST['senha_login'];
    $nome = $_POST['nome_login'];

    $sql = "INSERT INTO usuarios (nome, senha, email, logado, acesso) VALUES ('$nome', '$senha','$email', 'sim', 1)";
    $resultado = banco($server, $user, $pass, $name, $sql);
    
    if ($resultado) {
        $response['status'] = 'success';
        $response['message'] = 'Usuário cadastrado com sucesso';
    } else {
        $response['message'] = 'Erro ao cadastrar usuário';
    }
} catch (Exception $e) {
    $response['message'] = 'Erro: ' . $e->getMessage();
}

echo json_encode($response);
?>
