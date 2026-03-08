<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cacómetro</title>
</head>

<body>
    <!-- TITULO -->
    <!-- BIENVENIDA -->
    <!-- FORMIULARIO LOGIN -->
    <!-- FORMULARIO REGISTRO -->
    <div class="titulo">
        <h1>CACÓMETRO</h1>
        <h3>Bienvenido al cacómetro</h3>
        <p>Aqui podrás competir junto con tus amigos para ver quien es el más cagón</p>
    </div>

    <div class="form_registro">
        <form action="index.php" method="post">
            <fieldset>REGISTRO NUEVO USER
                <input type="hidden" name="controller" value="registro">
                <input type="hidden" name="action" value="procesarRegistro">

                <label for="email">Email</label>
                <input type="email" name="emain" id="email">
                <label for="username">Nombre Usuario</label>
                <input type="text" name="username" id="username">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password">
                <label for="confirmPass">Confirmar Contraseña</label>
                <input type="password" name="password" id="password">

                <button type="submit">Registrarse</button>
            </fieldset>
        </form>
    </div>
    <div class="form_login">
        <fieldset>
            INICIAR SESION

            <form action="index.php" method="post">
                <input type="hidden" name="controller" value="login">
                <input type="hidden" name="action" value="procesarLogin">

                <label for="email">Email</label>
                <input type="email" name="emain" id="email">
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