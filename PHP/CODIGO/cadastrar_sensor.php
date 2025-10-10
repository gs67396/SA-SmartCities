<?php

include 'conexao.php';

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