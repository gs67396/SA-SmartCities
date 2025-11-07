<?php
session_start();
require_once("../CODIGO/bd.php"); 

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $modelo_trem = trim($_POST['modelo_trem']);
    $condicao_trem = "inativo"; 

    if ($modelo_trem !== "") { 
        $sql = "INSERT INTO trem (modelo_trem, condicao_trem) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $modelo_trem, $condicao_trem);
        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
         
            header("Location: inicio.php");
            exit(); 
        } else {
            echo "Erro ao cadastrar trem.";
            $stmt->close();
        }
    } else {
        echo "Preencha todos os campos obrigatórios.";
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Alertas</title>
    <link rel="stylesheet" href="../../CSS/loginstyle.css">
</head>
<body>
    <h2>Alertas de Sensores</h2>
    <form method="POST" action="">
        <label for="modelo_trem">Modelo do Trem:</label>
        <input type="text" id="modelo_trem" name="modelo_trem" required>
        <br><br>
        <button type="submit">Adicionar alerta</button>
    </form>
    <h2>Alertas de Manuntenção</h2>
    <form method="POST" action="">
        <label for="modelo_trem">Modelo do Trem:</label>
        <input type="text" id="modelo_trem" name="modelo_trem" required>
        <br><br>
        <button type="submit">Adicionar alerta</button>
    </form>
</body>
</html>