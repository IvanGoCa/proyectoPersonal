<?php

    /**
     * Clase de la Base de Datos
     * 
     * Clase con constructor vacío donde se realiza la conexión con la Base
     * de Datos o las distintas consultas que se requieran.
     * 
     * @author: Iván Gómez Caviedes
     * @version: 1.0.0 
     */
    class bd{
        // Variable que va a almacenar la conexión con la BBDD
        private $bd;

        /**
         * Constructor vacío. Esta clase no requiere de un constructor.
         */
        public function __construct(){}
        
        /**
         * Función que realiza la conexión con la BBDD.
         * 
         * La función recibe diversos parámetros requeridos para la creación de 
         * la conexión.
         * 
         * @param ip Se almacena la IP donde se encuentra la BBDD.
         * @param usuario Se almacena el usuario apto para modificar la BBDD.
         * @param contra Se almacena la contraseña del usuario.
         * @param base Se almacena el nombre de la BBDD que se quiere modificar o consultar.
         * 
         * @return -1 en el caso de que la conexión no se haya realizado.
         * @return 0 en el caso de que la conexión se haya realizado con éxito.
         */
        function conectar(string $ip, string $usuario, string $contra, string $base){
            $this -> bd = new mysqli($ip, $usuario, $contra, $base);

            if($this -> bd -> connect_errno)
                return -1;
            return 0;
        }

        /**
         * Función que desconecta de la BBDD.
         * 
         * La función no recibe ningún parámetro. Recoge el atributo global de la clase y en el
         * caso de que se haya realizado la conexión la cierra.
         */
        function desconectar(){
            if($this -> bd)
                $this -> bd -> close();
        }

        /**
         * Función que realiza una consulta.
         * 
         * La función recibe una consulta. Se busca mediante la variable global la cual tiene una 
         * conexión realizada con la BBDD. Una vez realizada la consulta se devuelven las filas encontradas.
         * 
         * @param sql Consulta.
         * 
         * @return resultado Devuelve los resultados de la consulta solicitada.
         */
        function consulta($sql){
            $resultado = $this -> bd -> query($sql);
            return $resultado;
        }

        /**
         * Función que modifica datos de tablas.
         * 
         * La función recibe una query. Se modifican los datos mediante la variable global la cual tiene 
         * una conexión realizada con la BBDD. Una vez realizada la conexión devuelve las filas que se han 
         * modificado.
         * 
         * @param sql Query.
         * 
         * @return this->bd->affected_rows Líneas afectadas al modificar la tabla.
         */
        function manipular($sql){
            $this -> bd -> query($sql);
            return $this -> bd -> affected_rows;
        }
    }
?>