<?php
$host = "localhost";
$user = "root"; // seu usuário do MySQL
$pass = "";     // sua senha
$dbname = "sensores";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>
