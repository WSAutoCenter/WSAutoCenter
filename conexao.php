<?php
$server = 'localhost';
$user = 'root';
$pass = 'root';
$name = 'db_ws';


function banco($server, $user, $pass, $name, $sql)
{
    $conexao = mysqli_connect($server, $user, $pass, $name);
    $consulta = mysqli_query($conexao, $sql);
    return $consulta;
}