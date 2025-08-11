<?php
    // Importamos Config
    require_once __DIR__.'/../Config/database.php';

    // Creamos clase
    class MesaModel {
        // Atributos
        private $conn;

        // Constructor
        public function __construct(){
            $db = new Database();
            $this -> conn = $db -> conectar();
        }

        // CRUD
        public function crearMesa ($numeroMesa, $ubicacion, $capacidad) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.FIDE_INSERTA_MESA_SP(:numeroMesa, :ubicacion, :capacidad);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":numeroMesa", $numeroMesa);
            oci_bind_by_name($stmt, ":ubicacion", $ubicacion);
            oci_bind_by_name($stmt, ":capacidad", $capacidad);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al insertar mesa: " . $e['message']);
            }
            oci_free_statement($stmt);
        }
        
        public function actualizarMesa ($idMesa, $idEstado, $numeroMesa, $ubicacion, $capacidad) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.FIDE_ACTUALIZA_MESA_SP(:idMesa, :idEstado, :numeroMesa, :ubicacion, :capacidad);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idMesa", $idMesa);
            oci_bind_by_name($stmt, ":idEstado", $idEstado);
            oci_bind_by_name($stmt, ":numeroMesa", $numeroMesa);
            oci_bind_by_name($stmt, ":ubicacion", $ubicacion);
            oci_bind_by_name($stmt, ":capacidad", $capacidad);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al actualizar mesa: " . $e['message']);
            }
            oci_free_statement($stmt);
        }

        public function cambiarEstadoMesa ($idMesa) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.FIDE_INACTIVA_MESA_SP(:idMesa);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idMesa", $idMesa);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al inactivar mesa: " . $e['message']);
            }
            oci_free_statement($stmt);
        }

        public function obtenerMesas () {
            $mesas = [];
            $idMesa = 1;

            while (true) {
                $sql = "BEGIN
                            FIDE_PK_KERAT_PKG.FIDE_OBTENER_MESAS_SP(:idMesa, :estado, :numeroMesa, :ubicacion, :capacidad);
                        END;";

                $stmt = oci_parse($this->conn, $sql);
                    
                $estado = 0;
                $numeroMesa = 0;
                $ubicacion = "";
                $capacidad = 0;
                                
                oci_bind_by_name($stmt, ":idMesa", $idMesa, 4000);            // In
                oci_bind_by_name($stmt, ":estado", $estado, 4000);            // Out
                oci_bind_by_name($stmt, ":numeroMesa", $numeroMesa, 4000);    // Out
                oci_bind_by_name($stmt, ":ubicacion", $ubicacion, 4000);      // Out
                oci_bind_by_name($stmt, ":capacidad", $capacidad, 4000);      // Out
                                
                oci_execute($stmt);
                
                if ($estado === null && $numeroMesa === null && $ubicacion === null && $capacidad === null){
                    break;
                } 

                $mesas[] = [
                    "id" => $idMesa,
                    "estado" => $estado,
                    "numeroMesa" => $numeroMesa,
                    "ubicacion" => $ubicacion,
                    "capacidad" => $capacidad
                ];
                
                $idMesa++;
            }
                
            oci_free_statement($stmt);
            return $mesas;
        }
    }
?>