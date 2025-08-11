<?php
    // Importamos Config
    require_once __DIR__.'/../Config/database.php';

    // Creamos clase
    class CarritoDetalleModel {
        // Atributos
        private $conn;

        // Constructor
        public function __construct(){
            $db = new Database();
            $this -> conn = $db -> conectar();
        }

        // CRUD
        public function crearCarritoDetalle ($idCarrito, $idProducto, $cantidad) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.FIDE_INSERTA_DETALLE_CARRITO_SP(:idCarrito, :idProducto, :cantidad);
                    END;";

            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idCarrito", $idCarrito);
            oci_bind_by_name($stmt, ":idProducto", $idProducto);
            oci_bind_by_name($stmt, ":cantidad", $cantidad);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al insertar el detalle: " . $e['message']);
            }
            oci_free_statement($stmt);
        }
        
        public function actualizarCarritoDetalle ($idCarrito, $idProducto, $cantidad) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.FIDE_ACTUALIZA_DETALLE_CARRITO_SP(:idCarrito, :idProducto, :cantidad);
                    END;";

            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idCarrito", $idCarrito);
            oci_bind_by_name($stmt, ":idProducto", $idProducto);
            oci_bind_by_name($stmt, ":cantidad", $cantidad);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al actualizar el detalle: " . $e['message']);
            }
            oci_free_statement($stmt);
        }

        public function cambiarEstadoCarritoDetalle ($idCarrito, $idProducto) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.FIDE_INACTIVA_DETALLE_CARRITO_SP(:idCarrito, :idProducto);
                    END;";

            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idCarrito", $idCarrito);
            oci_bind_by_name($stmt, ":idProducto", $idProducto);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al inactivar el detalle: " . $e['message']);
            }
            oci_free_statement($stmt);
        }
    }
?>