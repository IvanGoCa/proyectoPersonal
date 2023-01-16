<?php
    class Votos{
        
        public static function getVotado(){
            $bd = new Bd();
            $bd -> conectar('localhost', 'root', '', 'goty');
            
            $resultado = $bd -> consulta("SELECT votado FROM usuarios WHERE usuario = '". $_SESSION['usuario'] ."'");
            
            $bd -> desconectar();
            return $resultado;
        }

        public static function setVotos(){
            $bd = new Bd();
            $bd -> conectar('localhost', 'root', '', 'goty');

            $bd -> manipular(
                'UPDATE juegos
                SET votos = votos + 1
                WHERE id = "'. $_GET['juego'] .'"'
            );

            $bd -> manipular(
                'UPDATE usuarios
                SET votado = 1
                WHERE usuario = "'. $_SESSION['usuario'] .'"'
            );

        }
    }
?>