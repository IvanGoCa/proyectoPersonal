<?php
    include ('../modelos/juegos.php');
    include ('../modelos/bd.php');
    $ranking = Juegos::getRanking();
    include ('../vistas/vistaRanking.php');
?>