<?php
    require_once("../CODIGO/bd.php");
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
    <?php include("../CODIGO/menu.php"); ?>
    <div class='home'><button id='menuButton' onclick='openav()'><img id='icon'
                src='../../IMAGENS/Hamburger_icon.svg.png'></button></div>
    <script src='../../JAVASCRIPT/menu.js'></script>

    <div class="infoLogo">
        Alertas
    </div>
     <?php 
     $sql = "SELECT tipo_alerta, descricao_alerta, data_hora_alerta, pk_trem FROM alerta ORDER BY data_hora_alerta DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
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
     
     ?>

</body>

</html>