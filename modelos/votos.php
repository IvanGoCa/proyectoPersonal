<?php
    include ('./../controladores/bd.php');

    class Votos{

        
        public static function getVotado(string $usuario){
            $bd = conexion();
            $resultado = $bd -> consulta("SELECT votado FROM usuarios WHERE usuario = '". $usuario ."'");
            
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