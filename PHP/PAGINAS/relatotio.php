<?php
session_start();

if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] != true) {
    header("Location: login.php");
    exit;
}

// Conexão com banco
require_once("../CODIGO/bd.php");

// =================== CONSULTAS SQL =================== //

// Total de trens
$sqlTotalTrens = "SELECT COUNT(*) AS total FROM trem";
$resTotalTrens = $conn->query($sqlTotalTrens);
$totalTrens = ($resTotalTrens && $resTotalTrens->num_rows > 0) ? $resTotalTrens->fetch_assoc()['total'] : 0;

// Total de rotas
$sqlTotalRotas = "SELECT COUNT(*) AS total FROM rota";
$resTotalRotas = $conn->query($sqlTotalRotas);
$totalRotas = ($resTotalRotas && $resTotalRotas->num_rows > 0) ? $resTotalRotas->fetch_assoc()['total'] : 0;

// Total de alertas
$sqlTotalAlertas = "SELECT COUNT(*) AS total FROM alerta";
$resTotalAlertas = $conn->query($sqlTotalAlertas);
$totalAlertas = ($resTotalAlertas && $resTotalAlertas->num_rows > 0) ? $resTotalAlertas->fetch_assoc()['total'] : 0;

// Quantos trens estão "Operacionais" vs "Danificados"
$sqlCondicoes = "SELECT condicao_trem, COUNT(*) AS qtd FROM trem GROUP BY condicao_trem";
$resCondicoes = $conn->query($sqlCondicoes);
$condicoes = [];
if ($resCondicoes) {
    while ($row = $resCondicoes->fetch_assoc()) {
        $condicoes[$row['condicao_trem']] = $row['qtd'];
    }
}

// Alertas recentes (últimos 5)
$sqlAlertasRecentes = "SELECT tipo_alerta, descricao_alerta, data_hora_alerta FROM alerta ORDER BY data_hora_alerta DESC LIMIT 5";
$resAlertasRecentes = $conn->query($sqlAlertasRecentes);

// Histórico de rotas por trem (últimos registros)
$sqlRotasTrem = "SELECT t.pk_trem, t.modelo_trem, r.nome_rota, r.origem_rota, r.destino_rota, rt.data_hora_rota
                FROM rotas_trem rt
                INNER JOIN trem t ON t.pk_trem = rt.pk_trem
                INNER JOIN rota r ON r.pk_rota = rt.pk_rota
                ORDER BY rt.data_hora_rota DESC LIMIT 10";
$resRotasTrem = $conn->query($sqlRotasTrem);

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
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap"
        rel="stylesheet">
    <title>Relatório Semanal</title>
</head>

<body>
    <?php include("../CODIGO/menu.php"); ?>
    <div class='home'>
        <button id='menuButtonOpen' onclick='openav()'>
            <img id='icon' src='../../IMAGENS/Hamburger_icon.svg.png'>
        </button>
    </div>
    <script src='../../JAVASCRIPT/menu.js'></script>

    <div class="infoLogo">Relatório Semanal</div>

    <!-- ===================== RESUMO GERAL ===================== -->
    <div class="bigbox">
        <h2 style="color:black;">Resumo Geral</h2>
        <div style="display:flex;flex-wrap:wrap;justify-content:space-around;margin-top:10px;">
            <div class="box free">
                <h3>Total de Trens</h3>
                <p><?= $totalTrens ?></p>
            </div>
            <div class="box free">
                <h3>Total de Rotas</h3>
                <p><?= $totalRotas ?></p>
            </div>
            <div class="box free">
                <h3>Alertas Ativos</h3>
                <p><?= $totalAlertas ?></p>
            </div>
            <div class="box free">
                <h3>Trens Operacionais</h3>
                <p><?= $condicoes['Operacional'] ?? 0 ?></p>
            </div>
        </div>
    </div>

    <hr>

    <!-- ===================== GRÁFICO DE CONDIÇÃO DOS TRENS ===================== -->
    <div class="bigbox">
        <h2 style="color:black;">Condição dos Trens</h2>
        <div id="condicaoTrem_graph" style="width:100%;max-width:700px;"></div>
        <script>
            let condicoesLabels = <?= json_encode(array_keys($condicoes)) ?>;
            let condicoesValues = <?= json_encode(array_values($condicoes)) ?>;
            let dataCondicoes = [{
                values: condicoesValues,
                labels: condicoesLabels,
                type: 'pie'
            }];
            let layoutCondicoes = {
                paper_bgcolor: "#ececec",
                automargin: true
            };
            Plotly.newPlot('condicaoTrem_graph', dataCondicoes, layoutCondicoes, {responsive: true});
        </script>
    </div>

    <hr>

    <!-- ===================== ROTAS RECENTES ===================== -->
    <div class="bigbox">
        <h2 style="color:black;">Últimas Viagens Registradas</h2>
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="background-color:#41b8d5;color:white;">
                    <th>Trem</th>
                    <th>Rota</th>
                    <th>Origem</th>
                    <th>Destino</th>
                    <th>Data/Hora</th>
                </tr>
            </thead>
            <tbody style="text-align:center;">
                <?php if ($resRotasTrem && $resRotasTrem->num_rows > 0): ?>
                    <?php while ($row = $resRotasTrem->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['modelo_trem']) ?></td>
                            <td><?= htmlspecialchars($row['nome_rota']) ?></td>
                            <td><?= htmlspecialchars($row['origem_rota']) ?></td>
                            <td><?= htmlspecialchars($row['destino_rota']) ?></td>
                            <td><?= date("d/m/Y H:i", strtotime($row['data_hora_rota'])) ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="5">Nenhuma rota registrada recentemente.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <hr>

    <!-- ===================== ALERTAS RECENTES ===================== -->
    <div class="bigbox">
        <h2 style="color:black;">Alertas Recentes</h2>
        <ul>
            <?php if ($resAlertasRecentes && $resAlertasRecentes->num_rows > 0): ?>
                <?php while ($row = $resAlertasRecentes->fetch_assoc()): ?>
                    <li>
                        ⚠️ <b><?= htmlspecialchars($row['tipo_alerta']) ?></b> — 
                        <?= htmlspecialchars($row['descricao_alerta']) ?> 
                        (<?= date("d/m/Y H:i", strtotime($row['data_hora_alerta'])) ?>)
                    </li>
                <?php endwhile; ?>
            <?php else: ?>
                <li>Sem alertas recentes.</li>
            <?php endif; ?>
        </ul>
    </div>

</body>
</html>