<?php 
    require_once("bd.php");
    session_start();

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['email-edit'])) {
        $novoEmail = trim($_POST['email-edit']);
        $id = $_SESSION["usuario_id"];

        if ($novoEmail !== "") {
            
            $stmt_check = $conn->prepare("SELECT email_usuario FROM usuario WHERE pk_usuario = ?");
            $stmt_check->bind_param("i", $id);
            $stmt_check->execute();
            $stmt_check->bind_result($emailAtual);
            $stmt_check->fetch();
            $stmt_check->close();

            if ($novoEmail === $emailAtual) {
                
                header("Location: ../PAGINAS/configuracoes.php");
                exit;
            }

            // verifica se o e-mail ja esta cadastrado
            $stmt_verifica = $conn->prepare("SELECT pk_usuario FROM usuario WHERE email_usuario = ? AND pk_usuario != ?");
            $stmt_verifica->bind_param("si", $novoEmail, $id);
            $stmt_verifica->execute();
            $stmt_verifica->store_result();

            if ($stmt_verifica->num_rows > 0) {
                header("Location: ../PAGINAS/configuracoes.php?email=existe");
                exit;
            }
            $stmt_verifica->close();

            $stmt = $conn->prepare("UPDATE usuario SET email_usuario = ? WHERE pk_usuario = ?");
            $stmt->bind_param("si", $novoEmail, $id);

            if ($stmt->execute()) {
                $_SESSION["email_usuario"] = $novoEmail;
                header("Location: ../PAGINAS/configuracoes.php?email=ok");
                exit;
            } else {
                header("Location: ../PAGINAS/configuracoes.php?email=erro");
                exit;
            }
        } else {
            header("Location: ../PAGINAS/configuracoes.php?email=vazio");
            exit;
        }
    } else {
        header("Location: ../PAGINAS/configuracoes.php");
        exit;
    }
?>