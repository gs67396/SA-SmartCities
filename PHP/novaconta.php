<?php  
    require_once("bd.php");
    session_start();
    $erro = "";
    $resultado = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['novoUsername'] ?? '';
        $email = $_POST['novoEmail'] ?? '';
        $genero = $_POST['genero'] ?? '';
        $senha = $_POST['novaSenha'] ?? '';
        $confirmaSenha = $_POST['confirmarSenha'] ?? '';

        // Função para validar a senha
        function senhaValida($senha) {
            return (
                strlen($senha) >= 8 &&
                preg_match('/[A-Za-z]/', $senha) &&       // pelo menos uma letra
                preg_match('/[0-9]/', $senha) &&          // pelo menos um número
                preg_match('/[\W]/', $senha)              // pelo menos um caractere especial
            );
        }

        // Validação da senha
        if ($senha !== $confirmaSenha) {
            $erro= "As senhas não conferem!";
        } elseif (!senhaValida($senha)) {
            $erro= "A senha deve ter no mínimo 8 caracteres, incluindo pelo menos uma letra, um número e um caractere especial."; 
        } else {
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            $sql_verifica = "SELECT pk_usuario FROM usuario WHERE email_usuario = ?";
            $stmt_verifica = $conn->prepare($sql_verifica);
            $stmt_verifica->bind_param("s", $email);
            $stmt_verifica->execute();
            $stmt_verifica->store_result();

            if ($stmt_verifica->num_rows > 0) {
                $erro = "Este e-mail já está cadastrado.";
            } else {
                // E-mail inédito, pode cadastrar
                $sql = "INSERT INTO usuario (nome_usuario, email_usuario, senha_usuario, genero) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss", $nome, $email, $senhaHash, $genero);

                if ($stmt->execute()) {
                   $erro =  "Usuário cadastrado com sucesso!";
                } else {
                    $erro =  "Erro ao cadastrar usuário: " . $stmt->error; 
                }

                $stmt->close();
            }

            $stmt_verifica->close();
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/loginstyle.css">
    <title>Cadastro</title>
</head>

<body>

    <header>
        <div class="logo"><img src="../IMAGENS/SmartTrain.png" alt="Logo"></div>
    </header>

    <div class="imagem">
        <img src="../IMAGENS/user-3296.png" alt="header">
    </div>

    <div class="espaco"></div>

    <form method="POST" id="criarconta">
        <input type="text" name="novoUsername" required placeholder="Nome de usuário">
        <input type="e-mail" name="novoEmail" required placeholder="E-mail">
        <label for="genero">Gênero</label><br>
        <select name="genero" required>
            <option value="">Escolha..</option>
            <option value="masc">Masculino</option>
            <option value="fem">Feminino</option>
            <option value="out">Outro</option>
            <option value="out">Prefiro não dizer</option>
        </select>
        <input type="password" name="novaSenha"  required placeholder="Senha">
        <input type="password" name="confirmarSenha" required placeholder="confirmar senha">
        <?php if ($erro): ?>
                <div class="erro"><?= htmlspecialchars($erro) ?></div>
        <?php endif; ?>
        
        <button type="submit">Criar conta</button>
    </form>
    <div class="criarconta"><button ><a href="../PHP/login.php">Voltar</a></button></div>
    
</body>

</html>
