<?php
    include ('./../modelos/votos.php');
    if(isset($_SESSION['usuario']))
        $votos = Votos::getVotado($_SESSION['usuario']);
    include ('./../vistas/vistaIndex.php');
?>