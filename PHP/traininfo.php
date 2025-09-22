<?php
    session_start();

    if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] != true) {
        header("Location: login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/traininfostyle.css">
    <link rel="stylesheet" href="../CSS/menu.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <title>Pagina de informação</title>
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
        Informações
    </div>
    <div class="bigbox">
        <div style="display: flex;">
            <img src="../IMAGENS/trem1.png">
            <div class="trainid">017</div>
        </div>

        <div class="maininfo">
            <div class="box">
                <div>Maquinista</div>

                <img src="../IMAGENS/user-3296.png">
                <div>fulano</div>
                <div>000-000-008</div>

            </div>
            <div style="display: flex;">
                <div class="box" style="width: 100%;">
                    Modelo <br>
                    00012
                </div>
                <div class="box" style="width: 100%;">
                    Condição <br>
                    Danificado
                </div>

            </div>
            <div style="display: flex;">
                <div class="box" style="width: 100%;">
                    Combustivel <br>
                    Eletrico
                </div>
                <div class="box" style="width: 100%;">
                    Velocidade media <br>
                    320 Km/h
                </div>

            </div>




        </div>

    </div>
    <hr>
    <h2>Rota Atual</h2>
    <div class="bigbox">
        <img src="../IMAGENS/mapa.jpg">
        <div class="rotaatual">
            <div>Lugar 1 - Lugar 2</div>

            <div>18:00 20:00</div>


        </div>

        <div class="alterar">
            <button>
                cancelar
            </button>
        </div>

    </div>
    <hr>
    <h2>Rotas planejadas</h2>
    <div class="nodatalert">Não há nenhuma rota planejada no momento. </div>

    <hr>
    <h2>Historico</h2>
    <div class="bigbox">
        <div class="event">
            <div class="tempo">14:26 20 de mar de 2024</div>
            <div style="display: flex;">
                <div class="dot"></div>
                Acidente reportado proximo ao bairro Guanabara.

                <img src="../IMAGENS/mapa.jpg" alt="">
            </div>

        </div>
    </div>

</body>

</html>