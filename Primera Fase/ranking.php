<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleRanking.css">
    <link rel="shortcut icon" href="https://i.postimg.cc/sfMkg4R8/The-Game-Awards-logo-2020-svg.png" type="image/x-icon">
    <title>Ranking</title>
</head>
<body>
    <header>
        <article>
            <a href="index.php">
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
                $goty = new mysqli('localhost', 'root', '', 'goty');

                try{
                    // Busco en la BBDD el nombre del juego junto con sus votos ordenados por el que tiene más votos al que menos
                    $sql = 'SELECT nombre, votos
                            FROM juegos
                            ORDER BY votos DESC';

                    $resultado = $goty -> query($sql);

                    $num = 1;

                    // Imprimo el nombre y el voto
                    foreach($resultado as $row){
                        echo '<section>';
                            echo '<p>'. $num++ .'</p>';
                            echo '<p>'. $row['nombre'] .'</p>';
                            if($row['votos'] == 1)
                                echo '<p>'. $row['votos'] .' voto</p>';
                            else
                                echo '<p>'. $row['votos'] .' votos</p>';
                        echo '</section>';
                    }
                }catch(Exception $e){
                    echo $e -> getMessage();
                }
            ?>

        </article>
    </main>
</body>
</html>