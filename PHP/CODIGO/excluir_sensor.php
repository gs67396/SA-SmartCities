<?php

require_once("bd.php");

if (isset($_POST['sensor_id'])) {
    $id = intval($_POST['sensor_id']);
    $conn = new mysqli("localhost", "nome_sensor", "tipo_sensor", "sensores.sql");
    if ($conn->connect_error) die("Erro de conexão");
    $sql = "DELETE FROM sensores WHERE id = $id";
    if ($conn->query($sql)) {
        echo "ok";
    } else {
        echo "erro";
    }
    $conn->close();
}
?>