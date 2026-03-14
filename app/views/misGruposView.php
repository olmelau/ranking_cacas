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
    <ul>
        <?php foreach ($grupos as $grupo): ?>
            <li><?=$grupo['nombre_grupo']?> </li>
            <?php endforeach; ?>
    </ul>

    <form action="index.php" method="post">
        <input type="hidden" name="controller" value="dashboard">
        <input type="hidden" name="action" value="mostrardashboard">
        <button type="submit">Volver al menú</button>
    </form>
</body>
</html>