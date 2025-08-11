<?php
    // Importamos Config
    require_once __DIR__.'/../Config/database.php';

    // Clase
    class IngredienteProductoModel {
        // Atributos
        private $conn;

        // Constructor
        public function __construct(){
            $db = new Database();
            $this -> conn = $db -> conectar();
        }

        // CRUD
        public function crearIngredienteProducto ($idIngrediente, $idProducto, $cantidad) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.FIDE_INSERTA_INGREDIENTE_PRODUCTO_SP(:idIngrediente, :idProducto, :cantidad);
                    END;";

            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idIngrediente", $idIngrediente);
            oci_bind_by_name($stmt, ":idProducto", $idProducto);
            oci_bind_by_name($stmt, ":cantidad", $cantidad);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al asignar el ingrediente al producto: " . $e['message']);
            }
            oci_free_statement($stmt);
        }

        public function actualizarIngredienteProducto ($idIngrediente, $idProducto, $cantidad) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.FIDE_ACTUALIZA_INGREDIENTE_PRODUCTO_SP(:idIngrediente, :idProducto, :cantidad);
                    END;";

            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idIngrediente", $idIngrediente);
            oci_bind_by_name($stmt, ":idProducto", $idProducto);
            oci_bind_by_name($stmt, ":cantidad", $cantidad);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al actualizar la cantidad del ingrediente asignado al producto: " . $e['message']);
            }
            oci_free_statement($stmt);
        }

        public function obtenerIngredientesProductos () {
            $ingredientesPorProductos = [];

            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.FIDE_OBTENER_INGREDIENTE_PRODUCTO_SP(:cursor);
                    END;";

            $stmt = oci_parse($this->conn, $sql);

            // Declaramos el cursor
            $cursor = oci_new_cursor($this->conn);
                            
            oci_bind_by_name($stmt, ":cursor", $cursor, -1, OCI_B_CURSOR);        // Out
                            
            oci_execute($stmt);

            // Ejecutamos el cursor tambien
            oci_execute($cursor);
            
            while (($row = oci_fetch_assoc($cursor)) != false) {
                $ingredientesPorProductos[] = $row;
            }
                
            oci_free_statement($stmt);
            oci_free_statement($cursor);

            return $ingredientesPorProductos;
        }
    }
?>