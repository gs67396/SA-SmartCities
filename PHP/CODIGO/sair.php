<?php 

    require_once('bd.php');
    session_start();
    session_destroy();
    $_SESSION["nome_usuario"]= "";
    $_SESSION["usuario_id"]= null;
    $_SESSION["email_usuario"]= "";
    $_SESSION["conectado"]= false;



    header("Location: ../PAGINAS/login.php");
?>