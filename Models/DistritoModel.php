<?php
    // Importamos Config
    require_once __DIR__.'/../Config/database.php';

    // Creamos clase
    class DistritoModel {
        // Atributos
        private $conn;

        // Constructor
        public function __construct(){
            $db = new Database();
            $this -> conn = $db -> conectar();
        }

        // CRUD
        public function crearDistrito ($descripcion) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.fide_insertar_distrito_SP(:descripcion);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":descripcion", $descripcion);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al insertar distrito: " . $e['message']);
            }
            oci_free_statement($stmt);
        }
        
        public function actualizarDistrito ($idDistrito, $descripcion) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.fide_actualizar_distrito_SP(:idDistrito, :descripcion);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idDistrito", $idDistrito);
            oci_bind_by_name($stmt, ":descripcion", $descripcion);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al actualizar distrito: " . $e['message']);
            }
            oci_free_statement($stmt);
        }

        public function obtenerDistritos () {
            $distritos = [];
            $idDistrito = 1;

            while (true) {
                $sql = "BEGIN
                            FIDE_PK_KERAT_PKG.FIDE_OBTENER_DISTRITOS_SP(:idDistrito, :descripcion);
                        END;";

                $stmt = oci_parse($this->conn, $sql);
                    
                $descripcion = "";
                                
                oci_bind_by_name($stmt, ":idDistrito", $idDistrito, 4000);        // In
                oci_bind_by_name($stmt, ":descripcion", $descripcion, 4000);      // Out
                                
                oci_execute($stmt);
                
                if ($descripcion === null){
                    break;
                } 

                $distritos[] = [
                    "id" => $idDistrito,
                    "descripcion" => $descripcion
                ];
                
                $idDistrito++;
            }
                
            oci_free_statement($stmt);
            return $distritos;
        }
    }
?>