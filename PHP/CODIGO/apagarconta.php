<?php
require("../CODIGO/bd.php");
session_start();


if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] !== true) {
    header("Location: login.php"); 
    exit;
}

$usuarioId = $_SESSION["usuario_id"];


$stmt = $conn->prepare("DELETE FROM usuario WHERE pk_usuario = ?");
$stmt->bind_param("i", $usuarioId);

if ($stmt->execute()) {
    
    session_unset();
    session_destroy();
    echo "<script>alert('Sua conta foi excluída com sucesso.');</script>";
    header("Location: ../PAGINAS/login.php"); 
    exit;
} else {
    echo "Erro ao deletar usuário: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>