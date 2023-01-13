<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleLogoff.css">
    <link rel="shortcut icon" href="https://i.postimg.cc/sfMkg4R8/The-Game-Awards-logo-2020-svg.png" type="image/x-icon">
    <title>Cerrar sesión</title>
</head>
<?php
    // Inicio de control de sesiones
    session_start();
    
    // Variable para comprobar si el usuario ha iniciado sesión iniciada a false
    $iniciado = false;

    // Si ha iniciado sesión variable a true
    if(isset($_SESSION['usuario']))
        $iniciado = true;
?>
<body>
    <header>
        <article>
            <a href="index.php">
                <img src="https://i.postimg.cc/TPKktRsR/The-Game-Awards-logo-2020-svg.png" alt="">
            </a>
        </article>
        <article>
            <p>Cerrar sesión</p>
        </article>
    </header>
    <?php
        // Si ha iniciado sesión muestra el mensaje de cierre de sesión
        if($iniciado){
    ?>
    <main>
        <article>
            <p>Has cerrado sesión. Redirigiendo...</p>
            <?php
                // Se cierra la sesión y redirige al index
                session_destroy();
                header('Refresh: 2; url=index.php');
            ?>
        </article>
    </main>

    <?php
        // Si no tiene la sesión iniciada
        }else{
    ?>

    <main>
        <article>
            <p>No has iniciado sesión. Redirigiendo...</p>
            <?php
                // Redirige al index
                header('Refresh: 2; url=index.php');
            ?>
        </article>
    </main>

    <?php
        }
    ?>
</body>
</html>