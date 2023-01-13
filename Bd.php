<?php
    class bd{
        private $bd;
        
        function conectar(string $ip, string $usuario, string $contra, string $tabla){
            $this -> bd = new mysqli($ip, $usuario, $contra, $tabla);

            if($this -> bd -> connect_errno)
                return -1;
            return 0;
        }

        function desconectar(){
            if($this -> bd)
                $this -> bd -> close();
        }

        function consulta($sql){
            $resultado = $this -> bd -> query($sql);
            return $resultado;
        }

        function manipular($sql){
            $this -> bd -> query($sql);
            return $this -> bd -> affected_rows;
        }
    }
?>