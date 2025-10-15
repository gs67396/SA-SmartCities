<?php
session_start();
include_once("../CODIGO/bd.php");

if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] != true) {
    header("Location: login.php");
    exit;
}

$msg = '';

// Processa os formulários
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'create') {
        $nome_sensor = trim($_POST['nome_sensor'] ?? '');
        $tipo_sensor = trim($_POST['tipo_sensor'] ?? '');
        $localizacao_trem = trim($_POST['localizacao_trem'] ?? '');

        if ($nome_sensor && $tipo_sensor && $localizacao_trem) {
            $sql = "INSERT INTO sensores (nome_sensor, tipo_sensor, localizacao_trem) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $nome_sensor, $tipo_sensor, $localizacao_trem);
            if ($stmt->execute()) {
                $msg = "Sensor cadastrado com sucesso.";
            } else {
                $msg = "Erro ao cadastrar sensor.";
            }
            $stmt->close();
        } else {
            $msg = "Por favor, preencha todos os campos para cadastrar.";
        }

    } elseif ($action === 'update') {
        $id_sensor = intval($_POST['id_sensor'] ?? 0);
        $nome_sensor = trim($_POST['new_nome_sensor'] ?? '');
        $tipo_sensor = trim($_POST['new_tipo_sensor'] ?? '');
        $localizacao_trem = trim($_POST['new_localizacao_trem'] ?? '');

        if ($id_sensor > 0) {
            $fields = [];
            $params = [];
            $types = '';

            if ($nome_sensor !== '') {
                $fields[] = 'nome_sensor = ?';
                $params[] = $nome_sensor;
                $types .= 's';
            }
            if ($tipo_sensor !== '') {
                $fields[] = 'tipo_sensor = ?';
                $params[] = $tipo_sensor;
                $types .= 's';
            }
            if ($localizacao_trem !== '') {
                $fields[] = 'localizacao_trem = ?';
                $params[] = $localizacao_trem;
                $types .= 's';
            }

            if (count($fields) > 0) {
                $sql = "UPDATE sensores SET " . implode(', ', $fields) . " WHERE id_sensor = ?";
                $params[] = $id_sensor;
                $types .= 'i';

                $stmt = $conn->prepare($sql);
                $stmt->bind_param($types, ...$params);
                if ($stmt->execute()) {
                    $msg = "Sensor atualizado com sucesso.";
                } else {
                    $msg = "Erro ao atualizar sensor.";
                }
                $stmt->close();
            } else {
                $msg = "Nenhum campo para atualizar.";
            }
        } else {
            $msg = "ID inválido para atualização.";
        }

    } elseif ($action === 'delete') {
        $id_sensor = intval($_POST['id_sensor'] ?? 0);

        if ($id_sensor > 0) {
            $sql = "DELETE FROM sensores WHERE id_sensor = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id_sensor);
            if ($stmt->execute()) {
                $msg = "Sensor excluído com sucesso.";
            } else {
                $msg = "Erro ao excluir sensor.";
            }
            $stmt->close();
        } else {
            $msg = "ID inválido para exclusão.";
        }
    }
}

// Buscar sensores para exibir na tabela
$result = $conn->query("SELECT * FROM sensores ORDER BY id_sensor DESC");
$sensores = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $sensores[] = $row;
    }
    $result->free();
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cadastro de Sensores</title>
    <link rel="stylesheet" href="../../CSS/loginstyle.css" />
    <link rel="stylesheet" href="../../CSS/menu.css" />
</head>

<body>

    <?php include("../CODIGO/menu.php"); ?>

    <div class='home'>
        <button id='menuButton' onclick='openav()'>
            <img id='icon' src='../../IMAGENS/Hamburger_icon.svg.png' />
        </button>
    </div>
    <script src='../../JAVASCRIPT/menu.js'></script>

    <h2>Monitoramento de sensores</h2>
    <hr>

    <?php if ($msg): ?>
        <p style="color: green; font-weight: bold;"><?= htmlspecialchars($msg) ?></p>
    <?php endif; ?>

    <h3>Cadastrar sensor</h3>
    <form method="POST">
        <input type="hidden" name="action" value="create" />
        <label for="nome_sensor">Nome do Sensor:</label>
        <input type="text" id="nome_sensor" name="nome_sensor" required /><br /><br />

        <label for="tipo_sensor">Tipo de Sensor:</label>
        <input type="text" id="tipo_sensor" name="tipo_sensor" required /><br /><br />

        <label for="localizacao_trem">Localização (id do trem):</label>
        <input type="text" id="localizacao_trem" name="localizacao_trem" required /><br /><br />

        <button type="submit">Cadastrar Sensor</button>
    </form>

    <br /><hr /><br />

    <h2>Editar sensores</h2>
    <form method="POST">
        <input type="hidden" name="action" value="update" />
        <label for="id_sensor">ID do Sensor:</label>
        <input type="number" id="id_sensor" name="id_sensor" required /><br /><br />

        <label for="new_nome_sensor">Novo Nome do Sensor:</label>
        <input type="text" id="new_nome_sensor" name="new_nome_sensor" /><br /><br />

        <label for="new_tipo_sensor">Novo Tipo de Sensor:</label>
        <input type="text" id="new_tipo_sensor" name="new_tipo_sensor" /><br /><br />

        <label for="new_localizacao_trem">Nova Localização (id do trem):</label>
        <input type="text" id="new_localizacao_trem" name="new_localizacao_trem" /><br /><br />

        <button type="submit">Editar Sensor</button>
    </form>

    <br /><hr /><br />

    <h2>Lista de Sensores</h2>
    <div class="table">
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>ID do Sensor</th>
                    <th>Nome do Sensor</th>
                    <th>Tipo de Sensor</th>
                    <th>Localização (id do trem)</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sensores as $s): ?>
                    <tr>
                        <td><?= htmlspecialchars($s['id_sensor']) ?></td>
                        <td><?= htmlspecialchars($s['nome_sensor']) ?></td>
                        <td><?= htmlspecialchars($s['tipo_sensor']) ?></td>
                        <td><?= htmlspecialchars($s['localizacao_trem']) ?></td>
                        <td>
                            <form method="POST" style="display:inline;" onsubmit="return confirm('Excluir este sensor?');">
                                <input type="hidden" name="action" value="delete" />
                                <input type="hidden" name="id_sensor" value="<?= $s['id_sensor'] ?>" />
                                <button type="submit">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (count($sensores) === 0): ?>
                    <tr><td colspan="5">Nenhum sensor cadastrado.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>

</html>