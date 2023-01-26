<?php
    /**
     * Clase Juegos
     * 
     * Clase donde se realizan distintas operaciones sobbre la tabla 
     * juegos de la BBDD.
     * 
     * @author: Iván Gómez Caviedes
     * @version: 1.0.0 
     */
    class Juegos{

        /**
         * Constructor vacío. La clase no lo requiere.
         */
        public function __construct(){}

        /**
         * Funcion que devuelve juegos.
         * 
         * Realiza una consulta con la BBDD donde se buscan todos los juegos con
         * todas sus columnas.
         * 
         * @return resultado Devuelve los resultados obtenidos
         */
        public static function getJuegos(){
            $bd = new Bd();
            $bd -> conectar('localhost', 'root', '', 'goty');
            
            $resultado = $bd -> consulta('SELECT * FROM juegos');
            
            $bd -> desconectar();
            return $resultado;
        }

        /**
         * Función que realiza una consulta para realizar el ranking
         * 
         * Función que realiza una consulta buscando el nombre y los votos 
         * en la tabla juegos ordenados por los votos de manera descendiente
         * para que en el ranking aparezca en primera posición el que más votos tenga.
         * 
         * @return resultado Devuelve todas las filas encontradas.
         */
        public static function getRanking(){
            $bd = new Bd();
            $bd -> conectar('localhost', 'root', '', 'goty');
            
            $resultado = $bd -> consulta('SELECT nombre, votos FROM juegos ORDER BY votos DESC');

            $bd -> desconectar();
            return $resultado;
        }

        /**
         * Función que busca todos los juegos a partir de un ID
         * 
         * Función que realiza una consunlta buscando un juego dado en la URL y 
         * recogido mediante $_GET[].
         * 
         * @return resultado Devuelve todo lo relacionado con el juego dado.
         */
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