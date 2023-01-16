<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../estilos/styleRanking.css">
    <link rel="shortcut icon" href="https://i.postimg.cc/sfMkg4R8/The-Game-Awards-logo-2020-svg.png" type="image/x-icon">
    <title>Ranking</title>
</head>
<body>
    <header>
        <article>
            <a href="./../controladores/index.php">
                <img src="https://i.postimg.cc/TPKktRsR/The-Game-Awards-logo-2020-svg.png" alt="">
            </a>
        </article>
        <article>
            <p>Ranking</p>
        </article>
    </header>

    <main>
        <article>
            <section>
                <p>Mejor juego del año</p>
            </section>

            <?php
                $num = 1;
                foreach($ranking as $row){
                    echo '<section>';
                        echo '<p>'. $num++ .'</p>';
                        echo '<p>'. $row['nombre'] .'</p>';
                        if($row['votos'] == 1)
                            echo '<p>'. $row['votos'] .' voto</p>';
                        else
                            echo '<p>'. $row['votos'] .' votos</p>';
                    echo '</section>';
                }
            ?>

        </article>
    </main>
</body>
</html>