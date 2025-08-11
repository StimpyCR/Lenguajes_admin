<?php
    // Importamos Config
    require_once __DIR__.'/../Config/database.php';

    // Creamos clase
    class PedidoDetalleModel {
        // Atributos
        private $conn;

        // Constructor
        public function __construct(){
            $db = new Database();
            $this -> conn = $db -> conectar();
        }

        // CRUD
        public function crearPedidoDetalle ($idPedido, $idCarrito) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.FIDE_INSERTA_DETALLE_PEDIDO_SP(:idPedido, :idCarrito);
                    END;";

            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idPedido", $idPedido);
            oci_bind_by_name($stmt, ":idCarrito", $idCarrito);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al insertar el detalle: " . $e['message']);
            }
            oci_free_statement($stmt);
        }
        
        public function actualizarPedidoDetalle ($idPedido, $idCarrito, $idEstado) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.FIDE_ACTUALIZA_DETALLE_PEDIDO_SP(:idPedido, :idCarrito, :idEstado);
                    END;";

            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idPedido", $idPedido);
            oci_bind_by_name($stmt, ":idCarrito", $idCarrito);
            oci_bind_by_name($stmt, ":idEstado", $idEstado);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al actualizar el detalle: " . $e['message']);
            }
            oci_free_statement($stmt);
        }

        public function cambiarEstadoPedidoDetalle ($idPedido, $idCarrito) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.FIDE_INACTIVA_DETALLE_PEDIDO_SP(:idPedido, :idCarrito);
                    END;";

            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idPedido", $idPedido);
            oci_bind_by_name($stmt, ":idCarrito", $idCarrito);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al inactivar el detalle: " . $e['message']);
            }
            oci_free_statement($stmt);
        }
    }
?>