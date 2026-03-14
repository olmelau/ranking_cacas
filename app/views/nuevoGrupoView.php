<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Nuevo Grupo</title>
</head>
<body>
    <h1>Crea tu propio grupo de cagones</h1>
    <form action="index.php" method="post">
    <input type="hidden" name="controller" value="grupos">
    <input type="hidden" name="action" value="registrarGrupo">
    <fieldset>
    <label for="nombre_grupo">Nombre del grupo *</label>    
    <input type="text" name="nombre_grupo" id="nombre_grupo" required>
    <br><br>
    <label for="descripcion">Descripcion del grupo (opcional)</label>
    <input type="text" name="descripcion" id="descripcion">
    <br><br>
    <label for="password">Contraseña del grupo *</label>    
    <input type="password" name="password" id="password" required placeholder="minimo 4 caracteres">
    <br><br>
    <label for="password2">Repite la contraseña *</label>    
    <input type="password" name="password2" id="password2" required>
    <br><br>
    <button type="submit">Crear Grupo</button>

    </fieldset>
    </form>

</body>
</html>