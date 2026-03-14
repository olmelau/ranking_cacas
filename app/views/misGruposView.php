<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Grupos</title>
</head>
<body>
    <h1>Mis grupos</h1>
    <p>Estos son los grupos a los que pertenezco:</p>
    
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Grupo</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($grupos as $grupo): ?>
            <tr>
                <td><?= $grupo['nombre_grupo'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>
    <form action="index.php" method="post">
        <input type="hidden" name="controller" value="dashboard">
        <input type="hidden" name="action" value="mostrardashboard">
        <button type="submit">Volver al menú</button>
    </form>
</body>
</html>