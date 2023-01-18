<?php
    // Se inicia la sesión nada más incluir el archivo.
    session_start();
    
    // Clase que realiza toda la gestión de usuarios.
    class Usuarios {
        
        // Constructor vacío. Esta clase no requiere de un constructor.
        public function __construct(){}

        // Función que comprueba si el usuario ha iniciado sesión en la página.
        // En el caso de que sea así devuelve true. En caso contrario devuelve false.
        static function isLogged(){
            if(isset($_SESSION['usuario']))
                return true;
            return false;
        }

        // Función que inicia la sesión del usuario. Se pasan por parámetro el usuario
        // y la contraseña (se encripta por md5). Realiza una consulta buscando el usuario
        // y la contraseña de la tabla usuarios dentro de la BBDD donde el usuario y la 
        // contraseña sean los dados por parámetro. En el caso de que haya encontrado un 
        // resultado devuelve TRUE, en caso contrario FALSE.
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

        // Función que destruye la sesión que exista.
        static function logoff(){session_destroy();}

        // Función que comprueba si el usuario pasado por parámetro existe. Realiza una
        // consulta en la tabla usuarios de la BBDD donde el usuario sea el pasado por
        // parámetro. En el caso de que el usuario exista se devuelve TRUE, en caso 
        // contrario devuelve FALSE.
        static function userExists($usuario){
            $bd = new Bd();
            $bd -> conectar('localhost', 'root', '', 'goty');

            $resultado = $bd -> consulta('
                SELECT usuario
                FROM usuarios
                WHERE usuario = "'. $usuario .'"'
            );

            $bd -> desconectar();

            foreach($resultado as $row){
                if($row['usuario'] === $usuario)
                    return true;
            }
            return false;
        }

        // Función que crea un usuario en la BBDD pasando por parámetro el usuario y la 
        // contraseña sin encriptar. Se encripta la contraseña por md5 y se realiza in INSERT
        // en la tabla usuarios con el usuario y la contraseña pasados por parámetro.
        // Inicia la sesión y no devuelve nada.
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