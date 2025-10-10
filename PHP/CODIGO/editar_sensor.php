<?php
    require_once("bd.php");
    session_start();

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['Editar_sensor']) && isset($_POST['id_sensor'])) {
        $Nome_novo = trim($_POST['nome_sensor']);
        $Id_sensor = intval($_POST['id_sensor']);
        $tipo_sensor = trim($_POST['tipo_sensor']);
        $localizacao_sensor = trim($_POST['localizacao_sensor']);

        if ($Nome_novo !== "") {
            $stmt_check = $conn->prepare("SELECT nome_sensor FROM sensores WHERE id_sensor = ?");
            $stmt_check->bind_param("i", $Id_sensor);
            $stmt_check->execute();
            $stmt_check->bind_result($nomeAtual);
            $stmt_check->fetch();
            $stmt_check->close();

            if ($Nome_novo === $nomeAtual) {
                header("Location: ../PAGINAS/gerenciador_sensores.php");
                exit;
            }

            $stmt = $conn->prepare("UPDATE sensores SET nome_sensor = ?, tipo_sensor = ?, localizacao_sensor = ? WHERE id_sensor = ?");
            $stmt->bind_param("sssi", $Nome_novo, $tipo_sensor, $localizacao_sensor, $Id_sensor);

            if ($stmt->execute()) {
                header("Location: ../PAGINAS/gerenciador_sensores.php?editar=ok");
                exit;
            } else {
                header("Location: ../PAGINAS/gerenciador_sensores.php?editar=erro");
                exit;
            }
        } else {
            header("Location: ../PAGINAS/gerenciador_sensores.php?editar=vazio");
            exit;
        }
    } else {
        header("Location: ../PAGINAS/gerenciador_sensores.php");
        exit;
    }

?>