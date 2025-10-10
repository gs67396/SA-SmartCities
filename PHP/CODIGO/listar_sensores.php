<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "Sensores";

$con = new mysqli($host, $user, $pass, $db);

if ($con->connect_error) {
    die("Erro na conexão: " . $con->connect_error);
}

$acao = $_GET['acao'] ?? $_POST['acao'] ?? '';

if ($acao == 'listar') { 
    $result = $con->query("SELECT * FROM sensores ORDER BY id_sensor DESC");
    $dados = [];
    while ($row = $result->fetch_assoc()) {
        $dados[] = $row;
    }
    echo json_encode($dados);
}

if ($acao == 'adicionar') {
    $id_sensor = $_POST['id_sensor'];
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $localizacao = $_POST['localizacao'];
    $stmt = $con->prepare("INSERT INTO sensores (id_sensor, nome, tipo, localizacao) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $id_sensor, $nome, $tipo, $localizacao);
    $stmt->execute();
    $stmt->close();
}

if ($acao == 'editar') {
    $id_sensor = $_POST['id_sensor'];
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $localizacao = $_POST['localizacao'];
    $stmt = $con->prepare("UPDATE sensores SET nome=?, tipo=?, localizacao=? WHERE id_sensor=?");
    $stmt->bind_param("sssi", $nome, $tipo, $localizacao, $id_sensor);
    $stmt->execute();
    $stmt->close();
}

if ($acao == 'excluir') {
    $id_sensor = $_POST['id_sensor'];
    $stmt = $con->prepare("DELETE FROM sensores WHERE id_sensor=?");
    $stmt->bind_param("i", $id_sensor);
    $stmt->execute();
    $stmt->close();
}

$con->close();
?>