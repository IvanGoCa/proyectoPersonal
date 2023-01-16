<?php
    include ('../modelos/juegos.php');
    $ranking = Juegos::getRanking();
    include ('../vistas/vistaRanking.php');
?>