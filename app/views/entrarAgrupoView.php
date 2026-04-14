<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar a grupo</title>
</head>
<body>
    <h1>Entrar a grupo existente</h1>

    <form action="index.php" method="post">
    <input type="hidden" name="controller" value="grupos">
    <input type="hidden" name="action" value="existeGrupo">
    <fieldset>
    <label for="nombre_grupo">Nombre del grupo: *</label>    
    <input type="text" name="nombre_grupo" id="nombre_grupo" required>
    <br><br>
    
    <label for="password">Contraseña del grupo: *</label>    
    <input type="password" name="password" id="password" required>
    <br><br>
  
    <button type="submit">Entrar a Grupo</button>
    </fieldset>
    </form>
</body>
</html>