<?php

    session_start();

    if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] != true) {
        header("Location: login.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/menu.css">
    <link rel="stylesheet" href="../../CSS/traininfostyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Belleza&display=swap" rel="stylesheet">
    <title>Inicio</title>
</head>

<body>

    <header>
        <div class="navbar" id="navbar" style="display: none;">
        <a href="../PAGINAS/Inicio.php"><div><img src="../../IMAGENS/SmartTrain.png" alt=""></div></a>
        <a href="../PAGINAS/Inicio.php"> Inicio </a>
        <a href="../PAGINAS/rotas.php"> Rotas </a>
        <a href="../PAGINAS/dashboard.php"> Dashboard</a>
        <a href="../PAGINAS/Alertas.php">Alertas</a>
        <a href="../PAGINAS/configuracoes.php">Configurações</a>
    </div>

        <div class="pageheader">
            <div class="home"><button id="menuButton" onclick="openav()"><img id="icon"
                        src="../../IMAGENS/Hamburger_icon.svg.png"></button></div>
            <script src="../../JAVASCRIPT/menu.js"></script>
            <div class="smatrainlogo">SmartTrain</div>
        </div>
    </header>

    <main>
        <a href="../PAGINAS/traininfo.php">
            <div class="bigbox clickable">
                <div class="train-imagem">
                    <img src="../../IMAGENS/trem1.png" alt="">
                </div>
                <div class="train-info">
                    <div class="espaco3"></div>
                    <div class="top-info">
                        <span class="texto trainid">017</span>
                        <span class="texto status-trem">Danificado</span>
                        <span class="texto modelo">Modelo 00Y4-G586</span>
                    </div>
                    <a href="../PAGINAS/rotas.php">
                        <div class="box clickable" style="margin-top: 10px; margin-bottom: 10px;">

                            <div class="rota">
                                <span>Rotas</span>
                                <span class="seta">&gt;</span>
                            </div>

                            <div class="localizacao">
                                <span>Lugar 1 - Lugar 2</span>
                            </div>

                            <div class="tempo">
                                <span>18:00</span>
                                <span>20:00</span>
                            </div>
                        </div>
                    </a>

                    <a href="../PAGINAS/Alertas.php">
                        <div class="alertas">
                            <span>Alertas</span>
                            <span class="dot">1</span>
                        </div>
                    </a>

                </div>
            </div>
        </a>

       <a href="../PAGINAS/traininfo.php">
            <div class="bigbox clickable">
                <div class="train-imagem">
                    <img src="../../IMAGENS/trem2.png" alt="">
                </div>
                <div class="train-info">
                    <div class="espaco3"></div>
                    <div class="top-info">
                        <span class="texto trainid">027</span>
                        <span class="texto status-trem">Danificado</span>
                        <span class="texto modelo">Modelo 768X-PO90</span>
                    </div>
                    <a href="../PAGINAS/rotas.php">
                        <div class="box clickable" style="margin-top: 10px; margin-bottom: 10px;">

                            <div class="rota">
                                <span>Rotas</span>
                                <span class="seta">&gt;</span>
                            </div>

                            <div class="localizacao">
                                <span>Lugar 1 - Lugar 2</span>
                            </div>

                            <div class="tempo">
                                <span>18:00</span>
                                <span>20:00</span>
                            </div>
                        </div>
                    </a>

                    <a href="../PHP/Alertas.php">
                        <div class="alertas">
                            <span>Alertas</span>
                            <span class="dot">1</span>
                        </div>
                    </a>

                </div>
            </div>
        </a>
        <a href="../PAGINAS/traininfo.php">
            <div class="bigbox clickable">
                <div class="train-imagem">
                    <img src="../../IMAGENS/trem3.png" alt="">
                </div>
                <div class="train-info">
                    <div class="espaco3"></div>
                    <div class="top-info">
                        <span class="texto trainid">008</span>
                        <span class="texto status-trem">Danificado</span>
                        <span class="texto modelo">Modelo 13E6-W09L</span>
                    </div>
                    <a href="../PAGINAS/rotas.php">
                        <div class="box clickable" style="margin-top: 10px; margin-bottom: 10px;">

                            <div class="rota">
                                <span>Rotas</span>
                                <span class="seta">&gt;</span>
                            </div>

                            <div class="localizacao">
                                <span>Lugar 1 - Lugar 2</span>
                            </div>

                            <div class="tempo">
                                <span>18:00</span>
                                <span>20:00</span>
                            </div>
                        </div>
                    </a>

                    <a href="../PAGINAS/Alertas.php">
                        <div class="alertas">
                            <span>Alertas</span>
                            <span class="dot">1</span>
                        </div>
                    </a>

                </div>
            </div>
        </a>

        <body>
    </main>
</html>
