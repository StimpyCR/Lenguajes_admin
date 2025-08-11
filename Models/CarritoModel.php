<?php
    // Importamos Config
    require_once __DIR__.'/../Config/database.php';

    // Creamos clase
    class CarritoModel {
        // Atributos
        private $conn;

        // Constructor
        public function __construct(){
            $db = new Database();
            $this -> conn = $db -> conectar();
        }

        // CRUD
        public function crearCarrito ($idUsuario) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.FIDE_INSERTA_CARRITO_SP(:idUsuario);
                    END;";

            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idUsuario", $idUsuario);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al insertar carrito: " . $e['message']);
            }
            oci_free_statement($stmt);
        }
        
        public function actualizarCarrito ($idCarrito, $idUsuario) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.FIDE_ACTUALIZA_CARRITO_SP(:idCarrito, :idUsuario);
                    END;";
            
            $stmt = oci_parse($this->conn, $sql);
            
            oci_bind_by_name($stmt, ":idCarrito", $idCarrito);
            oci_bind_by_name($stmt, ":idUsuario", $idUsuario);
            
            $resultado = oci_execute($stmt);
            
            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al actualizar carrito: " . $e['message']);
            }
            oci_free_statement($stmt);
        }
        
        public function obtenerIdCarrito ($idUsuario) {
            $sql = "BEGIN
                        :idCarrito := FIDE_PK_KERAT_PKG.FIDE_CARRITO_OBTENER_ID_FN(:idUsuario);
                    END;";

            $stmt = oci_parse($this->conn, $sql);

            $idCarrito = 0;

            oci_bind_by_name($stmt, ":idUsuario", $idUsuario, 4000);
            oci_bind_by_name($stmt, ":idCarrito", $idCarrito, 4000);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al obtener el ID del Carrito: " . $e['message']);
            }
            oci_free_statement($stmt);

            return (int) $idCarrito;
        }
        
        
        public function obtenerCarritoCompleto ($idUsuario) {
            $carritoCompleto = [];
            
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.FIDE_OBTENER_CARRITO_COMPLETO_SP(:idUsuario, :cursor);
                    END;";

            $stmt = oci_parse($this->conn, $sql);

            $cursor = oci_new_cursor($this->conn);
            oci_bind_by_name($stmt, ":cursor", $cursor, -1, OCI_B_CURSOR);
            oci_bind_by_name($stmt, ":idUsuario", $idUsuario);

            $result = oci_execute($stmt);

            if (!$result) {
                $e = oci_error($stmt);
                throw new Exception("Error al obtener carrito completo: " . $e['message']);
            }

            oci_execute($cursor);

            while (($row = oci_fetch_assoc($cursor)) != false) {
                $carritoCompleto[] = $row;
            }

            oci_free_statement($cursor);
            oci_free_statement($stmt);

            return $carritoCompleto;
        }
    }
?>