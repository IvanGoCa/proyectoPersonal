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
        if(Usuarios::isLogged()){
    ?>

    <main>

        <?php
            // Variable que controla el botón 'Si' del formulario
            $btnSi = false;

            // Si se ha pulsado el botón 'Si'
            if(isset($_POST['btnSi'])){
                // Pongo la variable del botón a true
                $btnSi = true;
                Votos::setVotos();
            }

            // Si ha pulsado el botón 'No' redirige al index
            if(isset($_POST['btnNo']))
                header('Location: ./../controladores/index.php');

            // Si no se ha pulsado el botón 'Si'
            if(!$btnSi){

                // En el caso de que no haya votado
                if(Votos::getVotado()){
        ?>

        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">

            <?php
                // Muestro el nombre del juego junto con su imagen
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
                // Si ha votado muestra un mensaje distinto y redirige al index
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
            // Si ha pulsado el botón 'Si'
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
        // Si no ha iniciado sesión muestra un mensaje y redirige al index
        }else{
    ?>

    <main>
        <article>
            <p>No has iniciado sesión. Redirigiendo...</p>
            <?php
                header('Refresh: 2; url=./../controladores/index.php');
            ?>
        </article>
    </main>

    <?php
        }
    ?>
</body>
</html>