<?php

    session_start();

    if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] != true) {
        header("Location: login.php");
        exit;
    } 

    // Conexão PDO
    /*''$pdo = new PDO("mysql:host=localhost;dbname=seubanco;charset=utf8mb4", "usuario", "senha", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["foto"])) {
        $userId = $_SESSION['pk_usuario']; // ID do usuário logado

        $arquivo = $_FILES["foto"]; // Dados do arquivo enviado

        // Verificar se não houve erro
        if ($arquivo["error"] === 0) {
            // Definir pasta de destino
            $pasta = "uploads/";
            if (!is_dir($pasta)) {
                mkdir($pasta, 0777, true);
            }

            // Gerar nome único para evitar conflito
            $extensao = pathinfo($arquivo["name"], PATHINFO_EXTENSION);
            $nomeUnico = uniqid("user_") . "." . $extensao; 

            $caminho = $pasta . $nomeUnico;

            // Mover arquivo para pasta
            if (move_uploaded_file($arquivo["tmp_name"], $caminho)) {
                // Salvar caminho no banco
                $stmt = $pdo->prepare("UPDATE users SET foto = ? WHERE id = ?");
                $stmt->execute([$caminho, $userId]);

                echo "✅ Foto enviada com sucesso!";
                echo "<br><img src='$caminho' width='150'>";
            } else {
                echo "❌ Erro ao salvar o arquivo.";
            }
        } else {
            echo "❌ Erro no upload: " . $arquivo["error"];
        }
    }''*/

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/traininfostyle.css">
    <link rel="stylesheet" href="../CSS/menu.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="../JAVASCRIPT/configuracao.js"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <title>configurações</title>
</head>

<body>
    <div class="navbar" id="navbar" style="display: none;">
        <a href="../PHP/Inicio.php"><div><img src="../IMAGENS/SmartTrain.png" alt=""></div></a>
        <a href="../PHP/Inicio.php"> Inicio </a>
        <a href="../PHP/rotas.php"> Rotas </a>
        <a href="../PHP/dashboard.php"> Dashboard</a>
        <a href="../PHP/Alertas.php">Alertas</a>
        <a href="../PHP/configuracoes.php">Configurações</a>
    </div>
    <div class="home"><button id="menuButton" onclick="openav()"><img id="icon"
                src="../IMAGENS/Hamburger_icon.svg.png"></button></div>
    <script src="../JAVASCRIPT/menu.js"></script>

    <div class="infoLogo">
        Configurações
    </div>
    <div class="bigbox">
        <h2 style="color: black;">Seu perfil</h2>
        <div class="box free">
            <h3>Foto de perfil</h3>
            <div class="bigscreenflex">
                <img src="../IMAGENS/user-3296.png" alt="">
                <div class="alterar" style="font-weight: 200;">
                    <!-- <form action="bd.php" method="post" enctype="multipart/form-data"> 
                    <input type="file" name="foto" accept="image/*"><br><br> ! -->
                    <button>Editar</button>
                </div>
            </div>
        </div>


        <div class="box free">
    <h3>Nome de Usuário</h3>
    <div class="bigscreenflex">
        <p id="usuario-view"><?php echo $_SESSION["nome_usuario"]; ?></p> 

        <form  action="mudarnome.php" method="POST" id="mudarnome" style="display:none;" > 
            <div class="bigscreenflex"> 
                <input type="text" name="usuario-edit" value="<?php echo $_SESSION["nome_usuario"]; ?>" >  
          
                <div class="alterar" style="font-weight: 200;">
                  <button id="salvar-usuario" onclick="salvarUsuario()" >Salvar</button>
                </div>

            </div>
          
        </form>
        
        <div class="alterar" style="font-weight: 200;">
            <button id="editar-usuario" onclick="editarUsuario()">Editar</button>
            
        </div>
    </div>
</div>

    
        <div class="box free">
    <h3>E-mail</h3>
    <div class="bigscreenflex">
        <p id="email-view"><?php echo $_SESSION["email_usuario"]; ?></p>
        <input type="email" id="email-edit" value="<?php echo $_SESSION["email_usuario"]; ?>" style="display:none;">
        <div class="alterar" style="font-weight: 200;">
            <button id="editar-email" onclick="editarEmail()">Editar</button>
            <button id="salvar-email" onclick="salvarEmail()" style="display:none;">Salvar</button>
        </div>
    </div>
</div>


<script>
function editarEmail() {
    document.getElementById('email-view').style.display = 'none';
    document.getElementById('email-edit').style.display = 'inline';
    document.getElementById('editar-email').style.display = 'none';
    document.getElementById('salvar-email').style.display = 'inline';
}
function salvarEmail() {
    var novoEmail = document.getElementById('email-edit').value;
    document.getElementById('email-view').textContent = novoEmail;
    document.getElementById('email-view').style.display = 'inline';
    document.getElementById('email-edit').style.display = 'none';
    document.getElementById('editar-email').style.display = 'inline';
    document.getElementById('salvar-email').style.display = 'none';
}
</script>

<script>
function editarUsuario() {
    document.getElementById('usuario-view').style.display = 'none';
    document.getElementById('mudarnome').style.display = 'inline';
    document.getElementById('editar-usuario').style.display = 'none';
}
function salvarUsuario() {
    var novoEmail = document.getElementById('usuario-edit').value;
    document.getElementById('usuario-view').textContent = novoEmail;
    document.getElementById('usuario-view').style.display = 'inline';
    document.getElementById('usuario-edit').style.display = 'none';
    document.getElementById('editar-usuario').style.display = 'inline';
    document.getElementById('salvar-usuario').style.display = 'none';
}
</script>

    </div>

</body>

</html>

