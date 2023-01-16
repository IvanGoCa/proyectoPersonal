<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://i.postimg.cc/sfMkg4R8/The-Game-Awards-logo-2020-svg.png" type="image/x-icon">
    <link rel="stylesheet" href="styleVoto.css">
    <title>Votación</title>
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
            <p>votación</p>
        </article>
    </header>

    <?php
        // Si ha iniciado la sesión puede votar
        if($iniciado){
    ?>

    <main>

        <?php
            // Variable que controla el botón 'Si' del formulario
            $btnSi = false;

            // Si se ha pulsado el botón 'Si'
            if(isset($_POST['btnSi'])){
                // Pongo la variable del botón a true
                $btnSi = true;

                $goty = new mysqli('localhost', 'root', '', 'goty');

                try{
                    // Añado un voto al juego
                    $sql = 'UPDATE juegos
                            SET votos = votos + 1
                            WHERE id = "'. $_GET['juego'] .'"';

                    $goty -> query($sql);

                    // Cambio a 1 el voto del usuario para que no vuelva a votar
                    $sql = 'UPDATE usuarios
                            SET votado = 1
                            WHERE usuario = "'. $_SESSION['usuario'] .'"';

                    $goty -> query($sql);

                }catch(Excception $e){
                    echo $e -> getMessage();
                }
            }

            // Si ha pulsado el botón 'No' redirige al index
            if(isset($_POST['btnNo']))
                header('Location: index.php');

            // Si no se ha pulsado el botón 'Si'
            if(!$btnSi){

                // Creo una variable para comprobar si el usuario ha votado
                $votado = false;
                $goty = new mysqli('localhost', 'root', '', 'goty');

                try{
                    // Busca en la BBDD si ha votado el usuario
                    $sql = 'SELECT votado
                            FROM usuarios
                            WHERE usuario = "'. $_SESSION['usuario'] .'"';
                    $resultado = $goty -> query($sql);

                    // Si el usuario ha votado, la variable de comprobación cambia a true
                    foreach($resultado as $row){
                        if($row['votado'] == 1)
                            $votado = true;
                    }

                }catch(Exception $e){
                    echo $e -> getMessage();
                }

                $goty -> close();

                // En el caso de que no haya votado
                if(!$votado){
        ?>


        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">


            <?php
                $goty = new mysqli('localhost', 'root', '', 'goty');

                try{
                    // Consulta que busca el juego seleccionado a través de una variable guardada en la URL
                    $sql = 'SELECT *
                            FROM juegos
                            WHERE id = "'. $_GET['juego'] .'"';
                    $resultado = $goty -> query($sql);

                    // Muestro el nombre del juego junto con su imagen
                    foreach($resultado as $row){
                        echo ' <p>¿Quieres votar a <strong>'. $row['nombre'] .'</strong> como mejor juego del año?</p>';
                        
                        echo '<img src="'. $row['img'] .'" alt="imagen de '. $row['nombre'] .'">';
                    }

                    
                }catch(Exception $e){
                    echo $e -> getMessage();
                }

                $goty -> close();
            ?>

            
            <div>
                <button type="submit" name="btnSi">si</button>
                <button type="submit" name="btnNo">no</button>
            </div>
        </form>
        <?php
                // Si ha votado muestra un mensaje distinto y redirige al index
                }else{
        ?>
            
        <main>
            <article>
                <p>Gracias por tu voto.</p>
                <?php
                    header('Refresh: 2; url=ranking.php');
                ?>
            </article>
        </main>

        <?php
                }
        ?>

        <?php
            // Si ha pulsado el botón 'Si'
            }else{
        ?>

        <main>
            <article>
                <p>Gracias por tu voto.</p>
                <?php
                    header('Refresh: 2; url=ranking.php');
                ?>
            </article>
        </main>

        <?php
            }
        ?>
    </main>

    <?php
        // Si no ha iniciado sesión muestra un mensaje y redirige al index
        }else{
    ?>

    <main>
        <article>
            <p>No has iniciado sesión. Redirigiendo...</p>
            <?php
                header('Refresh: 2; url=index.php');
            ?>
        </article>
    </main>

    <?php
        }
    ?>
</body>
</html>