<?php
    session_start();

    class Usuarios {
        
        static function isLogged(){
            if(isset($_SESSION['usuario']))
                return true;
            return false;
        }

        static function login($usuario, $contra){
            $contra = md5($contra);

            $bd = new Bd();
            $bd -> conectar('localhost', 'root', '', 'goty');

            $resultado = $bd -> consulta('
                SELECT usuario, contra 
                FROM usuarios 
                WHERE usuario = "'. $usuario .'" AND contra = "'. $contra .'";'
            );

            $bd -> desconectar();

            if($resultado -> num_rows == 1){
                $_SESSION['usuario'] = $usuario;
                return true;
            }
            return false;
        }

        static function logoff(){session_destroy();}

        static function userExists($usuario){
            $bd = new Bd();
            $bd -> conectar('localhost', 'root', '', 'goty');

            $resultado = $bd -> consulta('
                SELECT usuario
                FROM usuarios
                WHERE usuario = "'. $usuario .'"'
            );

            $bd -> desconectar();

            return $resultado;
        }

        static function createUser($usuario, $contra){
            $contra = md5($contra);
            
            $bd = new Bd();
            $bd -> conectar('localhost', 'root', '', 'goty');

            $bd -> manipular('INSERT INTO usuarios VALUES ("'. $usuario .'", "'. $contra .'", 0)');

            $bd -> desconectar();

            $_SESSION['usuario'] = $usuario;
        }

    }
?>