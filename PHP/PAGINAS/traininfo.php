<?php
    session_start();
    include_once("../CODIGO/bd.php");

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
    <link rel="stylesheet" href="../../CSS/traininfostyle.css">
    <link rel="stylesheet" href="../../CSS/menu.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <title>Pagina de informação</title>
</head>

<body>
    <?php include("../CODIGO/menu.php"); ?>
    <div class='home'><button id='menuButton' onclick='openav()'><img id='icon'
                src='../../IMAGENS/Hamburger_icon.svg.png'></button></div>
    <script src='../../JAVASCRIPT/menu.js'></script>
    <div class="infoLogo">
        Informações
    </div>
    <?php
        if (isset($_GET['tremid'])) { 
    $tremid = intval($_GET['tremid']); 
    
    $sql = "SELECT 
                t.pk_trem, 
                t.modelo_trem, 
                t.condicao_trem, 
                t.tipo_trem, 
                r.origem_rota, 
                r.destino_rota,
                COUNT(a.pk_alerta) AS total_alertas
            FROM 
                trem t
            LEFT JOIN 
                rota r ON t.rota_atual_trem = r.pk_rota
            LEFT JOIN 
                alerta a ON t.pk_trem = a.pk_trem
            WHERE 
                t.pk_trem = $tremid
            GROUP BY 
                t.pk_trem, 
                t.modelo_trem, 
                t.condicao_trem, 
                t.tipo_trem, 
                r.origem_rota, 
                r.destino_rota";

    $sql_alertas = "SELECT 
                tipo_alerta, 
                descricao_alerta, 
                data_hora_alerta, 
                pk_trem 
            FROM 
                alerta 
            WHERE 
                pk_trem = $tremid 
            ORDER BY 
                data_hora_alerta DESC";

            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {

                    $tipoTrem = strtolower($row["tipo_trem"]); 
                    switch ($tipoTrem) {
                        case 'a':
                            $imagem = 'trem1.png';
                            break;
                        case 'b':
                            $imagem = 'trem2.png';
                            break;
                        case 'c':
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
                        default:
                            $statusColor = '#5958b2'; 
                    }

                    if (!empty($row["origem_rota"]) && !empty($row["destino_rota"])) {
                        $localizacao = htmlspecialchars($row["origem_rota"]) . " - " . htmlspecialchars($row["destino_rota"]);
                    } else {
                        $localizacao = "SEM_ROTA";
                    }

                    echo '
                                <div class="bigbox">
                    <div style="display: flex;">
                        <img src="../../IMAGENS/' . $imagem . '">
                        <div class="trainid">' . str_pad($row["pk_trem"], 3, '0', STR_PAD_LEFT) . '</div>
                    </div>

                    <div class="maininfo">
                        <div class="box">
                            <div>Maquinista</div>

                            <img src="../../IMAGENS/user-3296.png">
                            <div>fulano</div>
                            <div>000-000-008</div>

                        </div>
                        <div style="display: flex;">
                            <div class="box" style="width: 100%;">
                                Modelo <br>
                                ' . htmlspecialchars($row["modelo_trem"]) . '
                            </div>
                            <div class="box" style="width: 100%;">
                                Condição <br>
                                ' . htmlspecialchars($row["condicao_trem"]) . '
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
                
                    <div class="rotaatual">';
                        if ($localizacao =="SEM_ROTA"){
                           echo "<div class='nodatalert'>
                                <h1>Não há rotas disponíveis no momento.</h1>
                            </div>";
                        }else{
                            echo '
                                    <div class="bigbox" style="text-align: center;font-weight: bold;">
                                        
                                    <div class="traintext">
                                            <div>
                                                <div class="text">' . htmlspecialchars($row["origem_rota"]) . '</div>
                                            </div>
                                            <div class="text">-</div>
                                            <div>
                                                <div class="text">' . htmlspecialchars($row["destino_rota"]) . '</div>

                                            </div>

                                        </div>
                                    </div>
                                ';
                        }
                        

                    echo '

                    
                        
                    </div>

                </div>
                <hr>
                <h2>Rotas planejadas</h2>';
                $sql_rotas = "SELECT t.pk_trem, t.modelo_trem, t.condicao_trem, t.tipo_trem, 
                     r.origem_rota, r.destino_rota
                    FROM trem t
                    INNER JOIN rotas_trem rt ON t.pk_trem = rt.pk_trem
                    INNER JOIN rota r ON rt.pk_rota = r.pk_rota
                    WHERE t.pk_trem = $tremid
                    ORDER BY t.pk_trem, r.pk_rota";

                    $result_rotas = $conn->query($sql_rotas);

                    if (!$result_rotas) {
                    echo "Erro na consulta: " . $conn->error;
                    exit;
                }

                    if($result_rotas->num_rows > 0){
                        while ($row = $result_rotas->fetch_assoc()){
                            
                            echo '
                                    <div class="bigbox" style="text-align: center;font-weight: bold;">
                                        
                                    <div class="traintext">
                                            <div>
                                                <div class="text">' . htmlspecialchars($row["origem_rota"]) . '</div>
                                            </div>
                                            <div class="text">-</div>
                                            <div>
                                                <div class="text">' . htmlspecialchars($row["destino_rota"]) . '</div>

                                            </div>

                                        </div>
                                    </div>
                                ';

                        }

                    }else{
                        echo "<div class='nodatalert'>
                                <h1>Não há rotas disponíveis no momento.</h1>
                            </div>";
                    }


                echo '<hr>
                <h2>Histórico de alertas</h2>';

                $result_alertas = $conn->query($sql_alertas);
                if ($result_alertas->num_rows > 0) {
                    while($row = $result_alertas->fetch_assoc()) {
                        ?>
                        <div class="bigbox">
                            <div class="event">
                                <div class="tempo"><?php echo date("d-m-Y H:i:s", strtotime($row["data_hora_alerta"])); ?></div>
                                <div style="display: flex;">
                                    <div class="dot" style="background-color: <?php echo ($row["tipo_alerta"] == "Manutenção") ? "gray" : "#e74c3c"; ?>;"></div>
                                    <?php echo htmlspecialchars($row["descricao_alerta"]); ?>
                                    <?php if (!empty($row["pk_trem"])): ?>
                                        no veículo de ID <div class="trainid-text"><?php echo $row["pk_trem"]; ?></div>.
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<div class='bigbox'><div class='event'>Nenhum alerta encontrado.</div></div>";
                }
                        }
                    } else {
                        echo "<p>Nenhum trem cadastrado.</p>";
                    }
                    }
                echo "<div class='box free'> 
                        <div class='alterar' style='font-weight: 200;'>
                            <button id='excluirtrem' onclick='editarApagar()'>Excluir trem</button>
                        </div>
                        
                        <div id='botaoapergunta' style='font-weight: 200; display: none;'>
                            <p>Tem certeza que deseja apagar esse trem ?</p>
                            <div class='alterar' style='font-weight: 200;'>
                                 <a href='../CODIGO/excluirtrem.php?tremid=".$tremid."'>
                                    <button>Sim</button>
                                </a>
                            </div>  
                            <div class='alterar' style='font-weight: 200;'>
                                <button onclick='location.reload()'>Não</button>
                            </div>
                        </div>

                        <script>
                            function editarApagar() {
                                document.getElementById('botaoapergunta').style.display = 'inline';
                                document.getElementById('excluirtrem').style.display = 'none';
                            }
                        </script>
                    </div>";
                                
                            
                        ?>

    
    

</body>

</html>