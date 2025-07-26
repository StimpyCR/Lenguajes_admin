<?php
    require_once __DIR__.'/../Config/database.php';

    class Prueba {
        private $conexion;

        public function __construct() {
            $db = new Database();
            $this -> conexion = $db -> conectar();
        }

        public function mesasDisponibles () {
            $sql = 'BEGIN 
                        :resultado := FIDE_MESAS_OBTENER_DISPONIBLES_FN;
                    END;';
            $sentencia = oci_parse($this -> conexion, $sql);

            // Variable para recibir el resultado
            oci_bind_by_name($sentencia, ":resultado", $resultado, 4000); // 4000 es el tamaño máximo

            oci_execute($sentencia);

            // Mostrar resultado
            echo "<h1>$resultado</h1>";

            oci_free_statement($sentencia);
        }
    }
?>