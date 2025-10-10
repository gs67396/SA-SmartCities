<?php

include 'gerenciar_sensores.html';
require_once("bd.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_sensor = intval($_POST['id_sensor']);
    $nome_sensor = trim($_POST['nome_sensor']);
    $tipo_sensor = trim($_POST['tipo_sensor']);
    $localizacao_sensor = trim($_POST['localizacao_sensor']);

    if ($nome_sensor !== "" && $tipo_sensor !== "" && $localizacao_sensor !== "") {
        $stmt = $conn->prepare("INSERT INTO sensores (id_sensor, nome_sensor, tipo_sensor, localizacao_sensor) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $id_sensor, $nome_sensor, $tipo_sensor, $localizacao_sensor);
        if ($stmt->execute()) {
            echo "ok";
        } else {
            echo "erro";
        }
        $stmt->close();
    } else {
        echo "erro";
    }
    $conn->close();
}

$sql = "SELECT descricao_item, quantidade_item FROM itens"; 
$resultado = $conexao->query($sql);

$itens = array();

if ($resultado->num_rows > 0) {
    while ($linha = $resultado->fetch_assoc()) {
        $itens[] = $linha;
    }
}

$conexao->close();

header('Content-Type: application/json');
echo json_encode($itens);
exit;