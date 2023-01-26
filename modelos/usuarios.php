<?php
    // Se inicia la sesión nada más incluir el archivo.
    // De esta manera se hacen las sesiones desde el principio 
    // del archivo aunque la clase no esté instanciada.
    session_start();

    /**
     * Clase Usuarios
     * 
     * Clase que realiza toda la gestión de usuarios.
     * 
     * @author: Iván Gómez Caviedes
     * @version: 1.0.0 
     */
    class Usuarios {
        
        /**
         * Constructor vacío. La clase no lo requiere.
         */
        public function __construct(){}

        /**
         * Función para comprobar si el usuario está logueado.
         * 
         * Comprueba si el usuario ha iniciado sesión en la página.
         * 
         * @return true En el caso de que esté logueado.
         * @return false En el caso de que no esté logueado.
         */
        static function isLogged(){
            if(isset($_SESSION['usuario']))
                return true;
            return false;
        }

        /**
         * Función que hace login al usuario
         * 
         * Función que inicia la sesión del usuario. Se pasan por parámetro el usuario
         * y la contraseña (se encripta por md5). Realiza una consulta buscando el usuario
         * y la contraseña de la tabla usuarios dentro de la BBDD donde el usuario y la 
         * contraseña sean los dados por parámetro. 
         * 
         * @param usuario El nombre de usuario.
         * @param contra La contraseña del usuario.
         * 
         * @return true En el caso de que haya devuelto un resultado.
         * @return false En el caso de que no haya devuelto nada.
         */
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

        /**
         * Función que destruye la sesión
         * 
         * Destruye la sesión existente.
         */
        static function logoff(){session_destroy();}

        /**
         * Función que comprueba si el usuario existe.
         * 
         * Comprueba si el usuario pasado por parámetro existe.
         * Realiza una consulta en la tabla usuarios de la BBDD donde
         * el usuario sea el pasado por parámetro. 
         * 
         * @param usuario Nombre de usuario.
         * 
         * @return true En el caso de que el usuario exista.
         * @return false En el caso de que en usuario no exista.
         */
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

        /**
         * Función para registrar usuarios
         * 
         * Crea un usuario en la BBDD pasando por parámetro el usuario y la 
         * contraseña sin encriptar. Se encripta la contraseña por md5 y se realiza in INSERT
         * en la tabla usuarios con el usuario y la contraseña pasados por parámetro.
         * Inicia la sesión y no devuelve nada.
         * 
         * @param usuario Nombre de usuario.
         * @param contra Contraseña del usuario.
         */
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