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
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="../../CSS/loginstyle.css"/>
    <title>Novo trem</title>
    <style>
        #imagem_trem {
            margin-top: 20px;
            max-width: 300px;
            height: auto;
            border: 1px solid #ccc;
        }
    </style>
</head>

<body>
    <h2>Cadastro de trem</h2>
    <form id="cadastro_trem" method="POST">

        <label for="modelo_trem">Modelo do trem:</label>
        <select id="modelo_trem" name="modelo_trem" required>
            <option value="">Selecione o tipo</option>
            <option value="00Y4-G586">00Y4-G586</option>
            <option value="37P9-JF85">37P9-JF85</option>
            <option value="823X-KLP9">823X-KLP9</option>
        </select><br><br>

        <img id="imagem_trem" src="../../IMAGENS/trem1.png" alt="Imagem do trem" />

        <br><br>
        <button type="submit">Cadastrar Trem</button>
    </form>

    <script>
        const select = document.getElementById('modelo_trem');
        const img = document.getElementById('imagem_trem');

        function atualizarImagem() {
            const valor = select.value.toLowerCase();
            let caminhoImagem = "../../IMAGENS/";

            switch(valor) {
                case '00y4-g586':
                    img.src = caminhoImagem + 'trem1.png';
                    break;
                case '37p9-jf85':
                    img.src = caminhoImagem + 'trem2.png';
                    break;
                case '823x-klp9':
                    img.src = caminhoImagem + 'trem3.png';
                    break;
                default:
                    img.src = caminhoImagem + 'trem1.png';
            }
        }

        select.addEventListener('change', atualizarImagem);
        window.addEventListener('load', atualizarImagem);
    </script>
</body>
</html>