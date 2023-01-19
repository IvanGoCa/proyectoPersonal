<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://i.postimg.cc/sfMkg4R8/The-Game-Awards-logo-2020-svg.png" type="image/x-icon">
    <link rel="stylesheet" href="./../estilos/styleVoto.css">
    <title>Votación</title>
</head>
<body>
    <header>
        <article>
            <a href="./../index.php">
                <img src="https://i.postimg.cc/TPKktRsR/The-Game-Awards-logo-2020-svg.png" alt="">
            </a>
        </article>
        <article>
            <p>votación</p>
        </article>
    </header>
    <?php
        // Si ha iniciado la sesión puede votar
        // Para ver la función 'isLogged()' ir a la clase modelo Usuarios.
        if(Usuarios::isLogged()){
    ?>
    <main>
        <?php
            // Variable que controla el botón 'Si' del formulario
            $btnSi = false;

            // Si se ha pulsado el botón 'Si' se cambia la variable que controla el botón
            // y modifica las tablas de la BBDD.
            // Para ver la función 'setVotos()' ir a la clase modelo Votos.
            if(isset($_POST['btnSi'])){
                $btnSi = true;
                Votos::setVotos();
            }

            if(isset($_POST['btnNo']))
                header('Location: ./../index.php');

            // Si no se ha pulsado el botón 'Si' muestra los votos.
            // En caso contrario muestra un mensaje y redirige al index.
            if(!$btnSi){

                // En el caso de que no haya votado muestra el nombre del juego con su imagen.
                // En caso contrario redirige al index.
                // Para ver la función 'getVotado()' ir a la clase modelo Votos.
                if(!Votos::getVotado()){
        ?>
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
            <?php
                foreach(Juegos::getJuego() as $row){
                    echo ' <p>¿Quieres votar a <strong>'. $row['nombre'] .'</strong> como mejor juego del año?</p>';
                            
                    echo '<img src="'. $row['img'] .'" alt="imagen de '. $row['nombre'] .'">';
                }
            ?>            
            <div>
                <button type="submit" name="btnSi">si</button>
                <button type="submit" name="btnNo">no</button>
            </div>
        </form>
        <?php
                }else{
        ?>            
        <main>
            <article>
                <p>Gracias por tu voto.</p>
                <?php
                    header('Refresh: 2; url=./../controladores/ranking.php');
                ?>
            </article>
        </main>
        <?php
                }
        ?>
        <?php
            }else{
        ?>
        <main>
            <article>
                <p>Gracias por tu voto.</p>
                <?php
                    header('Refresh: 2; url=./../controladores/ranking.php');
                ?>
            </article>
        </main>
        <?php
            }
        ?>
    </main>
    <?php
        }else{
    ?>
    <main>
        <article>
            <p>No has iniciado sesión. Redirigiendo...</p>
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