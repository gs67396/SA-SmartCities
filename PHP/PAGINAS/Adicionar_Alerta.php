<?php
session_start();
require_once("../CODIGO/bd.php"); 

// Lógica de edição de alerta
if (isset($_GET['acao']) && $_GET['acao'] === 'editar' && isset($_GET['id_editar'])) {
    $id_editar = intval($_GET['id_editar']);
    $alerta = null;
    $sql = "SELECT * FROM alerta WHERE pk_alerta = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_editar);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        $alerta = $result->fetch_assoc();
    }
    $stmt->close();
}

// Atualização do alerta
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['editar_alerta'])) {
    $pk_alerta = intval($_POST['pk_alerta']);
    $tipo_alerta = trim($_POST['tipo_alerta'] ?? '');
    $descricao_alerta = trim($_POST['descricao_alerta'] ?? '');
    $data_hora_alerta = trim($_POST['data_hora_alerta'] ?? '');
    $pk_trem = isset($_POST['pk_trem']) ? intval($_POST['pk_trem']) : null;
    if ($tipo_alerta !== "" && $descricao_alerta !== "" && $data_hora_alerta !== "" && $pk_trem) {
        $sql = "UPDATE alerta SET tipo_alerta=?, descricao_alerta=?, data_hora_alerta=?, pk_trem=? WHERE pk_alerta=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssii", $tipo_alerta, $descricao_alerta, $data_hora_alerta, $pk_trem, $pk_alerta);
        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            header("Location: Alertas.php?editado=1");
            exit();
        } else {
            echo "Erro ao editar alerta.";
            $stmt->close();
        }
    } else {
        echo "Preencha todos os campos obrigatórios para editar.";
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $tipo_alerta = trim($_POST['tipo_alerta'] ?? '');
    $descricao_alerta = trim($_POST['descricao_alerta'] ?? '');
    $data_hora_alerta = trim($_POST['data_hora_alerta'] ?? '');

    if ($tipo_alerta !== "" && $descricao_alerta !== "" && $data_hora_alerta !== "") { 
        // Verifica se o usuário enviou o pk_trem manualmente
        $pk_trem = isset($_POST['pk_trem']) ? intval($_POST['pk_trem']) : null;
        if (!$pk_trem) {
            // Se não enviou, pega o primeiro trem cadastrado
            $sql_trem = "SELECT pk_trem FROM trem LIMIT 1";
            $result_trem = $conn->query($sql_trem);
            if ($result_trem && $row = $result_trem->fetch_assoc()) {
                $pk_trem = $row['pk_trem'];
            }
        }
        if ($pk_trem) {
            $sql = "INSERT INTO alerta (tipo_alerta, descricao_alerta, data_hora_alerta, pk_trem) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $tipo_alerta, $descricao_alerta, $data_hora_alerta, $pk_trem);
            if ($stmt->execute()) {
                $stmt->close();
                $conn->close();
                header("Location: Alertas.php?sucesso=1");
                exit(); 
            } else {
                echo "Erro ao cadastrar alerta.";
                $stmt->close();
            }
        } else {
            echo "Nenhum trem cadastrado encontrado. Cadastre um trem antes de adicionar alertas.";
        }
    } else {
        echo "Preencha todos os campos obrigatórios.";
    }
    $conn->close();
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Alertas</title>
    <link rel="stylesheet" href="../../CSS/loginstyle.css">
</head>

<body></body>

<h1>Alertas dos trens</h1>

     <button onclick="alternarVisibilidade()">Manutenção</button>

    <div class="Oculto1" id="Oculto1">
        <h2>Alertas de Manutenção</h2>
        <form method="POST" action="">
            <label for="pk_trem">ID do Trem (opcional):</label>
            <input type="number" id="pk_trem" name="pk_trem" min="1" placeholder="ID do Trem">
            <label for="tipo_alerta">Tipo de alerta:</label>
            <input type="text" id="tipo_alerta" name="tipo_alerta" required>
            <label for="descricao_alerta">Descrição do alerta:</label>
            <input type="text" id="descricao_alerta" name="descricao_alerta" required>
            <label for="data_hora_alerta">Data e hora do alerta:</label>
            <input type="datetime-local" id="data_hora_alerta" name="data_hora_alerta" required>
            <br><br>
            <button type="submit">Adicionar alerta</button>
        </form>
    </div>

     <script>
        function alternarVisibilidade() {
            var elemento = document.getElementById("Oculto1");
            if (elemento.style.display === "none" || elemento.style.display === "") {
                elemento.style.display = "block";
            } else {
                elemento.style.display = "none";
            }
        }
    </script>

    <hr>

    <button onclick="alternarVisibilidade2()">Sensores</button>

    <div class="Oculto2" id="Oculto2">
        <h2>Alertas de Sensores</h2>
        <form method="POST" action="">
            <label for="pk_trem">ID do Trem (opcional):</label>
            <input type="number" id="pk_trem" name="pk_trem" min="1" placeholder="ID do Trem">
            <label for="tipo_alerta">Tipo de alerta:</label>
            <input type="text" id="tipo_alerta" name="tipo_alerta" required>
            <label for="descricao_alerta">Descrição do alerta:</label>
            <input type="text" id="descricao_alerta" name="descricao_alerta" required>
            <label for="data_hora_alerta">Data e hora do alerta:</label>
            <input type="datetime-local" id="data_hora_alerta" name="data_hora_alerta" required>
            <br><br>
            <button type="submit">Adicionar alerta</button>
        </form>
    </div>

    <script>
        function alternarVisibilidade2() {
            var elemento = document.getElementById("Oculto2");
            if (elemento.style.display === "none" || elemento.style.display === "") {
                elemento.style.display = "block";
            } else {
                elemento.style.display = "none";
            }
        }
    </script>

    <hr>

    <h2>Editar Alerta Existente</h2>
    <form method="GET" action="Adicionar_Alerta.php">
        <label for="id_editar">ID do Alerta:</label>
        <input type="number" id="id_editar" name="id_editar" min="1" required>
        <button type="submit" name="acao" value="editar">Buscar Alerta</button>
    </form>

    <?php if (isset($alerta)) : ?>
        <h3>Editando Alerta #<?= $alerta['pk_alerta'] ?></h3>
        <form method="POST" action="">
            <input type="hidden" name="pk_alerta" value="<?= $alerta['pk_alerta'] ?>">
            <label for="pk_trem">ID do Trem:</label>
            <input type="number" id="pk_trem" name="pk_trem" min="1" value="<?= $alerta['pk_trem'] ?>" required>
            <label for="tipo_alerta">Tipo de alerta:</label>
            <input type="text" id="tipo_alerta" name="tipo_alerta" value="<?= htmlspecialchars($alerta['tipo_alerta']) ?>" required>
            <label for="descricao_alerta">Descrição do alerta:</label>
            <input type="text" id="descricao_alerta" name="descricao_alerta" value="<?= htmlspecialchars($alerta['descricao_alerta']) ?>" required>
            <label for="data_hora_alerta">Data e hora do alerta:</label>
            <input type="datetime-local" id="data_hora_alerta" name="data_hora_alerta" value="<?= str_replace(' ', 'T', $alerta['data_hora_alerta']) ?>" required>
            <button type="submit" name="editar_alerta" value="1">Salvar Alterações</button>
        </form>
    <?php endif; ?>
</body>

</html>