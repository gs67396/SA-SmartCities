<?php
include 'db_conexao.php'; // ou o nome do seu arquivo de conexão

$action = $_POST['action'] ?? '';

if ($action === 'create') {
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $location = $_POST['valor']; // no JS o campo se chama "valor"

    $sql = "INSERT INTO sensores (nome, tipo, location) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nome, $tipo, $location);
    $stmt->execute();

} elseif ($action === 'update') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $location = $_POST['valor'];

    $sql = "UPDATE sensores SET nome=?, tipo=?, location=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nome, $tipo, $location, $id);
    $stmt->execute();

} elseif ($action === 'delete') {
    $id = $_POST['id'];
    $sql = "DELETE FROM sensores WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

} elseif ($action === 'list') {
    $result = $conn->query("SELECT * FROM sensores");
    $sensores = [];
    while ($row = $result->fetch_assoc()) {
        $sensores[] = $row;
    }
    echo json_encode($sensores);
}

$conn->close();
?>
