<?php 
include "conexao.php";
$email = $_POST['email'];
$sql = "SELECT * FROM usuarios WHERE email = '$email'";
$resultado = banco($server, $user, $pass, $name, $sql);

$data = [];
while($row = $resultado->fetch_assoc()){
    $data[] = $row;
}

echo json_encode($data);
?>