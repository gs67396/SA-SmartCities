<?php
    session_start();

    if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] != true) {
        header("Location: login.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/traininfostyle.css">
    <link rel="stylesheet" href="../../CSS/menu.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <title>Alertas</title>
</head>

<body>
    <div class="navbar" id="navbar" style="display: none;">
        <a href="../PAGINAS/Inicio.php"><div><img src="../../IMAGENS/SmartTrain.png" alt=""></div></a>
        <a href="../PAGINAS/Inicio.php"> Inicio </a>
        <a href="../PAGINAS/rotas.php"> Rotas </a>
        <a href="../PAGINAS/relatotio.php"> Dashboard</a>
        <a href="../PAGINAS/Alertas.php">Alertas</a>
        <a href="../PAGINAS/configuracoes.php">Configurações</a>
    </div>
    <div class="home"><button id="menuButton" onclick="openav()"><img id="icon"
                src="../../IMAGENS/Hamburger_icon.svg.png"></button></div>
    <script src="../../JAVASCRIPT/menu.js"></script>

    <div class="infoLogo">
        Alertas
    </div>
     <div class="bigbox">
        <div class="event">
            <div class="tempo">16:16 23 de fevereiro de 2025</div>
            <div style="display: flex;">
                <div class="dot"></div>
                Falta de enrgia reportada no veículo de ID <div class="trainid-text">017</div>.
            </div>

        </div>
    </div>
     <div class="bigbox">
        <div class="event">
            <div class="tempo">14:26 20 de mar de 2012</div>
            <div style="display: flex;">
                <div class="dot" style="background-color: gray;" ></div>
                Manutenção nessecitada no veículo de ID <div class="trainid-text">017</div>.
            </div>

        </div>
    </div>
     <div class="bigbox">
        <div class="event">
            <div class="tempo">14:26 20 de mar de 2024</div>
            <div style="display: flex;">
                <div class="dot" style="background-color: gray;"></div>
                Acidente reportado proximo ao bairro Guanabara.

                <img src="../../IMAGENS/mapa.jpg" alt="">
            </div>

        </div>
    </div>

</body>

</html>