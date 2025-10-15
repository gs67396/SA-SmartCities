<?php
    session_start();

    if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] != true) {
        header("Location: login.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/traininfostyle.css">
    <link rel="stylesheet" href="../../CSS/menu.css">
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <title>Dashboard</title>
</head>

<body>
     <?php include("../CODIGO/menu.php"); ?>
     <div class='home'><button id='menuButton' onclick='openav()'><img id='icon'
                src='../../IMAGENS/Hamburger_icon.svg.png'></button></div>
    <script src='../../JAVASCRIPT/menu.js'></script>

    <div class="infoLogo">
        Realatório Semanal
    </div>

    <div class="bigbox">


        <h2 style="color: black;">Total de atividade</h2>
        <div id="totalDeAtividades_graph" style="width:100%;max-width:700px;"></div>
        <script>

            let dataTDA = [{
                x: ["Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sabado", "Domingo"],
                y: [8, 12, 16, 20, 22, 10, 4],

                type: "bar",
                orientation: "v",
                marker: { color: "rgba(44,103,158,1.0)" }
            }];


            let layoutTDA = {
                paper_bgcolor: "#ececec",
                plot_bgcolor: "#ececec",
                xaxis: { tickangle: -45 },
            };
            let configTDA = {
                displayModeBar: false,
                responsive: true
            }

            Plotly.newPlot("totalDeAtividades_graph", dataTDA, layoutTDA, configTDA);
        </script>
    </div>
    <hr>
    <div class="bigbox">
        <h2 style="color: black;">Atividade por tipo de transporte</h2>
        <div id="TipoDeTansporte_graph" style="width:100%;max-width:700px;"></div>
        <script>
            let dataTDT = [{
                values: [33, 76,],
                labels: ['Passageiros', 'Carga'],
                type: 'pie'
            }];

            let layoutTDT = {
                autosize: true,
                automargin: true,
                paper_bgcolor: "#ececec",
            };

            let configTDT = {
                responsive: true,
                displayModeBar: false
            }

            Plotly.newPlot('TipoDeTansporte_graph', dataTDT, layoutTDT, configTDT);
        </script>


    </div>
    <hr>
    <div class="bigbox">
        <h2 style="color: black;">Uso de energia</h2>
        <div id="UsoDeEnergia_graph" style="width:100%;max-width:700px;"></div>
        <script>
            let dataUDE = [{
                values: [38, 45, 16],
                labels: ['Diesel', 'Carvão', 'Elétrico'],
                type: 'pie'
            }];

            let layoutUDE = {
                autosize: true,
                automargin: true,
                paper_bgcolor: "#ececec",
            };

            let configUDE = {
                responsive: true,
                displayModeBar: false
            }

            Plotly.newPlot('UsoDeEnergia_graph', dataUDE, layoutUDE, configUDE);
        </script>

    </div>



</body>

</html>