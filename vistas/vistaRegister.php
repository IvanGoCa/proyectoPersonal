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
            <p>Registrarse</p>
        </article>
    </header>
<?php
    // Si no ha iniciado sesión
    if(!$iniciado){
?>
    <main>
        <?php
            // Si ha pulsado el botón
            if(isset($_POST['btn'])){

                if(isset($_POST['usuario']))
                    // Recojo el usuario introducido en el formulario
                    $usuario = $_POST['usuario'];

                    // Creo 2 variables con las que se comprueba si el usuario ya existe y si las contraseñas coinciden
                    $contrasenaNoCoincide = false;
                    $usuarioExiste = false;

                    // Guardo la contraseña introducida
                    if(isset($_POST['contra']))
                        $contra = $_POST['contra'];

                    // Guardo la contraseña que hay que repetir en el formulario
                    if(isset($_POST['repiteContra']))
                        $reptieContra = $_POST['repiteContra'];

                    // Primero se comprueba si la contraseña existe
                    // Si no son iguales las contraseñas la variable cambia a true.
                    if($contra !== $reptieContra)
                        $contrasenaNoCoincide = true;

                    // Después se comprueba si el usuario existe
                    $goty = new mysqli('localhost', 'root', '', 'goty');

                    try{
                        // Busco en la BBDD el usuario introducido en el formulario
                        $sql = 'SELECT usuario
                                FROM usuarios
                                WHERE usuario = "'. $usuario .'"';
                    
                        $resultado = $goty -> query($sql);

                        // Si el usuario existe cambio la variable de compropbación del usuario a true
                        foreach($resultado as $row){
                            if($row['usuario'] === $usuario)
                                $usuarioExiste = true;
                        }

                    }catch(Exception $e){
                        echo '<p style="color: red">Error: '. $e .'</p>';
                    }

                    // Cierro la conexión
                    $goty -> close();
            }
        ?>

        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
            <article>
                <?php
                    // Cuando se pulse el botón
                    if(isset($_POST['btn'])){
                        // Si una de las variables de comprobación está a true
                        if($contrasenaNoCoincide || $usuarioExiste){
                            // Si la contraseña no coincide se muestra un mensaje
                            if($contrasenaNoCoincide)
                                echo '<p>Las contraseñas no coinciden</p>';
                            // Si el usuario no coincide se muestra un mensaje
                            else
                                echo '<p>El usuario '. $usuario .' ya existe</p>';
                        
                        // Si el usuario no existe y las contraseñas no coinciden crea el usuario
                        }else{
                            // Se encripta la contraseña
                            $contra = md5($contra);

                            $goty = new mysqli('localhost', 'root', '', 'goty');

                            try{
                                // Consulta que introduce un usuario y pone por defecto 0 en la columna de votado
                                $sql = 'INSERT INTO usuarios VALUES ("'. $usuario .'", "'. $contra .'", 0)';
                            
                                $resultado = $goty -> query($sql);

                            }catch(Exception $e){
                                echo '<p style="color: red">Error: '. $e .'</p>';
                            }

                            $goty -> close();

                            // Tras el registro inicia sesión
                            $_SESSION['usuario'] = $usuario;

                            echo '<p style="color: green">Usuario creado correctamente</p>';

                            header('Refresh: 1; url=index.php');
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
                <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
            </article>
        </form>
    </main>
    
<?php
    // Si ha iniciado sesión muestra un mensaje de error junto con un enlace a login. Despues de 4 segundos redirige a index.
    }else{
?>

    <main>
        <article>
            <p>Ya has iniciado sesión</p>
            <p>Si quieres registrarte primero <a href="logoff.php">cierra sesión</a></p>
            
            <?php
                header('Refresh: 4; url=index.php');
            ?>

        </article>
    </main>

<?php
    }
?>
</body>
</html>