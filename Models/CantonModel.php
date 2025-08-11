<?php
    // Importamos Config
    require_once __DIR__.'/../Config/database.php';

    // Creamos clase
    class CantonModel {
        // Atributos
        private $conn;

        // Constructor
        public function __construct(){
            $db = new Database();
            $this -> conn = $db -> conectar();
        }

        // CRUD
        public function crearCanton ($descripcion) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.fide_insertar_canton_SP(:descripcion);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":descripcion", $descripcion);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al insertar canton: " . $e['message']);
            }
            oci_free_statement($stmt);
        }
        
        public function actualizarCanton ($idCanton, $descripcion) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.fide_actualizar_canton_SP(:idCanton, :descripcion);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idCanton", $idCanton);
            oci_bind_by_name($stmt, ":descripcion", $descripcion);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al actualizar canton: " . $e['message']);
            }
            oci_free_statement($stmt);
        }

        public function obtenerCantones () {
            $cantones = [];
            $idCanton = 1;

            while (true) {
                $sql = "BEGIN
                            FIDE_PK_KERAT_PKG.FIDE_OBTENER_CANTONES_SP(:idCanton, :descripcion);
                        END;";

                $stmt = oci_parse($this->conn, $sql);
                    
                $descripcion = "";
                                
                oci_bind_by_name($stmt, ":idCanton", $idCanton, 4000);        // In
                oci_bind_by_name($stmt, ":descripcion", $descripcion, 4000);      // Out
                                
                oci_execute($stmt);
                
                if ($descripcion === null){
                    break;
                } 

                $cantones[] = [
                    "id" => $idCanton,
                    "descripcion" => $descripcion
                ];
                
                $idCanton++;
            }
                
            oci_free_statement($stmt);
            return $cantones;
        }
    }
?>