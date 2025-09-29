<?php 
    require_once("bd.php");
    session_start();

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['usuario-edit'])) {
        $novoNome = trim($_POST['usuario-edit']);
        $id = $_SESSION["usuario_id"];

        if ($novoNome !== "") {
            
            $stmt_check = $conn->prepare("SELECT nome_usuario FROM usuario WHERE pk_usuario = ?");
            $stmt_check->bind_param("i", $id);
            $stmt_check->execute();
            $stmt_check->bind_result($nomeAtual);
            $stmt_check->fetch();
            $stmt_check->close();

            if ($novoNome === $nomeAtual) {
                
                header("Location: ../PAGINAS/configuracoes.php");
                exit;
            }

            $stmt = $conn->prepare("UPDATE usuario SET nome_usuario = ? WHERE pk_usuario = ?");
            $stmt->bind_param("si", $novoNome, $id);

            if ($stmt->execute()) {
                $_SESSION["nome_usuario"] = $novoNome;
                header("Location: ../PAGINAS/configuracoes.php?nome=ok");
                exit;
            } else {
                header("Location: ../PAGINAS/configuracoes.php?nome=erro");
                exit;
            }
        } else {
            header("Location: ../PAGINAS/configuracoes.php?nome=vazio");
            exit;
        }
    } else {
        header("Location: ../PAGINAS/configuracoes.php");
        exit;
    }
?>