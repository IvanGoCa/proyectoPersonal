<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://i.postimg.cc/sfMkg4R8/The-Game-Awards-logo-2020-svg.png" type="image/x-icon">
    <link rel="stylesheet" href="./../estilos/styleLogin.css">
    <title>Registrarse</title>
</head>
<body>
    <header>
        <article>
            <a href="./../index.php">
                <img src="https://i.postimg.cc/TPKktRsR/The-Game-Awards-logo-2020-svg.png" alt="">
            </a>
        </article>
        <article>
            <p>Registrarse</p>
        </article>
    </header>
<?php
    // Si no ha iniciado sesión
    // Para ver la función 'isLogged()' ir a la clase modelo Usuarios.
    if(!Usuarios::isLogged()){
?>
    <main>
        <?php
            // Si ha pulsado el botón
            if(isset($_POST['btn'])){

                // Creo 2 variables con las que se comprueba si el usuario ya existe y si las contraseñas coinciden.
                $contrasenaNoCoincide = false;
                $usuarioExiste = false;

                // Recojo los datos del formulario.
                if(isset($_POST['usuario']))
                    $usuario = $_POST['usuario'];

                if(isset($_POST['contra']))
                    $contra = $_POST['contra'];

                if(isset($_POST['repiteContra']))
                    $reptieContra = $_POST['repiteContra'];

                // Se comprueban usuarios y contraseñas para en caso de no ser válidas mostrar
                // un mensaje de error.
                // Para ver la función 'userExists()' ir a la clase modelo Usuarios.
                if($contra !== $reptieContra)
                    $contrasenaNoCoincide = true;

                if(Usuarios::userExists($usuario))
                    $usuarioExiste = true;  
            }
        ?>
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
            <article>
                <?php
                    // Cuando se pulse el botón si las variables de comprobación están a true muestra los mensajes.
                    // En el caso de que ambas variables sean false crea el usuario.
                    if(isset($_POST['btn'])){
                        if($contrasenaNoCoincide || $usuarioExiste){
                            
                            if($contrasenaNoCoincide)
                                echo '<p>Las contraseñas no coinciden</p>';
                            else
                                echo '<p>El usuario '. $usuario .' ya existe</p>';
                        
                        }else{
                            // Para ver la función 'createUser()' ir a la clase modelo Usuarios.
                            Usuarios::createUser($usuario, $contra);

                            echo '<p style="color: green">Usuario creado correctamente</p>';

                            header('Refresh: 1; url=./../index.php');
                        }
                    }
                ?>

                <label for="usuario">Usuario: </label>
                <input type="text" required placeholder="Usuario" id="usuario" name="usuario">

                <label for="contra">Contraseña: </label>
                <input type="password" required placeholder="Contraseña" id="contra" name="contra">

                <label for="contra">Repite la contraseña: </label>
                <input type="password" required placeholder="Repita la contraseña" id="repiteContra" name="repiteContra">
            </article>

            <article>
                <button type="submit" name="btn"><span>Registrarse</span></button>
            </article>

            <article>
                <p>¿Ya tienes cuenta? <a href="./../controladores/login.php">Inicia sesión aquí</a></p>
            </article>
        </form>
    </main>    
<?php
    // Si ha iniciado sesión muestra un mensaje de error junto con un enlace a login. 
    // Despues de 4 segundos redirige a index.
    }else{
?>
    <main>
        <article>
            <p>Ya has iniciado sesión</p>
            <p>Si quieres registrarte primero <a href="./../controladores/logoff.php">cierra sesión</a></p>            
            <?php
                header('Refresh: 4; url=./../index.php');
            ?>
        </article>
    </main>
<?php
    }
?>
</body>
</html>