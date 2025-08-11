<?php
    // Importamos Config
    require_once __DIR__.'/../Config/database.php';

    // Creamos clase
    class PrioridadModel {
        // Atributos
        private $conn;

        // Constructor
        public function __construct(){
            $db = new Database();
            $this -> conn = $db -> conectar();
        }

        // CRUD
        public function crearPrioridad ($descripcion) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.fide_insertar_prioridad_SP(:descripcion);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":descripcion", $descripcion);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al insertar prioridad: " . $e['message']);
            }
            oci_free_statement($stmt);
        }
        
        public function actualizarPrioridad ($idPrioridad, $descripcion) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.fide_actualizar_prioridad_SP(:idPrioridad, :descripcion);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idPrioridad", $idPrioridad);
            oci_bind_by_name($stmt, ":descripcion", $descripcion);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al actualizar prioridad: " . $e['message']);
            }
            oci_free_statement($stmt);
        }

        public function obtenerPrioridades () {
            $prioridades = [];
            $idPrioridad = 1;

            while (true) {
                $sql = "BEGIN
                            FIDE_PK_KERAT_PKG.FIDE_OBTENER_PRIORIDADES_SP(:idPrioridad, :descripcion);
                        END;";

                $stmt = oci_parse($this->conn, $sql);
                    
                $descripcion = "";
                                
                oci_bind_by_name($stmt, ":idPrioridad", $idPrioridad, 4000);        // In
                oci_bind_by_name($stmt, ":descripcion", $descripcion, 4000);      // Out
                                
                oci_execute($stmt);
                
                if ($descripcion === null){
                    break;
                } 

                $prioridades[] = [
                    "id" => $idPrioridad,
                    "descripcion" => $descripcion
                ];
                
                $idPrioridad++;
            }
                
            oci_free_statement($stmt);
            return $prioridades;
        }
    }
?>