<?php

require_once("bd.php");

if (isset($_POST['id_sensor'])) {
    $id = intval($_POST['id_sensor']);
    // Usar a conexão do bd.php
    global $conn;
    if ($conn->connect_error) die("Erro de conexão");
    $stmt = $conn->prepare("DELETE FROM sensores WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "ok";
    } else {
        echo "erro";
    }
    $stmt->close();
    $conn->close();
}
?>