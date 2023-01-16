<?php
    include ('./../controladores/bd.php');

    class Juegos{

        public static function getJuegos(){
            $bd = conexion();
            
            $resultado = $bd -> consulta('SELECT * FROM juegos');
            $juegos = array();
            
            foreach($resultado as $row)
                $juegos[] = $row;
            
            $bd -> desconectar();
            return $juegos;
        }


        public static function getRanking(){
            $bd = conexion();
            $resultado = $bd -> consulta('SELECT nombre, votos FROM juegos ORDER BY votos DESC');

            $bd -> desconectar();
            return $resultado;
        }
    }
    
    function conexion(){
        $bd = new Bd();
        $bd -> conectar('localhost', 'root', '', 'goty');
        
        return $bd;
    }
?>