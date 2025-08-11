<?php
    // Importamos Config
    require_once __DIR__.'/../Config/database.php';

    // Clase
    class IngredienteModel {
        // Atributos
        private $conn;

        // Constructor
        public function __construct(){
            $db = new Database();
            $this -> conn = $db -> conectar();
        }

        // CRUD
        public function crearIngrediente ($nombre, $cantidadProducto) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.FIDE_INSERTA_INGREDIENTE_SP(:nombre, :cantidadProducto);
                    END;";

            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":nombre", $nombre);
            oci_bind_by_name($stmt, ":cantidadProducto", $cantidadProducto);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al insertar ingrediente: " . $e['message']);
            }
            oci_free_statement($stmt);
        }

        public function actualizarIngrediente ($idIngrediente, $nombre, $cantidadProducto, $idEstado) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.FIDE_ACTUALIZA_INGREDIENTE_SP(:idIngrediente, :nombre, :cantidadProducto, :idEstado);
                    END;";

            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idIngrediente", $idIngrediente);
            oci_bind_by_name($stmt, ":nombre", $nombre);
            oci_bind_by_name($stmt, ":cantidadProducto", $cantidadProducto);
            oci_bind_by_name($stmt, ":idEstado", $idEstado);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al actualizar ingrediente: " . $e['message']);
            }
            oci_free_statement($stmt);
        }

        public function cambiarEstadoIngrediente ($idIngrediente) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.FIDE_INACTIVA_INGREDIENTE_SP(:idIngrediente);
                    END;";

            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idIngrediente", $idIngrediente);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al inactivar ingrediente: " . $e['message']);
            }
            oci_free_statement($stmt);
        }

        public function obtenerIngredientes () {
            $ingredientes = [];
            $idIngrediente = 9; // Por alguna razón los ingredientes empiezan en 9

            while (true) {
                $sql = "BEGIN
                            FIDE_PK_KERAT_PKG.FIDE_OBTENER_INGREDIENTES_SP(:idIngrediente, :estado, :nombre, :cantidadProducto);
                        END;";

                $stmt = oci_parse($this->conn, $sql);
                    
                $estado = '';
                $nombre = '';
                $cantidadProducto = 0;
                                
                oci_bind_by_name($stmt, ":idIngrediente", $idIngrediente, 4000);            // In
                oci_bind_by_name($stmt, ":estado", $estado, 4000);                          // Out
                oci_bind_by_name($stmt, ":nombre", $nombre, 4000);                          // Out
                oci_bind_by_name($stmt, ":cantidadProducto", $cantidadProducto, 4000);      // Out
                                
                oci_execute($stmt);
                
                if ($nombre === null && $cantidadProducto === null){
                    break;
                } 

                $ingredientes[] = [
                    "id" => $idIngrediente,
                    "estado" => $estado,
                    "nombre" => $nombre,
                    "cantidad" => $cantidadProducto,
                ];
                
                $idIngrediente++;
            }
                
            oci_free_statement($stmt);
            return $ingredientes;
        }

    }
?>