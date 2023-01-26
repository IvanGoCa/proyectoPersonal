<?php

    /**
     * Clase que gestiona los votos de la BBDD
     * 
     * Clase que realiza toda la gestión de usuarios.
     * 
     * @author: Iván Gómez Caviedes
     * @version: 1.0.0 
     */
    class Votos{

        /**
         * Constructor vacío. Esta clase no requiere de un constructor.
         */
        public function __construct(){}

        /**
         * Función que comprueba si el usuario ha votado.
         * 
         * Comprueba si el usuario ha votado o no a través de la variable de 
         * sesión. Se realiza una consulta donde en la tabla usuarios busca si
         * el usuario ha votado.
         * 
         * @return true En el caso de que haya votado.
         * @return false En el caso de que no haya votado.
         */
        public static function getVotado(){
            $bd = new Bd();
            $bd -> conectar('localhost', 'root', '', 'goty');
            
            $resultado = $bd -> consulta("SELECT votado FROM usuarios WHERE usuario = '". $_SESSION['usuario'] ."'");
            
            $bd -> desconectar();
            
            foreach($resultado as $row){                            
                if($row['votado'] == "1")
                    return true;
            }
            return false;
        }

        /**
         * Función que añade votos.
         * 
         * Función que añade votos a un juego y al usuario. Realiza 2 updates, uno en
         * la tabla juegos con el juego dado por variable en la URL y recogido mediante
         * $_GET[] y otro en la tabla usuarios modificando la columna votado para que una
         * vez haya votado no pueda volver a votar.
         */
        public static function setVotos(){
            $bd = new Bd();
            $bd -> conectar('localhost', 'root', '', 'goty');

            $bd -> manipular('
                UPDATE juegos
                SET votos = votos + 1
                WHERE id = "'. $_GET['juego'] .'"'
            );

            $bd -> manipular('
                UPDATE usuarios
                SET votado = 1
                WHERE usuario = "'. $_SESSION['usuario'] .'"'
            );

        }
    }
?>