<?php

    class Juegos{

        public static function getJuegos(){
            $bd = new Bd();
            $bd -> conectar('localhost', 'root', '', 'goty');
            
            $resultado = $bd -> consulta('SELECT * FROM juegos');
            $juegos = array();
            
            foreach($resultado as $row)
                $juegos[] = $row;
            
            $bd -> desconectar();
            return $juegos;
        }


        public static function getRanking(){
            $bd = new Bd();
            $bd -> conectar('localhost', 'root', '', 'goty');
            
            $resultado = $bd -> consulta('SELECT nombre, votos FROM juegos ORDER BY votos DESC');

            $bd -> desconectar();
            return $resultado;
        }

        public static function getJuego(){
            $bd = new Bd();
            $bd -> conectar('localhost', 'root', '', 'goty');

            $resultado = $bd -> consulta(
               'SELECT *
                FROM juegos
                WHERE id = "'. $_GET['juego'] .'"'
            ); 

            return $resultado;
        }
    }
?>