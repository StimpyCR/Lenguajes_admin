<?php
    // Importamos Config
    require_once __DIR__.'/../Config/database.php';

    // Creamos clase
    class ProvinciaModel {
        // Atributos
        private $conn;

        // Constructor
        public function __construct(){
            $db = new Database();
            $this -> conn = $db -> conectar();
        }

        // CRUD
        public function crearProvincia ($descripcion) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.fide_insertar_provincia_SP(:descripcion);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":descripcion", $descripcion);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al insertar provincia: " . $e['message']);
            }
            oci_free_statement($stmt);
        }
        
        public function actualizarProvincia ($idProvincia, $descripcion) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.FIDE_ACTUALIZAR_PROVINCIA_SP(:idProvincia, :descripcion);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idProvincia", $idProvincia);
            oci_bind_by_name($stmt, ":descripcion", $descripcion);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al actualizar provincia: " . $e['message']);
            }
            oci_free_statement($stmt);
        }

        public function obtenerProvincias () {
            $provincias = [];
            $idProvincia = 1;

            while (true) {
                $sql = "BEGIN
                            FIDE_PK_KERAT_PKG.FIDE_OBTENER_PROVINCIAS_SP(:idProvincia, :descripcion);
                        END;";

                $stmt = oci_parse($this->conn, $sql);
                    
                $descripcion = "";
                                
                oci_bind_by_name($stmt, ":idProvincia", $idProvincia, 4000);        // In
                oci_bind_by_name($stmt, ":descripcion", $descripcion, 4000);      // Out
                                
                oci_execute($stmt);
                
                if ($descripcion === null){
                    break;
                } 

                $provincias[] = [
                    "id" => $idProvincia,
                    "descripcion" => $descripcion
                ];
                
                $idProvincia++;
            }
                
            oci_free_statement($stmt);
            return $provincias;
        }
    }
?>