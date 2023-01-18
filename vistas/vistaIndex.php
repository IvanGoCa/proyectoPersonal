<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../estilos/styleIndex.css">
    <link rel="shortcut icon" href="https://i.postimg.cc/sfMkg4R8/The-Game-Awards-logo-2020-svg.png" type="image/x-icon">
    <title>Juego del año | Nominados</title>
</head>
<body>
    <header>
        <article>
            <a href="./../controladores/index.php">
                <img src="https://i.postimg.cc/TPKktRsR/The-Game-Awards-logo-2020-svg.png" alt="logo">
            </a>
        </article>
        <article>
            <?php
                // Dependiendo de si el usuario ha iniciado sesión o no pondrá un mensaje u otro
                if(!Usuarios::isLogged()){
                    echo '<a href="./../controladores/login.php"><img src="https://i.postimg.cc/tJQm1L29/login.png" alt="icono-inicio-sesion"><span>Iniciar sesión</span></a>';
                }else{
                    echo '<a href="./../controladores/logoff.php"><img src="https://i.postimg.cc/fR2273B2/logoff.png" alt="logoff"><span>Cerrar sesión</span></a>';
                }
            ?>            
        </article>
    </header>

    <main>
        <h1>Juego del año</h1>

        <a href="./../controladores/ranking.php"><span>ranking</span></a>

        <article>
            <?php
                // Creo un string en el que se pueden almacenar 3 tipos de mensajes dependiendo de si ha votado el usuario o no y si ha iniciado sesión
                $boton = "";
                if(Usuarios::isLogged()){// Si el usuario ha iniciado sesión
    
                    if(Votos::getVotado())
                        $boton = "ya has votado";
                    else
                        $boton = "vota aquí";

                }else{ // En el caso de que no haya iniciado sesión
                    $boton = "inicia sesión para votar";
                }


                foreach(Juegos::getJuegos() as $row){

                    // Dependiendo del mensaje del botón habrá un enlace u otro
                    if($boton == "inicia sesión para votar")
                        echo '<a href="./../controladores/login.php">';
                    if($boton == "ya has votado")
                        echo '<a href="#">';
                    if($boton == "vota aquí")
                        // Cada enlace del juego contiene una variable en la que se muestra el id
                        echo '<a href="votos.php?juego='.$row['id'].'">'; 

                        // Añado la información de cada juego (Imagen, nombre, descripción)
                        echo '<img src="'. $row['img'] .'" alt="">';
                        echo '<p>'. $boton .'</p>';
                        echo '<h2>'. $row['nombre'] .'</h2>';
                        echo '<h3>'. $row['productora'] .'</h3>';
                    echo '</a>';
                }

            ?>
        </article>
    </main>

    <footer>
        <h1>&#x24B8; Iván Gómez S.A. | 02/12/2022</h1>
    </footer>
</body>
</html>