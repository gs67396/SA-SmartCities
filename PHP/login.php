<?php 

    require('bd.php');
    
    session_start();
        
    $erro = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        

        $email = trim($_POST["LoEmail"] ?? "");
        $senha = trim($_POST["LoSenha"] ?? "");

        $stmt = $conn->prepare("SELECT pk_usuario, nome_usuario, senha_usuario FROM usuario WHERE email_usuario = ? AND senha_usuario = ?");
        $stmt->bind_param("ss", $email, $senha);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $dados = $resultado->fetch_assoc();
            $_SESSION["nome_usuario"] = $dados["nome_usuario"];
            $_SESSION["usuario_id"] = $dados["pk_usuario"];
            $_SESSION["conectado"] = true;

    
            header("Location: Inicio.php");
            exit;
        } else {
            $erro = "E-mail ou senha inválidos.";
        }
    }


?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/loginstyle.css">
    <title>Login</title>
</head>

<body>
    <header>
        <div class="logo"><img src="../IMAGENS/SmartTrain.png" alt="Logo"></div>
    </header>

    <main>
        <div class="imagem"><img src="../IMAGENS/user-3296.png" alt="Usericon"></div>
        
        <form method="POST" id="Login">
            <input type="email" name="LoEmail" placeholder="E-mail"><br>
            <input type="password" name="LoSenha" placeholder="Senha"><br>
            <?php if ($erro): ?>
                <div class="erro"><?= htmlspecialchars($erro) ?></div>
            <?php endif; ?>
            <button type="submit">Login</button>
            
        </form> 
        <div class="criarconta"><button><a href="novaconta.html">Criar conta</a></button></div>      
       
    </main>
    <footer>

    </footer>
</body>

</html>

