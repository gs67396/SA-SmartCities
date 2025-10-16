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
    <style>
        /* Esconde o formulário de cadastro inicialmente */
        #formCadastroSensor {
            display: none;
            margin-top: 15px;
            margin-bottom: 30px;
        }
    </style>
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

    <!-- Botão para mostrar/esconder o formulário -->
    <button id="btnMostrarForm">Mostrar formulário de cadastro</button>

    <form method="POST" id="formCadastroSensor">
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


    <h2>Lista de Sensores</h2>
        <div class="tableSensores">
            <table  cellpadding="8" cellspacing="0">
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
                        <tr id="sensorRow<?= $s['id_sensor'] ?>">
                            <td><?= htmlspecialchars($s['id_sensor']) ?></td>
                            <td><?= htmlspecialchars($s['nome_sensor']) ?></td>
                            <td><?= htmlspecialchars($s['tipo_sensor']) ?></td>
                            <td><?= htmlspecialchars($s['localizacao_trem']) ?></td>
                            <td>
                                <button type="button" class="btnEditar" data-id="<?= $s['id_sensor'] ?>">Editar</button>
                                <form method="POST" style="display:inline;" onsubmit="return confirm('Excluir este sensor?');">
                                    <input type="hidden" name="action" value="delete" />
                                    <input type="hidden" name="id_sensor" value="<?= $s['id_sensor'] ?>" />
                                    <button type="submit">Excluir</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Linha de edição, escondida inicialmente -->
                        <tr class="editRow" id="editRow<?= $s['id_sensor'] ?>" style="display:none;">
                            <td colspan="5">
                                <form method="POST" class="formEditSensor">
                                    <input type="hidden" name="action" value="update" />
                                    <input type="hidden" name="id_sensor" value="<?= $s['id_sensor'] ?>" />

                                    <label for="new_nome_sensor_<?= $s['id_sensor'] ?>">Nome do Sensor:</label>
                                    <input type="text" id="new_nome_sensor_<?= $s['id_sensor'] ?>" name="new_nome_sensor" value="<?= htmlspecialchars($s['nome_sensor']) ?>" required />

                                    <label for="new_tipo_sensor_<?= $s['id_sensor'] ?>">Tipo de Sensor:</label>
                                    <input type="text" id="new_tipo_sensor_<?= $s['id_sensor'] ?>" name="new_tipo_sensor" value="<?= htmlspecialchars($s['tipo_sensor']) ?>" required />

                                    <label for="new_localizacao_trem_<?= $s['id_sensor'] ?>">Localização (id do trem):</label>
                                    <input type="text" id="new_localizacao_trem_<?= $s['id_sensor'] ?>" name="new_localizacao_trem" value="<?= htmlspecialchars($s['localizacao_trem']) ?>" required />

                                    <button type="submit">Salvar</button>
                                    <button type="button" class="btnCancelar" data-id="<?= $s['id_sensor'] ?>">Cancelar</button>
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

        <script>
            document.querySelectorAll('.btnEditar').forEach(button => {
                button.addEventListener('click', () => {
                    const sensorId = button.getAttribute('data-id');
                    const editRow = document.getElementById('editRow' + sensorId);
                    
                    // Esconde todas as linhas de edição antes
                    document.querySelectorAll('.editRow').forEach(row => row.style.display = 'none');
                    
                    // Mostra a linha de edição da sensor clicado
                    editRow.style.display = 'table-row';
                    
                    // Opcional: scroll para o formulário de edição
                    editRow.scrollIntoView({ behavior: 'smooth', block: 'center' });
                });
            });

            // Botão cancelar para esconder o formulário
            document.querySelectorAll('.btnCancelar').forEach(button => {
                button.addEventListener('click', () => {
                    const sensorId = button.getAttribute('data-id');
                    const editRow = document.getElementById('editRow' + sensorId);
                    editRow.style.display = 'none';
                });
            });
        </script>

    <script>
        const btnMostrarForm = document.getElementById('btnMostrarForm');
        const formCadastro = document.getElementById('formCadastroSensor');

        btnMostrarForm.addEventListener('click', () => {
            if (formCadastro.style.display === 'none' || formCadastro.style.display === '') {
                formCadastro.style.display = 'block';
                btnMostrarForm.textContent = 'Esconder formulário de cadastro';
            } else {
                formCadastro.style.display = 'none';
                btnMostrarForm.textContent = 'Mostrar formulário de cadastro';
            }
        });
    </script>

</body>

</html>