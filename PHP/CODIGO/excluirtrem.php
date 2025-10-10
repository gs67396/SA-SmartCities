<?php
session_start();
include_once("../CODIGO/bd.php");


if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] !== true) {
    header("Location: login.php");
    exit;
}


if (isset($_GET['tremid'])) {
    $tremid = intval($_GET['tremid']);  // Converte para inteiro com segurança

    
    $conn->begin_transaction();

    try {
        // Deleta todos os alertas associados ao trem
        $stmt1 = $conn->prepare("DELETE FROM alerta WHERE pk_trem = ?");
        $stmt1->bind_param("i", $tremid);
        $stmt1->execute();

        // Remove as associações do trem com rotas
        $stmt2 = $conn->prepare("DELETE FROM rotas_trem WHERE pk_trem = ?");
        $stmt2->bind_param("i", $tremid);
        $stmt2->execute();

        // Deleta o próprio trem
        $stmt3 = $conn->prepare("DELETE FROM trem WHERE pk_trem = ?");
        $stmt3->bind_param("i", $tremid);
        $stmt3->execute();

        // Finaliza a transação
        $conn->commit();

        // Redireciona para a página inicial com uma mensagem de sucesso (opcional)
        header("Location: ../PAGINAS/inicio.php?msg=trem_excluido");
        exit;

    } catch (Exception $e) {
        $conn->rollback();
        echo "Erro ao excluir trem: " . $e->getMessage();
    }

} else {
    echo "Trem não especificado.";
}
?>