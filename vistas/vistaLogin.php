<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://i.postimg.cc/sfMkg4R8/The-Game-Awards-logo-2020-svg.png" type="image/x-icon">
    <link rel="stylesheet" href="./../estilos/styleLogin.css">
    <title>Iniciar sesión</title>
</head>
<body>
    <header>
        <article>
            <a href="./../index.php">
                <img src="https://i.postimg.cc/TPKktRsR/The-Game-Awards-logo-2020-svg.png" alt="">
            </a>
        </article>
        <article>
            <p>Inicio de sesión</p>
        </article>
    </header>
    <?php
        // Si no ha iniciado sesión muestra el formulario de login
        // Para ver la función 'isLogged()' ir a la clase modelo Usuarios.
        if(!Usuarios::isLogged()){
    ?>
    <main>
    <?php
            // Variable que se inicia a false y solo cambiará cuando todos los datos del formulario sean true
            $incorrecto = false;

            // En el caso de que se haya pulsado el botón
            if(isset($_POST['btn'])){

                // Recojo los datos del formulario
                if(isset($_POST['usuario']))
                    $usuario = $_POST['usuario'];

                if(isset($_POST['contra']))
                    $contra = $_POST['contra'];

                // Si se ha encontrado una coincidencia se inicia la sesión y redirige al index
                // En caso contrario pone la variable $incorrecto a true.
                // Para ver la función 'login()' ir a la clase modelo Usuarios.
                if(Usuarios::login($usuario, $contra)){
                    header('Location: ./../index.php');
                }else
                    $incorrecto = true;
                }
            ?>
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
            <article>
                <?php
                    // Si la variable incorrecto está a true muestra el mensaje de error
                    if($incorrecto)
                        echo '<p>Usuario o contraseña incorrectos *</p>';
                ?>
                <label for="usuario">Usuario: </label>
                <input type="text" required placeholder="Usuario" id="usuario" name="usuario">

                <label for="contra">Contraseña: </label>
                <input type="password" required placeholder="Contraseña" id="contra" name="contra">
            </article>

            <article>
                <button type="submit" name="btn"><span>Iniciar sesión</span></button>
            </article>

            <article>
                <p>¿No tienes cuenta? <a href="./../controladores/register.php">Regístrate aquí</a></p>
            </article>
        </form>
    </main>
    <?php
        // Si ha iniciado sesión muestra un mensaje y redirige al index
        }else{
    ?>
        <main>
            <article>
                <p>Ya has iniciado sesión</p>
                <?php
                    header('Refresh: 2; url=./../index.php');
                ?>
            </article>
        </main>
    <?php
        }
    ?>
</body>
</html>