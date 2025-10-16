<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/traininfostyle.css">
    <link rel="stylesheet" href="../../CSS/menu.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <title>rotas de um trem</title>
</head>
<body>
    <h2>Escolher rotas de um trem</h2>
     <form id="Escolher_rotas" method="POST">
        <label for="id_trem" class="">ID do trem:</label>
        <input type="number" id="id_trem" name="id_trem" required class="input">

        <label for="rota">Selecione a Rota:</label>
        <select id="rota" name="rota" required class="select">
            <option value="">Nenhuma</option>
            <option value="Rota 1">1</option>
            <option value="Rota 2">2</option>
        </select><br><br>

        <button type="submit" class="button">Salvar Rota</button>
    </form>
</body>
</html>