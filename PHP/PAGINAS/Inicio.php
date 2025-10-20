<?php

    session_start();
    include_once("../CODIGO/bd.php");

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

    <?php include("../CODIGO/menu.php"); ?>

    
        <div class="pageheader">
            <div class="home"><button id="menuButtonOpen" onclick="openav()"><img id="icon"
                        src="../../IMAGENS/Hamburger_icon.svg.png"></button></div>
            <script src="../../JAVASCRIPT/menu.js"></script>
            <div class="smatrainlogo">SmartTrain</div>
        </div>
        <div class="box free"> 
            <a href="cadastrartrem.php" style='text-decoration: none;'>
            <div class="alterar" style="font-weight: 200;" >
                            
                            <button>Cadastrar trem</button>
                            
                            
                        </div>
            </a>
            
        </div>
    

    <main>
        <?php
            $sql = "SELECT t.pk_trem, t.modelo_trem, t.condicao_trem,  r.origem_rota, r.destino_rota,
               COUNT(a.pk_alerta) AS total_alertas
                FROM trem t
                LEFT JOIN rota r ON t.rota_atual_trem = r.pk_rota
                LEFT JOIN alerta a ON t.pk_trem = a.pk_trem
                GROUP BY t.pk_trem, t.modelo_trem, t.condicao_trem, r.origem_rota, r.destino_rota";
            $result = $conn->query($sql);

            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    $tipoTrem = strtolower($row["modelo_trem"]); 
                    switch ($tipoTrem) {
                        case '00y4-g586':
                            $imagem = 'trem1.png';
                            break;
                        case '37p9-jf85':
                            $imagem = 'trem2.png';
                            break;
                        case '823x-klp9':
                            $imagem = 'trem3.png';
                            break;
                        default:
                            $imagem = 'trem1.png';
                    }
                    $condicao = strtolower($row["condicao_trem"]);
                    switch ($condicao) {
                        case 'operacional':
                            $statusColor = '#4caf50'; 
                            break;
                        case 'manutenção':
                            $statusColor = '#ff9800'; 
                            break;
                        case 'danificado':
                            $statusColor = '#e43d3c'; 
                            break;
                        case 'inativo':
                            $statusColor = '#e43d3c'; 
                            break;
                        default:
                            $statusColor = '#5958b2'; 
                    }

                    if (!empty($row["origem_rota"]) && !empty($row["destino_rota"])) {
                        $localizacao = htmlspecialchars($row["origem_rota"]) . " - " . htmlspecialchars($row["destino_rota"]);
                    } else {
                        $localizacao = "Sem rota atual";
                    }

                    echo '
                    <a href="../PAGINAS/traininfo.php?tremid='.$row["pk_trem"].'">
                        <div class="bigbox clickable">
                            <div class="train-imagem">
                                <img src="../../IMAGENS/' . $imagem . '" alt="Imagem do trem">
                            </div>
                            <div class="train-info">
                                <div class="espaco3"></div>
                                <div class="top-info">
                                    <span class="texto trainid">' . str_pad($row["pk_trem"], 3, '0', STR_PAD_LEFT) . '</span>
                                    <span class="texto status-trem" style="background-color:'. $statusColor .'">' . htmlspecialchars($row["condicao_trem"]) . '</span>
                                    <span class="texto modelo">Modelo ' . htmlspecialchars($row["modelo_trem"]) . '</span>
                                </div>
                                <a href="../PAGINAS/rotas.php">
                                    <div class="box clickable" style="margin-top: 10px; margin-bottom: 10px;">
                                        <div class="rota">
                                            <span>Rotas</span>
                                            <span class="seta">&gt;</span>
                                        </div>
                                        <div class="localizacao">
                                            <span>' . $localizacao . '</span>
                                        </div>
                                    </div>
                                </a>';
                                if ($row["total_alertas"] > 0) {
                                    echo '
                                    <a href="../PAGINAS/Alertas.php">
                                        <div class="alertas">
                                            <span>Alertas</span>
                                            <span class="dot">' . $row["total_alertas"] . '</span>
                                        </div>
                                    </a>';
                                }
                                echo '
                            </div>
                        </div>
                    </a>';
                }
            } else {
                echo "<div class='nodatalert' ><h1>Nenhum trem cadastrado.</h1></div>";
            }
        ?>
        
    </main>
</html>
