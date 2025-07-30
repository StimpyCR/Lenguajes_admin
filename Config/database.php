<?php   
    class Database {
        // Parámetros de conexión
        private $usuario = 'kerat_restaurante';
        private $contrasena = '123';
        private $cadenaConexion = 'localhost/XE';
    
        public $conexion;

        // Conexión
        public function conectar () {
            $this -> conexion = oci_connect($this -> usuario, $this -> contrasena, $this -> cadenaConexion);
        
            // Verificar si la conexión fue exitosa
            if (!$this -> conexion) {
                $error = oci_error();
                echo "Error de conexión: " . $error['message'];
            } else {
                return $this -> conexion;
            }

        }
    }
?>