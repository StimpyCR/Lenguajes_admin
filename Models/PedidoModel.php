<?php
    // Importamos Config
    require_once __DIR__.'/../Config/database.php';

    // Creamos clase
    class PedidoModel {
        // Atributos
        private $conn;

        // Constructor
        public function __construct(){
            $db = new Database();
            $this -> conn = $db -> conectar();
        }

        // CRUD
        public function crearPedido ($idUsuario) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.FIDE_INSERTA_PEDIDO_SP(:idUsuario);
                    END;";

            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idUsuario", $idUsuario);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al insertar pedido: " . $e['message']);
            }
            oci_free_statement($stmt);
        }
        
        public function actualizarPedido ($idPedido, $idUsuario) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.FIDE_ACTUALIZA_PEDIDO_SP(:idPedido, :idUsuario);
                    END;";
            
            $stmt = oci_parse($this->conn, $sql);
            
            oci_bind_by_name($stmt, ":idPedido", $idPedido);
            oci_bind_by_name($stmt, ":idUsuario", $idUsuario);
            
            $resultado = oci_execute($stmt);
            
            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al actualizar pedido: " . $e['message']);
            }
            oci_free_statement($stmt);
        }
        
        public function obtenerIdPedido ($idUsuario) {
            $sql = "BEGIN
                        :idPedido := FIDE_PK_KERAT_PKG.FIDE_PEDIDO_OBTENER_ID_FN(:idUsuario);
                    END;";

            $stmt = oci_parse($this->conn, $sql);

            $idPedido = 0;

            oci_bind_by_name($stmt, ":idUsuario", $idUsuario, 4000);
            oci_bind_by_name($stmt, ":idPedido", $idPedido, 4000);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al obtener el ID del Pedido: " . $e['message']);
            }
            oci_free_statement($stmt);

            return (int) $idPedido;
        }
        
        
        public function obtenerPedidoCompleto ($idCarrito) {
            $pedidoCompleto = [];
            
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.FIDE_OBTENER_PEDIDO_COMPLETO_SP(:idCarrito, :cursor);
                    END;";

            $stmt = oci_parse($this->conn, $sql);

            $cursor = oci_new_cursor($this->conn);
            oci_bind_by_name($stmt, ":cursor", $cursor, -1, OCI_B_CURSOR);
            oci_bind_by_name($stmt, ":idCarrito", $idCarrito);

            $result = oci_execute($stmt);

            if (!$result) {
                $e = oci_error($stmt);
                throw new Exception("Error al obtener pedido completo: " . $e['message']);
            }

            oci_execute($cursor);

            while (($row = oci_fetch_assoc($cursor)) != false) {
                $pedidoCompleto[] = $row;
            }

            oci_free_statement($cursor);
            oci_free_statement($stmt);

            return $pedidoCompleto;
        }
    }
?>