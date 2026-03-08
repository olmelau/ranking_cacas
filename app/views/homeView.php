<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cacómetro</title>
</head>

<body>
    <div class="titulo">
        <!-- TITULO -->
        <h1>CACÓMETRO</h1>
        <!-- BIENVENIDA -->
        <h3>Bienvenido al cacómetro</h3>
        <p>Aqui podrás competir junto con tus amigos para ver quien es el más cagón</p>
    </div>
    
    <!-- FORMULARIO REGISTRO -->
    <div class="form_registro">
        <form action="index.php" method="post">
            <fieldset>REGISTRO NUEVO USER
                <input type="hidden" name="controller" value="registro">
                <input type="hidden" name="action" value="procesarRegistro">
                
                <label for="username">Nombre Usuario</label>
                <input type="text" name="username" id="username">
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password">
                <label for="confirm_password">Confirmar Contraseña</label>
                <input type="password" name="confirm_password" id="password">
                
                <button type="submit">Registrarse</button>
            </fieldset>
        </form>
    </div>
    <!-- FORMIULARIO LOGIN -->
    <div class="form_login">
        
        <form action="index.php" method="post">
            <fieldset>
                    INICIAR SESION
                <input type="hidden" name="controller" value="login">
                <input type="hidden" name="action" value="procesarLogin">

                <label for="email">Email</label>
                <input type="email" name="email" id="email">
                <label for="username">Nombre Usuario</label>
                <input type="text" name="username" id="username">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password">

                <button type="submit">Log in</button>
            </form>
        </fieldset>
    </div>
</body>

</html>