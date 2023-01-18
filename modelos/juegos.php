<?php
    // Clase juegos
    class Juegos{

        // Constructor vacío. La clase no lo requiere.
        public function __construct(){}

        // Función que realiza una consulta buscando todo lo que se encuentra 
        // en la tabla juegos y devuelve todas las filas.
        public static function getJuegos(){
            $bd = new Bd();
            $bd -> conectar('localhost', 'root', '', 'goty');
            
            $resultado = $bd -> consulta('SELECT * FROM juegos');
            
            $bd -> desconectar();
            return $resultado;
        }

        // Función que realiza una consulta buscando el nombre y los votos 
        // en la tabla juegos ordenados por los votos de manera descendiente
        // para que en el ranking aparezca en primera posición el que más votos tenga.
        // Devuelve todas las filas encontradas.
        public static function getRanking(){
            $bd = new Bd();
            $bd -> conectar('localhost', 'root', '', 'goty');
            
            $resultado = $bd -> consulta('SELECT nombre, votos FROM juegos ORDER BY votos DESC');

            $bd -> desconectar();
            return $resultado;
        }

        // Función que realiza una consunlta buscando un juego dado en la URL y 
        // recogido mediante $_GET[].
        // Devuelve todo lo relacionado con el jugo dado.
        public static function getJuego(){
            $bd = new Bd();
            $bd -> conectar('localhost', 'root', '', 'goty');

            $resultado = $bd -> consulta(
               'SELECT *
                FROM juegos
                WHERE id = "'. $_GET['juego'] .'"'
            ); 

            $bd -> desconectar();

            return $resultado;
        }
    }
?>