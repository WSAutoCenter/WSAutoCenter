<?php
include "conexao.php";
header('Content-Type: application/json');
$email = $_POST['email_login'];

$sql = "SELECT nome FROM usuarios WHERE email = '$email'";
$resultado = banco($server, $user, $pass, $name, $sql);

$data = [];

if ($resultado->num_rows > 0) {
    while($row = $resultado->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    $data = [];
}
$sql = "UPDATE usuarios SET logado = 'sim' WHERE email = '$email'";
$resultado = banco($server, $user, $pass, $name, $sql);
echo json_encode($data);
?>
