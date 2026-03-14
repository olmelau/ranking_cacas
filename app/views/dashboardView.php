<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard</title>
</head>
<body>
     <?php 
    // Mostrar el username si está en sesión
    session_start();
    $username = $_SESSION['username'] ?? 'hola'; 
    ?>

    <h1>Bienvenido <?php echo $username ?></h1>
    <form action="index.php" method="post">
        <input type="hidden" name="controller" value="caca">
        <input type="hidden" name="action" value="sumarCaca">
        <button type="submit">SUMAR CACA</button>
    </form>
    <form action="index.php" method="get">
        <!-- LLAMADA AL CONTROLLER -->
        <input type="hidden" name="controller" value="grupos">
        <input type="hidden" name="action" value="mostrarGrupos">
        <button type="submit">MIS GRUPOS</button>
    </form>
    <form action="index.php" method="get">
        <!-- LLAMADA AL CONTROLLER -->
         <input type="hidden" name="controller" value="grupos">
         <input type="hidden" name="action" value="nuevoGrupo">
         <button type="submit">Nuevo Grupo</button>
    </form>

    <form action="index.php" method="get">
        <!-- LLAMADA AL CONTROLLER -->
        <input type="hidden" name="controller" value="grupos">
        <input type="hidden" name="action" value="entrarAgrupo">
        <button type="submit">Entrar a grupo</button>
    </form>

    <form action="index.php" method="get">
        <!-- LLAMADA AL CONTROLLER -->
        <input type="hidden" name="controller" value="perfilUser">
        <input type="hidden" name="action" value="editarPerfil">
        <button type="submit">Editar perfil</button>
    </form>

    <form action="index.php" method="post">
        <!-- LLAMADA AL CONTROLLER -->
        <input type="hidden" name="controller" value="login">
        <input type="hidden" name="action" value="logout">
        <button type="submit">Cerrar Sesion</button>
    </form>

    <div class="mostrarGrupos">
        <p>Aqui se mostrará un scroll con los rankings de los grupos a los que pertenece el user</p>
    </div>

    <div class="totalCacas">
        <p>Mostrar aqui el total de cacas que lleva el usuario</p>
    </div>

</body>
</html>