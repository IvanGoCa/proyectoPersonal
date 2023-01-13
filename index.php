<?php
    include ('./modelos/votos.php');
    include ('./vistas/vistaIndex.php');
    $votos = Votos::getVotado($_SESSION['usuario']);
?>