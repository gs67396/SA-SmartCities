<?php
session_start();
require_once("../CODIGO/bd.php"); 

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $modelo_trem = trim($_POST['modelo_trem']);
    $condicao_trem = "inativo"; 

    if ($modelo_trem !== "") { 
        $sql = "INSERT INTO trem (modelo_trem, condicao_trem) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $modelo_trem, $condicao_trem);
        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
         
            header("Location: inicio.php");
            exit(); 
        } else {
            echo "Erro ao cadastrar trem.";
            $stmt->close();
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

<body>

     <button onclick="alternarVisibilidade()">Manuntenção</button>

    <div class="Oculto1">

        <h2>Alertas de Manuntenção</h2>
        <form method="POST" action="">
            <label for="modelo_trem">Modelo do Trem:</label>
            <input type="text" id="modelo_trem" name="modelo_trem" required>
            <lapel for="tipo_alerta">Tipo de alerta:</label>
                <input type="text" id="modelo_trem" name="modelo_trem" required>
                <label for="descricao_alerta">Descrição do alerta:</label>
                <input type="text" id="modelo_trem" name="modelo_trem" required>
                <label for="data_hora_alerta">Data e hora do alerta:</label>
                <input type="datetime-local" id="data_hora_alerta" name="data_hora_alerta" required>
                <br><br>
                <button type="submit">Adicionar alerta</button>
        </form>

    </div>

    <button onclick="alternarVisibilidade()">Sensores</button>

    <div class="Oculto2">

        <h2>Alertas de Sensores</h2>
        <form method="POST" action="">
            <label for="modelo_trem">Modelo do Trem:</label>
            <input type="text" id="modelo_trem" name="modelo_trem" required>
            <label for="id_sensor">Id do sensor:</label>
            <input type="text" id="modelo_trem" name="modelo_trem" required>
            <lapel for="tipo_alerta">Tipo de alerta:</label>
                <input type="text" id="modelo_trem" name="modelo_trem" required>
                <label for="descricao_alerta">Descrição do alerta:</label>
                <input type="text" id="modelo_trem" name="modelo_trem" required>
                <label for="data_hora_alerta">Data e hora do alerta:</label>
                <input type="datetime-local" id="data_hora_alerta" name="data_hora_alerta" required>
                <br><br>
                <button type="submit">Adicionar alerta</button>
        </form>

    </div>

     <script>
        function alternarVisibilidade() {
            // Obtém o elemento pelo seu ID
            var elemento = document.getElementById("Oculto1");

            // Verifica o estado atual da propriedade 'display'
            if (elemento.style.display === "none" || elemento.style.display === "") {
                // Se estiver oculto ou sem estilo definido, mostra como bloco (ou outro valor, como 'block', 'flex', etc., dependendo do layout desejado)
                elemento.style.display = "block";
            } else {
                // Se estiver visível, oculta
                elemento.style.display = "none";
            }
        }
    </script>

    <script>
        function alternarVisibilidade() {
            // Obtém o elemento pelo seu ID
            var elemento = document.getElementById("Oculto2");

            // Verifica o estado atual da propriedade 'display'
            if (elemento.style.display === "none" || elemento.style.display === "") {
                // Se estiver oculto ou sem estilo definido, mostra como bloco (ou outro valor, como 'block', 'flex', etc., dependendo do layout desejado)
                elemento.style.display = "block";
            } else {
                // Se estiver visível, oculta
                elemento.style.display = "none";
            }
        }
    </script>
</body>

</html>