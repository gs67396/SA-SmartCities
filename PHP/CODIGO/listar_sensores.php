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
    $result = $con->query("SELECT * FROM sensores ORDER BY id DESC");
    $dados = [];
    while ($row = $result->fetch_assoc()) {
        $dados[] = $row;
    }
    echo json_encode($dados);
}

if ($acao == 'adicionar') {
    $nome = $_POST['id'];
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $valor = $_POST['localizacao'];
    $con->query("INSERT INTO sensores (id, nome, tipo, valor) VALUES ('$id', '$nome', '$tipo', '$localizacao')");
}

if ($acao == 'editar') {
    $nome = $_POST['id'];
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $valor = $_POST['localizacao'];
    $con->query("UPDATE sensores SET nome='$nome', tipo='$tipo', valor='$localizacao' WHERE id=$id");
}

if ($acao == 'excluir') {
    $id = $_POST['id'];
    $con->query("DELETE FROM sensores WHERE id=$id");
}

$con->close();
?>