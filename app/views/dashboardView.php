<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard</title>
</head>
<body>
    <h1>Bienvenido </h1>
    <form action="index.php" method="post">
        <input type="hidden" name="controller" value="caca">
        <input type="hidden" name="action" value="sumar">
        <button type="submit">SUMAR CACA</button>
    </form>
    <form action="index.php" method="post">
        <input type="hidden" name="controller" value="login">
        <input type="hidden" name="action" value="logout">
        <button type="submit">Cerrar Sesion</button>
    </form>

</body>
</html>