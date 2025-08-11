<?php
    // Importamos Config
    require_once __DIR__.'/../Config/database.php';

    // Creamos clase
    class EstadoModel {
        // Atributos
        private $conn;

        // Constructor
        public function __construct(){
            $db = new Database();
            $this -> conn = $db -> conectar();
        }

        // CRUD
        public function crearEstado ($descripcion) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.FIDE_INSERTAR_ESTADO_SP(:descripcion);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":descripcion", $descripcion);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al insertar estado: " . $e['message']);
            }
            oci_free_statement($stmt);
        }
        
        public function actualizarEstado ($idEstado, $descripcion) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.FIDE_ACTUALIZAR_ESTADO_SP(:idEstado, :descripcion);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idEstado", $idEstado);
            oci_bind_by_name($stmt, ":descripcion", $descripcion);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al actualizar estado: " . $e['message']);
            }
            oci_free_statement($stmt);
        }

        public function obtenerEstados () {
            $estados = [];
            $idEstado = 1;

            while (true) {
                $sql = "BEGIN
                            FIDE_PK_KERAT_PKG.FIDE_OBTENER_ESTADOS_SP(:idEstado, :descripcion);
                        END;";

                $stmt = oci_parse($this->conn, $sql);
                    
                $descripcion = "";
                                
                oci_bind_by_name($stmt, ":idEstado", $idEstado, 4000);            // In
                oci_bind_by_name($stmt, ":descripcion", $descripcion, 4000);      // Out
                                
                oci_execute($stmt);
                
                if ($descripcion === null){
                    break;
                } 

                $estados[] = [
                    "id" => $idEstado,
                    "descripcion" => $descripcion
                ];
                
                $idEstado++;
            }
                
            oci_free_statement($stmt);
            return $estados;
        }
    }
?>