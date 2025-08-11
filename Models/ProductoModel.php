<?php
    // Importamos Config
    require_once __DIR__.'/../Config/database.php';

    // Creamos clase
    class ProductoModel {
        // Atributos
        private $conn;

        // Constructor
        public function __construct(){
            $db = new Database();
            $this -> conn = $db -> conectar();
        }

        // CRUD
        public function crearProducto ($idCategoria, $nombre, $descripcion, $precio) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.FIDE_INSERTA_PRODUCTO_SP(:idProducto, :idCategoria, :idEstado, :nombre, :descripcion, :precio);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            $idProducto = 0;
            $idEstado = 1;

            oci_bind_by_name($stmt, ":idProducto", $idProducto);   // Se asigna automático, entonces enviamos 0 solo para que no de error
            oci_bind_by_name($stmt, ":idCategoria", $idCategoria);
            oci_bind_by_name($stmt, ":idEstado", $idEstado);
            oci_bind_by_name($stmt, ":nombre", $nombre);
            oci_bind_by_name($stmt, ":descripcion", $descripcion);
            oci_bind_by_name($stmt, ":precio", $precio);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al insertar producto: " . $e['message']);
            }
            oci_free_statement($stmt);
        }
        
        public function actualizarProducto ($idProducto, $idCategoria, $idEstado, $nombre, $descripcion, $precio) {
            $sql = "BEGIN
                        FIDE_PK_KERAT_PKG.FIDE_ACTUALIZA_PRODUCTO_SP(:idProducto, :idCategoria, :idEstado, :nombre, :descripcion, :precio);
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ":idProducto", $idProducto);    // Automatico
            oci_bind_by_name($stmt, ":idCategoria", $idCategoria);
            oci_bind_by_name($stmt, ":idEstado", $idEstado);
            oci_bind_by_name($stmt, ":nombre", $nombre);
            oci_bind_by_name($stmt, ":descripcion", $descripcion);
            oci_bind_by_name($stmt, ":precio", $precio);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al actualizar producto: " . $e['message']);
            }
            oci_free_statement($stmt);
        }

        public function cambiarEstadoProducto($idProducto){
            $sql = "BEGIN 
                        FIDE_PK_KERAT_PKG.FIDE_INACTIVA_PRODUCTO_SP(:idProducto); 
                    END;";
            $stmt = oci_parse($this->conn, $sql);

            oci_bind_by_name($stmt, ':idProducto', $idProducto);

            $resultado = oci_execute($stmt);

            if (!$resultado) {
                $e = oci_error($stmt);
                throw new Exception("Error al cambiar estado del producto: " . $e['message']);
            }
            oci_free_statement($stmt);
        }

        public function obtenerProductos () {
            $productos = [];
            $idProducto = 1;

            while (true) {
                $sql = "BEGIN
                            FIDE_PK_KERAT_PKG.FIDE_OBTENER_PRODUCTOS_SP(:idProducto, :categoria, :estado, :nombre, :descripcion, :precio);
                        END;";

                $stmt = oci_parse($this->conn, $sql);
                    
                $categoria = "";
                $estado = "";
                $nombre = "";
                $descripcion = "";
                $precio = 0.00;
                                
                oci_bind_by_name($stmt, ":idProducto", $idProducto, 4000);        // In
                oci_bind_by_name($stmt, ":categoria", $categoria, 4000);          // Out
                oci_bind_by_name($stmt, ":estado", $estado, 4000);                // Out
                oci_bind_by_name($stmt, ":nombre", $nombre, 4000);                // Out
                oci_bind_by_name($stmt, ":descripcion", $descripcion, 4000);      // Out
                oci_bind_by_name($stmt, ":precio", $precio, 4000);                // Out
                                
                oci_execute($stmt);
                
                if ($nombre === null && $precio === null){
                    break;
                } 

                $productos[] = [
                    "id" => $idProducto,
                    "categoria" => $categoria,
                    "estado" => $estado,
                    "nombre" => $nombre,
                    "descripcion" => $descripcion,
                    "precio" => $precio
                ];
                
                $idProducto++;
            }
                
            oci_free_statement($stmt);
            return $productos;
        }
    }
?>