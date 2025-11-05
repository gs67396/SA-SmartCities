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