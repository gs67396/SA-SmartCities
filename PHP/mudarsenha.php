<?php 
    require_once("bd.php");
    session_start();

    function senhaValida($senha) {
        return (
            strlen($senha) >= 8 &&                    // pelo menos 8 caracteres
            preg_match('/[A-Za-z]/', $senha) &&       // pelo menos uma letra
            preg_match('/[0-9]/', $senha) &&          // pelo menos um número
            preg_match('/[\W]/', $senha)  &&          // pelo menos um caractere especial
            !preg_match('/\s/', $senha)               // não pode conter espaços
        );
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $novaSenha = trim($_POST['senhanova'] ?? '');
        $atualSenha = trim($_POST['senhavelha'] ?? '');
        $id = $_SESSION["usuario_id"] ?? null;

        if (!$id) {
            header("Location: configuracoes.php?senha=erro");
            exit;
        }

        if ($novaSenha === "" || $atualSenha === "") {
            header("Location: configuracoes.php");
            exit;
        }

        // Buscar senha atual do usuário
        $stmt = $conn->prepare("SELECT senha_usuario FROM usuario WHERE pk_usuario = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($senhaHashAtual);
        if ($stmt->fetch()) {
            $stmt->close();

            // Verifica se a senha atual está correta
            if (!password_verify($atualSenha, $senhaHashAtual)) {
                header("Location: configuracoes.php?senha=incorreta");
                exit;
            }

            // Verifica se a nova senha é válida
            if (!senhaValida($novaSenha)) {
                header("Location: configuracoes.php?senha=invalida");
                exit;
            }

            // Não permitir que a nova senha seja igual à atual
            if (password_verify($novaSenha, $senhaHashAtual)) {
                header("Location: configuracoes.php?senha=mesma");
                exit;
            }

            // Hash da nova senha
            $novaSenhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);

            // Atualiza a senha no banco
            $stmt2 = $conn->prepare("UPDATE usuario SET senha_usuario = ? WHERE pk_usuario = ?");
            $stmt2->bind_param("si", $novaSenhaHash, $id);

            if ($stmt2->execute()) {
                $stmt2->close();
                header("Location: configuracoes.php?senha=ok");
                exit;
            } else {
                $stmt2->close();
                header("Location: configuracoes.php?senha=erro");
                exit;
            }
        } else {
            $stmt->close();
            header("Location: configuracoes.php?senha=erro");
            exit;
        }
    } else {
        header("Location: configuracoes.php");
        exit;
    }

?>