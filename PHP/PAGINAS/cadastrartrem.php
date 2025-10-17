 <?php

    session_start();
    require_once("../CODIGO/bd.php"); 

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $modelo_trem = trim($_POST['modelo_trem']);
        $condicao_trem = trim($_POST['condicao_trem']);
        $tipo_trem = trim($_POST['tipo_trem']);

        if ( $modelo_trem !== "" && $condicao_trem !== "") { 
            $sql = "INSERT INTO trem (modelo_trem, condicao_trem, tipo_trem) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $modelo_trem, $condicao_trem, $tipo_trem);
            if ($stmt->execute()) {
                echo "ok cadastrado trem";
            } else {
                echo "erro ao cadastrar";
            }
            $stmt->close();
        } else {
            echo "erro";
        }
        $conn->close();
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/loginstyle.css">
    <title>Novo trem</title>
</head>

<body>

<h2>Cadastro de trem</h2>
     <form id="cadastro_trem" method="POST">
        <label for="id_trem">ID do trem:</label>
        <input type="number" id="id_trem" name="id_trem" required><br><br>
        <label for="modelo_trem">Modelo do trem:</label>
        <input type="text" id="modelo_trem" name="modelo_trem" required><br><br>
        <label for="condicao_trem">Condição do trem:</label>
        <input type="text" id="condicao_trem" name="condicao_trem" required><br><br>
        <label for="tipo_trem">Tipo do trem:</label>
        <input type="text" id="tipo_trem" name="tipo_trem" required><br><br>
        <label for="rota_atual_trem">Rota atual do trem:</label>
        <input type="text" id="rota_atual_trem" name="rota_atual_trem" required><br><br>
        <button type="submit">Cadastrar Trem</button>
    </form>
</body>
   
</html>


