<?php
    // Importamos Config
    require_once __DIR__.'/../Config/database.php';

    // Creamos clase
    class DireccionModel {
        // Atributos
        private $conn;

        // Constructor
        public function __construct(){
            $db = new Database();
            $this -> conn = $db -> conectar();
        }

        // CRUD
        public function crearDireccion ($idProvincia, $idCanton, $idDistrito, $detalle) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.fide_insertar_direccion_SP(:idProvincia, :idCanton, :idDistrito, :detalle);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idProvincia", $idProvincia);
            oci_bind_by_name($stmt, ":idCanton", $idCanton);
            oci_bind_by_name($stmt, ":idDistrito", $idDistrito);
            oci_bind_by_name($stmt, ":detalle", $detalle);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al insertar direccion: " . $e['message']);
            }
            oci_free_statement($stmt);
        }
        
        public function actualizarDireccion ($idDireccion, $idProvincia, $idCanton, $idDistrito, $detalle) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.fide_actualizar_direccion_SP(:idDireccion, :idProvincia, :idCanton, :idDistrito, :detalle);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idDireccion", $idDireccion);
            oci_bind_by_name($stmt, ":idProvincia", $idProvincia);
            oci_bind_by_name($stmt, ":idCanton", $idCanton);
            oci_bind_by_name($stmt, ":idDistrito", $idDistrito);
            oci_bind_by_name($stmt, ":detalle", $detalle);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al actualizar direccion: " . $e['message']);
            }
            oci_free_statement($stmt);
        }

        public function obtenerDirecciones () {
            $direcciones = [];
            $idDireccion = 1;

            while (true) {
                $sql = "BEGIN
                            FIDE_PK_KERAT_PKG.FIDE_OBTENER_DIRECCIONES_SP(:idDireccion, :provincia, :canton, :distrito, :detalle);
                        END;";

                $stmt = oci_parse($this->conn, $sql);
                    
                $provincia = "";
                $canton = "";
                $distrito = "";
                $detalle = "";
                                
                oci_bind_by_name($stmt, ":idDireccion", $idDireccion, 4000);        // In
                oci_bind_by_name($stmt, ":provincia", $provincia, 4000);            // Out
                oci_bind_by_name($stmt, ":canton", $canton, 4000);                  // Out
                oci_bind_by_name($stmt, ":distrito", $distrito, 4000);              // Out
                oci_bind_by_name($stmt, ":detalle", $detalle, 4000);                // Out
                                
                oci_execute($stmt);
                
                if ($provincia === null && $canton === null && $distrito === null && $detalle === null){
                    break;
                }

                $direcciones[] = [
                    "id" => $idDireccion,
                    "provincia" => $provincia,
                    "canton" => $canton,
                    "distrito" => $distrito,
                    "detalle" => $detalle
                ];
                
                $idDireccion++;
            }
                
            oci_free_statement($stmt);
            return $direcciones;
        }
    }
?>